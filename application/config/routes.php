<?php
defined('BASEPATH') OR exit('No direct script access allowed');
//$route['(:any)'] = 'login/$1';
$route['logout'] = 'login/logout';
$route['default_controller'] = 'login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
