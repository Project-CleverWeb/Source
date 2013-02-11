<?php
include __DIR__.'/settings.php'; // should be the only file needed, file will change in the future
$_CW->init(
	array( // these args will override settings.php's values
		'debug_level'     => 5, // 0 means we see nothing, 5 means we see every possible error; use your imaginiation for 1-4
		'enviroment'      => 'development', // accepts production, development, maintenance
		'index_path'      => __DIR__ // Making this automatic in the future
		'exlcude_modules' => array( // This will allow you to prevent the loading of scripts you don't use that were included by default
			'GD_Lib' // Disables the loading of any CW functions/classes that use the GD Library
		)
		'inlcude_modules' => array( // This will allow you to load scripts you do use but were not included by default
			'CodeIgniter' // Enable CodeIgniter and any CW functions/classes that use it
		)
	)
);