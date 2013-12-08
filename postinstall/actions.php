<?php
/**
 * @package    Example_Postinstall_Messages
 * @author     b2z <bzzjuka@gmail.com>
 * @copyright  Copyright (C) 2013 Dmitry Rekun. All rights reserved.
 * @license    GNU General Public License version 3 or later; see license.txt
 */

defined('_JEXEC') or die;

/**
 * Checks if the plugin is enabled. If not it returns true, meaning that the
 * message concerning this plugin should be displayed.
 *
 * @return  boolean
 *
 * @since   1.0
 */
function example_postinstall_condition()
{
	$db = JFactory::getDbo();
	$query = $db->getQuery(true)
		->select('enabled')
		->from($db->quoteName('#__extensions'))
		->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
		->where($db->quoteName('enabled') . ' = 1')
		->where($db->quoteName('folder') . ' = ' . $db->quote('system'))
		->where($db->quoteName('element') . ' = ' . $db->quote('example_postinstall_messages'));
	$db->setQuery($query);

	if ($db->loadResult())
	{
		return false;
	}

	return true;
}

/**
 * Enables plugin and redirects the user to the plugin configuration page.
 *
 * @return  void
 *
 * @since   1.0
 */
function example_postinstall_action()
{
	// Get the plugin information
	$db = JFactory::getDbo();
	$query = $db->getQuery(true)
		->select('*')
		->from($db->quoteName('#__extensions'))
		->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
		->where($db->quoteName('enabled') . ' = 0')
		->where($db->quoteName('folder') . ' = ' . $db->quote('system'))
		->where($db->quoteName('element') . ' = ' . $db->quote('example_postinstall_messages'));
	$db->setQuery($query);
	$plugin = $db->loadObject();

	// Enable the plugin
	$query->clear()
		->update($db->quoteName('#__extensions'))
		->set($db->quoteName('enabled') . ' = 1')
		->where($db->quoteName('type') . ' = ' . $db->quote('plugin'))
		->where($db->quoteName('folder') . ' = ' . $db->quote('system'))
		->where($db->quoteName('element') . ' = ' . $db->quote('example_postinstall_messages'));
	$db->setQuery($query);
	$db->execute();

	// Redirect a user to the plugin configuration page
	$url = 'index.php?option=com_plugins&task=plugin.edit&extension_id=' . $plugin->extension_id;

	JFactory::getApplication()->redirect($url);
}
