<?php
/*
*
* @package My Topics
* @copyright (c) Pierre Duhem - LMDI - 2016
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
	protected $root_path;
	protected $php_ext;
	/* @var \phpbb\config\config */
	protected $config;


	public function __construct(
		\phpbb\user $user,
		\phpbb\config\config $config,
		\phpbb\template\template $template, 
		$root_path, 
		$phpEx)
	{
		$this->user = $user;
		$this->config = $config;
		$this->template = $template;
		$this->root_path = $root_path;
		$this->phpEx = $phpEx;
	}

	static public function getSubscribedEvents()
	{
		return array(
			'core.user_setup'	=> 'load_language',
			'core.page_header'	=> 'build_url',
		);
	}

	public function load_language($event)
	{
		$lang_set_ext = $event['lang_set_ext'];
		$lang_set_ext[] = array(
			'ext_name' => 'lmdi/mytop',
			'lang_set' => 'mytop',
		);
		$event['lang_set_ext'] = $lang_set_ext;
	}

	public function build_url($event)
	{
		if (version_compare ($this->config['version'], '3.2.x', '<'))
		{
			$mytop_class = 0;
		}
		else
		{
			$mytop_class = 1;
		}
		// var_dump ($mytop_class);
		$params  = "author=" . $this->user->data['username'] . "&amp;sf=firstpost&amp;sr=topics";
		$url = append_sid($this->root_path . "search." . $this->phpEx, $params);
		$this->template->assign_vars(array(
			'U_MYTOPICS'	=> $url,
			'S_320'		=> $mytop_class,
		));
	}
}
