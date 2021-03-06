<?php
/**
 * @version		$Id: view.html.php 1047 2011-10-05 18:36:25Z joomlaworks $
 * @package		K2
 * @author		JoomlaWorks http://www.joomlaworks.gr
 * @copyright	Copyright (c) 2006 - 2011 JoomlaWorks Ltd. All rights reserved.
 * @license		GNU/GPL license: http://www.gnu.org/copyleft/gpl.html
 */

// no direct access
defined('_JEXEC') or die('Restricted access');

jimport('joomla.application.component.view');

class K2ViewUser extends JView
{

	function display($tpl = null) {
	
		JRequest::setVar('hidemainmenu', 1);
		$model = & $this->getModel();
		$user = $model->getData();
		JFilterOutput::objectHTMLSafe( $user );
		$joomlaUser = & JUser::getInstance(JRequest::getInt('cid'));
	
		$user->name = $joomlaUser->name;
		$user->userID = $joomlaUser->id;
		$this->assignRef('row', $user);
	
		$wysiwyg = & JFactory::getEditor();
		$editor = $wysiwyg->display('description', $user->description, '480px', '250px', '', '', false);
		$this->assignRef('editor', $editor);
	
		$lists = array ();
		$genderOptions[] = JHTML::_('select.option', 'm', JText::_('K2_MALE'));
		$genderOptions[] = JHTML::_('select.option', 'f', JText::_('K2_FEMALE'));
		$lists['gender'] = JHTML::_('select.radiolist', $genderOptions, 'gender','','value','text',$user->gender);
		
		$userGroupOptions=$model->getUserGroups();
		$lists['userGroup']=JHTML::_('select.genericlist', $userGroupOptions, 'group', 'class="inputbox"', 'id', 'name', $user->group);
		
		$this->assignRef('lists', $lists);
	
		$params = & JComponentHelper::getParams('com_k2');
		$this->assignRef('params', $params);
		
		JPluginHelper::importPlugin ( 'k2' );
		$dispatcher = &JDispatcher::getInstance ();
		$K2Plugins=$dispatcher->trigger('onRenderAdminForm', array (&$user, 'user' ) );
		$this->assignRef('K2Plugins', $K2Plugins);
	
		JToolBarHelper::title(JText::_('K2_USER'), 'k2.png');
		JToolBarHelper::save();
		JToolBarHelper::apply();
		JToolBarHelper::cancel();
		$toolbar=JToolBar::getInstance('toolbar');
		if(K2_JVERSION == '16'){
			$link = JURI::base().'index.php?option=com_users&view=user&task=user.edit&id='.$user->userID;
		}
		else {
			$link = JURI::base().'index.php?option=com_users&view=user&task=edit&cid[]='.$user->userID;
		}
		$toolbar->prependButton('Link', 'edit', 'K2_EDIT_JOOMLA_USER', $link);
	
		parent::display($tpl);
	}

}
