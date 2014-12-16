<?php
	include_once("../../../twitteroauth/twitteroauth.php");
	
 class PruebaTest extends PHPUnit_Framework_TestCase
 {
	public function testPrueba()
	{
			
			$consumer_key = 12345;
			$consumer_secret = 123456;
		    $shouldreturn = "https://api.twitter.com/1.1/";
			/*$twitter = TwitterOAuth;*/
			$twitter = $this->getMockBuilder('TwitterOAuth')
			->setConstructorArgs(array($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL))
			->getMock();
			/*print_r(get_class_methods($twitter));*/
			$result = $host;
			$this->assertEquals($shouldreturn, $result);
	}
}
