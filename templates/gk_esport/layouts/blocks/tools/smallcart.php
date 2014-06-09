<?php

	// no direct access
	defined('_JEXEC') or die('Restricted access');
	
?>

<?php if($this->modules('cart')) : ?>
<div id="gkHiddenCart">		
	<jdoc:include type="modules" name="cart" style="none" />
</div>
<?php endif; ?>	