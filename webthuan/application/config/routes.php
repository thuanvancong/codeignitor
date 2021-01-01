<?php
defined('BASEPATH') OR exit('No direct script access allowed');

/*
| -------------------------------------------------------------------------
| URI ROUTING
| -------------------------------------------------------------------------
| This file lets you re-map URI requests to specific controller functions.
|
| Typically there is a one-to-one relationship between a URL string
| and its corresponding controller class/method. The segments in a
| URL normally follow this pattern:
|
|	example.com/class/method/id/
|
| In some instances, however, you may want to remap this relationship
| so that a different class/function is called than the one
| corresponding to the URL.
|
| Please see the user guide for complete details:
|
|	https://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There are three reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router which controller/method to use if those
| provided in the URL cannot be matched to a valid route.
|
|	$route['translate_uri_dashes'] = FALSE;
|
| This is not exactly a route, but allows you to automatically route
| controller and method names that contain dashes. '-' isn't a valid
| class or method name character, so it requires translation.
| When you set this option to TRUE, it will replace ALL dashes in the
| controller and method URI segments.
|
| Examples:	my-controller/index	-> my_controller/index
|		my-controller/my-method	-> my_controller/my_method
*/
$route['default_controller'] = 'Login_Controller/pageLogin';
$route['404_override'] = 'Custom404';
$route['translate_uri_dashes'] = FALSE;
$route['accessdenied'] = 'Accessdenied_Controller';
$route['homepage'] = 'quanlytrungtam';

/*---- ĐỊNH DANH ROUTER MENU ---*/
$route['menu/add'] = 'Menu/add';
$route['menu/update'] = 'Menu/update';
$route['menu/delete'] = 'Menu/delete';
$route['menu/index'] ='Menu/index';

/*---- ĐỊNH DANH ROUTER CONFIG ---*/
$route['config/add'] = 'Config/add';
$route['config/update'] = 'Config/update';
$route['config/delete'] = 'Config/delete';
$route['config'] ='Config/index';

/*---- ĐỊNH DANH ROUTER COURSE ---*/
$route['course/add'] = 'Course/add';
$route['course/update'] = 'Course/update';
$route['course/delete()'] = 'Course/delete';
$route['course'] = 'Course/index';

/*---- ĐỊNH DANH ROUTER CLASS ---*/
$route['class/add'] = 'Class_CI/add';
$route['class/update'] = 'Class_CI/update';
$route['class/delete'] = 'Class_CI/delete';
$route['class/index'] = 'Class_CI/index';

/*---- ĐỊNH DANH ROUTER STUDENT ---*/
$route['student/add'] = 'Student/add';
$route['student/update'] = 'Student/update';
$route['student/delete'] = 'Student/delete';
$route['student/updatelevel'] = 'Student/updatelevel';
$route['student'] = 'Student/index';

/*---- ĐỊNH DANH ROUTER TEACHER ---*/
$route['teacher/add'] = 'Teacher/add';
$route['teacher/update'] = 'Teacher/update';
$route['teacher/delete'] = 'Teacher/delete';
$route['teacher'] = 'Teacher/index';

/*---- ĐỊNH DANH ROUTER USER ---*/
$route['user/add'] = 'Users/add';
$route['user/update'] = 'Users/update';
$route['user/delete'] = 'Users/delete';
$route['user/updatepass'] = 'Users/updatepass';
$route['user/userrole'] = 'Userrole/index';
$route['user'] = 'Users/index';

/*---- ĐỊNH DANH ROUTER ROLE ---*/
$route['role/add'] = 'Role/add';
$route['role/update'] = 'Role/update';
$route['role/delete'] = 'Role/delete';
$route['role'] = 'Role/index';

/*---- ĐỊNH DANH ROUTER LOGIN ---*/
$route['login'] = 'Login_Controller/pageLogin';