function __autoload($class_name) {
	if (file_exists($class_name . '.php'))
	{		
		require_once $class_name.'.php';
	}
	else 
	{
		print "autoload can not load the $class_name"; 
		print " exiting...";
		exit;
	}	
}

$obj  = new MyClass1();
$obj2 = new MyClass2();
