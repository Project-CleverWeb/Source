<?php

if(POST){
	$defaults = $_POST;
}else{
	$defaults = Array('name'=>'','email'=>'','message'=>'');
}

$template = '
	<h1>Contact CleverWeb</h1>
	' . $message . '
	<form method="post">
		Name: <input type="text" name="name" value="' . $defaults['name'] . '">
		<br>
		Email: <input type="text" name="email" value="' . $defaults['email'] . '">
		<br>
		Message:<br>
		<textarea name="message">' . $defaults['message'] . '</textarea>
		<br>
		<input type="submit" value="Send Message">
	</form>

';