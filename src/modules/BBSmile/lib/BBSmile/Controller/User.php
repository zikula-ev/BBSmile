<?php
// $Id$
// ----------------------------------------------------------------------
// LICENSE
//
// This program is free software; you can redistribute it and/or
// modify it under the terms of the GNU General Public License (GPL)
// as published by the Free Software Foundation; either version 2
// of the License, or (at your option) any later version.
//
// This program is distributed in the hope that it will be useful,
// but WITHOUT ANY WARRANTY; without even the implied warranty of
// MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
// GNU General Public License for more details.
//
// To read the license please visit http://www.gnu.org/copyleft/gpl.html
// ----------------------------------------------------------------------
// Original Author of file: Hinrich Donner
// changed to bbsmile: larsneo
// ----------------------------------------------------------------------

/**
 * @package Zikula_Utility_Modules
 * @subpackage bbsmile
 * @license http://www.gnu.org/copyleft/gpl.html
*/

class BBSmile_Controller_User extends Zikula_Controller
{

	/**
	* main funcion
	* The main function is not used in the bbsmile module, we just rediret to index.php
	*
	*/
	public function main()
	{
	    return System::redirect(System::getVar('entrypoint', 'index.php'));
	}

	/**
	* bbsmile
	* returns a html snippet with buttons for inserting bbsmiles into a text
	*
	* @param    $args['textfieldid']  id of the textfield for inserting smilies
	*/
	public function bbsmiles($args)
	{
		if(!isset($args['textfieldid']) || empty($args['textfieldid'])) {
			return LogUtil::registerArgsError();
		}

		// if we have more than one textarea we need to distinguish them, so we simply use
		// a counter stored in a session var until we find a better solution
		$counter = SessionUtil::getVar('bbsmile_counter', 0);
		$counter++;
		SessionUtil::setVar('bbsmile_counter', $counter);

		$pnr = Zikula_View::getInstance('BBSmile', false, null, true);
		$pnr->assign('counter', $counter);
		$pnr->assign('textfieldid', $args['textfieldid']);

		PageUtil::addVar('stylesheet', ThemeUtil::getModuleStylesheet('BBSmile'));
		
		$templatefile = DataUtil::formatForOS(ModUtil::getName()) . '.tpl';
		if($pnr->template_exists($templatefile)) {
		    return $pnr->fetch($templatefile);
		}
		$pnr->add_core_data();
		return $pnr->fetch('bbsmile_user_bbsmiles.tpl');
	}
}
