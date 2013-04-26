<?php
// text the basics

require_once "PHPUnit/Autoload.php";

class Standard_Test extends PHPUnit_Framework_TestCase{
	public $sample;
	
	public function setUp(){
		$this->sample = TRUE;
	}
	public function tearDown(){
		
	}
	public function test_sample(){
		global $meh;
		$expected = TRUE;
		$actual = $this->sample;
		$this->assertEquals($expected, $actual);
	}
}