<?php
namespace AgoraTeam\Agora\Domain\Factory;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Björn Christopher Bresser <bjoern.bresser@gmail.com>
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

class AbstractFactory {

	/**
	 * userRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository;


	/**
	 * Get current logged in user
	 *
	 * @return null|object
	 */
	public function getCurrentUser() {
		if (!is_array($GLOBALS['TSFE']->fe_user->user)) {
			return NULL;
		}

		return $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
	}


}