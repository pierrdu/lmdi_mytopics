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
			'core.viewtopic_assign_template_vars_before'	 => 'load_language_on_viewtopic',
		);
	}

	public function load_language_on_viewtopic()
	{
		$this->user->add_lang_ext('lmdi/mytop', 'mytop');
	} 
}
