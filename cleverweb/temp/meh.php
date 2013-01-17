<?php

$golb = 'hi';


function test(&$test){
		$test .= ' mod';
}

class test{
	function __construct(&$test=NULL){
		global $glob;
		$glob = 'bye';
		$test .= ' cmod';
	}
}


new test($win);


echo $glob;








?>