<?php
namespace AgoraTeam\Agora\Domain\Repository;

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
 * Class Repository
 *
 * @package AgoraTeam\Agora\Domain\Repository
 */
class Repository extends \TYPO3\CMS\Extbase\Persistence\Repository {

	/**
     * userRepository
     *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository;

	/**
     * user
     *
     * the logged in frontend user, if there is any
     *
	 * @var mixed
	 */
	protected $user;

    /**
     * initialize object
     *
     * @return void
     */
	public function initializeObject() {
		$userFromTSFE = $GLOBALS['TSFE']->fe_user->user;
		$user = $this->userRepository->findByUid($userFromTSFE['uid']);
        if(is_a($user, '\AgoraTeam\Agora\Domain\Repository\User')) {
            $this->setUser($user);
        }
	}

	/**
     * Returns the user
     *
	 * @return mixed
	 */
	public function getUser() {
		return $this->user;
	}

	/**
     * Sets the user
     *
	 * @param mixed $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}


}
