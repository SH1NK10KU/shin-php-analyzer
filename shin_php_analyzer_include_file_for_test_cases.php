<?php
/**
 *  Include file for test cases for php analyzer.
 **/
function my_func($var) {
    echo htmlspecialchars($var);
    mysql_query($var);
    exec($var);
}

class my_class
{
    const my_class_var = "my_class_var";
    
    static function my_static_func($var) {
    	echo $var;
        mysql_query($var);
        exec($var);
    }
    
    function my_func() {
        echo self::my_class_var;
        mysql_query(self::my_class_var);
        exec(self::my_class_var);
    }
}

?>