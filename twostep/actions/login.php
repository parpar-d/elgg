<?php
/**
 * Elgg login action
 *
 * @subpackage User.Authentication
 */
// set forward url
if (!empty($_SESSION['last_forward_from'])) {
	$forward_url = $_SESSION['last_forward_from'];
} elseif (get_input('returntoreferer')) {
	$forward_url = REFERER;
} else {
	// forward to main index page
	$forward_url = '';
}

$username = get_input('username');
$password = get_input('password', null, false);
$persistent = (bool) get_input("persistent");
$code=get_input('googleauthenticatorcode');
$result = false;

if (empty($username) || empty($password)) {
	register_error(elgg_echo('login:empty'));
	forward();
}

// check if logging in with email address
if (strpos($username, '@') !== false && ($users = get_user_by_email($username))) {
	$username = $users[0]->username;
}

$result = elgg_authenticate($username, $password);
if ($result !== true) {
	register_error($result);
	forward(REFERER);
}
//get users guid
$user = get_user_by_username($username);
$userGuid = $user->getGUID();
//get secret from database
$secret=elgg_get_plugin_user_setting('secret',$userGuid, 'twostep');
//check for first login
if($secret==NULL)
{
	$user = get_user_by_username($username);
   try
   {
	login($user, $persistent);
	// re-register at least the core language file for users with language other than site default
	register_translations(dirname(dirname(__FILE__)) . "/languages/");
   } 
   catch (LoginException $e) 
   {
	register_error($e->getMessage());
	forward(REFERER);
   }
}
else
{
//verify code and secret
require_once 'GoogleAuthenticator.php';
$ga = new GoogleAuthenticator();
$output = $ga -> verifyCode($secret,$code,10); // 10*30 = 300 sec time telorance
if($output == true)
{
  $user = get_user_by_username($username);
   try
   {
	login($user, $persistent);
	// re-register at least the core language file for users with language other than site default
	register_translations(dirname(dirname(__FILE__)) . "/languages/");
   } 
   catch (LoginException $e) 
   {
	register_error($e->getMessage());
	forward(REFERER);
   }
}
else
  {
	//login with backup code
	$backup=elgg_get_plugin_user_setting('backup',$userGuid, 'twostep');
    if($code==$backup)
	{
		$user = get_user_by_username($username);
        try
        {
	    login($user, $persistent);
	    // re-register at least the core language file for users with language other than site default
	    register_translations(dirname(dirname(__FILE__)) . "/languages/");
        } 
        catch (LoginException $e) 
        {
	    register_error($e->getMessage());
	    forward(REFERER);
        }
	}
else
{
	register_error(elgg_echo('Please carefully fill all the fields.'));
	forward();
}
  }
}
// elgg_echo() caches the language and does not provide a way to change the language.
// @todo we need to use the config object to store this so that the current language
// can be changed. Refs #4171
if ($user->language) {
	$message = elgg_echo('loginok', array(), $user->language);
} else {
	$message = elgg_echo('loginok');
}

if (isset($_SESSION['last_forward_from'])) {
	unset($_SESSION['last_forward_from']);
}

system_message($message);
forward($forward_url);




   

