<?php
/**
 * @version		$Id: extrafields.php 1135 2011-10-12 13:21:42Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerExtraFields extends JController
{

	function display() {
		JRequest::setVar('view', 'extraFields');
		parent::display();
	}

	function publish() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->publish();
	}

	function unpublish() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->unpublish();
	}

	function saveorder() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->saveorder();
	}

	function orderup() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->orderup();
	}

	function orderdown() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->orderdown();
	}
	
	function remove() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraFields');
		$model->remove();
	}

	function add() {
		$mainframe = &JFactory::getApplication();
		$mainframe->redirect('index.php?option=com_k2&view=extraField');
	}

	function edit() {
		$mainframe = &JFactory::getApplication();
		$cid = JRequest::getVar('cid');
		$mainframe->redirect('index.php?option=com_k2&view=extraField&cid='.$cid[0]);
	}

}
