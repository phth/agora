<?php
namespace AgoraTeam\Agora\UserFunc;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Phillip Thiele <philipp.thiele@phth.de>
 *           Björn Christopher Bresser <bjoern.bresser@gmail.com>
 *
 *  All rights reserved
 *
 *  This script is part of the TYPO3 project. The TYPO3 project is
 *  free software; you can redistribute it and/or modify
 *  it under the terms of the GNU General Public License as published by
 *  the Free Software Foundation; either version 3 of the License, or
 *  (at your option) any later version.
 *
 *  The GNU General Public License can be found at
 *  http://www.gnu.org/copyleft/gpl.html.
 *
 *  This script is distributed in the hope that it will be useful,
 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
 *  GNU General Public License for more details.
 *
 *  This copyright notice MUST APPEAR in all copies of the script!
 ***************************************************************/

/**
 * ActionController
 */
class Parsedown {

	/**
	 * @param $PA
	 * @param $fObj
	 * @return mixed
	 */
	public function getParsedText($PA, $fObj) {
		$uid = $PA['row']['uid'];
		$parameter = $PA['fieldConf']['config']['parameter'];

		$res = $GLOBALS['TYPO3_DB']->exec_SELECTquery(
			$parameter['field'],
			$parameter['table'],
			'uid=' . $uid );

		while($row = $GLOBALS['TYPO3_DB']->sql_fetch_assoc($res)) {
			$result[] = $row;
		}

		$parsedown = new \Parsedown();
		$text = $parsedown->text($result[0]['text']);

		return '<div class="t3-tceforms-fieldReadOnly">' . $text . '</div>';

	}

}