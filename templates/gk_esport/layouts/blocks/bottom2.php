<?php

// No direct access.
defined('_JEXEC') or die;

$bottom_7_12_columns = $this->generateColumnsBlock(6, 'bottom', 'bottom7_12', 7);

?>
	
<?php if($this->modules('bottom7 + bottom8 + bottom9 + bottom10 + bottom11 + bottom12') && $bottom_7_12_columns !== null) : ?>
<div id="gkBottom2" class="gkWrap clear">
	
	<div class="clearfix">
		<?php foreach($bottom_7_12_columns as $column) : ?>
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