<?php  if ( ! defined('BASEPATH')) exit('No direct script access allowed');
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
|	http://codeigniter.com/user_guide/general/routing.html
|
| -------------------------------------------------------------------------
| RESERVED ROUTES
| -------------------------------------------------------------------------
|
| There area two reserved routes:
|
|	$route['default_controller'] = 'welcome';
|
| This route indicates which controller class should be loaded if the
| URI contains no data. In the above example, the "welcome" class
| would be loaded.
|
|	$route['404_override'] = 'errors/page_missing';
|
| This route will tell the Router what URI segments to use if those provided
| in the URL cannot be matched to a valid route.
|
*/
//for home
$route['default_controller'] 	 		= 'home';
//$route['san-pham'] 	 				 = 'sanpham';
//$route['san-pham/chi-tiet']			 = 'sanpham/chitiet';
//$route['san-pham/chi-tiet/(:any)']	  = 'sanpham/chitiet';
//$route['san-pham/(:any)'] 			   = 'sanpham';

$route['gioi-thieu'] 				    = 'intro';
$route['gioi-thieu/(:any)'] 		     = 'intro';
$route['chinh-sach'] 				    = 'chinhsach';
$route['chinh-sach/(:any)'] 		     = 'chinhsach';
$route['thanh-toan'] 				    = 'thanhtoan';
$route['thanh-toan/(:any)'] 		     = 'thanhtoan';

$route['lien-he'] 					   = 'contact';
$route['lien-he/(:any)'] 			    = 'contact';


//for admin
$route['admin'] 				  	     = 'admin/login';
$route['404_override'] 				  = 'home';