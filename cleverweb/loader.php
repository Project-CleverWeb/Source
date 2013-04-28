<?php

// add required items to the queue
$_CW->init->add_folder('this-key','/this/path',1);
$_CW->init->add_function('this-key','/this/path',1);
$_CW->init->add_plugin('this-key','/this/path',1);
$_CW->init->add_class('this-key','/this/path',1);
$_CW->init->add_set('this-key','/this/path',1);

// add default/optional items to the queue
$_CW->init->add_folder('this-key','/this/path',1);
$_CW->init->add_function('this-key','/this/path',1);
$_CW->init->add_plugin('this-key','/this/path',1);
$_CW->init->add_class('this-key','/this/path',1);
$_CW->init->add_set('this-key','/this/path',1);

// load everything
$_CW->init->load_internals();
$_CW->init->load_libs();
$_CW->init->load_plugins();
$_CW->init->load_theme();