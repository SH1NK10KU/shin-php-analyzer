<?php
/**
 *	Test cases for php analyzer.
 **/

include __DIR__ . '/shin_php_analyzer_include_file_for_test_cases.php';

echo $uninit_var; // WARN
echo $_GET['uninit_spec_var']; // ALERT
echo $_GET['uninit_spec_var'] . $uninit_var; // ALERT
$init_compiled_var_without_spec_var = 'init_compiled_var_without_spec_var';
echo $init_compiled_var_without_spec_var; // WARN
$init_compiled_var_with_spec_var = $_GET['uninit_spec_var'] . 'init_compiled_var_with_spec_var';
echo $init_compiled_var_with_spec_var; // ALERT
$_GET['init_spec_var'] = 'init_spec_var';
echo $_GET['init_spec_var']; // ALERT
htmlspecialchars($_GET['uninit_spec_var_with_safety_func']);
echo $_GET['uninit_spec_var_with_safety_func']; // ALERT
echo htmlspecialchars($_GET['uninit_spec_var_with_safety_func']); // NONE
$uninit_spec_var_with_safety_func = htmlspecialchars($_GET['uninit_spec_var_with_safety_func']);
echo $uninit_spec_var_with_safety_func; // NONE

print "PRINT_STRING"; // NONE
print "{$uninit_var}"; // WARN
print "{$_GET['uninit_spec_var']}"; // ALERT
print "{$init_compiled_var_without_spec_var}"; // WARN
print "{$init_compiled_var_with_spec_var}"; // ALERT
print "{$_GET['init_spec_var']}"; // ALERT
print "{$uninit_spec_var_with_safety_func}"; // NONE

printf("PRINTF_STRING"); // NONE
printf("%s", $uninit_var); // WARN
printf("%s", $_GET['uninit_spec_var']); // ALERT
printf("%s", $init_compiled_var_without_spec_var); // WARN
printf("%s", $init_compiled_var_with_spec_var); // ALERT
printf("%s", $_GET['init_spec_var']); // ALERT
printf("%s", htmlspecialchars($_GET['init_spec_var'])); // NONE
printf("%s", $uninit_spec_var_with_safety_func); // NONE

proc_open('ls'); // NONE
proc_open($uninit_var); // WARN
exec($_GET['uninit_spec_var']); // ALERT
exec($init_compiled_var_without_spec_var); // WARN
exec($init_compiled_var_with_spec_var); // ALERT
system($_GET['init_spec_var']); // ALERT
system(escapeshellcmd($_GET['init_spec_var'])); // NONE
$uninit_spec_var_with_safety_func = escapeshellcmd($_GET['uninit_spec_var_with_safety_func']);
system($uninit_spec_var_with_safety_func); // NONE

mysql_query("SELECT * FROM mysql"); // NONE
$query = "SHOW DATABASES";
mysql_query($query); // WARN
mysqli_query($_GET['mysqli_query']); // ALERT
mysqli_query(mysql_real_escape_string($_GET['mysqli_query'])); // NONE
$uninit_spec_var_with_safety_func = addslashes($_GET['uninit_spec_var_with_safety_func']);
mysqli_query($uninit_spec_var_with_safety_func); // NONE

//$result = sqlite_query($query); // depend on environment 
//$result = sqlite_single_query($query); // depend on environment 

function my_func_without_ret($var) {
    printf("%d%d", $var, $var);
}
my_func_without_ret($my_func_without_ret_var); // WARN LINE 62
my_func_without_ret($_GET['my_func_without_ret_spec_var']); // ALERT LINE 62
my_func_without_ret(htmlspecialchars($_GET['my_func_without_ret_spec_var'])); // NONE

function my_func_with_ret($var) {
    return ($var);
}
$my_func_with_ret_var = "my_func_with_ret_var";
echo my_func_with_ret($my_func_with_ret_var); // WARN LINE 72

my_func($_GET['my_func_spec_var']); // ALERT INCLUDE_FILE LINE 6 & 7 & 8

$my_func_spec_var = $_GET['my_func_spec_var'];
my_func($_GET['my_func_spec_var']); // ALERT INCLUDE_FILE LINE 6 & 7 & 8
my_func(htmlspecialchars($_GET['my_func_spec_var'])); // WARN INCLUDE_FILE LINE 7 & 8
my_func($my_func_spec_var); // WARN INCLUDE_FILE LINE 6 & 7 & 8

$my_static_func_spec_var = $_GET['my_static_func_spec_var'];
my_class::my_static_func($my_static_func_spec_var); // ALERT INCLUDE_FILE LINE 16 & 17 & 18

$my_class_instance = new my_class;
$my_class_instance->my_func(); // WARN INCLUDE_FILE LINE 22 & 23 & 24

?>
