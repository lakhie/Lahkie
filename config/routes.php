<?php

//Less define our simple routes in this file to help us map to the exact methods in our project

$route['']                          =               "functions/index";

$route['dashboard']                 =               "dashboard/index";
$route['complete/user/profile']     =               "functions/first_step";
$route['fb_auth']                   =               "functions/fb_auth";
$route['login']                     =               "functions/login";
$route['register']                  =               "functions/register";
$route['search/school']             =               "functions/search_school";
$route['school/sub']                =               "dashboard/get_school_for_subscriptions";
$route['school/subscribe']          =               "functions/subscribe_to_school";
$route['student/subscriptions']     =               "dashboard/student_applications";
$route['user/profile']              =               "dashboard/user_profile";
$route['user/update_profile']       =               "dashboard/update_user_profile";


//Two arguments
$route['register/(:any)']           =               "functions/apply/1/2";
$route['school/edit/(:any)']        =               "dashboard/edit_school/1";