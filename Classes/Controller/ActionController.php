<?php
namespace AgoraTeam\Agora\Controller;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Philipp Thiele <philipp.thiele@phth.de>
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
class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * persistenceManager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

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
		$user = $this->getCurrentUser();
		if(is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			$this->setUser($user);
		}
	}

	/**
	 * Get current logged in user
	 *
	 * @return null|\AgoraTeam\Agora\Domain\Repository\User
	 */
	public function getCurrentUser() {

		if (!is_array($GLOBALS['TSFE']->fe_user->user)) {
			return NULL;
		}
		return $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
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

	/**
	 * Get Usergroups from current user
	 *
	 * @return array
	 */
	public function getCurrentUsergroupUids() {
		$currentUser = $this->getUser();
		$usergroupUids = array();
		if ($currentUser !== NULL) {
			foreach ($currentUser->getUsergroup() as $usergroup) {
				$usergroupUids[] = $usergroup->getUid();
			}
		}
		return $usergroupUids;
	}


}