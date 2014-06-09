<?php

// No direct access.
defined('_JEXEC') or die;

$bottom_1_6_columns = $this->generateColumnsBlock(6, 'bottom', 'bottom1_6', 1);

?>

<?php if($this->modules('bottom1 + bottom2 + bottom3 + bottom4 + bottom5 + bottom6') && $bottom_1_6_columns !== null) : ?>
<div id="gkBottom1" class="clear">
	<div class="clearfix">
		<?php foreach($bottom_1_6_columns as $column) : ?>
		<?php if($column !== null) : ?>	
		<div id="gkbottom<?php echo $column['name']; ?>" class="gkCol <?php echo $column['class']; ?>">
            <div>
			<?php $this->addCSSRule('#gkbottom'.$column['name'].' { width: ' . $column['width'] . '%; }'); ?>
			<jdoc:include type="modules" name="<?php echo $column['name']; ?>" style="<?php echo $this->module_styles[$column['name']]; ?>" />
            </div>
        </div>
		<?php endif; ?>
		<?php endforeach; ?>
	</div>
</div>
<?php endif; ?>