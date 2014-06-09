<?php

// No direct access.
defined('_JEXEC') or die;

$right_column_middle_class = ' oneCol';

if($this->modules('right_left and right_right')) {
	$right_column_middle_class = ' twoCol';
}

?>


<?php if($this->modules('right_top + right_bottom + right_left + right_right')) : ?>
<div id="gkRight" class="gkMain gkCol">
	<?php if($this->modules('right_top')) : ?>
	<div id="gkRightTop" class="gkMain">
		<jdoc:include type="modules" name="right_top" style="<?php echo $this->module_styles['right_top']; ?>" />
	</div>
	<?php endif; ?>

	<?php if($this->modules('right_left + right_right')) : ?>
	<div id="gkRightMiddle" class="gkMain">
		<?php if($this->modules('right_left')) : ?>
		<div id="gkRightLeft" class="gkMain gkCol <?php echo $this->generatePadding('gkRightLeft'); ?>">
			<jdoc:include type="modules" name="right_left" style="<?php echo $this->module_styles['right_left']; ?>" />
		</div>
		<?php endif; ?>	
		
		<?php if($this->modules('right_right')) : ?>
		<div id="gkRightRight" class="gkMain gkCol">
			<jdoc:include type="modules" name="right_right" style="<?php echo $this->module_styles['right_right']; ?>" />
		</div>
		<?php endif; ?>			
	</div>
	<?php endif; ?>	

	<?php if($this->modules('right_bottom')) : ?>
	<div id="gkRightBottom" class="gkMain">
		<jdoc:include type="modules" name="right_bottom" style="<?php echo $this->module_styles['right_bottom']; ?>" />
	</div>
	<?php endif; ?>	
</div>
<?php endif; ?>