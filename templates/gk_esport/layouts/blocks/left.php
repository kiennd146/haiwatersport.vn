<?php

// No direct access.
defined('_JEXEC') or die;

$left_column_middle_class = ' oneCol';

if($this->modules('left_left and left_right')) {
	$left_column_middle_class = ' twoCol';
}

?>


<?php if($this->modules('left_top + left_bottom + left_left + left_right')) : ?>
<div id="gkLeft" class="gkMain gkCol">
	<?php if($this->modules('left_top')) : ?>
	<div id="gkLeftTop" class="gkMain">
		<jdoc:include type="modules" name="left_top" style="<?php echo $this->module_styles['left_top']; ?>" />
	</div>
	<?php endif; ?>

	<?php if($this->modules('left_left + left_right')) : ?>
	<div id="gkLeftMiddle" class="gkMain">
		<?php if($this->modules('left_left')) : ?>
		<div id="gkLeftLeft" class="gkMain gkCol <?php echo $this->generatePadding('gkLeftLeft'); ?>">
			<jdoc:include type="modules" name="left_left" style="<?php echo $this->module_styles['left_left']; ?>" />
		</div>
		<?php endif; ?>	
		
		<?php if($this->modules('left_right')) : ?>
		<div id="gkLeftRight" class="gkMain gkCol">
			<jdoc:include type="modules" name="left_right" style="<?php echo $this->module_styles['left_right']; ?>" />
		</div>
		<?php endif; ?>			
	</div>
	<?php endif; ?>	

	<?php if($this->modules('left_bottom')) : ?>
	<div id="gkLeftBottom" class="gkMain">
		<jdoc:include type="modules" name="left_bottom" style="<?php echo $this->module_styles['left_bottom']; ?>" />
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>