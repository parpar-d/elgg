<?php
/**
* 
*/


elgg_register_event_handler('init', 'system', 'test_init');
function test_init() 
{
	elgg_extend_view('forms/login', 'test/login');
	//elgg_extend_view('forms/profile/edit', 'test/edit');
	//elgg_extend_view('page/elements/header', 'test/save');
	//elgg_register_ajax_view('edit');
    
	elgg_register_action('test/save', elgg_get_plugins_path() . 'test/actions/plugins/usersettings/save.php');
    //$action_base = elgg_get_plugins_path() . 'test/actions';
    //elgg_register_action("test", "$action_base/edit.php");
}


