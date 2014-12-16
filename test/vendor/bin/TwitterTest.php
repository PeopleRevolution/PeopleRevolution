<?php

	namespace PeopleRevolution\test\vendor\bin;
 
	use PeopleRevolution\twitteroauth\twitteroauth;

    class PruebaTest extends PHPUnit_Framework_TestCase
    {
	   public function testPrueba()
	   {
		    $shouldreturn = 'https://api.twitter.com/oauth/access_token';
			$twitter = new TwitterOAuth;
			$result = $twitter->accessTokenURL;
			$this->assertEquals($shouldreturn, $result);
	   }
    }

	/*class TestTwitterOAuth extends \PHPUnit_Framework_TestCase
	{
		public function Testingaccess()
		{
			/*$shouldreturn = "https://api.twitter.com/1.1/";
			$twitter = new TwitterOAuth;
			$result = $twitter->$host;
			$this->assertEquals($shouldreturn, $result);
			$this-> assertTrue(true);
		}
	}
?>*/
