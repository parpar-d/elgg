<?php
/**
* 
*/


elgg_register_event_handler('init', 'system', 'test_init');
function test_init() 
{
	elgg_extend_view('forms/login', 'test/login');
    // register to receive requests that start with 'welcome'
    elgg_register_page_handler('test', 'test_page_handler');

    // add a menu item to primary site navigation
    
    $item = new ElggMenuItem('test', 'Google Authenticator Setting', 'test');
    elgg_register_menu_item('site', $item);

    $action_base = elgg_get_plugins_path() . 'test/actions';
    //elgg_register_action("test/GA_newsecret", "$action_base/createnewsecret.php");
}
function test_page_handler($page) 
{
    $base = elgg_get_plugins_path() . 'test/pages/test';
    //elgg_extend('river.php', 'test/secret');
    $data = file_get_contents("$base/secret.php");
    echo elgg_view_page('Title', $data);
    //include "$base/coder.php";

    return true;
}

?>