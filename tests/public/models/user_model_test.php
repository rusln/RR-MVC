<?php
// will keep the tests for another day
class UserTest extends PHPUnit_Framework_TestCase
{
    // test the talk method
    public function testTalk() {
        // make an instance of the user
        $user = new User_Model();

        // use assertEquals to ensure the greeting is what you
        $expected = "Hello world!";
        $actual = $user->talk();
        $this->assertEquals($expected, $actual);
    }
}