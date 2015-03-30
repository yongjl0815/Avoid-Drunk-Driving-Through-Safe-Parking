<?php
require_once('./unitTesting/tests/simpletest/autorun.php');
require_once('./unitTesting/tests/simpletest/web_tester.php');
require_once('./unitTesting/tests/simpletest/browser.php');

SimpleTest::prefer(new TextReporter());

class TestOfSaving extends WebtestCase {
    function testRegister() {
		$this->get('https://web.engr.oregonstate.edu/~leey2/simpletest/classes/register.php/'); // replace with your file path to register.php
    $this->assertField('username', '');
		$this->setField('username', 'John111');
		$this->assertField('username', 'John111');
		
		$this->assertField('password', '');
		$this->setField('password', 'John222');
		$this->assertField('password', 'John222');
		
		$this->assertField('fname', '');
		$this->setField('fname', 'John');
		$this->assertField('fname', 'John');
		
		$this->assertField('lname', '');
		$this->setField('lname', 'Smith');
		$this->assertField('lname', 'Smith');
		
		/* These tests aren't working due to the HTML 5 input type of 
				email that we are using. We tested this using a text input
				type within the HTML and the tests passed. */
		//$this->assertField('email', '');
		//$this->setField('email', 'JS@OSU.ORG');
		//$this->assertField('email', 'JS@OSU.ORG');
		
		$this->assertTrue($this->clickSubmitByName('submit'));
		$this->clickSubmitByName('submit');
    }
	
	function testLogin() {
		$this->get('https://web.engr.oregonstate.edu/~leey2/simpletest/classes/login.php/'); // replace with your file path to login.php
		$this->assertField('username', '');
		$this->setField('username', 'John111');
		$this->assertField('username', 'John111');
		
		$this->assertField('password', '');
		$this->setField('password', 'John222');
		$this->assertField('password', 'John222');
		
		$this->assertTrue($this->clickSubmitByName('login'));
		$this->assertTrue($this->clickSubmit('Register'));	
		$this->assertTrue($this->clickSubmit('Back'));

	}

	function testIndex() {
		$this->get('https://web.engr.oregonstate.edu/~leey2/simpletest/classes/index.php/'); // replace with your file path to index.php
		$this->assertField('destination', '');
		$this->setField('destination', 'Oregon');
		$this->assertField('destination', 'Oregon');
		
		$this->assertTrue($this->clickSubmit('Search'));
		
		$this->assertTrue($this->clickSubmit('Register'));	
		$this->assertTrue($this->clickSubmit('Sign in'));

	}	
	
	function testDestination() {
		$this->get('https://web.engr.oregonstate.edu/~leey2/simpletest/classes/destinationCreation.php/'); // replace with your file path to destinationCreation.php
		$this->assertField('destination', '');
		$this->setField('destination', 'Oregon');
		$this->assertField('destination', 'Oregon');
		
		$this->assertField('address', '');
		$this->setField('address', 'NW');
		$this->assertField('address', 'NW');
		
		$this->assertField('directions', '');
		$this->setField('directions', 'NA');
		$this->assertField('directions', 'NA');			
		
		$this->assertTrue($this->clickSubmit('Back'));
		$this->assertTrue($this->clickSubmit('Add Destination'));

	}

  function testIndexLoggedIn() {
  	$this->get('https://web.engr.oregonstate.edu/~leey2/simpletest/classes/index_loggedin.php/');
      
  	$this->assertField('destination', '');
		$this->setField('destination', 'Cheerful Tortoise');
		$this->assertField('destination', 'Cheerful Tortoise');
	
		$this->assertTrue($this->clickSubmit('Search'));
		$this->assertTrue($this->clickLink('Click Here'));
		$this->assertTrue($this->clickSubmit('Logout'));
  }    

}
?>
