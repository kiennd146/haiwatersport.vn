<?php
/**
 * @version		$Id: usergroup.php 1034 2011-10-04 17:00:00Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.model');

JTable::addIncludePath(JPATH_COMPONENT.DS.'tables');

class K2ModelUserGroup extends JModel
{

	function getData() {
	
		$cid = JRequest::getVar('cid');
		$row = & JTable::getInstance('K2UserGroup', 'Table');
		$row->load($cid);
		return $row;
	}

	function save() {
	
		$mainframe = &JFactory::getApplication();
		$row = & JTable::getInstance('K2UserGroup', 'Table');
	
		if (!$row->bind(JRequest::get('post'))) {
			$mainframe->redirect('index.php?option=com_k2&view=userGroups', $row->getError(), 'error');
		}
	
		if (!$row->check()) {
			$mainframe->redirect('index.php?option=com_k2&view=userGroup&cid='.$row->id, $row->getError(), 'error');
		}
		
		if (!$row->store()) {
			$mainframe->redirect('index.php?option=com_k2&view=userGroups', $row->getError(), 'error');
		}

		$cache = & JFactory::getCache('com_k2');
		$cache->clean();
		
		switch(JRequest::getCmd('task')) {
			case 'apply':
			$msg = JText::_('K2_CHANGES_TO_USER_GROUP_SAVED');
			$link = 'index.php?option=com_k2&view=userGroup&cid='.$row->id;
			break;
			case 'save':
			default:
			$msg = JText::_('K2_USER_GROUP_SAVED');
			$link = 'index.php?option=com_k2&view=userGroups';
			break;
		}
		$mainframe->redirect($link, $msg);
	}
	
}
