<?php if
(! defined('BASEPATH') ) exit ('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| Hooks
| -------------------------------------------------------------------------
| This file lets you define "hooks" to extend CI without hacking the core
| files.  Please see the user guide for info:
|
|	https://codeigniter.com/user_guide/general/hooks.html
|
*/

function get_uploaded_file_extention($str)
{
	preg_match('/[0-9a-zA-Z]*$/', $str, $matches);

	if ( empty($matches) )
		return '.jpg';
	else if ( $matches[0] == 'jpg' )
		return '.jpg';
	else if ( $matches[0] == 'png' )
		return '.png';
	else if ( $matches[0] == 'bmp' )
		return '.bmp';
	else
		return '.'.$matches[0];
}