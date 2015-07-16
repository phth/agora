<?php
namespace AgoraTeam\Agora\Domain\Model;

	/***************************************************************
	 *  Copyright notice
	 *  (c) 2015 Philipp Thiele <philipp.thiele@phth.de>
	 *           Björn Christopher Bresser <bjoern.bresser@gmail.com>
	 *  All rights reserved
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 3 of the License, or
	 *  (at your option) any later version.
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

/**
 * Forum
 */
class Forum extends Entity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * description
	 *
	 * @var string
	 */
	protected $description = '';

	/**
	 * parent
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\Forum
	 * @lazy
	 */
	protected $parent = NULL;

	/**
	 * parent
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Forum>
	 * @cascade remove
	 * @lazy
	 */
	protected $subForums = NULL;

	/**
	 * threads
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Thread>
	 * @cascade remove
	 * @lazy
	 */
	protected $threads = NULL;

	/**
	 * groupsWithReadAccess
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group>
	 * @lazy
	 */
	protected $groupsWithReadAccess = NULL;

	/**
	 * groupsWithWriteAccess
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group>
	 * @lazy
	 */
	protected $groupsWithWriteAccess = NULL;

	/**
	 * groupsWithModificationAccess
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group>
	 * @lazy
	 */
	protected $groupsWithModificationAccess = NULL;

	/**
	 * usersWithReadAccess
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User>
	 * @lazy
	 */
	protected $usersWithReadAccess = NULL;

	/**
	 * usersWithWriteAccess
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User>
	 * @lazy
	 */
	protected $usersWithWriteAccess = NULL;

	/**
	 * usersWithModificationAccess
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User>
	 * @lazy
	 */
	protected $usersWithModificationAccess = NULL;

	/**
	 * rootline
	 *
	 * @var array
	 */
	protected $rootline = array();

	/**
	 * __construct
	 */
	public function __construct() {
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
		$this->subForums = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->threads = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->groupsWithReadAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->groupsWithWriteAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->groupsWithModificationAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->usersWithReadAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->usersWithWriteAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->usersWithModificationAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the description
	 *
	 * @return string $description
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the description
	 *
	 * @param string $description
	 * @return void
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the parent
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\Forum $parent
	 */
	public function getParent() {
		return $this->parent;
	}

	/**
	 * Sets the parent
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $parent
	 * @return void
	 */
	public function setParent($parent) {
		$this->parent = $parent;
	}

	/**
	 * Adds a SubForum
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $subForum
	 * @return void
	 */
	public function addSubForum(\AgoraTeam\Agora\Domain\Model\Forum $subForum) {
		$this->subForums->attach($subForum);
	}

	/**
	 * Removes a Forum
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $subForumToRemove The SubForum to be removed
	 * @return void
	 */
	public function removeSubForum(\AgoraTeam\Agora\Domain\Model\Forum $subForumToRemove) {
		$this->subForums->detach($subForumToRemove);
	}

	/**
	 * Returns the subForums
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Forum> $parent
	 */
	public function getSubForums() {
		return $this->subForums;
	}

	/**
	 * Sets the subForums
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Forum> $subForums
	 * @return void
	 */
	public function setSubForums(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $subForums) {
		$this->subForums = $subForums;
	}

	/**
	 * Adds a Thread
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function addThread(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->threads->attach($thread);
	}

	/**
	 * Removes a Thread
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $threadToRemove The Thread to be removed
	 * @return void
	 */
	public function removeThread(\AgoraTeam\Agora\Domain\Model\Thread $threadToRemove) {
		$this->threads->detach($threadToRemove);
	}

	/**
	 * Returns the threads
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Thread> $threads
	 */
	public function getThreads() {
		return $this->threads;
	}

	/**
	 * Sets the threads
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Thread> $threads
	 * @return void
	 */
	public function setThreads(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $threads) {
		$this->threads = $threads;
	}

	/**
	 * Returns the latest thread
	 *
	 * @return \boolean|\AgoraTeam\Agora\Domain\Model\Thread $latestThread
	 */
	public function getLatestThread() {
		$latestThread = FALSE;
		if ($this->threads->count()) {
			$threads = $this->threads->toArray();
			$latestThread = $threads[$this->threads->count() - 1];
		}

		return $latestThread;
	}

	/**
	 * Adds a Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupsWithReadAccess
	 * @return void
	 */
	public function addGroupsWithReadAccess(\AgoraTeam\Agora\Domain\Model\Group $groupsWithReadAccess) {
		$this->groupsWithReadAccess->attach($groupsWithReadAccess);
	}

	/**
	 * Removes the Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupsWithReadAccessToRemove The Group to be removed
	 * @return void
	 */
	public function removeGroupsWithReadAccess(\AgoraTeam\Agora\Domain\Model\Group $groupsWithReadAccessToRemove) {
		$this->groupsWithReadAccess->detach($groupsWithReadAccessToRemove);
	}

	/**
	 * Returns the groupsWithReadAccess
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groupsWithReadAccess
	 */
	public function getGroupsWithReadAccess() {
		return $this->groupsWithReadAccess;
	}

	/**
	 * Sets the groupsWithReadAccess
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groupsWithReadAccess
	 * @return void
	 */
	public function setGroupsWithReadAccess(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $groupsWithReadAccess) {
		$this->groupsWithReadAccess = $groupsWithReadAccess;
	}

	/**
	 * Adds the Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupWithWriteAccess
	 * @return void
	 */
	public function addGroupWithWriteAccess(\AgoraTeam\Agora\Domain\Model\Group $groupWithWriteAccess) {
		$this->groupsWithWriteAccess->attach($groupWithWriteAccess);
	}

	/**
	 * Removes the groupsWithWriteAccess
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupWithWriteAccessToRemove The Group to be removed
	 * @return void
	 */
	public function removeGroupWithWriteAccess(\AgoraTeam\Agora\Domain\Model\Group $groupWithWriteAccessToRemove) {
		$this->groupsWithWriteAccess->detach($groupWithWriteAccessToRemove);
	}

	/**
	 * Returns the groupsWithWriteAccess
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groupsWithWriteAccess
	 */
	public function getGroupsWithWriteAccess() {
		return $this->groupsWithWriteAccess;
	}

	/**
	 * Sets the groupsWithWriteAccess
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groupsWithWriteAccess
	 * @return void
	 */
	public function setGroupsWithWriteAccess(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $groupsWithWriteAccess) {
		$this->groupsWithWriteAccess = $groupsWithWriteAccess;
	}

	/**
	 * Adds a Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupWithModificationAccess
	 * @return void
	 */
	public function addGroupWithModificationAccess(\AgoraTeam\Agora\Domain\Model\Group $groupWithModificationAccess) {
		$this->groupsWithModificationAccess->attach($groupWithModificationAccess);
	}

	/**
	 * Removes a Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupWithModificationAccessToRemove The Group to be removed
	 * @return void
	 */
	public function removeGroupWithModificationAccess(\AgoraTeam\Agora\Domain\Model\Group $groupWithModificationAccessToRemove) {
		$this->groupsWithModificationAccess->detach($groupWithModificationAccessToRemove);
	}

	/**
	 * Returns the groupsWithModificationAccess
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groupsWithModificationAccess
	 */
	public function getGroupsWithModificationAccess() {
		return $this->groupsWithModificationAccess;
	}

	/**
	 * Sets the groupsWithModificationAccess
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groupsWithModificationAccess
	 * @return void
	 */
	public function setGroupsWithModificationAccess(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $groupsWithModificationAccess) {
		$this->groupsWithModificationAccess = $groupsWithModificationAccess;
	}

	/**
	 * Adds a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $userWithReadAccess
	 * @return void
	 */
	public function addUserWithReadAccess(\AgoraTeam\Agora\Domain\Model\User $userWithReadAccess) {
		$this->usersWithReadAccess->attach($userWithReadAccess);
	}

	/**
	 * Removes a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $userWithReadAccessToRemove The User to be removed
	 * @return void
	 */
	public function removeUserWithReadAccess(\AgoraTeam\Agora\Domain\Model\User $userWithReadAccessToRemove) {
		$this->usersWithReadAccess->detach($userWithReadAccessToRemove);
	}

	/**
	 * Returns the usersWithReadAccess
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $usersWithReadAccess
	 */
	public function getUsersWithReadAccess() {
		return $this->usersWithReadAccess;
	}

	/**
	 * Sets the usersWithReadAccess
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $usersWithReadAccess
	 * @return void
	 */
	public function setUsersWithReadAccess(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $usersWithReadAccess) {
		$this->usersWithReadAccess = $usersWithReadAccess;
	}

	/**
	 * Adds a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $userWithWriteAccess
	 * @return void
	 */
	public function addUserWithWriteAccess(\AgoraTeam\Agora\Domain\Model\User $userWithWriteAccess) {
		$this->usersWithWriteAccess->attach($userWithWriteAccess);
	}

	/**
	 * Removes a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $userWithWriteAccessToRemove The User to be removed
	 * @return void
	 */
	public function removeUserWithWriteAccess(\AgoraTeam\Agora\Domain\Model\User $userWithWriteAccessToRemove) {
		$this->usersWithWriteAccess->detach($userWithWriteAccessToRemove);
	}

	/**
	 * Returns the usersWithWriteAccess
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $usersWithWriteAccess
	 */
	public function getUsersWithWriteAccess() {
		return $this->usersWithWriteAccess;
	}

	/**
	 * Sets the usersWithWriteAccess
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $usersWithWriteAccess
	 * @return void
	 */
	public function setUsersWithWriteAccess(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $usersWithWriteAccess) {
		$this->usersWithWriteAccess = $usersWithWriteAccess;
	}

	/**
	 * Adds a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $userWithModificationAccess
	 * @return void
	 */
	public function addUserWithModificationAccess(\AgoraTeam\Agora\Domain\Model\User $userWithModificationAccess) {
		$this->usersWithModificationAccess->attach($userWithModificationAccess);
	}

	/**
	 * Removes a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $userWithModificationAccessToRemove The User to be removed
	 * @return void
	 */
	public function removeUserWithModificationAccess(\AgoraTeam\Agora\Domain\Model\User $userWithModificationAccessToRemove) {
		$this->usersWithModificationAccess->detach($userWithModificationAccessToRemove);
	}

	/**
	 * Returns the usersWithModificationAccess
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $usersWithModificationAccess
	 */
	public function getUsersWithModificationAccess() {
		return $this->usersWithModificationAccess;
	}

	/**
	 * Sets the usersWithModificationAccess
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $usersWithModificationAccess
	 * @return void
	 */
	public function setUsersWithModificationAccess(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $usersWithModificationAccess) {
		$this->usersWithModificationAccess = $usersWithModificationAccess;
	}

	/**
	 * Returns the read protected flag
	 *
	 * @return boolean $readProtected
	 */
	public function getReadProtected() {
		$readProtected = FALSE;
		if ($this->getUsersWithReadAccess()->count() > 0) {
			$readProtected = TRUE;
		}
		if ($this->getGroupsWithReadAccess()->count() > 0) {
			$readProtected = TRUE;
		}

		return $readProtected;
	}

	/**
	 * Returns the boolean state of the read protected flag
	 *
	 * @return boolean
	 */
	public function isReadProtected() {
		return $this->getReadProtected();
	}

	/**
	 * Returns the write protected flag
	 *
	 * @return boolean $writeProtected
	 */
	public function getWriteProtected() {
		$writeProtected = FALSE;
		if ($this->getUsersWithWriteAccess()->count() > 0) {
			$writeProtected = TRUE;
		}
		if ($this->getGroupsWithWriteAccess()->count() > 0) {
			$writeProtected = TRUE;
		}

		return $writeProtected;
	}

	/**
	 * Returns the boolean state of the write protected flag
	 *
	 * @return boolean
	 */
	public function isWriteProtected() {
		return $this->getWriteProtected();
	}

	/**
	 * Returns the modify protected flag
	 *
	 * @return boolean $modifyProtected
	 */
	public function getModifyProtected() {
		$modifyProtected = FALSE;
		if ($this->getUsersWithModificationAccess()->count() > 0) {
			$modifyProtected = TRUE;
		}
		if ($this->getGroupsWithModificationAccess()->count() > 0) {
			$modifyProtected = TRUE;
		}

		return $modifyProtected;
	}

	/**
	 * Returns the boolean state of the modify protected flag
	 *
	 * @return boolean
	 */
	public function isModifyProtected() {
		return $this->getModifyProtected();
	}

	/**
	 * Returns the rootline
	 *
	 * @return array
	 */
	public function getRootline() {
		if (empty($this->rootline)) {
			$this->fetchNextRootlineLevel();
		}

		return $this->rootline;
	}

	/**
	 * fetches next rootline level recursively
	 *
	 * @return void
	 */
	public function fetchNextRootlineLevel() {

		if (empty($this->rootline)) {
			if (is_object($this->getParent())) {
				array_push($this->rootline, current($this->getParent()->getRootline()));
				array_push($this->rootline, $this);
			} else {
				array_push($this->rootline, $this);
			}
		}
	}

	/**
	 * checks if the forum is accessible for the given user
	 *
	 * @param mixed $user
	 * @return bool
	 */
	public function isAccessibleForUser($user) {
		$isAccessible = FALSE;

		if ($this->isReadProtected()) {
			if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
				if ($this->getUsersWithReadAccess()->count() > 0) {
					foreach ($this->getUsersWithReadAccess() as $currentUser) {
						if ($user->getUid() == $currentUser->getUid()) {
							$isAccessible = TRUE;
							break;
						}
					}
				}
				// the comparision on group level is expensive, so check and double-check if this is really necessary
				if ($isAccessible != TRUE) {
					if ($this->getGroupsWithReadAccess()->count() > 0) {
						foreach ($this->getGroupsWithReadAccess() as $groupWithAccess) {
							foreach ($user->getFlattenedGroups() as $group) {
								if ($groupWithAccess->getUid() == $group->getUid()) {
									$isAccessible = TRUE;
									break;
								}
							}
						}
					}
				}
			}
		} else {
			$isAccessible = TRUE;
		}

		return $isAccessible;
	}

	/**
	 * checks if the forum is writable for the given user
	 *
	 * @param mixed $user
	 * @return bool
	 */
	public function isWritableForUser($user) {
		$isWritable = FALSE;

		if ($this->isWriteProtected()) {
			if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
				if ($this->getUsersWithWriteAccess()->count() > 0) {
					foreach ($this->getUsersWithWriteAccess() as $currentUser) {
						if ($user->getUid() == $currentUser->getUid()) {
							$isWritable = TRUE;
							break;
						}
					}
				}
				// the comparision on group level is expensive, so check and double-check if this is really necessary
				if ($isWritable !== TRUE) {
					if ($this->getGroupsWithWriteAccess()->count() > 0) {
						foreach ($this->getGroupsWithWriteAccess() as $groupWithAccess) {
							foreach ($user->getFlattenedGroups() as $group) {
								if ($groupWithAccess->getUid() == $group->getUid()) {
									$isWritable = TRUE;
									break;
								}
							}
						}
					}
				}
			}
		} else {
			$isWritable = TRUE;
		}

		return $isWritable;
	}

}