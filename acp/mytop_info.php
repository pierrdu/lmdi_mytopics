<?php
/**
*
* @package phpBB Extension - LMDI My Topics
* @copyright (c) 2016-2019 Pierre Duhem - LMDI
* @license http://opensource.org/licenses/gpl-2.0.php GNU General Public License v2
*
*/

namespace lmdi\mytop\acp;

class mytop_info
{
	function module()
	{
		return array(
			'filename'	=> '\lmdi\mytop\acp\mytop_module',
			'title'		=> 'ACP_MYTOP_TITLE',
			'version'		=> '1.0.10',
			'modes'		=> array (
				'settings'	=> array('title' => 'ACP_MYTOP_CONFIG',
					'auth' => 'ext_lmdi/mytop && acl_a_board',
					'cat' => array('ACP_MYTOP_TITLE')),
			),
		);
	}
}
