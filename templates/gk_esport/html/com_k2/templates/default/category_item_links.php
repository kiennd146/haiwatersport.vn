<?php

/**
 * @package		K2
 * @author		GavickPro http://gavick.com
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

// Define default image size (do not change)
K2HelperUtilities::setDefaultImage($this->item, 'itemlist', $this->params);

?>

<!-- Start K2 Item Layout (links) -->
<li>
	<?php if($this->item->params->get('catItemTitle')): ?>
	  	<?php if ($this->item->params->get('catItemTitleLinked')): ?>
			<a href="<?php echo $this->item->link; ?>">
	  			<?php echo $this->item->title; ?>
	  		</a>
	  	<?php else: ?>
	  		<?php echo $this->item->title; ?>
	  	<?php endif; ?>
	<?php endif; ?>
</li>
<!-- End K2 Item Layout (links) -->