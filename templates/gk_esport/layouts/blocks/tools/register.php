<?php

	// no direct access
	defined('_JEXEC') or die('Restricted access');

	$url = JURI::getInstance();	
	$user = JFactory::getUser();
	$userID = $user->get('id');

?>

<?php if($this->modules('register') && $userID == 0) : ?>	
<div id="registerForm">		
	<h3><?php echo JText::_('TPL_GK_LANG_REGISTER'); ?></h3>
	<div class="clear overflow">
		<jdoc:include type="modules" name="register" style="<?php echo $this->module_styles['register']; ?>" />
	</div>
</div>		
<?php endif; ?>		