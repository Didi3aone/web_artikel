<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/**
 * Auth controllers class
 *
 * @package     DHY CMS
 * @subpackage  Controllers
 * @category    Controllers
 * @author      Didi Triawan
 */
class Index_manager extends CI_Controller {

    protected  $_currentUser;
    private    $_view = 'index/manager/';

    function __construct() {
        parent::__construct();
        

        $this->load->library('form_validation');
        $this->load->model('user/User_model');
        $this->load->helper('base');

    }
    
    public function index()
    { 
        $header = array(
            "title"      => "Login Admin",   
                'css' => array(
                    'asset/css/sweetalert2.css'
            )
        );

        $data = array(
             "title_page" =>  "Login Administrator", 
        );

       $footer = array(
            'js' => array(
                'asset/js/plugins/sweetalert.min.js',
                'asset/js/pages/login.js'
            )
        );
       
        $this->load->view(LAYOUT_LOGIN_HEADER, $header);
        $this->load->view($this->_view.'login',$data);
        $this->load->view(LAYOUT_LOGIN_FOOTER, $footer);
    }

    function login() 
    {
         // Must AJAX and POST
        if (!$this->input->is_ajax_request() || $this->input->method(true) != "POST") {
            exit('No direct script access allowed');
        }

        // Declare variable here
        $message['is_error']    = true;
        $message['error_msg']   = "";
        $message['redirect_to'] = "";

        //validation
        $this->form_validation->set_rules('username', 'Username', 'trim|required');
        $this->form_validation->set_rules('password', 'Password', 'trim|required');
        
        if($this->form_validation->run() == false) {
            // Validation failed
            $message['error_msg'] = validation_errors();;
        } 
        else {

            $username = $this->input->post('username');
            $password = sha1($this->input->post('password'));
            
            $user = $this->User_model->check_login($username ,$password);
            // pr($user);exit;
            if ($user) {
                $this->session->set_userdata(ADMIN_SESSION, $user);
                $this->session->set_userdata("user_id", $user['user_id']);

                // pr($user);exit;
                //set message
                $message['is_error']      = false;
                $message['notif_title']   = "Excellent!";
                $message['notif_message'] = "Login succes";
                $message['redirect_to']   = site_url('manager/dashboard');
                //update login time
                $update = array(
                    'last_login_time' => date('Y-m-d H:i:s'),
                );
                //get user login
                $get_user = $this->User_model->get_all_data(array(
                    "row_array" => true,
                    "conditions" => array("user_id" => $user['user_id'])
                ))['datas'];

                $result = $this->User_model->update($update, $get_user);
            } 
            else {
                // Login failed
                $message['error_msg']   = "Username or Password is wrong!";
            }
        }  
        // Send response to AJAX
        $this->output->set_content_type('application/json');
        echo json_encode($message);
        exit;
    }

    public function logout()
    {
        $this->session->sess_destroy();
        redirect('admin/auth');
    }

    public function forgot_password() 
    {
        //validation
        $this->form_validation->set_rules("email","Email","trim|required|valid_email");
        
        //plugin and script
        $header = array(
            "title" => "Forgot Password"
        );

        $footer = array(
            "js" => array(
                "asset/js/pages/login.js"
            )
        );

        if($this->form_validation->run() == false) {

            //send error
            $error_message = validation_errors();
            $this->session->set_flashdata("message", $error_message);
            $this->session->set_flashdata("alert", "danger");
        } else {

            //get the post values.
            $email = $this->input->post('email');

            //check to the model if the email is correct.
            $result = $this->User_model->get_all_data(array(
                "row_array" => true,
                "conditions" => array("email" => $email),
            ))['datas'];

            //validate result
            if($result) {
                //send email
                
                //start begin
                $this->db->trans_begin();

                //send url 
                $forgot_link = $this->User_model->send_forgot_pass($result);

                //end transaction
                if($this->db->trans_status() == false) {

                    //error
                    $this->session->set_flashdata("message","there is something wrong. please retry input your email.");
                    $this->session->set_flashdata('alert','danger');
                } else {
                    //success
                    $this->db->trans_commit();

                    //send email to user with the reset password
                    $content = $this->load->view('admin/forgot_pass','',true);
                    $content = str_replace('%NAME%', $result['name'], $content);
                    $content = str_replace('%LINK%', $forgot_link, $content);

                    $mail = sendmail (array(
                        'sucject' => 'RESET PASSWORD',
                        'message' => $content,
                        'to'      => array($result['email']),
                    ),"html");

                    $this->session->set_flashdata("message", "Check your email");
                    $this->session->set_flashdata('alert','success');
                }
            } else {

                $this->session->set_flashdata('message',' Email is wrong');
                $this->session->set_flashdata('alert','danger');
            }
        }

        $this->load->view(LAYOUT_LOGIN_HEADER, $header);
        $this->load->view($this->_view.'forgot_pass');
        $this->load->view(LAYOUT_LOGIN_FOOTER, $footer);
    }

    /**
     * function to reset password.
     * from link in reset password email.
     */
    public function reset_password($code) {

        //load model.
        $this->load->model('user/User_model');

        //check code.
        if (!$code) {
            show_404();
        }

        //decode code.
        $code_decoded = base64_decode(urldecode($code));

        //check code if exist.
        $user = $this->User_model->checkCode($code_decoded);
        if (!$user) {
            show_404();
        }

        if ($user['end_forgotpass_time'] < strtotime("now")) {
            show_404();
        }

        //begin transaction.
        $this->db->trans_begin();

        //reset passsword.
        $new_pass = $this->User_model->reset_password($user);

        //end transaction.
        if ($this->db->trans_status() === FALSE) {
            $this->db->trans_rollback();

            //some kind of DB problem?
            show_404();

        } else {
            //success and commiting.
            $this->db->trans_commit();

            //send email for the newly generated password.
            //get content from view
            $content = $this->load->view('layout/email/reset_password', '', true);
            $content = str_replace('%NAME%',$user['name'],$content);
            $content = str_replace('%NEW_PASS%',$new_pass,$content);

            $mail = sendmail (array(
                'subject'   => SUBJECT_PASSWORD_INFO,
                'message'   => $content,
                'to'        => array($user['email']),
            ), "html");

            //close window
            echo "<script>window.close();</script>";
        }
    }
}