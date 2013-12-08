<?php
/**
 * @package    Example_Postinstall_Messages
 * @author     b2z <bzzjuka@gmail.com>
 * @copyright  Copyright (C) 2013 Dmitry Rekun. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

/**
 * Plugin installer script
 *
 * @package  Example_Postinstall_Messages
 * @since    1.0
 */
class plgSystemExample_Postinstall_MessagesInstallerScript
{
	/**
	 * Method to run on the plugin install.
	 *
	 * @param   object  $parent  Parent object.
	 *
	 * @return  void
	 */
	public function install($parent)
	{
		$db = JFactory::getDbo();
		$query = 'INSERT INTO ' . $db->quoteName('#__postinstall_messages')
			. '(`extension_id`,
			`title_key`, 
			`description_key`, 
			`action_key`, 
			`language_extension`, 
			`language_client_id`, 
			`type`, 
			`action_file`, 
			`action`, 
			`condition_file`, 
			`condition_method`, 
			`version_introduced`, 
			`enabled`) VALUES '
			. '(700,
			"PLG_SYSTEM_EXAMPLE_POSTINSTALL_MESSAGES_POSTINSTALL_TITLE", 
			"PLG_SYSTEM_EXAMPLE_POSTINSTALL_MESSAGES_POSTINSTALL_BODY", 
			"PLG_SYSTEM_EXAMPLE_POSTINSTALL_MESSAGES_POSTINSTALL_ACTION",
			"plg_system_example_postinstall_messages",
			1,
			"action", 
			"site://plugins/system/example_postinstall_messages/postinstall/actions.php",
			"example_postinstall_action", 
			"site://plugins/system/example_postinstall_messages/postinstall/actions.php",
			"example_postinstall_condition", 
			"3.2.0", 
			1)';
		$db->setQuery($query);
		$db->execute();
	}

	/**
	 * Method to run on the plugin uninstall.
	 *
	 * @param   object  $parent  Parent object.
	 *
	 * @return  void
	 */
	public function uninstall($parent)
	{
		$db = JFactory::getDbo();
		$query = 'DELETE FROM ' . $db->quoteName('#__postinstall_messages') .
			' WHERE ' . $db->quoteName('language_extension') . ' = ' . $db->quote('plg_system_example_postinstall_messages');
		$db->setQuery($query);
		$db->execute();
	}
}
