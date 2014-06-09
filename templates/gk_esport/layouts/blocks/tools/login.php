<?php

	// no direct access
	defined('_JEXEC') or die('Restricted access');

	$url = JURI::getInstance();	
	$user = JFactory::getUser();
	$userID = $user->get('id');

?>

<?php if($this->modules('login')) : ?>		
<div id="loginForm">
	<h3><?php echo JText::_(($userID == 0) ? 'TPL_GK_LANG_LOGIN' : 'TPL_GK_LANG_LOGOUT'); ?> <small><?php echo JText::_('TPL_GK_LANG_OR'); ?><a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=registration"><?php echo JText::_('TPL_GK_LANG_REGISTER'); ?></a></small></h3>
	<div class="clear overflow">
		<?php if($userID > 0) : ?><div><?php endif; ?>
		<jdoc:include type="modules" name="login" style="<?php echo $this->module_styles['login']; ?>" />
		<?php if($userID > 0) : ?></div><?php endif; ?>
		
		<?php if($userID > 0) : ?>
		<div>
			<jdoc:include type="modules" name="usermenu" style="<?php echo $this->module_styles['usermenu']; ?>" />
		</div>
		<?php endif; ?>
	</div>
</div>
<?php endif; ?>	