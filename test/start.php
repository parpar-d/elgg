<?php
/**
* 
*/


elgg_register_event_handler('init', 'system', 'test_init');
function test_init() 
{
	global $CONFIG;
	$actionspath = $CONFIG->pluginspath . "test/actions/test";
	elgg_register_action("test/usersettings/save", "$actionspath/usersettings/save.php");
	elgg_extend_view('forms/login', 'test/login');
	
    
	//elgg_register_action('test/save', elgg_get_plugins_path() . 'test/actions/plugins/usersettings/save.php');
    //$action_base = elgg_get_plugins_path() . 'test/actions';
    //elgg_register_action("test", "$action_base/edit.php");
}


