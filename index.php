<?php
#header ( "Content-type: text/html; charset=utf-8" );
#header ( "Cache-Control: no-cache, must-revalidate" ); // HTTP/1.1
#header ( "Expires: Sat, 26 Jul 1997 05:00:00 GMT" ); // Date in the past
#header ( "Pragma: no-cache" );
define ( "DS", DIRECTORY_SEPARATOR );
$base_path = dirname ( __FILE__ ) ;
define ( 'CLASSPATH', $base_path . DS . 'classes' );
define ( 'TPLSPATH', $base_path . DS . 'tpls' );

require CLASSPATH . DS . 'frame/autoload.php';
spl_autoload_register ( array ('AutoLoad', 'auto_load' ) );
AutoLoad::decrypt();
$class =  AutoLoad::get_uri();
$action = new $class();
$action->run_before();
$action->run();

