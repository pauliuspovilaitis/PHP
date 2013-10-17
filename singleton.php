<?php
require_once 'config.ini.php';

class database
{
	public $dbhc;
	private static $instance;

	private function __construct()
	{
		try {
		$this -> dbhc = new PDO(DB_DRIVER.':host='.DB_HOST.';dbname='.DB_NAME,DB_USER,DB_PASS);
		$this -> dbhc -> setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
		}
		catch (PDOException $e) {
			echo 'failed: ' . $e->getMessage();
		}		
	}
	//singleton pattern
	public static function getInstance()
	{
		if (!isset(self::$instance))
		{
			$object = __CLASS__;
			self::$instance = new $object;
		}
		return self::$instance;
	}
}
