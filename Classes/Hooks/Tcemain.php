<?php
namespace AgoraTeam\Agora\Hooks;


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
 * Hook into tcemain
 */
class Tcemain  {

	/**
	 * processDatamap after Database Operations
	 *
	 * @param string $status status
	 * @param string $table table name
	 * @param integer $recordUid id of the record
	 * @param array $fields fieldArray
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject parent Object
	 * @return void
	 */
	public function processDatamap_afterDatabaseOperations($status, $table, $recordUid, array $fields, \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject) {

		// set access rights on subforums recoursively
		if ($table === 'tx_agora_domain_model_forum') {
			$record = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tx_agora_domain_model_forum', $recordUid);
			$this->updateSubforums($record);
		}
	}

	/**
	 * update subforums
	 *
	 * @param $forum
	 * @param array $forum forum
	 * @return void
	 */
	protected function updateSubforums($forum) {
		// users_with_read_access
		$usersOfForumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_userswithreadaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		// users_with_write_access
		$usersOfForumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_userswithwriteaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		// users_with_modification_access
		$usersOfForumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_userswithmodificationaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		// groups_with_read_access
		$groupsOfForumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_groupswithreadaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		// groups_with_write_access
		$groupsOfForumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_groupswithwriteaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		// groups_with_modification_access
		$groupsOfForumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_groupswithmodificationaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);

		$subForums = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'*', 'tx_agora_domain_model_forum', 'parent = "' . $forum['uid'] . '" '
		);

		foreach($subForums as $subforum) {
			// users_with_read_access
			$usersOfSubforumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithreadaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			foreach(array_keys($usersOfForumWithReadAccess) as $userOfForumWithReadAccess) {
				if(!array_key_exists($userOfForumWithReadAccess, $usersOfSubforumWithReadAccess)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery(
						'tx_agora_forum_userswithreadaccess_mm',
						array(
							'uid_local' => $subforum['uid'],
							'uid_foreign' => $userOfForumWithReadAccess,

						)
					);
				}
			}
			// users_with_write_access
			$usersOfSubforumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithwriteaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			foreach(array_keys($usersOfForumWithWriteAccess) as $userOfForumWithWriteAccess) {
				if(!array_key_exists($userOfForumWithWriteAccess, $usersOfSubforumWithWriteAccess)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery(
						'tx_agora_forum_userswithwriteaccess_mm',
						array(
							'uid_local' => $subforum['uid'],
							'uid_foreign' => $userOfForumWithWriteAccess,

						)
					);
				}
			}
			// users_with_modification_access
			$usersOfSubforumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithmodificationaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			// groups_with_read_access
			$groupsOfSubforumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithreadaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			// groups_with_write_access
			$groupsOfSubforumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithwriteaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			// groups_with_modification_access
			$groupsOfSubforumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithmodificationaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
		}

		foreach($subForums as $subforum) {
			$this->updateSubforums($subforum);
		}

	}


}