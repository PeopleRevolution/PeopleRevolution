<?php
	include_once("../../../twitteroauth/twitteroauth.php");
	
  class iniciotest extends PHPUnit_Framework_TestCase
 {
	public function testaccessTokenURL()
	{
			
			$consumer_key = 12345;
			$consumer_secret = 123456;
		    $shouldreturn = 'https://api.twitter.com/oauth/access_token';
			$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL);
			/*$twitter = $this->getMockBuilder('TwitterOAuth')
			->setConstructorArgs(array($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL))
			->getMock();
			/*print_r(get_class_methods($twitter));*/
			$result = $twitter->accessTokenURL();
			$this->assertEquals($shouldreturn, $result);
	}
	
	public function testauthenticateURL()
	{
			
			$consumer_key = 12345;
			$consumer_secret = 123456;
		    $shouldreturn = 'https://api.twitter.com/oauth/authenticate';
			$twitter = new TwitterOAuth($consumer_key, $consumer_secret, $oauth_token = NULL, $oauth_token_secret = NULL);
			$result = $twitter->authenticateURL();
			$this->assertEquals($shouldreturn, $result);
	}
}
