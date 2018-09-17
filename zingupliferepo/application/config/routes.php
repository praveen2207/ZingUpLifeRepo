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
  |	http://codeigniter.com/user_guide/general/routing.html
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


$route['record_users_assessment_steps'] = 'Survey/record_users_assessment_steps';


$route['default_controller'] = 'Home';
$route['404_override'] = 'my404'; // adding custom controller.

$route['translate_uri_dashes'] = FALSE;


//Assessment Users
$route['admin/assessment'] = "admin/assessment/interpretation_users";


/* added by anitha */

//Recommended goals list
$route['goals'] ="Prat_recommended_goals/index";

$route['sitemap'] = "Home/sitemap";

/* Route for partner login */
$route['partner'] = "Business_providers/partner_login";

/* Route for partner login */
$route['do_partner_login'] = "Business_providers/do_partner_login";

/* Route for partner editprofile */
$route['vendor/dashboard'] = "Business_providers/partner_editprofile";


/* Route for adding business information */
$route['vendor/business_information'] = "Business_providers/business_information";

/* Route for adding business information */
$route['vendor/adding_business_information'] = "Business_providers/adding_business_information";

/* Route for packages and treatments */
$route['vendor/packages_treatments'] = "Business_providers/packages_treatments";

/* Route for adding business programs */
$route['adding_business_programs'] = "Business_providers/adding_business_programs";

/* Route for adding business services */
$route['vendor/adding_business_services'] = "Business_providers/adding_business_services";

/* Route for adding business services */
$route['vendor/success'] = "Business_providers/success";

/* Route for partner registration */
$route['vendor/joining_network'] = "Business_providers/joining_network";

/* Route for partner registration */
$route['vendor/registration'] = "Business_providers/partner_registration";

/* Route for partner registration */
$route['vendor/do_registration'] = "Business_providers/do_registration";

/* Route for partner registration */
$route['vendor/email_verification'] = "Business_providers/email_verification";

/* Route for partner registration */
$route['vendor/email_verification/(:any)'] = "Business_providers/verify_email";

/* Route for partner registration */
$route['vendor/verify_vendor_email'] = "Business_providers/verify_vendor_email";


/* Route for partner registration */
$route['vendor/business_info'] = "Business_providers/business_info";

/* Route for partner registration */
$route['vendor/review_submit'] = "Business_providers/review_submit";

/* Route for partner registration */
$route['vendor/add_registration'] = "Business_providers/add_partner_registration";

/* Route for update_profile */
$route['update_vendorprofile'] = "Business_providers/update_partnerprofile";

/* Route for business service slots */
$route['vendor/business_service_slots'] = "Business_providers/business_service_slots";

/* Route for adding business services slots */
$route['vendor/adding_business_service_slots'] = "Business_providers/adding_business_service_slots";

/* Route for getting business services by program */
$route['get_business_services'] = "Business_providers/get_business_services_by_program";

/* Route for partner forgot password */
$route['vendor/forgot_password'] = "Business_providers/partner_forgot_password";

/* Route for partner forgot password mail */
$route['vendor/reset_password_request'] = "Business_providers/partner_reset_password_request";

/* Route for validating password token */
$route['vendor/reset_password/(:any)'] = "Business_providers/partner_reset_password";

/* Route for storing partner new password */
$route['vendor/store_new_password'] = "Business_providers/store_partner_new_password";

/* Route for business service listing */
$route['confirm_page'] = "Business_providers/confirm_page";

/* Route for business service listing */
$route['vendor/business_service_list'] = "Business_providers/business_service_list";

/* Route for business service listing */
$route['vendor/business_service_edit/(:any)'] = "Business_providers/business_service_edit";

/* Route for updating business service  */
$route['vendor/updating_business_services'] = "Business_providers/updating_business_services";

/* Route for business service listing */
$route['vendor/packages_treatmets_listing'] = "Business_providers/packages_treatmets_listing";

/* Route for business service listing */
$route['vendor/delete_business_services'] = "Business_providers/delete_business_services";


/* Route for business service listing */
$route['vendor/delete_business_package'] = "Business_providers/delete_business_package";


/* Route for business service listing */
$route['vendor/business_package_edit/(:any)'] = "Business_providers/business_package_edit";

/* Route for business service listing */
$route['vendor/updating_business_program'] = "Business_providers/updating_business_program";

/* Route for business service listing */
$route['vendor/delete_business_gallery_image'] = "Business_providers/delete_business_gallery_image";

/* Route for business service listing */
$route['vendor/delete_business_service_gallery_image'] = "Business_providers/delete_business_service_gallery_image";
/* added by anitha */

/* Route for displaying list of locations by service */
$route['get_locations_by_service'] = "Business_providers";

/* Route for displaying list of business providers by service and location */
$route['getVendor'] = "Business_providers/get_business_providers_list";

/* Route for displaying vendor details */
$route['vendorDetails/(:any)'] = "Business_providers/show_business_provider_details";

/* Route for displaying About us page */
$route['about_us'] = "Static_pages/get_static_pages";

/* Route for displaying terms page */
$route['terms'] = "Static_pages/terms";

/* Route for displaying terms page */
$route['privacy'] = "Static_pages/privacy";


/* Route for displaying Feedback page */
$route['feedback'] = "Static_pages/get_static_pages";

/* Route for displaying Customer support page */
$route['customer_support'] = "Static_pages/customer_support";

/* Route for displaying Register as vendor page */
$route['register_as_partner'] = "Static_pages/get_static_pages";

/* Route for displaying Contact us page */
$route['contact_us'] = "Static_pages/contact_us";

/* Route for sigin redirecting page */
$route['signin_success'] = "Users/signin_success";

/* Route for displaying user registration form */
$route['register'] = "Users/register";

/* Route for displaying user registration form */
$route['register_success'] = "Users/register_success";

/* Route for displaying user registration form */
$route['do_registration'] = "Users/do_registration";

/* Route for user account activation */
$route['activate_account/(:any)'] = "Users/activate_account";
/* $route['my_profile/(:num)'] = "Users/my_profile/$1"; */

/* Route for displaying login form */
$route['login'] = "Users/login";

/* Route for doing login process */
$route['do_login'] = "Users/do_login";

/* Route for doing facebook login process */
$route['facebook_login'] = "Users/facebook_login";

/* Route for displaying forgot password form */
$route['forgot_password'] = "Users/forgot_password";

/* Route for sending reset password link to user */
$route['reset_password_request'] = "Users/reset_password_request";

/* Route for validating password token */
$route['reset_password/(:any)'] = "Users/reset_password";

/* Route for validating otp password token */
$route['reset_password'] = "Users/reset_password_otp";

/* Route for reseting user account password */
$route['store_new_password'] = "Users/store_new_password";

/* Route for loading enter reset password otp page */
$route['enter_otp'] = "Users/enter_otp";

/* Route for checking reset password otp */
$route['validate_otp'] = "Users/enter_otp_check";

/* Route for doing google login process */
$route['google_login'] = "Users/google_login";

/* Route for doing logout */
$route['logout'] = "Users/logout";

/* Route for displaying user dashboard page */
/*$route['dashboard'] = "Users/dashboard";*/
/* Route for displaying user profile page */
$route['my_profile'] = "Users/my_profile";

/* $route['my_profile/(:num)'] = "Users/my_profile/$1"; */
/* Route for displaying edit user profile page */
$route['edit_profile'] = "Users/edit_profile";

/* Route for updating user profile */
$route['update_profile'] = "Users/update_profile";

/* Route for displaying list of user's transactions */
$route['my_bookings'] = "Booking/my_bookings";

/* Route for displaying list of user's transactions */
$route['my_upcoming_bookings'] = "Booking/my_upcoming_bookings";

/* Route for displaying list of user's transactions */
$route['my_past_bookings'] = "Booking/my_past_bookings";


/* Route for displaying transaction details */
$route['transaction_details/(:any)'] = "Booking/transaction_details";

/* Route for displaying list of user's bookings */
$route['order_details/(:any)'] = "Booking/order_details";

/* Route for generating pdf */
$route['pdf/(:any)'] = "pdf";

/* Route for rescheduling the order */
$route['cancel_order/(:any)'] = "Booking/cancel_order";


/* Route for rescheduling the order */
$route['reschedule/(:any)'] = "Booking/reschedule_order";

/* Route for displaying rescheduling time page for the order */
$route['reschedule_time/(:any)'] = "Booking/reschedule_order_time";

/* Route for displaying rescheduling date page for the order */
$route['reschedule_date/(:any)'] = "Booking/reschedule_order_date";

/* Route for rescheduling time for the order */
$route['confirm_reschedule_time'] = "Booking/confirm_rescheduling_time";

/* Route for rescheduling date for the order */
$route['confirm_reschedule_date'] = "Booking/confirm_rescheduling_date";

/* Route for rescheduling success message */
$route['reschedule_success'] = "Booking/rescheduling_success";

/* Route for getting locations by service */
$route['locationsService/(:any)'] = "Locations/get_locations_by_service";

/* Route for getting locations by city */
$route['locationsCity/(:any)/(:any)'] = "Locations/get_locations_by_city";

/* Route for getting near by locations */
$route['nearLocations'] = "Locations/get_near_by_locations";

/* Route for getting services by location */
$route['servicesListLocation/(:any)'] = "Services_locations/get_services_list_by_location";

/* Route for displaying list of locations by service */
//$route['selectLocation/(:any)'] = "Business_providers";
$route['(:any)'] = "Business_providers";

/* Route for displaying list of business providers by service and locations */
$route['(:any)/location/(:any)'] = "Business_providers/get_business_providers_list";

/* Route for displaying providers details */
$route['providerDetails/(:any)'] = "Business_providers/show_business_provider_details";

/* Route for displaying offering programs list by business provider */
$route['offeringPrograms/(:any)'] = "Business_offerings/get_offering_programs_list";

/* Route for getting offerings services list */
$route['offeringServices/(:any)'] = "Business_offerings/get_business_offering_services_list";

/* Route for getting  offering service details */
$route['offeringServiceDetails/(:any)'] = "Business_offerings/get_business_offering_services_details";

/* Route for choosing date for booking */
$route['chooseBookingDate'] = "Booking/choose_booking_date";

/* Route for choosing date for booking */
$route['chooseBookingTime'] = "Booking/choose_booking_time";

/* Route for user signup for booking */
$route['signup'] = "Users/signup";

/* Route for user signin for booking */
$route['signin'] = "Users/signin";

/* Route for checking user signin for booking */
$route['sign_in'] = "Users/sign_in";

/* Route for choosing date for booking */
$route['review_booking_details'] = "Booking/review_booking_details";

/* Route for choosing date for booking payment */
$route['payment'] = "Booking/payment";

/* Route for choosing date for booking payment */
$route['payment_process'] = "Booking/payment_process";




/* Route for choosing date for booking payment */
$route['paymentSuccess'] = "Booking/payment_success";

/* Route for choosing date for booking payment */
$route['paymentFailure'] = "Booking/payment_failure";


/* Route for displaying users notifications */
$route['notifications'] = "Users/notifications";
$route['users/notifications'] = "Users/user_notifications";

/* Route for displaying users notifications */
$route['customer_support/(:any)'] = "Booking/contact_to_vendor";

/* Route for choosing date for membership booking */
$route['chooseMembershipBookingDate'] = "Booking/choose_membership_booking_date";


/* Route for choosing date for membership booking */
$route['membershipSignup'] = "Users/membership_signup";
/* Route for choosing date for membership booking */
$route['membership_signin'] = "Users/membership_signin";


/* Route for choosing date for booking */
$route['review_membership_details'] = "Booking/review_membership_details";

/* Route for choosing date for booking */
$route['membership_payment'] = "Booking/membership_payment";

/* Route for choosing date for booking */
$route['membership_payment_process'] = "Booking/membership_payment_process";

/* Route for choosing date for booking payment */
$route['membership_payment_success'] = "Booking/membership_payment_success";

/* Route for choosing date for booking payment */
$route['membership_payment_failure'] = "Booking/membership_payment_failure";

/* Route for choosing date for booking payment */
$route['reschedule_membership_date/(:any)'] = "Booking/reschedule_membership_date";

/* Route for choosing date for booking payment */
$route['membership_rescheduling_success'] = "Booking/membership_rescheduling_success";

/*Route for going to user dashboard*/
$route['individual_dashboard'] ="Users/individual_dashboard";









/* Routes for Admin Section */

/* Route for displaying login form for admin section */
$route['admin'] = "admin/Users/login";

/* Route for displaying login form for admin section */
$route['admin/do_login'] = "admin/Users/do_login";

/* Route for displaying login form for admin section */
$route['admin_logout'] = "admin/Users/logout";

/* Route for forgot password for  admin section */
$route['admin/forgot_password'] = "admin/Users/forgot_password";

/* Route for sending reset password link to admin */
$route['admin/reset_password_request'] = "admin/Users/reset_password_request";

/* Route for validating password token */
$route['admin/reset_password/(:any)'] = "admin/Users/reset_password";

/* Route for reseting admin user account password */
$route['admin/store_new_password'] = "admin/Users/store_new_password";

/* Route for displaying login form for admin section */
$route['customer_support/transactions'] = "admin/Transactions/customer_support_transactions";

/* Route for displaying customer_support transactions search admin */
$route['customer_support/transactions_search'] = "admin/Transactions/customer_support_transactions_search";

/* Route for displaying customer_support transactions search admin */
$route['customer_support/transactions_filter'] = "admin/Transactions/customer_support_transactions_filter";

/* Route for displaying login form for admin section */
$route['customer_support/vendors'] = "admin/Vendors/customer_support_vendors";

/* Route for displaying login form for admin section */
$route['customer_support/vendors/(:any)'] = "admin/Vendors/customer_support_vendors_filter";

/* Route for displaying login form for admin section */
$route['customer_support/vendor_details/(:any)'] = "admin/Vendors/customer_support_vendors_details";

/* Route for displaying login form for admin section */
$route['update_vendor_notes'] = "admin/Vendors/update_vendor_notes";

/* Route for displaying search filter */
$route['customer_support/vendors/search_filter'] = "admin/Vendors/customer_support_vendors_search_filter";

/* Route for displaying login form for admin section */
$route['customer_support/customers'] = "admin/Customers/get_all_customers";

/* Route for displaying login form for admin section */
$route['customer_support/customer_details/(:any)'] = "admin/Customers/customers_details";

/* Route for displaying login form for admin section */
$route['customer_support/customers_filter'] = "admin/Customers/customers_filter";

/* Route for displaying login form for admin section */
$route['customer_support/customer_search'] = "admin/Customers/get_customer_filter_search";


/* Route for displaying login form for admin section */
$route['customer_support/customer_transactions_filter'] = "admin/Customers/customer_transactions_sorting";


/* Route for displaying login form for admin section */
$route['customer_support/faqs'] = "admin/Faqs";

/* Route for displaying login form for admin section */
$route['customer_support/vendor_transactions_filter'] = "admin/Vendors/cs_vendor_transactions_sorting";










/* Route for displaying login form for admin section */
$route['finance/transactions'] = "admin/Transactions/finance_transactions";

/* Route for displaying login form for admin section */
$route['finance/vendors'] = "admin/Vendors/finance_vendors";

/* Route for displaying login form for admin section */
$route['finance/vendors/(:any)'] = "admin/Vendors/finance_vendors_filter";

/* Route for displaying login form for admin section */
$route['finance/vendor_details/(:any)'] = "admin/Vendors/finance_vendors_details";

/* Route for displaying login form for admin section */
$route['finance/batch_payment/(:any)'] = "admin/Vendors/batch_payment_for_vendor";

/* Route for displaying login form for admin section */
$route['finance/payment_details/(:any)/(:any)'] = "admin/Vendors/batch_payment_details_for_vendor";

/* Route for displaying login form for admin section */
$route['finance/customers'] = "admin/Customers/get_all_customers_for_finance";

/* Route for displaying login form for admin section */
$route['finance/customer_details/(:any)'] = "admin/Customers/customers_details_for_finance";

/* Route for displaying login form for admin section */
$route['finance/customer_transactions_filter'] = "admin/Customers/customer_transactions_sorting";

/* Route for displaying login form for admin section */
$route['finance/customer_search'] = "admin/Customers/get_customer_filter_search";

/* Route for displaying search filter */
$route['finance/vendors/search_filter'] = "admin/Vendors/finance_vendors_search_filter";

/* Route for displaying login form for admin section */
$route['finance/vendor_transactions_filter'] = "admin/Vendors/finance_vendor_transactions_sorting";

/* Route for displaying login form for admin section */
$route['finance/transaction_search_filter'] = "admin/Transactions/finance_transactions_listing_filter";

/* Route for displaying login form for admin section */
$route['finance/transaction_search_filter_sorting'] = "admin/Transactions/finance_transactions_listing_sorting";








/* Route for displaying login form for admin section */
$route['admin/transactions'] = "admin/Transactions/admin_transactions";

/* Route for displaying customer_support transactions search admin */
$route['admin/transactions_search'] = "admin/Transactions/admin_transactions_search";

/* Route for displaying customer_support transactions search admin */
$route['admin/transactions_filter'] = "admin/Transactions/admin_transactions_filter";

/* Route for displaying login form for admin section */
$route['admin/vendors'] = "admin/Vendors/admin_vendors";

/* Route for displaying login form for admin section */
$route['admin/vendors/(:any)'] = "admin/Vendors/admin_vendors_filter";

/* Route for displaying login form for admin section */
$route['admin/vendor_details/(:any)'] = "admin/Vendors/admin_vendors_details";

/* Route for displaying search filter */
$route['admin/vendors/search_filter'] = "admin/Vendors/admin_vendors_search_filter";

/* Route for displaying login form for admin section */
$route['admin/delete_vendor'] = "admin/Vendors/delete_vendor";

/* Route for displaying login form for admin section */
$route['admin/update_vendor_status'] = "admin/Vendors/update_vendor_status";


/* Route for displaying login form for admin section */
$route['admin/customers'] = "admin/Customers/get_all_customers_for_admin";

/* Route for displaying login form for admin section */
$route['admin/customer_details/(:any)'] = "admin/Customers/admin_customers_details";

/* Route for displaying login form for admin section */
$route['admin/edit_customer_details/(:any)'] = "admin/Customers/edit_customers_details";

/* Route for displaying login form for admin section */
$route['admin/update_customer'] = "admin/Customers/update_customer";

/* Route for displaying login form for admin section */
$route['admin/delete_customer'] = "admin/Customers/delete_customer";

/* Route for displaying login form for admin section */
$route['admin/customers_filter'] = "admin/Customers/customers_filter";

/* Route for displaying login form for admin section */
$route['admin/customer_search'] = "admin/Customers/get_customer_filter_search";

/* Route for displaying login form for admin section */
$route['admin/customer_transactions_filter'] = "admin/Customers/customer_transactions_filter";


/* Route for displaying login form for admin section */
$route['admin/vendor_transactions_filter'] = "admin/Vendors/vendor_transactions_sorting";






/* Route for displaying login form for admin section */
$route['admin/users'] = "admin/Users/get_all_users";

/* Route for displaying login form for admin section */
$route['admin/user_details/(:any)'] = "admin/Users/user_details";

/* Route for displaying login form for admin section */
$route['admin/edit_user_details/(:any)'] = "admin/Users/edit_user_details";

/* Route for displaying login form for admin section */
$route['admin/update_user'] = "admin/Users/update_user";

/* Route for displaying login form for admin section */
$route['admin/add_user'] = "admin/Users/add_user";


/* Route for displaying login form for admin section */
$route['admin/user_search'] = "admin/Users/search_user";


/* Route for displaying login form for admin section */
$route['admin/create_users'] = "admin/Users/create_users";

/* Route for displaying login form for admin section */
$route['admin/delete_user'] = "admin/Users/delete_user";

/* Route for displaying login form for admin section */
$route['admin/user_roles'] = "admin/Users/get_user_roles";

/* Route for displaying login form for admin section */
$route['admin/delete_role'] = "admin/Users/delete_user_roles";


/* Route for confirm order */
$route['customer_support/confirm_order'] = "admin/Transactions/confirm_order";

/* Route for mark as attend */
$route['customer_support/mark_attend'] = "admin/Transactions/mark_attend";

/* Route for remind customer */
$route['customer_support/remind_customer'] = "admin/Transactions/remind_customer";

/* Route for order details */
$route['customer_support/order_details/(:any)'] = "admin/Transactions/view_order_details";

/* Route for reschedule order page */
$route['customer_support/reschedule_order/(:any)'] = "admin/Transactions/reschedule_order";

/* Route for reschedule date page */
$route['customer_support/reschedule_date/(:any)'] = "admin/Transactions/reschedule_date";

/* Route for reschedule time page */
$route['customer_support/reschedule_time/(:any)'] = "admin/Transactions/reschedule_time";


/* Route for confirm reschedule date page */
$route['customer_support/confirm_reschedule_date'] = "admin/Transactions/confirm_reschedule_date";

/* Route for confirm reschedule time page */
$route['customer_support/confirm_reschedule_time'] = "admin/Transactions/confirm_reschedule_time";

/* Route for reschedule success page */
$route['customer_support/reschedule_success'] = "admin/Transactions/reschedule_success";

/* Route for faq filter */
$route['customer_support/faq_filter'] = "admin/Faqs/faq_filter";

/* Route for displaying rder details page for finance */
$route['finance/order_details/(:any)'] = "admin/Transactions/finance_order_details";

/* Route for remind customer */
$route['admin/remind_customer'] = "admin/Transactions/admin_remind_customer";

/* Route for mark as attend */
$route['admin/mark_attend'] = "admin/Transactions/admin_mark_attend";

/* Route for confirm order */
$route['admin/confirm_order'] = "admin/Transactions/admin_confirm_order";

/* Route for displaying rder details page for finance */
$route['admin/order_details/(:any)'] = "admin/Transactions/admin_order_details";

/* Route for reschedule order page */
$route['admin/reschedule_order/(:any)'] = "admin/Transactions/admin_reschedule_order";

/* Route for reschedule date page */
$route['admin/reschedule_date/(:any)'] = "admin/Transactions/admin_reschedule_date";

/* Route for reschedule time page */
$route['admin/reschedule_time/(:any)'] = "admin/Transactions/admin_reschedule_time";

/* Route for confirm reschedule date page */
$route['admin/confirm_reschedule_date'] = "admin/Transactions/admin_confirm_reschedule_date";

/* Route for confirm reschedule date page */
$route['admin/confirm_reschedule_time'] = "admin/Transactions/admin_confirm_reschedule_time";

/* Route for reschedule success page */
$route['admin/reschedule_success'] = "admin/Transactions/admin_reschedule_success";

/* Route for change slot status */
$route['change_slot_status'] = "Users/change_slot_status";

/* Route for change slot status */
$route['update_slot_counter'] = "Users/update_slot_counter";

/* Route for admin reset password */
$route['admin/reset_password'] = "admin/Users/admin_reset_password";

/* Route for admin reset password */
$route['admin/new_password'] = "admin/Users/admin_new_password";


/* Route for displaying login form for admin section */
$route['customer_support/download'] = "admin/Transactions/customer_support_transactions_download";






/* Route for admin analytic */
$route['admin/analytic_view'] = "admin/Analytics_controller/page_visitors_view";

/* Route for displaying login form for admin section */
$route['search/keyword=(:any)'] = "Search/search";

/* Route for displaying login form for admin section */
$route['search/keywords=(:any)&location=(:any)'] = "Search/searchs";

/* Route for displaying login form for admin section */
$route['coming_soon'] = "Home/coming_soon";

/* Route for displaying login form for admin section */
$route['search_filter'] = "Search/search_filter";













/* Route for displaying login form for admin section */
$route['search'] = "Search";

/* Route for displaying login form for admin section */
$route['subscription'] = "Home/subscription";

/* Route for displaying login form for admin section */
$route['subscription_success'] = "Home/subscription_success";

/* Route for displaying login form for admin section */
$route['subscribe'] = "Home/subscribe";

/* Route for displaying login form for admin section */
$route['payment_canceled'] = "Booking/payment_canceled";
/* Route for displaying login form for admin section */
$route['home'] = "Home/home_page";

/* Route for partner login */
$route['vendor/facebook_login'] = "Business_providers/facebook_login";

/* Route for partner login */
$route['vendor/check_username_availability'] = "Business_providers/check_username_availability";


/* Route for partner login */
$route['get_locations'] = "Search/get_locations";

/* Route for partner login */
$route['get_vendors'] = "Search/get_vendors";

/* Route for partner login */
$route['filter_result'] = "Search/filter_result";

/* Route for partner login */
$route['filter_search_results'] = "Search/filter_search_results";

$route['ask_for_review'] = "Home/ask_for_review";

$route['review/(:any)'] = "Home/review";

$route['review_submitted/(:any)'] = "Home/review_submitted";

/* Route for partner login */
$route['review_service'] = "Business_offerings/review_service";


/* added by anitha for cs vendor */
/* Route for partner registration */
$route['customer_support/partner_registration'] = "admin/Vendors/partner_registration";
/* Route for inserting partner registration */
$route['customer_support/add_partner_registration'] = "admin/Vendors/add_partner_registration";
/* Route for getting business information */
//$route['customer_support/business_information/(:any)'] = "admin/Vendors/business_information";
/* Route for updating business inforamtion */
$route['customer_support/adding_business_information'] = "admin/Vendors/adding_business_information";
/* Route for deleting gallery image */
$route['customer_support/delete_business_gallery_image'] = "admin/Vendors/delete_business_gallery_image";
/* Route for getting packages/treatments */
$route['customer_support/packages_treatments/(:any)'] = "admin/Vendors/packages_treatmets_listing";
/* Route for adding  service  */
$route['customer_support/adding_package_service/(:any)'] = "admin/Vendors/adding_package_service";
/* Route for adding programs */
$route['customer_support/adding_business_programs'] = "admin/Vendors/adding_business_programs";
/* Route for adding services */
$route['customer_support/adding_business_services'] = "admin/Vendors/adding_business_services";
/* Route for deleting package */
$route['customer_support/delete_business_package'] = "admin/Vendors/delete_business_package";
/* Route for deleting package */
$route['customer_support/business_package_edit/(:any)'] = "admin/Vendors/business_package_edit";
/* Route for deleting package */
$route['customer_support/updating_business_program'] = "admin/Vendors/updating_business_program";

/* Route for deleting package */
$route['customer_support/delete_business_services'] = "admin/Vendors/delete_business_services";

/* Route for deleting package */
$route['customer_support/business_services/(:any)'] = "admin/Vendors/business_services";

/* Route for deleting package */
$route['customer_support/business_service_edit/(:any)'] = "admin/Vendors/business_service_edit";

/* added by anitha for cs vendor */






/* Route for business service listing */
$route['vendor/service_slots_edit/(:any)'] = "Business_providers/service_slots_edit";

/* Route for business service listing */
$route['vendor/update_business_services_slots'] = "Business_providers/update_business_services_slots";

/* Route for business service listing */
$route['vendor/service_slots_delete'] = "Business_providers/service_slots_delete";






/* added by vikrant for back-end */
/* Route for business service listing */
$route['admin/add_vendor'] = "admin/Vendors/add_vendor";

/* Route for business service listing */
$route['admin/do_vendor_registration'] = "admin/Vendors/do_vendor_registration";

/* Route for business service listing */
$route['admin/vendor_packages/(:any)'] = "admin/Vendors/vendor_packages";

/* Route for business service listing */
$route['admin/add_new_package/(:any)'] = "admin/Vendors/add_new_package";

/* Route for business service listing */
$route['admin/create_new_package'] = "admin/Vendors/create_new_package";

/* Route for business service listing */
$route['admin/delete_package'] = "admin/Vendors/delete_package";

/* Route for business service listing */
$route['admin/edit_package/(:any)'] = "admin/Vendors/edit_package";

/* Route for business service listing */
$route['admin/update_package'] = "admin/Vendors/update_package";


/* Route for business service listing */
$route['admin/offering_services/(:any)'] = "admin/Vendors/offering_services";

/* Route for business service listing */
$route['admin/add_new_offerings/(:any)'] = "admin/Vendors/add_new_offerings";


/* Route for business service listing */
$route['admin/create_offerings'] = "admin/Vendors/create_offerings";

/* Route for business service listing */
$route['admin/delete_offerings'] = "admin/Vendors/delete_offerings";


/* Route for business servic(e listing */
$route['admin/edit_offering/(:any)'] = "admin/Vendors/edit_offering";


/* Route for business servic(e listing */
$route['admin/update_offering'] = "admin/Vendors/update_offering";


/* Route for business servic(e listing */
$route['admin/business_hours/(:any)'] = "admin/Vendors/business_hours";

/* Route for business servic(e listing */
$route['admin/add_business_hours/(:any)'] = "admin/Vendors/add_business_hours";

/* Route for business servic(e listing */
$route['admin/create_slots'] = "admin/Vendors/create_slots";





/* Route for business servic(e listing */
$route['admin/view_offerings_gallery/(:any)'] = "admin/Vendors/view_offerings_gallery";

/* Route for business servic(e listing */
$route['admin/add_offerings_gallery/(:any)'] = "admin/Vendors/add_offerings_gallery";





/* Route for packages and treatments */
$route['vendor/offerings_memberships/(:any)'] = "Business_offerings/offerings_memberships";

/* Route for packages and treatments */
$route['vendor/create_offerings_memberships'] = "Business_offerings/create_offerings_memberships";

/* Route for packages and treatments */
$route['vendor/delete_offerings_memberships'] = "Business_offerings/delete_offerings_memberships";

/* Route for packages and treatments */
$route['vendor/edit_offerings_memberships/(:any)'] = "Business_offerings/edit_offerings_memberships";

/* Route for packages and treatments */
$route['vendor/update_offerings_memberships'] = "Business_offerings/update_offerings_memberships";


/* Route for packages and treatments */
$route['vendor/offerings_gallery/(:any)'] = "Business_offerings/offerings_gallery";

/* Route for packages and treatments */
$route['vendor/offerings_gallery_delete'] = "Business_offerings/offerings_gallery_delete";

/* Route for packages and treatments */
$route['vendor/offerings_gallery_edit/(:any)'] = "Business_offerings/offerings_gallery_edit";

/* Route for packages and treatments */
$route['vendor/update_offerings_gallery'] = "Business_offerings/update_offerings_gallery";

/* Route for packages and treatments */
$route['vendor/add_offerings_gallery/(:any)'] = "Business_offerings/add_offerings_gallery";

/* Route for packages and treatments */
$route['vendor/create_offerings_gallery'] = "Business_offerings/create_offerings_gallery";

/* Route for packages and treatments */
$route['vendor/gallery/(:any)'] = "Business_providers/gallery";


/* Route for packages and treatments */
$route['vendor/gallery_delete'] = "Business_providers/gallery_delete";


/* Route for packages and treatments */
$route['vendor/edit_gallery/(:any)'] = "Business_providers/edit_gallery";

/* Route for packages and treatments */
$route['vendor/update_gallery'] = "Business_providers/update_gallery";


/* Route for packages and treatments */
$route['vendor/add_gallery/(:any)'] = "Business_providers/add_gallery";


/* Route for packages and treatments */
$route['vendor/create_gallery'] = "Business_providers/create_gallery";


/* Route for packages and treatments */
$route['vendor/business_service_add_slot/(:any)'] = "Business_offerings/business_service_add_slot";


/* Route for packages and treatments */
$route['vendor/business_service_adding_slot'] = "Business_offerings/business_service_adding_slot";

/* Route for business service listing */
$route['vendor/one_time_service_slots_delete'] = "Business_offerings/one_time_service_slots_delete";

/* Route for business service listing */
$route['vendor/one_time_service_slots_edit/(:any)'] = "Business_offerings/one_time_service_slots_edit";

/* Route for business service listing */
$route['vendor/update_one_time_slots'] = "Business_offerings/update_one_time_slots";

/* Route for business service listing */
$route['vendor/one_day_packages'] = "Business_offerings/one_day_packages";

/* Route for business service listing */
$route['vendor/delete_one_day_package'] = "Business_offerings/delete_one_day_package";

/* Route for business service listing */
$route['vendor/add_one_day_package'] = "Business_offerings/add_one_day_package";

/* Route for business service listing */
$route['vendor/create_one_day_package'] = "Business_offerings/create_one_day_package";

/* Route for business service listing */
$route['vendor/create_one_day_package'] = "Business_offerings/create_one_day_package";


/* Route for Partner Booking */
$route['vendor/partner_bookings'] = "Business_offerings/partner_bookings";

/* Route for Spa Partner Booking Search */
$route['vendor/spa_search'] = "Business_offerings/spa_search";
$route['vendor/spa_search_slots'] = "Business_offerings/spa_search_slots";
$route['vendor/member_book_slot'] = "Business_offerings/member_book_slot";
$route['vendor/spa_booked_slots_detail'] = "Business_offerings/spa_booked_slots_detail";
$route['vendor/cancel_slot_data'] = "Business_offerings/cancel_slot_data";








/* Route for business service listing */
$route['admin/offerings_search'] = "admin/Vendors/offerings_search";

$route['admin/business_information/(:any)'] = "admin/Vendors/business_information";

$route['admin/adding_business_information'] = "admin/Vendors/adding_business_information";

$route['admin/view_business_gallery/(:any)'] = "admin/Vendors/view_business_gallery";

$route['admin/add_business_gallery/(:any)'] = "admin/Vendors/add_business_gallery";

$route['admin/delete_business_gallery'] = "admin/Vendors/delete_business_gallery";

/* Route for updating business service  */
$route['admin/adding_business_gallery'] = "admin/Vendors/adding_business_gallery";





























/* Articles controller */
$route['articles'] = "Articles/index";

$route['articles/edit_article/(:any)'] = "Articles/edit_article";

$route['articles/submit_article'] = "Articles/submit_article";

$route['articles/delete_image'] = "Articles/delete_image";

$route['articles/add_article'] = "Articles/add_article";

$route['articles/delete_article/(:any)'] = "Articles/delete_article";

$route['articles/article_add'] = "Articles/article_add";

$route['articles/detail/(:any)'] = "Articles/detail";

$route['articles/sme_article_loadmore'] = "Articles/loadmore";

$route['articles/detailpage/(:any)/(:any)'] = "Articles/detailpage";

$route['articles/add_comment'] = "Articles/add_comment";

$route['articles/lists/(:any)'] = "Articles/lists";

$route['articles/loadmore'] = "Articles/loadmore";



/* book a call controller */
$route['book_call/user/(:any)'] = "Book_call/user";

$route['book_call/book'] = "Book_call/book";

$route['book_call/calls'] = "Book_call/calls";

$route['book_call/loadmore'] = "Book_call/loadmore";


/* events  controller */
$route['events'] = "Events/index";

$route['events/edit_event/(:any)'] = "Events/edit_event";

$route['events/update_event'] = "Events/update_event";

$route['events/add_event'] = "Events/add_event";

$route['events/insert_event'] = "Events/insert_event";

$route['events/delete_event/(:any)'] = "Events/delete_event";

$route['events/view_event/(:any)'] = "Events/view_event";

$route['events/delete_ev_image'] = "Events/delete_ev_image";

$route['events/loadmore'] = "Events/loadmore";

$route['events/lists/(:any)'] = "Events/lists";

$route['events/sme_event_loadmore'] = "Events/sme_event_loadmore";

$route['events/detailpage/(:any)/(:any)'] = "Events/detailpage";


/* feedback controller */

$route['feedback'] = "Feedback/index";

$route['feedback/user/(:any)'] = "Feedback/user";

$route['feedback/add_respond'] = "Feedback/add_respond";

$route['feedback/add/(:any)'] = "Feedback/add";

$route['feedback/reply'] = "Feedback/reply";

$route['feedback/publish'] = "Feedback/publish";

$route['feedback/update'] = "Feedback/update";

$route['feedback/detail/(:any)/(:any)'] = "Feedback/detail";

$route['feedback/edit/(:any)/(:any)'] = "Feedback/edit";

$route['feedback/add_reply'] = "Feedback/add_reply";

$route['feedback/loadmore'] = "Feedback/loadmore";

$route['feedback/loadmorefbtype'] = "Feedback/loadmorefbtype";

$route['feedback/listing'] = "Feedback/listing";

$route['feedback/addsme_reply'] = "Feedback/addsme_reply";

$route['feedback/sme_fb_loadmore'] = "Feedback/sme_fb_loadmore";

$route['feedback/lists/(:any)'] = "Feedback/lists";

$route['feedback/type/(:any)/(:any)'] = "Feedback/type";

$route['feedback/detailpage/(:any)/(:any)'] = "Feedback/detailpage";

$route['feedback/delete_feedback'] = "Feedback/delete_feedback";


/* followers controller */

$route['followers'] = "Followers/index";

$route['followers/message'] = "Followers/message";

$route['followers/send_message'] = "Followers/send_message";

$route['followers/mail'] = "Followers/mail";

$route['followers/send_email'] = "Followers/send_email";

$route['followers/loadmore'] = "Followers/loadmore";

$route['followers/lists/(:any)'] = "Followers/lists";

$route['followers/follow/(:any)'] = "Followers/follow";

$route['followers/unfollow/(:any)/(:any)'] = "Followers/unfollow";


/* Questions controller */

$route['questions'] = "Questions/index";

$route['questions/add_answer'] = "Questions/add_answer";

$route['questions/mail/(:any)/(:any)'] = "Questions/mail";

$route['questions/send_ans_email'] = "Questions/send_ans_email";

$route['questions/user/(:any)'] = "Questions/user";

$route['questions/unanswered/(:any)'] = "Questions/unanswered";

$route['questions/expedited'] = "Questions/expedited";

$route['questions/answered/(:any)'] = "Questions/answered";

$route['questions/ask/(:any)'] = "Questions/ask";

$route['questions/publish'] = "Questions/publish";

$route['questions/detail/(:any)/(:any)'] = "Questions/detail";

$route['questions/add_reply'] = "Questions/add_reply";

$route['questions/loadmore'] = "Questions/loadmore";

$route['questions/listing'] = "Questions/listing";

$route['questions/listing_unanswered'] = "Questions/listing_unanswered";

$route['questions/listing_answered'] = "Questions/listing_answered";

$route['questions/loadmore_sme_unansques'] = "Questions/loadmore_sme_unansques";

$route['questions/lists/(:any)'] = "Questions/lists";

$route['questions/detailpage/(:any)/(:any)'] = "Questions/detailpage";

$route['questions/add_user_reply'] = "Questions/add_user_reply";

$route['questions/checkout'] = "Questions/checkout";

$route['questions/payment'] = "Questions/payment";

$route['questions/payment_process'] = "Questions/payment_process";

$route['questions/payment_success'] = "Questions/payment_success";

$route['questions/payment_canceled'] = "Questions/payment_canceled";


/* SME load page */
$route['sme'] = "Sme/index";

$route['sme/register'] = "Sme/register";

$route['sme/login'] = "Sme/login";

$route['sme/signin'] = "Sme/signin";

$route['sme/dashboard'] = "Sme/dashboard";

$route['sme/profile'] = "Sme/profile";

$route['sme/update_profile'] = "Sme/update_profile";

$route['sme/forgot_password'] = "Sme/forgot_password";

$route['sme/send_mail'] = "Sme/send_mail";

$route['sme/reset_password/(:any)'] = "Sme/reset_password";

$route['sme/update_password'] = "Sme/update_password";

$route['sme/logout'] = "Sme/logout";

$route['sme/update_settings'] = "Sme/update_settings";

$route['sme/settings'] = "Sme/settings";

$route['sme/get_programs'] = "Sme/get_programs";

$route['sme/get_offerings'] = "Sme/get_offerings";


/* sme home */
$route['sme_home/user/(:any)'] = "Sme_home/user";








/* Route for displaying SME users */
$route['admin/sme_users'] = "admin/Sme/get_all_users";

/* Route for displaying login form for admin section */
$route['admin/sme_add_user'] = "admin/Sme/add_user";

/* Route for displaying login form for admin section */
$route['admin/sme/create_users'] = "admin/Sme/create_users";

/* Route for displaying login form for admin section */
$route['admin/sme/edit_user_details/(:any)'] = "admin/Sme/edit_user_details";

/* Route for displaying login form for admin section */
$route['admin/sme/update_user'] = "admin/Sme/update_user";

/* Route for displaying login form for admin section */
$route['admin/sme/delete_user'] = "admin/Sme/delete_user";

/* Route for displaying login form for admin section */
$route['admin/sme/user_details/(:any)'] = "admin/Sme/user_details";

/* Route for displaying SME users */
$route['admin/sme_events'] = "admin/Sme/get_all_events";

/* Route for displaying login form for admin section */
$route['admin/sme_add_event'] = "admin/Sme/add_event";

/* Route for displaying SME users */
$route['admin/sme_articles'] = "admin/Sme/get_all_articles";

/* Route for displaying login form for admin section */
$route['admin/sme_add_article'] = "admin/Sme/add_article";

/* Route for displaying login form for admin section */
$route['admin/sme_edit_article_details/(:any)'] = "admin/Sme/edit_article_details";

/* Route for displaying login form for admin section */
$route['admin/sme_article_details/(:any)'] = "admin/Sme/article_details";



/* Route for displaying corporate offerings page */
$route['workplace'] = "Home/workplace";

/* Route for  corporate offerings page enquiry */
$route['workplace_enquiry'] = "Home/workplace_enquiry";



/* Route for displaying about us page */
$route['about_us'] = "Static_pages/about_us";

/* Route for displaying about us page */
$route['all_offerings/(:any)'] = "Business_offerings/all_offerings";

/* Route for displaying about us page */
$route['offering_details/(:any)'] = "Business_offerings/offering_details";

/* Route for displaying about us page */
$route['get_available_slots_by_date'] = "Booking/get_available_slots_by_date";




/* Route for displaying about us page */
$route['checkout'] = "Booking/checkout";

/* Route for displaying about us page */
$route['pay_at_venue'] = "Booking/pay_at_venue";

/* Route for displaying about us page */
$route['payment_success'] = "Booking/booking_success";



/* Route for displaying about us page */
$route['signup'] = "Users/user_signup";

/* Route for displaying about us page */
$route['user_registration'] = "Users/user_registration";


/* Route for displaying about us page */
$route['change_password'] = "Users/change_password";

/* Route for displaying about us page */
$route['update_password'] = "Users/update_new_password";


/* Route for displaying about us page */
$route['memberships_offering/(:any)'] = "Business_offerings/offering_memberships";

/* Route for displaying about us page */
$route['membership_checkout'] = "Business_offerings/membership_checkout";

/* Route for displaying list of user's transactions */
$route['dashboard'] = "Users/prat_individual_dashboard";

/* Route for updating user profile */
$route['update_user_profile'] = "Users/update_user_profile";

/* Route for updating user profile */
$route['upload_user_image'] = "Users/upload_user_image";



/* Route for partner login */
$route['vendor_review'] = "Business_providers/vendor_review";

/* Route for partner login */
$route['faq'] = "Static_pages/faq";

/* Route for Careers */
$route['careers'] = "Static_pages/careers";

/* Route for Customer Support */
$route['customersupport'] = "Static_pages/customersupport";

/* Route for Partner Support */
$route['partnersupport'] = "Static_pages/partnersupport";


/* Route for partner login */
$route['contact_us_enquiry'] = "Static_pages/contact_us_enquiry";


/* Route for partner login */
$route['add_to_calendar'] = "Bookings/add_to_calendar";

/* Route for partner login */
$route['twitter'] = "Users/twitter";

/* Route for partner login */
$route['twitter_response'] = "Users/twitter_response";

/* Route for displaying login form for admin section */
$route['search_result_filter'] = "Search/search_result_filter";

/* Route for displaying login form for admin section */
$route['search_result_filter_show'] = "Search/search_result_filter_show";

/* Route for displaying login form for admin section */
$route['filtering_search'] = "Search/filtering_search";














/* experts routes added by anitha */

/* Route for displaying SME users */
$route['experts/user/(:any)'] = "Experts/user";

/* Route for displaying SME users */
$route['experts/dashboard'] = "Experts/dashboard";

/* Route for SME users edit profile */
$route['experts/profile'] = "Experts/profile";

/* Route for SME users edit profile */
$route['experts/update_profile'] = "Experts/update_profile";

/* Route for SME users edit profile */
$route['experts/questions'] = "Experts/add_question";


/* Route for SME users edit profile */
$route['experts/getpackages'] = "Experts/getpackages";

$route['experts/feedback/(:any)'] = "Experts/add_feedback";

$route['experts/check_userlogin'] = "Experts/check_userlogin";

$route['experts/upload_sme_photo'] = "Experts/upload_sme_photo";

$route['experts/upload_dashbaord_photo'] = "Experts/upload_dashbaord_photo";

$route['experts/get_available_dates'] = "Experts/get_available_dates";

$route['experts/user_booked_calls'] = "Experts/user_booked_calls";

$route['experts/feedback_publish'] = "Experts/feedback_publish";

$route['experts/sort_questions_by_dates'] = "Experts/sort_questions_by_dates";

$route['experts/followers'] = "Experts/followers";

$route['experts/followers_loadmore'] = "Experts/followers_loadmore";

$route['experts/allfeedback'] = "Experts/allfeedback";

$route['experts/insert_session_amount'] = "Experts/insert_session_amount";

$route['experts/checkout'] = "Experts/checkout";

$route['experts/payment'] = "Experts/payment";

$route['experts/payment_process'] = "Experts/payment_process";

$route['experts/payment_success'] = "Experts/payment_success";

$route['experts/payment_canceled'] = "Experts/payment_canceled";

$route['experts/getquestions'] = "Experts/getquestions";

$route['experts/sme_reply/(:any)'] = "Experts/sme_reply";

$route['experts/insert_sme_reply'] = "Experts/insert_sme_reply";

$route['experts/article_detail/(:any)'] = "Experts/article_detail";

$route['experts/answers/(:any)/(:any)'] = "Experts/answers";

$route['experts/insert_sme_event'] = "Experts/insert_sme_event";

$route['experts/insert_sme_article'] = "Experts/insert_sme_article";

$route['experts/allevents'] = "Experts/allevents";

$route['experts/bookedcalls'] = "Experts/bookedcalls";

$route['experts/allquestions'] = "Experts/allquestions";

$route['experts/feedback/loadmore'] = "Experts/feedback_loadmore";
/* experts routes added by anitha */



/* experts routes newly added  */
$route['experts/articles'] = "Experts/articles";
/* experts routes newly added */


$route['experts/login'] = "Experts/login";

/* social login routes */
$route['experts/login/(:any)'] = "Experts/socialogin";

/* wellness practioner(sme) search */
$route['experts/search'] = "Experts/search";



/* social login routes */
$route['user_login/(:any)'] = "Users/socialogin";

$route['test'] = "Users/redirect";

/*Call Reschedule route*/
$route['reschedule_call/(:any)'] = "Booking/call_reschedule_order";

/*cron job*/
$route['call_reminder'] = "Cron/sms_call_reminder";

$route['survey/checkemailregistered'] = 'Survey/checkemailregistered';

/* Route for getting notification for registered users */
$route['user/notifications'] = "Notifications/get_notifications_for_user";

/* Route for getting notification for registered users */
$route['chat'] = "users/chat";

/* Route for landing pages */
$route['appdownload'] = "Landing_page_controller/get_landing_page/download_page";
$route['contest'] = "Landing_page_controller/get_landing_page/contest";

 
/* added by Manikandan */

//All for zen at avani
$route['zen-at-avani'] ="Zen_at_avani/event_page";
$route['workplace-offerings'] ="Workplace";
$route['workplace-two'] = "Home/workplace_offerings";

