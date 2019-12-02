<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'Login/loginuser';
$route['payroll'] = 'Payroll_month';
$route['month'] = 'Payroll_month/payrollmonth';
$route['month/(:any)'] = 'Payroll_sheet/index/$1/$2';
$route['update']='Payroll_sheet/update_payroll';

$route['updateemployee'] = 'Employe/updateemp';
$route['deleteemployee'] = 'Employe/deleteemp';


$route['addemployeedata'] = 'Employe/newdata_emp';
$route['addemp'] = 'Addemploye/add';
$route['addemployee'] = 'Addemploye/ademployee';

$route['employeelist'] = 'Employe/emplist';

$route['employeelist/(:any)'] = 'Employe/emplist/$1';

$route['list'] = 'Employe/empdetails';
$route['list/(:any)'] = 'Employe/empdetails/$1';


$route['employe'] = 'Employe/empid';
$route['employe/(:any)'] = 'Employe/empid/$1';


$route['percentage'] = 'Percentage';


$route['expense'] = 'Expenses/index';
//$route['employee/expense'] = 'Expenses';
$route['newexpenses'] = 'Expenses/addexp';
$route['deleteexpenses']= 'Expenses/deleteexp';



$route['percentageupdate'] = 'Percentage/addpercent';
$route['percentagedelete'] = 'Percentage/deletepercent';
$route['completepercentagedelete']='Percentage/deletepercent';

$route['deleteemployeelist']='Employe/deleteemplist';
$route['cal']='Employe/sample_cal';

$route['singleempexpenses']='Employe/singleempmonthexp';

$route['logout']='Logout';

$route['unpaid']='Payroll_sheet/unpaid_emp';

$route['test']='Employe/total';

$route['gettingmonth']='Employe/gettingmonth_not_in_data';

$route['recentpay']='Payroll_sheet/recentpay';

$route['changepassword']='Forgot/change_password';

$route['forgot']='Forgot';

$route['reset']='Forgot/reset_password';




