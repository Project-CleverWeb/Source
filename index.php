<?php
include __DIR__.'/settings.php'; // should be the only file needed, file will change in the future
cleverweb::init(
	array( // these args will override settings.php's values
		'debug_level' => 5, // 0 means we see nothing, 5 means we see every possible error; use your imaginiation for 1-4
		'enviroment'  => 'development', // accepts production, development, maintenance
		'index_path'  => __DIR__ // Making this automatic in the future
	)
);