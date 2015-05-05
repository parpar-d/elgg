<?php

elgg_register_event_handler('init', 'system', 'test_init');
function test_init() 
{
	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "test/actions/test";
	elgg_register_action("test/usersettings/save", "$actionspath/usersettings/save.php");
	elgg_register_action('login', dirname(__FILE__) . '/actions/login.php', 'public');
	elgg_extend_view('forms/login', 'test/login');
}
