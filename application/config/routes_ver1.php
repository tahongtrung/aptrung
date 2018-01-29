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

$route['default_controller'] = "home/index";
$route['404_override'] = '';

$route['([a-zA-Z0-9_-]+)'] = "home/index/$1";
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$route['adminvn/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)'] = 'admin/$1/$2';
$route['adminvn/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)/([a-zA-Z0-9_-]+)'] = 'admin/$1/$2/$3';
/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/

$route['adminvn/login'] = 'admin/admin/login';
$route['adminvn/logout'] = 'admin/admin/logout';
$route['adminvn'] = 'admin/news/index';
$route['adminvn/doi-mat-khau'] = 'admin/admin/admin_change_password';
$route['adminvn/site_option'] = 'admin/admin/site_option';

//Modules=================================================================
$route['adminvn/danh-sach-modules'] = 'admin/modules/list';
$route['adminvn/quan-ly-modules'] = 'admin/modules/modulemanager';
$route['adminvn/edit-modules/(:num)'] = 'admin/modules/modulemanager/$1';
$route['adminvn/delete-module/(:num)'] = 'admin/modules/delete/$1';

//phan quyen admin
$route['adminvn/admin-permission'] = 'admin/admin/admin_permission';
$route['adminvn/admin-permission-edit/(:num)'] = 'admin/admin/admin_permission/$1';
$route['adminvn/admin-reset-pass/(:num)'] = 'admin/admin/reset_pass/$1';
$route['adminvn/admin-permission-delete/(:num)'] = 'admin/admin/delete_acc/$1';

//================FRONT END=======================================================================================================

/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$route['home'] = "home/home";
//product-category-alias  + pc + cat_id
//$route['([a-zA-Z0-9_-]+)-([a-zA-Z0-9_-]+)'] = 'products/pro_bycategory/$1/$2';
//$route['([a-zA-Z0-9_-]+)-([a-zA-Z0-9_-]+)/(:num)'] = 'products/pro_bycategory/$1/$2/$3';

//$route['([a-zA-Z0-9_-]+)-tp(:num)'] = 'products/products_brand/$1/$2';
//$route['([a-zA-Z0-9_-]+)-tp(:num)/(:num)'] = 'products/products_brand/$1/$2/$3';

//$route['([a-zA-Z0-9_-]+)-ts(:num)'] = 'products/products_style/$1/$2';
//$route['([a-zA-Z0-9_-]+)-ts(:num)/(:num)'] = 'products/products_style/$1/$2/$3';

//product-category-alias/product-alias    + c + cat_id + p + product_id
//$route['([a-zA-Z0-9_-]+)-(:num)/(:num)-([a-zA-Z0-9_-]+)'] = 'products/productdetail/$1/$2/$3/$4';
$route['san-pham/([a-zA-Z0-9_-]+)-c(:num)p(:num)'] = 'products/productdetail/$1/$2/$3/$4';
$route['san-pham'] = 'products/allProduct';
$route['san-pham/(:num)'] = 'products/allProduct/$1';
$route['product/([a-zA-Z0-9_-]+)-c(:num)p(:num)'] = 'products/productdetail/$1/$2/$3/$4';
$route['product'] = 'products/allProduct';
$route['producteee/(:num)'] = 'products/allProduct/$1';
//news-category-alias  + nc + cat_id
$route['news-cat/(:num)-([a-zA-Z0-9_-]+)'] = 'news/news_bycat/$1/$2';
//news-category-alias/news-alias    + c + cat_id + p + newsid
//$route['([a-zA-Z0-9_-]+)/(:num)-(:num)/([a-zA-Z0-9_-]+)'] = 'news/news_content/$1/$2/$3/$4';


/*+++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++++*/
$route['page/(:num)-(:any)'] = 'pages/page_content/$1/$2';
$route['lien-he'] = 'contact';
$route['contact'] = 'contact';
$route['search-tour'] = 'products/Search_pro';
$route['advanced-search'] = 'products/advancedSearch';
$route['gop-y'] = 'comment';
$route['gio-hang'] = 'shoppingcart/check_out';
$route['xoa-gio-hang/([a-zA-Z0-9_-]+)'] = 'shoppingcart/delete/$1';
$route['dat-hang-ngay'] = 'shoppingcart/quickbuy';
$route['thanh-toan-dat-hang'] = 'shoppingcart/Payment';

/**User front end**/
$route['dang-nhap'] = 'users_frontend/signin';
$route['dang-xuat'] = 'users_frontend/signout';

/*++++++++++++++Nhat*/
$route['quan-ly-gio-hang'] = 'users_frontend/user_orders';
$route['quan-ly-gio-hang/(:num)'] = 'users_frontend/user_orders/$1';
$route['quan-ly-san-pham'] = 'users_frontend/products';
$route['them-san-pham'] = 'users_frontend/product_add';
$route['sua-san-pham/(:num)'] = 'users_frontend/product_add/$1';
$route['quan-ly-danh-muc'] = 'users_frontend/categories';
$route['quan-ly-dia-diem'] = 'users_frontend/shopLocation';
$route['them-dia-diem'] = 'users_frontend/addShopLocation';
$route['sua-dia-diem/(:num)'] = 'users_frontend/addShopLocation/$1';
$route['xoa-dia-diem/(:num)'] = 'users_frontend/deleteShopLocation/$1';
$route['them-danh-muc'] = 'users_frontend/user_cat_add';
$route['sua-danh-muc/(:num)'] = 'users_frontend/user_cat_add/$1';
$route['xoa-danh-muc/(:num)'] = 'users_frontend/user_cat_del/$1';
/*++++++++++++++*/

$route['users/check-pass'] = 'users_frontend/check_old_pass';
$route['users/check-email'] = 'users_frontend/check_email';
$route['users/check-register-user'] = 'users_frontend/checkRegisterUser';

$route['doi-mat-khau'] = 'users_frontend/changePass';
$route['thong-tin-tai-khoan'] = 'users_frontend/changProfiler';
$route['dang-ky'] = 'users_frontend/signup';
$route['dang-ky-gian-hang'] = 'users_frontend/registerShop';
$route['dang-ky-thanh-cong'] = 'users_frontend/success_signup';
$route['quen-mat-khau'] = 'users_frontend/forgot_pass';
$route['cap-lai-mat-khau'] = 'users_frontend/forgot_pass';
$route['kich-hoat-thanh-cong'] = 'users_frontend/success_active_user';
$route['kick-hoat'] = 'users_frontend/atuto_active_user';

/*thuonghieunoitieng*/
$route['thuong-hieu-noi-tieng'] = 'products/brandAll';
$route['thuong-hieu-noi-tieng/(:num)'] = 'products/brandAll/1';

//Chat
$route['adminvn/chat-manager'] = 'admin/chat/chat_manager_admin';
$route['adminvn/message-offline-manager'] = 'admin/chat/message_offline_manager';
$route['adminvn/message-offline-manager/(:num)'] = 'admin/chat/message_offline_manager/$1';
$route['adminvn/message-manager'] = 'admin/chat/message_manager';
$route['adminvn/message-manager/(:num)'] = 'admin/chat/message_manager/$1';
$route['adminvn/chat/del-transcript/(:num)/(:any)'] = 'admin/chat/Delete_transcript/$1/$2';
$route['adminvn/chat-setting'] = 'admin/chat/Chat_setting';
$route['adminvn/customer-manager'] = 'admin/chat/customer_manager';
$route['adminvn/customer-manager/(:num)'] = 'admin/chat/customer_manager/$1';
//Chat frontend===========================================================
$route['get-message'] = 'chat_frontend/get_message';
$route['create-session'] = 'chat_frontend/create_session';
$route['remove-session'] = 'chat_frontend/remove_session';
$route['insert-message'] = 'chat_frontend/insert_message';
$route['insert-message-off'] = 'chat_frontend/insert_message_off';
//Dat ve may bay
$route['dat-ve-may-bay'] = 'booking/airPort';
$route['search'] = 'home/search';
/***User profiles***/
$route['quan-ly-tai-chinh'] = 'profile/financeManager';
$route['nap-tien'] = 'profile/recharge';
$route['tai-lieu-download'] = 'profile/getFiledownloaded';
$route['tags/(:any)'] = 'products/tags/$1';