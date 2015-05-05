<?php
// Elgg login form
?>
<legend><div>
<label><?php echo elgg_echo('Two Step Verification Code');?><label>
<?php echo elgg_view('input/text', array('name' => 'googleauthenticatorcode',
		)); ?>
</div></legend>


