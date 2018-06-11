<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
|--------------------------------------------------------------------------
| Display Debug backtrace
|--------------------------------------------------------------------------
|
| If set to TRUE, a backtrace will be displayed along with php errors. If
| error_reporting is disabled, the backtrace will not display, regardless
| of this setting
|
*/
defined('SHOW_DEBUG_BACKTRACE') OR define('SHOW_DEBUG_BACKTRACE', TRUE);

/*
|--------------------------------------------------------------------------
| File and Directory Modes
|--------------------------------------------------------------------------
|
| These prefs are used when checking and setting modes when working
| with the file system.  The defaults are fine on servers with proper
| security, but you may wish (or even need) to change the values in
| certain environments (Apache running a separate process for each
| user, PHP under CGI with Apache suEXEC, etc.).  Octal values should
| always be used to set the mode correctly.
|
*/
defined('FILE_READ_MODE')  OR define('FILE_READ_MODE', 0644);
defined('FILE_WRITE_MODE') OR define('FILE_WRITE_MODE', 0666);
defined('DIR_READ_MODE')   OR define('DIR_READ_MODE', 0755);
defined('DIR_WRITE_MODE')  OR define('DIR_WRITE_MODE', 0755);

/*
|--------------------------------------------------------------------------
| File Stream Modes
|--------------------------------------------------------------------------
|
| These modes are used when working with fopen()/popen()
|
*/
defined('FOPEN_READ')                           OR define('FOPEN_READ', 'rb');
defined('FOPEN_READ_WRITE')                     OR define('FOPEN_READ_WRITE', 'r+b');
defined('FOPEN_WRITE_CREATE_DESTRUCTIVE')       OR define('FOPEN_WRITE_CREATE_DESTRUCTIVE', 'wb'); // truncates existing file data, use with care
defined('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE')  OR define('FOPEN_READ_WRITE_CREATE_DESTRUCTIVE', 'w+b'); // truncates existing file data, use with care
defined('FOPEN_WRITE_CREATE')                   OR define('FOPEN_WRITE_CREATE', 'ab');
defined('FOPEN_READ_WRITE_CREATE')              OR define('FOPEN_READ_WRITE_CREATE', 'a+b');
defined('FOPEN_WRITE_CREATE_STRICT')            OR define('FOPEN_WRITE_CREATE_STRICT', 'xb');
defined('FOPEN_READ_WRITE_CREATE_STRICT')       OR define('FOPEN_READ_WRITE_CREATE_STRICT', 'x+b');

/*
|--------------------------------------------------------------------------
| Exit Status Codes
|--------------------------------------------------------------------------
|
| Used to indicate the conditions under which the script is exit()ing.
| While there is no universal standard for error codes, there are some
| broad conventions.  Three such conventions are mentioned below, for
| those who wish to make use of them.  The CodeIgniter defaults were
| chosen for the least overlap with these conventions, while still
| leaving room for others to be defined in future versions and user
| applications.
|
| The three main conventions used for determining exit status codes
| are as follows:
|
|    Standard C/C++ Library (stdlibc):
|       http://www.gnu.org/software/libc/manual/html_node/Exit-Status.html
|       (This link also contains other GNU-specific conventions)
|    BSD sysexits.h:
|       http://www.gsp.com/cgi-bin/man.cgi?section=3&topic=sysexits
|    Bash scripting:
|       http://tldp.org/LDP/abs/html/exitcodes.html
|
*/
defined('EXIT_SUCCESS')        OR define('EXIT_SUCCESS', 0); // no errors
defined('EXIT_ERROR')          OR define('EXIT_ERROR', 1); // generic error
defined('EXIT_CONFIG')         OR define('EXIT_CONFIG', 3); // configuration error
defined('EXIT_UNKNOWN_FILE')   OR define('EXIT_UNKNOWN_FILE', 4); // file not found
defined('EXIT_UNKNOWN_CLASS')  OR define('EXIT_UNKNOWN_CLASS', 5); // unknown class
defined('EXIT_UNKNOWN_METHOD') OR define('EXIT_UNKNOWN_METHOD', 6); // unknown class member
defined('EXIT_USER_INPUT')     OR define('EXIT_USER_INPUT', 7); // invalid user input
defined('EXIT_DATABASE')       OR define('EXIT_DATABASE', 8); // database error
defined('EXIT__AUTO_MIN')      OR define('EXIT__AUTO_MIN', 9); // lowest automatically-assigned error code
defined('EXIT__AUTO_MAX')      OR define('EXIT__AUTO_MAX', 125); // highest automatically-assigned error code
define('EXT', '.php');

//-- DEFAULT PAGER AND LIMIT
define("PAGER_PAGE_LIMIT", 20);
define("LIMIT_SEARCH", 20);
define('DEFAULT_LINK_VALUE', 'javascript:void(0);');

//-- session
define("USER_SESSION","sess_login_user");
define("ADMIN_SESSION","sess_login_admin");

//-- image type width and height
define("UPLOAD_PATH", "upload");
define("UPLOAD_PATH_AUDIO", "upload/audio");
define("UPLOAD_PATH_ANIMATION", "upload/animation");
define("UPLOAD_PATH_IMAGE", "upload/image");
define("UPLOAD_PATH_IMAGE_THUMB", "upload/image/thumb");

//-- FILES UPLOAD
define("FILE_TYPE_UPLOAD", "*");

define("MAX_UPLOAD_IMAGE_SIZE", 10485760);
define("MAX_UPLOAD_IMAGE_SIZE_IN_KB", 10240);
define("WORDS_MAX_UPLOAD_IMAGE_SIZE", "10 MB");

define("MAX_UPLOAD_FILE_SIZE", 104857600);
define("MAX_UPLOAD_FILE_SIZE_IN_KB", 102400);
define("WORDS_MAX_UPLOAD_FILE_SIZE", "100 MB");

//-- EMAIL
define("DEFAULT_EMAIL_FROM", "pejuangsubuh170317@gmail.com");
define("DEFAULT_EMAIL_FROM_NAME", "Administrator");
define("DEFAULT_EMAIL_RETURN_PATH", "pejuangsubuh170317@gmail.com");

define("SUBJECT_RESET_PASSWORD", "Reset Password Information");
define("SUBJECT_PASSWORD_INFO", "Password Information");
define("SUBJECT_LOGIN_INFO", "Login Information");

//-- session
define("USER_VALIDATED_SESSION", "_valid");
define("USER_VALIDATED_SESSION_TIMEBOMB", 60);

//-- Define status artikel
define("STATUS_DELETED", 0);
define("STATUS_ACTIVE", 1);
define("STATUS_EDITED", 2);
define("STATUS_CHECKED", 3);
define("STATUS_PUBLISH", 4);

//define kategori artikel
define("ARTIKEL_KATEGORI_KAJIAN", 45);
define("ARTIKEL_KATEGORI_BERITA", 46);
define("ARTIKEL_KATEGORI_INFO_DUNIA", 57);
define("ARTIKEL_KATEGORI_NASIONAL", 89);

//define
define("TITLE_WEBSITE", "Pejuang Subuh Blog");

//define view header/footer
define("HEADER_SIGN", "layout/manager/headers/header_sign");
define("FOOTER_SIGN", "layout/manager/footers/footer_sign");
define("HEADER_MANAGER", "layout/manager/headers/header");
define("FOOTER_MANAGER", "layout/manager/footers/footer");
define("LAYOUT_WEB_HEADER", "layout/front/header");
define("LAYOUT_WEB_FOOTER", "layout/front/footer");
define("LAYOUT_LOGIN_HEADER","layout/manager/headers/header_sign");
define("LAYOUT_LOGIN_FOOTER", "layout/manager/footers/footer_sign");

//define view 
define("VIEW_POPULAR_POST","index/front/popular_post");
define("VIEW_RECENT_POST", "index/front/recent_post");
define("VIEW_INFO_KAJIAN","index/front/info-kajian");

//date
define("NOW", date("Y-m-d H:i:s"));
