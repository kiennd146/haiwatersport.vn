<?php 

// no direct access
defined('_JEXEC') or die('Restricted access');
// get the tmpl variable from url
$tmpl = JRequest::getCmd('tmpl', '');
// check if it was an AJAX request
if($tmpl == 'cart') {
	// if it was an AJAX request - get images
	if(count($data->products)) {
		// get the DB access
		$db = JFactory::getDBO();
		// prepare an array of SKUs
		$skus = array();
		
		foreach($data->products as $product) {
			array_push($skus, "'".$product['product_sku']."'");
		}
		// prepare first query
		$query1 = $db->getQuery(true);
		$query1->select('`p`.`virtuemart_product_id` AS `pid`, `p`.`product_sku` AS `sku`');
		$query1->from('#__virtuemart_products AS p');
		$query1->where('`p`.`product_sku` IN('.implode(',', $skus).')');
		$db->setQuery((string)$query1);
		
		$ids = $db->loadObjectList();
		
		$pids = array();
		// get the IDs
		if ($ids) {
			foreach($ids as $id) {
				array_push($pids, $id->pid);
			}
		}
		// get the images
		$query2 = $db->getQuery(true);
		$query2->select('`m`.`file_url_thumb` AS `file`, `p`.`product_sku` AS `sku`');
		$query2->from('#__virtuemart_products AS p');
		$query2->leftJoin('#__virtuemart_product_medias AS `pm` ON `pm`.`virtuemart_product_id` = `p`.`virtuemart_product_id`');
		$query2->leftJoin('#__virtuemart_medias AS `m` ON `m`.`virtuemart_media_id` = `pm`.`virtuemart_media_id`');
		$query2->where('`p`.`virtuemart_product_id` IN('.implode(',', $pids).')');
		$query2->order('`pm`.`ordering` ASC');
		$db->setQuery((string)$query2);
		$pimages = $db->loadObjectList();
		
		$images = array();
		// get the first products images
		if ($pimages) {
			foreach($pimages as $image) {
				if(!isset($images[$image->sku])) {
					$images[$image->sku] = $image->file;
				}
			}
		}
	}
}

?>

<?php if($tmpl == 'cart') : ?>

	<div class="vmGkCartModule <?php echo $params->get('moduleclass_sfx'); ?>">
		<h3><?php echo JText::_('TPL_GK_LANG_MY_CART'); ?></h3>
		
		<?php if ($show_product_list) : ?>
			<div class="vmGkCartProducts">
				<?php 
					$iteration = 1;
					foreach ($data->products as $product) : 
				?>	
				<div class="gkContainer">
					<img src="<?php echo $images[$product['product_sku']]; ?>" alt="" width="90" height="90" />
					
					<div class="gkProductContent">
						<div class="gkProductName">
							<span class="gkQuantity"><?php echo  $product['quantity'] ?>x</span>
							<?php echo  $product['product_name'] ?>
						</div>
						
						<?php if ( !empty($product['product_attributes']) ) : ?>
						<div class="gkProductAttributes">
							<?php echo str_replace('<span>', '<br /><span>', $product['product_attributes']); ?>
						</div>
						<?php endif; ?>
					</div>
					
					<?php if ($show_price) : ?>
					<div class="gkPrice num<?php echo $iteration%3; ?>"><?php echo str_replace(' ', '', $product['prices']); ?></div>
					<?php endif; ?>
				</div>
				<?php 
					$iteration++;
					endforeach; 
				?>
			</div>
		<?php endif; ?>
		
		<?php if ($data->totalProduct) : ?>
		<div class="gkTotal">
			<?php echo str_replace(array(JText::_('COM_VIRTUEMART_CART_TOTAL').' : <strong>', '</strong>', ' '), '', $data->billTotal); ?>
		</div>
		<?php endif; ?>
		
		<div class="gkShowCart">
			<?php echo $data->cart_show; ?>
		</div>
		
		<noscript>
		<?php echo JText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
		</noscript>
	</div>
	
<?php else : ?>

	<div class="vmCartModule <?php echo $params->get('moduleclass_sfx'); ?>">
		<?php if ($show_product_list) : ?>
			<div id="hiddencontainer" style="display: none;">
				<div class="container">
					<?php if ($show_price) { ?>
					  <div class="prices" style="float: right;"></div>
					<?php } ?>
					<div class="product_row">
						<span class="quantity"></span>&nbsp;x&nbsp;<span class="product_name"></span>
					</div>
		
					<div class="product_attributes"></div>
				</div>
			</div>
			<div class="vm_cart_products">
				<div class="container">
				<?php foreach ($data->products as $product) : ?>	
					<?php if ($show_price) : ?>
						<div class="prices" style="float: right;"><?php echo  $product['prices'] ?></div>
					<?php endif; ?>
					<div class="product_row">
						<span class="quantity"><?php echo  $product['quantity'] ?></span>&nbsp;x&nbsp;<span class="product_name"><?php echo  $product['product_name'] ?></span>
					</div>
					<?php if ( !empty($product['product_attributes']) ) : ?>
						<div class="product_attributes"><?php echo  $product['product_attributes'] ?></div>
					<?php endif; ?>
				<?php endforeach; ?>
				</div>
			</div>
		<?php endif; ?>
		
		<?php if ($data->totalProduct) : ?>
		<div class="total" style="float: right;">
			<?php echo $data->billTotal; ?>
		</div>
		<div class="total_products"><?php echo $data->totalProductTxt ?></div>
		<?php endif; ?>
		
		<div class="show_cart">
			<?php echo $data->cart_show; ?>
		</div>
		
		<noscript>
		<?php echo JText::_('MOD_VIRTUEMART_CART_AJAX_CART_PLZ_JAVASCRIPT') ?>
		</noscript>
	</div>
<?php endif; ?>