<?php
class klase
{
	public $vec; 
	
	function __construct()
	{
		$this->vec = array();
	}
	
	function __get($str)
	{
		return $this->vec[$str];
	}
	
	function __set($var_name, $var_value)
	{
		$this->vec[$var_name] = $var_value;
	}	
}

$ob = new klase();
$ob->name = "test";
$ob->id = 123; 

echo $ob->name;
echo $ob->id;
