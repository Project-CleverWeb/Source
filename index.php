<pre><?php
// should be the only file needed, file will change in the future
include __DIR__.'/settings.php';
$_CW->init(
	// these args will override settings.php's values
	array(
		// 0 means we see nothing, 5 means we see every possible error; use your imaginiation for 1-4
		'debug_level'     => 5,
		// accepts production, development, maintenance
		'enviroment'      => 'development',
		// Making this automatic in the future
		'index_path'      => __DIR__,
		// This will allow you to prevent the loading of scripts you don't use that were included by default
		'exlcude_modules' =>
			array(
				// Disables the loading of any CW functions/classes that use the GD Library
				'GD_Lib'
			),
		// This will allow you to load scripts you do use but were not included by default
		'inlcude_modules' =>
			array(
				// Enable CodeIgniter and any CW functions/classes that use it
				'CodeIgniter' 
			)
	)
);
