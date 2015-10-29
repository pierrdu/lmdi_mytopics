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

	/* @var \phpbb\user */
	protected $user;

	/* @var \phpbb\template\template */
	protected $template;

	/* @var \phpbb\controller\helper */
	protected $helper;


	public function __construct(\phpbb\user $user, \phpbb\template\template $template)
	{
		$this->user = $user;
		$this->template = $template;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language',
			'core.page_header'	=> 'build_url',
		);
	}

	public function load_language ($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'lmdi/mytop',
			'lang_set' => 'mytop',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	} 
	
	public function build_url ($event)
	{
		$params  = "author=" . $this->user->data['username'] . "&sf=firstpost&sr=topics";
		$url = append_sid ("./search.php", $params);
		$this->template->assign_var('U_MYTOPICS', $url);
	}
}
