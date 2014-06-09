<?php

/**
 *
 * Framework module styles
 *
 * @version             1.0.0
 * @package             GK Framework
 * @copyright			Copyright (C) 2010 - 2011 GavickPro. All rights reserved.
 * @license                
 */
 
// No direct access.
defined('_JEXEC') or die;

/**
 * gk_style
 */
 
function modChrome_gk_style($module, $params, $attribs) {
	if (!empty ($module->content)) {		
		echo '<div class="box' . $params->get('moduleclass_sfx') . '"><div>';
		
		if($module->showtitle) {	
			echo '<h3 class="header">'.$module->title.'</h3>';
		}
		
		echo '<div class="content">' . $module->content . '</div>';
		echo '</div></div>';
	 }
}

/**
 * gk_mobile
 */

function modChrome_gk_mobile($module, $params, $attribs) {
	if (!empty ($module->content)) {
		echo '<div class="box' . $params->get('moduleclass_sfx') . '">';

		if($module->showtitle) { 
			echo '<h3 class="header">' . $module->title . '</h3>';
		}

		echo '<div><div class="content">' . $module->content . '</div></div>';
		echo '</div>';
	}
}