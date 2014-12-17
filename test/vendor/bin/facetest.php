<?php
	include_once("../../../src/facebook.php");
	
  class facetest extends PHPUnit_Framework_TestCase
 {
	public function testFailPersistentData()
	{
			$not_key = 123456;
		    $shouldreturn = 'Unsupported key passed to getPersistentData.';
			$facebook = new Facebook(array(
			'appId'  => '1234',   // Facebook App ID 
			'secret' => 'a5f6',  // Facebook App Secret
			'cookie' => true,	
			));
			$result = $facebook->setPersistentData($not_key);
			$this->assertEquals($shouldreturn, $result);
	}
	
	public function testFailGetPersistentData()
	{
			$not_key = 123456;
		    $shouldreturn = 'Unsupported key passed to getPersistentData.';
			$facebook = new Facebook(array(
			'appId'  => '1234',   // Facebook App ID 
			'secret' => 'a5f6',  // Facebook App Secret
			'cookie' => true,	
			));
			$result = $facebook->getPersistentData($not_key);
			$this->assertEquals($shouldreturn, $result);
	}
	
	public function testFailClearPersistentData()
	{
			$not_key = 123456;
		    $shouldreturn = 'Unsupported key passed to clearPersistentData.';
			$facebook = new Facebook(array(
			'appId'  => '1234',   // Facebook App ID 
			'secret' => 'a5f6',  // Facebook App Secret
			'cookie' => true,	
			));
			$result = $facebook->clearPersistentData($not_key);
			$this->assertEquals($shouldreturn, $result);
	}
 }
