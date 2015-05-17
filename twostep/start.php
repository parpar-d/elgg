<?php

elgg_register_event_handler('init', 'system', 'twostep_init');
function twostep_init() 
{
	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "twostep/actions/twostep";
	elgg_register_action("twostep/usersettings/save", "$actionspath/usersettings/save.php");
	elgg_register_action('login', dirname(__FILE__) . '/actions/login.php', 'public');
	elgg_extend_view('forms/login', 'twostep/login');
}
