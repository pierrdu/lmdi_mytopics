<?php
/*
*
* @package My Topics
* @copyright (c) Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-license.php GNU Public License
* 
*/

namespace lmdi\mytop\event;

use Symfony\Component\EventDispatcher\EventSubscriberInterface;

class listener implements EventSubscriberInterface
{

	protected $user;

	public function __construct(\phpbb\user $user)
	{
		$this->user = $user;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	 => 'load_language_on_viewtopic',
		);
	}

	public function load_language_on_viewtopic($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'lmdi/mytop',
			'lang_set' => 'mytop',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	} 
}
