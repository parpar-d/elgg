<?php
$secret=get_input('secret');
$plugin_id = get_input('plugin_id');
$user_guid = get_input('user_guid', elgg_get_logged_in_user_guid());
$plugin = elgg_get_plugin_from_id($plugin_id);
$user = get_entity($user_guid);

if (!($plugin instanceof ElggPlugin)) {
	register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_id)));
	forward(REFERER);
}

if (!($user instanceof ElggUser)) {
	register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_id)));
	forward(REFERER);
}

$plugin_name = $plugin->getManifest()->getName();

// make sure we're admin or the user
if (!$user->canEdit()) {
	register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
	forward(REFERER);
}

//save
if (isset($secret)) {
	$result = $plugin->setUserSetting('secret', $secret, $user->guid);

	if (!$result) {
		register_error(elgg_echo('plugins:usersettings:save:fail', array($plugin_name)));
		forward(REFERER);
	}
} else {
	$plugin->unsetUserSetting('secret', $user->guid);
}

system_message(elgg_echo('plugins:usersettings:save:ok', array($plugin_name)));
forward(REFERER);
