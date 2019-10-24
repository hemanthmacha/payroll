<?php
defined('BASEPATH') OR exit('No direct script access allowed');


$route['default_controller'] = 'Login';
$route['404_override'] = '';
$route['translate_uri_dashes'] = FALSE;
$route['login'] = 'Login/loginuser';
$route['payroll'] = 'Payroll_month';
$route['month'] = 'Payroll_month/payrollmonth';
$route['month/(:any)'] = 'Payroll_sheet';
$route['update']='Payroll_sheet/update_payroll';

$route['updateemployee'] = 'Employe/updateemp';

$route['addemployeedata'] = 'Employe/newdata_emp';
$route['addemp'] = 'Addemploye/add';
$route['addemployee'] = 'Addemploye/ademployee';

$route['employeelist'] = 'Employe/emplist';
$route['list'] = 'Employe/empdetails';


$route['employe'] = 'Employe/empid';


$route['percentage'] = 'Percentage';


$route['list/expense'] = 'Expenses';
$route['employee/expense'] = 'Expenses';
$route['newexpenses'] = 'Expenses/addexp';

$route['percentageupdate'] = 'Percentage/addpercent';

