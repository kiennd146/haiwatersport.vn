<?php

/**
 *
 * Default view
 *
 * @version             1.0.0
 * @package             Gavern Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 *               
 */
 
// No direct access.
defined('_JEXEC') or die;

$this->generateColumnsWidth();

$this->addCSSRule('.gkWrap { width: ' . $this->getParam('template_width','1240px') . '!important; }');
$this->addCSSRule('#gkVmCartSmall { margin-left: ' . floor($this->getParam('template_width','1240px') / 2) . 'px!important; }');

$tpl_page_suffix = '';

if($this->page_suffix != '') {
	$tpl_page_suffix = ' class="'.$this->page_suffix.'"';
}

$user = JFactory::getUser();
// getting User ID
$userID = $user->get('id');
// getting params
$option = JRequest::getCmd('option', '');
$view = JRequest::getCmd('view', '');
// defines if register is active
define('GK_REGISTER', ($this->modules('register') ? $userID == 0 : false));
// defines if login is active
define('GK_LOGIN', $this->modules('login'));
// defines if com_users
define('GK_COM_USERS', $option == 'com_users' && ($view == 'login' || $view == 'registration'));
//
$btn_login_text = ($userID == 0) ? JText::_('TPL_GK_LANG_LOGIN') : JText::_('TPL_GK_LANG_LOGOUT');

?>
<!DOCTYPE html PUBLIC "-//W3C//DTD XHTML 1.0 Transitional//EN" "http://www.w3.org/TR/xhtml1/DTD/xhtml1-transitional.dtd">
<html xmlns="http://www.w3.org/1999/xhtml" 
	  xmlns:og="http://ogp.me/ns#" 
	  xmlns:fb="http://www.facebook.com/2008/fbml" 
	  xml:lang="<?php echo $this->API->language; ?>" lang="<?php echo $this->API->language; ?>">
<head>
    <?php if($this->getParam("chrome_frame_support", '0') == '1') : ?>
    <meta http-equiv="X-UA-Compatible" content="chrome=1"/>
    <?php endif; ?>
    <meta http-equiv="X-UA-Compatible" content="IE=9" />
    <script>$GK_UPDATE = new Array()</script>
    <jdoc:include type="head" />
    <?php $this->loadBlock('head'); ?>
</head>
<body<?php echo $tpl_page_suffix; ?>>
	<?php if($this->browser->get('browser') == 'ie6' && $this->getParam('ie6bar', '1') == 1) : ?>
	<div id="gkInfobar"><a href="http://browsehappy.com"><?php echo JText::_('TPL_GK_LANG_IE6_BAR'); ?></a></div>
	<?php endif; ?>
	
	<div id="gkBg">
		<?php $this->messages('message-position-1'); ?>
				
	    <div id="gkPageTop" class="clearfix gkWrap">
	        <?php if(isset($_COOKIE['gkGavernMobile'.JText::_('TPL_GK_LANG_NAME')]) &&
                  $_COOKIE['gkGavernMobile'.JText::_('TPL_GK_LANG_NAME')] == 'desktop') : ?>
                  <div class="mobileSwitch gkWrap">
                    <a href="javascript:setCookie('gkGavernMobile<?php echo JText::_('TPL_GK_LANG_NAME'); ?>', 'mobile', 365);window.location.reload();"><?php echo JText::_('TPL_GK_LANG_SWITCH_TO_MOBILE'); ?></a>
                 </div>
            <?php endif; ?>    
	        <?php if($this->modules('banner1')) : ?>
	        <div id="gkBanner1">
	        	<jdoc:include type="modules" name="banner1" style="<?php echo $this->module_styles['banner1']; ?>" />
	        </div>
	        <?php endif; ?>
	    	
	    	<?php if(((GK_REGISTER || GK_LOGIN) && !GK_COM_USERS) || $this->modules('pagetop + cart')) : ?>
	    	<div id="gkPageTopFeatures" class="clearfix gkWrap">
		    	<?php if($this->modules('pagetop')) : ?>
		    	<div id="gkPageTopMod">
		    		<jdoc:include type="modules" name="pagetop" style="<?php echo $this->module_styles['pagetop']; ?>" />
		    	</div>
		    	<?php endif; ?>
		    	
		    	<?php if(((GK_REGISTER || GK_LOGIN) && !GK_COM_USERS) || $this->modules('cart')) : ?>
		    	<div id="gkPageTopLinks">
		    		<?php if($this->modules('cart')) : ?>
		    		<a href="#" id="btnCart"><?php echo JText::_('TPL_GK_LANG_MY_CART'); ?><span><?php echo JText::_('TPL_GK_LANG_MY_CART_LOADING'); ?></span></a>
		    		<?php endif; ?>
		    		
		    		<?php if(GK_LOGIN) : ?>
		    		<a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=login" id="btnLogin"><?php echo $btn_login_text; ?></a>
		    		<?php endif; ?>
		    		
		    		<?php if(GK_REGISTER) : ?>
		    		<a href="<?php echo $this->URLbase(); ?>index.php?option=com_users&amp;view=registration" id="btnRegister"><?php echo JText::_('TPL_GK_LANG_REGISTER'); ?></a>
		    		<?php endif; ?>
		    	</div>
		    	<?php endif; ?>
	    	</div>
	    	<?php endif; ?>
	    	
	        <div id="gkMainMenu" class="gkWrap<?php if($this->modules('banner1 + pagetop + login + register + cart')) : ?> gkTopSpace<?php endif; ?>">
	        	<?php $this->loadBlock('logo'); ?>
	        	
	        	<?php
	        		$this->menu->loadMenu($this->getParam('menu_name','mainmenu')); 
	        	    $this->menu->genMenu($this->getParam('startlevel', 0), $this->getParam('endlevel',-1));
	        	?>
	        	
	        	<?php if($this->generateSubmenu && $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1), true)): ?>
	        	<div id="gkSubmenu">
	        		<?php $this->menu->genMenu($this->getParam('startlevel', 0)+1, $this->getParam('endlevel',-1));?>
	        		
	        		<?php if($this->modules('search')) : ?>
	        		<div id="gkSearch">
	        			<jdoc:include type="modules" name="search" style="<?php echo $this->module_styles['search']; ?>" />
	        		</div>
	        		<?php endif; ?>
	        	</div>
	        	<?php else : ?>
		        	<?php if($this->modules('submenu + search')) : ?>
		        	<div id="gkSubmenuMod">
		        		<jdoc:include type="modules" name="submenu" style="<?php echo $this->module_styles['submenu']; ?>" />
		        		
		        		<?php if($this->modules('search')) : ?>
		        		<div id="gkSearch">
		        			<jdoc:include type="modules" name="search" style="<?php echo $this->module_styles['search']; ?>" />
		        		</div>
		        		<?php endif; ?>
		        	</div>
		        	<?php endif; ?>
	        	<?php endif; ?>
	        </div>
	    </div>
	    
	    <?php if($this->modules('banner2')) : ?>
	    <div id="gkBanner2" class="gkWrap">
	    	<jdoc:include type="modules" name="banner2" style="<?php echo $this->module_styles['banner2']; ?>" />
	    </div>
	    <?php endif; ?>
	    
	    <?php if( $this->modules('header')) : ?>
	    <div id="gkHeader" class="gkWrap clear clearfix">
	    	<jdoc:include type="modules" name="header" style="<?php echo $this->module_styles['header']; ?>" />
	    </div>
	    <?php endif; ?>
	    
	    <?php if($this->modules('banner3')) : ?>
	    <div id="gkBanner3" class="gkWrap">
	    	<jdoc:include type="modules" name="banner3" style="<?php echo $this->module_styles['banner3']; ?>" />
	    </div>
	    <?php endif; ?>
	    
		<div id="gkPage">
			<div id="gkPageWrap" class="gkMain gkWrap">  
			    <div id="mainContent" class="clear">
			    	<?php if($this->modules('breadcrumb') || $this->getToolsOverride()) : ?>
			    	<div id="gkBreadcrumb">
			    		<div>
			    			<?php if($this->modules('breadcrumb')) : ?>
			    			<jdoc:include type="modules" name="breadcrumb" style="<?php echo $this->module_styles['breadcrumb']; ?>" />
			    			<?php endif; ?>
			    			
			    			<?php if($this->getToolsOverride()) : ?>
			    				<?php $this->loadBlock('tools/tools'); ?>
			    			<?php endif; ?>
			    		</div>
			    	</div>
			    	<?php endif; ?>
					
					<?php $this->messages('message-position-2'); ?>
			    	
			    	<?php $this->loadBlock('top'); ?>
			    	
			    	<?php $this->loadBlock('main'); ?>
			    	
			    	<?php $this->loadBlock('user'); ?>
			    	
			    	<?php $this->loadBlock('bottom1'); ?>
			    </div>
		    </div>
	    </div>
	    
	    <?php $this->loadBlock('bottom2'); ?>
    	
    	<div id="gkFooter" class="gkWrap">
    		<?php $this->loadBlock('footer'); ?> 
    	</div>
    	
    	<?php if($this->getParam('framework_logo', '0') == '1') : ?>
    	<div id="gkFrameworkLogo">Framework logo</div>
    	<?php endif; ?>
    </div>
    
    <?php $this->loadBlock('social'); ?>
   
    <?php if(GK_LOGIN && !GK_COM_USERS) : ?>	
    <div id="gkPopupLogin">	
    	<div class="gkPopupWrap">
    	     <?php $this->loadBlock('tools/login'); ?>
    	</div>
    </div>
    <?php endif; ?>
    
    <?php if(GK_REGISTER && !GK_COM_USERS) : ?>
    <div id="gkPopupRegister">	
    	<div class="gkPopupWrap">
    		<?php $this->loadBlock('tools/register'); ?>
    	</div>
    </div>
    <?php endif; ?>
    
    <?php if($this->modules('cart')) : ?>	
    <div id="gkPopupCart">	
    	<div class="gkPopupWrap">
    	     <?php $this->loadBlock('tools/cart'); ?>
    	</div>
    </div>
    
    <div id="gkVmCartSmall">
    	<?php $this->loadBlock('tools/smallcart'); ?>
    </div>
    <?php endif; ?>
    
    <?php if(((GK_REGISTER || GK_LOGIN) && !GK_COM_USERS) || $this->modules('cart')) : ?>
    <div id="gkPopupOverlay"></div>
    <?php endif; ?>
   
	<jdoc:include type="modules" name="debug" />
</body>
</html>
