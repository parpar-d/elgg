<?php
/**
 * Elgg login form
 *
 * @package Elgg
 * @subpackage Core
 */
?>
<legend  ><div  >
<label ><?php echo elgg_echo('Google Authenticator Code');?><label>

<?php echo elgg_view('input/text', array('name' => 'googleauthenticatorcode',
		)); ?>

</div></legend>


