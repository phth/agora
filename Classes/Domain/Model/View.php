<?php
namespace AgoraTeam\Agora\Domain\Model;


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
 * View
 */
class View extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * thread
	 * 
	 * @var \AgoraTeam\Agora\Domain\Model\Thread
	 */
	protected $thread = NULL;

	/**
	 * user
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User>
	 * @cascade remove
	 */
	protected $user = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 * 
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->user = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the thread
	 * 
	 * @return \AgoraTeam\Agora\Domain\Model\Thread $thread
	 */
	public function getThread() {
		return $this->thread;
	}

	/**
	 * Sets the thread
	 * 
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function setThread(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->thread = $thread;
	}

	/**
	 * Adds a User
	 * 
	 * @param \AgoraTeam\Agora\Domain\Model\User $user
	 * @return void
	 */
	public function addUser(\AgoraTeam\Agora\Domain\Model\User $user) {
		$this->user->attach($user);
	}

	/**
	 * Removes a User
	 * 
	 * @param \AgoraTeam\Agora\Domain\Model\User $userToRemove The User to be removed
	 * @return void
	 */
	public function removeUser(\AgoraTeam\Agora\Domain\Model\User $userToRemove) {
		$this->user->detach($userToRemove);
	}

	/**
	 * Returns the user
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $user
	 * @return void
	 */
	public function setUser(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $user) {
		$this->user = $user;
	}

}