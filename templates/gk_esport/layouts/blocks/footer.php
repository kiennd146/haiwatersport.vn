<?php

// No direct access.
defined('_JEXEC') or die;

?>

<div id="gkFooterWrap">
      <div id="gkCopyrights">
            <?php if($this->modules('footer_nav')) : ?>
            <div id="gkFooterNav">
                  <jdoc:include type="modules" name="footer_nav" style="<?php echo $this->module_styles['footer_nav']; ?>" />
            </div>
            <?php endif; ?>
            
			<?php if($this->getParam('stylearea', '0') == '1') : ?>
            <div id="gkStyleArea">
                <a href="#" id="gkColor1">Green</a>
                <a href="#" id="gkColor2">Blue</a>
                <a href="#" id="gkColor3">Pink</a>
            </div>
            <?php endif; ?>
			
			<?php if($this->getParam('copyrights', '') !== '') : ?>
            <span>
            <?php echo $this->getParam('copyrights', ''); ?>
            </span>
            <?php endif; ?>
            
            <?php if(isset($_COOKIE['gkGavernMobile'.JText::_('TPL_GK_LANG_NAME')]) && 
	    	$_COOKIE['gkGavernMobile'.JText::_('TPL_GK_LANG_NAME')] == 'desktop') : ?>
            <a href="javascript:setCookie('gkGavernMobile<?php echo JText::_('TPL_GK_LANG_NAME'); ?>', 'mobile', 365);window.location.reload();"><?php echo JText::_('TPL_GK_LANG_SWITCH_TO_MOBILE'); ?></a>
            <?php endif; ?>
      </div>
</div>
