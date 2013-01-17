<?php
/*
ALL FUNCTIONS HERE ARE IN PHP
ALL JAVASCRIPT FUNCTIONS ARE STORED IN "/javascript/functions"

If you plan on writing a function of your own and adding it to CleverWeb, This is the place to learn how.
This page will tell you exaclty how to PROPERLY incorperate you own functions with CleverWeb.

Step 1:
  Write your own function file with whatever name you wish, the onnly requirement is that it end with ".php"
    NOTE: do not use capital letters when writing .php and make sure to include capital letters anywhere you used them.
	the best rule of thumb is to just use all lower case with all your functions and files.
	
	Example: hello_world.php
	
Step 2:
  Make sure that if you use any CleverWeb functions in your function that you inclue them with CW_Get_Functions() before the actual function.
  NOTE: CW_Get_Functions() supports both arrays and strings.
  NOTE: CW_Get_Functions() will ABORT THE PAGE if the funtcion is not found.
  NOTE: CW_Get_Functions() is redundant proof. you can call them on the same function as many times as you please without error.
  
    Example:
	  $functions = array("CW_Date","CW_Date","CW_Date"); // Call a function as many times as you like, it wont error out.
	  CW_Get_Functions("$functions"); // This one only works with arrays
	  CW_Get_Functions("CW_Date"); // Redundant of above
	  
	  function hello_world($message){
	    echo "Todays date is: ".CW_Date()."<br />";
		echo "The message of the day is \"".$message."\"";
	  }
	  
	  hello_world("Hello PHP!");
	  
	The above function would print:
	  Todays date is: 12/31/9999
	  The message of the day is "Hello PHP!"
	  
Step 3:
  Call your function on the page you wish to use it with CW_Get_New_Functions(). Like CW_Get_Functions() it only supports arrays
	  
*/
?>
