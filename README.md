shin-php-analyzer
=============

### Introduction
Shin PHP Analyzer is a tool based on Zend Engine to analyze the vulnerable PHP source code.

### Details
* Now it is ready for XSS, SQLI, CMDI.
 1. XSS: htmlspecialchars, htmlentities -> echo, print, printf
 2. SQLI: mysql_real_escape_string, addslashes, sqlite_escape_string -> mysql_query, mysqli_query, sqlite_query, sqlite_single_query
 3. CMDI: escapeshellcmd, escapeshellarg -> exec, passthru, proc_open, shell_exec, system
* Two level warning:
 1. Alert: VULNERABLE!
 2. WARN: MAY BE VULNERABLE!

### Plan
Cover FUA (File Upload Attack) and so on.

### Author
Shin Feng

### Contact me
<a href="Mailto:shin.f.kan@gmail.com">shin.f.kan@gmail.com</a><br />
