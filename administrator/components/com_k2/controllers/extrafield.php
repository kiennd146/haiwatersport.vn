<?php
/**
 * @version		$Id: extrafield.php 1134 2011-10-12 13:21:18Z lefteris.kavadas $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.controller');

class K2ControllerExtraField extends JController
{

	function display() {
		JRequest::setVar('view', 'extraField');
		parent::display();
	}

	function save() {
		JRequest::checkToken() or jexit('Invalid Token');
		$model = & $this->getModel('extraField');
		$model->save();
	}


	function apply() {
		$this->save();
	}

	function cancel() {
		$mainframe = &JFactory::getApplication();
		$mainframe->redirect('index.php?option=com_k2&view=extraFields');
	}

}
