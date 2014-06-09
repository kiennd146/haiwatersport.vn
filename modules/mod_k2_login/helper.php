<?php
/**
 * @version		$Id: helper.php 1212 2011-10-18 11:08:44Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */
// no direct access
defined('_JEXEC') or die('Restricted access');

JLoader::register('K2HelperRoute', JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'route.php');
JLoader::register('K2HelperUtilities', JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'utilities.php');

class modK2LoginHelper {

	function getReturnURL($params, $type) {

		if($itemid =  $params->get($type))
		{
			$menu =& JSite::getMenu();
			$item = $menu->getItem($itemid);
			$url = JRoute::_($item->link.'&Itemid='.$itemid, false);
		}
		else
		{
			// stay on the same page
			$uri = JFactory::getURI();
			$url = $uri->toString(array('path', 'query', 'fragment'));
		}

		return base64_encode($url);
	}

	function getType() {

		$user = & JFactory::getUser();
		return (!$user->get('guest')) ? 'logout' : 'login';
	}

	function getProfile( & $params) {

		$user = &JFactory::getUser();
		$db = & JFactory::getDBO();
		$query = "SELECT * FROM #__k2_users  WHERE userID=".(int)$user->id;
		$db->setQuery($query, 0, 1);
		$profile = $db->loadObject();

		if ($profile){
			if ($profile->image!='')
			$profile->avatar = JURI::root().'media/k2/users/'.$profile->image;

			require_once (JPATH_SITE.DS.'components'.DS.'com_k2'.DS.'helpers'.DS.'permissions'.'.php');

			if (JRequest::getCmd('option')!='com_k2')
			K2HelperPermissions::setPermissions();

			if(K2HelperPermissions::canAddItem())
			$profile->addLink = JRoute::_('index.php?option=com_k2&view=item&task=add&tmpl=component');

			return $profile;

		}

	}

	function countUserComments( $userID ) {

		$db = & JFactory::getDBO();
		$query = "SELECT COUNT(*) FROM #__k2_comments WHERE userID=".(int)$userID." AND published=1";
		$db->setQuery($query);
		$result = $db->loadResult();
		return $result;

	}

	function getMenu($params){
		$items = array();
		$children = array();
		if($params->get('menu')) {
			$menu = &JSite::getMenu();
			$items = $menu->getItems('menutype', $params->get('menu'));
		}
		foreach ( $items as $item ) {
			if(K2_JVERSION=='16'){
				$item->name = $item->title;
				$item->parent = $item->parent_id;
			}
			$index = $item->parent;
			$list = @$children[$index] ? $children[$index] : array();
			array_push( $list, $item );
			$children[$index] = $list;
		}
		if(K2_JVERSION=='16'){
			$items = JHTML::_('menu.treerecurse', 1, '', array(), $children, 9999, 0, 0 );
		}
		else {
			$items = JHTML::_('menu.treerecurse', 0, '', array(), $children, 9999, 0, 0 );
		}
		$links = array();
		foreach($items as $item) {
			if($item->type == 'url') {
				$item->route = $item->link;
			}
			if(K2_JVERSION == '15') {
				$item->level = $item->sublevel;
			}
			$links[] = $item;
		}
		return $links;
	}
}
