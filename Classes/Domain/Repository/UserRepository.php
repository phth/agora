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
 * The repository for Users
 */
class UserRepository extends Repository {

	/**
	 * @param int $uid
	 * @return object
	 */
	public function findByUid($uid) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setIgnoreEnableFields(TRUE);
		$query->getQuerySettings()->setRespectSysLanguage(FALSE);
		$query->getQuerySettings()->setRespectStoragePage(FALSE);
		$and = array(
			$query->equals('uid', $uid),
			$query->equals('deleted', 0)
		);
		$object = $query->matching($query->logicalAnd($and))->execute()->getFirst();
		return $object;
	}

	/**
	 * @param \AgoraTeam\Agora\Domain\Model\User $user
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 */
	public function findObservedThreadByUser(\AgoraTeam\Agora\Domain\Model\Thread $thread, \AgoraTeam\Agora\Domain\Model\User $user) {
		$query = $this->createQuery();
		$query->getQuerySettings()->setIgnoreEnableFields(TRUE);
		$query->getQuerySettings()->setRespectSysLanguage(FALSE);
		$query->getQuerySettings()->setRespectStoragePage(FALSE);

		$and = array(
			$query->equals('uid', $user->getUid()),
			$query->contains('observedThreads', $thread)
		);

		$object = $query->matching($query->logicalAnd($and))->execute()->getFirst();
		return ($object !== NULL) ? TRUE : FALSE;
	}



}