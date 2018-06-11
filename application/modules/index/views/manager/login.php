
<div class="row">
    <?php echo $this->session->flashdata('alert_failed') ?>
    <div class="login-header">
        <div class="col-md-8">
            <div class="well no-padding">
                <form action="<?php echo site_url() ?>manager/index/login" id="form-login" class="smart-form client-form" method="post">
                    <header>
                        <p class="font">
                        <strong><?php echo $title_page ?> </strong></p>
                    </header>
                    <fieldset>
                        <section>
                            <label class="label">Username</label>
                            <label class="input"> <i class="icon-append fa fa-user"></i>
                                <input type="text" name="username">
                                <b class="tooltip tooltip-top-right"><i class="fa fa-user txt-color-teal"></i> Please enter username</b></label>
                            </section>

                            <section>
                                <label class="label">Password</label>
                                <label class="input"> <i class="icon-append fa fa-lock"></i>
                                    <input type="password" name="password">
                                    <b class="tooltip tooltip-top-right"><i class="fa fa-lock txt-color-teal"></i> Enter your password</b> </label>
                                    <div class="note">
                                        <a href="<?php echo site_url() ?>admin/auth/forgot_password">Forgot password?</a>
                                    </div>
                                </section>
                            </fieldset>
                            <footer>
                                <button type="submit" class="btn btn-primary btn-submit">
                                    Sign in
                                </button>
                            </footer>
                        </form>
                    </div>

                    <h5 class="text-center"> - Or sign in using -</h5>
                    <ul class="list-inline text-center">
                        <li>
                            <a href="javascript:void(0);" class="btn btn-primary btn-circle"><i class="fa fa-facebook"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn btn-info btn-circle"><i class="fa fa-twitter"></i></a>
                        </li>
                        <li>
                            <a href="javascript:void(0);" class="btn btn-warning btn-circle"><i class="fa fa-linkedin"></i></a>
                        </li>
                    </ul>
                </div>
            </div>
        </div>
