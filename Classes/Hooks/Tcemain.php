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

	protected $preProcessValues = array();

	/**
	 * @param string $table
	 * @param string $uid
	 * @return string
	 */
	protected function getRecordKey($table, $uid) {
		return $table.'-'.$uid;
	}

	/**
	 * processDatamap preProcessFieldArray
	 *
	 * here we filter all groups and users with changed permissions and store them in $preProcessValues for later use
	 * in afterDatabaseOperations
	 *
	 * @param array $fields fieldArray
	 * @param string $table table name
	 * @param integer $recordUid id of the record
	 * @param \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject parent Object
	 * @return void
	 */
	public function processDatamap_preProcessFieldArray($fields, $table, $recordUid, \TYPO3\CMS\Core\DataHandling\DataHandler $parentObject) {
		if ($table === 'tx_agora_domain_model_forum') {
			$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['agora']);
			if ($settings[recoursivePermissions] !== 1) {
				return;
			}
			$forum = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tx_agora_domain_model_forum', $recordUid);

			$usersOfForumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithreadaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			$this->preProcessValues[$this->getRecordKey($table, $recordUid)]['usersOfForumWithReadAccess'] = array_keys($usersOfForumWithReadAccess);

			$usersOfForumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithwriteaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			$this->preProcessValues[$this->getRecordKey($table, $recordUid)]['usersOfForumWithWriteAccess'] = array_keys($usersOfForumWithWriteAccess);

			$usersOfForumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithmodificationaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			$this->preProcessValues[$this->getRecordKey($table, $recordUid)]['usersOfForumWithModificationAccess'] = array_keys($usersOfForumWithModificationAccess);

			$groupsOfForumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithreadaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			$this->preProcessValues[$this->getRecordKey($table, $recordUid)]['groupsOfForumWithReadAccess'] = array_keys($groupsOfForumWithReadAccess);

			$groupsOfForumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithwriteaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			$this->preProcessValues[$this->getRecordKey($table, $recordUid)]['groupsOfForumWithWriteAccess'] = array_keys($groupsOfForumWithWriteAccess);

			$groupsOfForumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithmodificationaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			$this->preProcessValues[$this->getRecordKey($table, $recordUid)]['groupsOfForumWithModificationAccess'] = array_keys($groupsOfForumWithModificationAccess);
		}
	}

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

		// set access rights on subforums for new forums recoursively
		if ($table === 'tx_agora_domain_model_forum') {
			$settings = unserialize($GLOBALS['TYPO3_CONF_VARS']['EXT']['extConf']['agora']);
			if ($settings[recoursivePermissions] !== 1) {
				return;
			}
			$record = \TYPO3\CMS\Backend\Utility\BackendUtility::getRecord('tx_agora_domain_model_forum', $recordUid);
			$this->updateSubforums($record, TRUE);
		}
	}

	/**
	 * update subforums
	 *
	 * @todo: refactor with a more generic approach
	 *
	 * @param array $forum forum
	 * @param bool $isRootForum
	 * @return void
	 */
	protected function updateSubforums($forum, $isRootForum = FALSE) {
		// users_with_read_access
		$usersOfForumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_userswithreadaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		if($isRootForum) {
			$this->usersOfForumWithReadAccessToDelete = array();
			foreach($this->preProcessValues[$this->getRecordKey('tx_agora_domain_model_forum', $forum['uid'])]['usersOfForumWithReadAccess'] as $userId) {
				if(!array_key_exists($userId, $usersOfForumWithReadAccess)) {
					$this->usersOfForumWithReadAccessToDelete[] = $userId;
				}
			}
		}
		// users_with_write_access
		$usersOfForumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_userswithwriteaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		if($isRootForum) {
			$this->usersOfForumWithWriteAccessToDelete = array();
			foreach($this->preProcessValues[$this->getRecordKey('tx_agora_domain_model_forum', $forum['uid'])]['usersOfForumWithWriteAccess'] as $userId) {
				if(!array_key_exists($userId, $usersOfForumWithWriteAccess)) {
					$this->usersOfForumWithWriteAccessToDelete[] = $userId;
				}
			}
		}
		// users_with_modification_access
		$usersOfForumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_userswithmodificationaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		if($isRootForum) {
			$this->usersOfForumWithModificationAccessToDelete = array();
			foreach($this->preProcessValues[$this->getRecordKey('tx_agora_domain_model_forum', $forum['uid'])]['usersOfForumWithModificationAccess'] as $userId) {
				if(!array_key_exists($userId, $usersOfForumWithModificationAccess)) {
					$this->usersOfForumWithModificationAccessToDelete[] = $userId;
				}
			}
		}
		// groups_with_read_access
		$groupsOfForumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_groupswithreadaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		if($isRootForum) {
			$this->groupsOfForumWithReadAccessToDelete = array();
			foreach($this->preProcessValues[$this->getRecordKey('tx_agora_domain_model_forum', $forum['uid'])]['groupsOfForumWithReadAccess'] as $userId) {
				if(!array_key_exists($userId, $groupsOfForumWithReadAccess)) {
					$this->groupsOfForumWithReadAccessToDelete[] = $userId;
				}
			}
		}
		// groups_with_write_access
		$groupsOfForumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_groupswithwriteaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		if($isRootForum) {
			$this->groupsOfForumWithWriteAccessToDelete = array();
			foreach($this->preProcessValues[$this->getRecordKey('tx_agora_domain_model_forum', $forum['uid'])]['groupsOfForumWithWriteAccess'] as $userId) {
				if(!array_key_exists($userId, $groupsOfForumWithWriteAccess)) {
					$this->groupsOfForumWithWriteAccessToDelete[] = $userId;
				}
			}
		}
		// groups_with_modification_access
		$groupsOfForumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
			'uid_foreign', 'tx_agora_forum_groupswithmodificationaccess_mm', 'uid_local = "' . $forum['uid'] . '" ', '', '', '', 'uid_foreign'
		);
		if($isRootForum) {
			$this->groupsOfForumWithModifactionAccessToDelete = array();
			foreach($this->preProcessValues[$this->getRecordKey('tx_agora_domain_model_forum', $forum['uid'])]['groupsOfForumWithModificationAccess'] as $userId) {
				if(!array_key_exists($userId, $groupsOfForumWithModificationAccess)) {
					$this->groupsOfForumWithModificationAccessToDelete[] = $userId;
				}
			}
		}

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
							'uid_foreign' => $userOfForumWithReadAccess
						)
					);
				}
			}
			if(count($this->usersOfForumWithReadAccessToDelete)) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					'tx_agora_forum_userswithreadaccess_mm',
					'uid_foreign IN (' . implode(',', $this->usersOfForumWithReadAccessToDelete) . ') AND uid_local = '.$subforum['uid']
				);
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
							'uid_foreign' => $userOfForumWithWriteAccess
						)
					);
				}
			}
			if(count($this->usersOfForumWithWriteAccessToDelete)) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					'tx_agora_forum_userswithwriteaccess_mm',
					'uid_foreign IN (' . implode(',', $this->usersOfForumWithWriteAccessToDelete) . ') AND uid_local = '.$subforum['uid']
				);
			}
			// users_with_modification_access
			$usersOfSubforumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_userswithmodificationaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			foreach(array_keys($usersOfForumWithModificationAccess) as $userOfForumWithModificationAccess) {
				if(!array_key_exists($userOfForumWithModificationAccess, $usersOfSubforumWithModificationAccess)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery(
						'tx_agora_forum_userswithmodificationaccess_mm',
						array(
							'uid_local' => $subforum['uid'],
							'uid_foreign' => $userOfForumWithModificationAccess
						)
					);
				}
			}
			if(count($this->usersOfForumWithModificationAccessToDelete)) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					'tx_agora_forum_userswithmodificationaccess_mm',
					'uid_foreign IN (' . implode(',', $this->usersOfForumWithModificationAccessToDelete) . ') AND uid_local = '.$subforum['uid']
				);
			}
			// groups_with_read_access
			$groupsOfSubforumWithReadAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithreadaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			foreach(array_keys($groupsOfForumWithReadAccess) as $groupOfForumWithReadAccess) {
				if(!array_key_exists($groupOfForumWithReadAccess, $groupsOfSubforumWithReadAccess)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery(
						'tx_agora_forum_groupswithreadaccess_mm',
						array(
							'uid_local' => $subforum['uid'],
							'uid_foreign' => $groupOfForumWithReadAccess
						)
					);
				}
			}
			if(count($this->groupsOfForumWithReadAccessToDelete)) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					'tx_agora_forum_groupswithreadaccess_mm',
					'uid_foreign IN (' . implode(',', $this->groupsOfForumWithReadAccessToDelete) . ') AND uid_local = '.$subforum['uid']
				);
			}
			// groups_with_write_access
			$groupsOfSubforumWithWriteAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithwriteaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			foreach(array_keys($groupsOfForumWithWriteAccess) as $groupOfForumWithWriteAccess) {
				if(!array_key_exists($groupOfForumWithWriteAccess, $groupsOfSubforumWithWriteAccess)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery(
						'tx_agora_forum_groupswithwriteaccess_mm',
						array(
							'uid_local' => $subforum['uid'],
							'uid_foreign' => $groupOfForumWithWriteAccess
						)
					);
				}
			}
			if(count($this->groupsOfForumWithWriteAccessToDelete)) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					'tx_agora_forum_groupswithwriteaccess_mm',
					'uid_foreign IN (' . implode(',', $this->groupsOfForumWithWriteAccessToDelete) . ') AND uid_local = '.$subforum['uid']
				);
			}
			// groups_with_modification_access
			$groupsOfSubforumWithModificationAccess = $GLOBALS['TYPO3_DB']->exec_SELECTgetRows(
				'uid_foreign', 'tx_agora_forum_groupswithmodificationaccess_mm', 'uid_local = "' . $subforum['uid'] . '" ', '', '', '', 'uid_foreign'
			);
			foreach(array_keys($groupsOfForumWithModificationAccess) as $groupOfForumWithModificationAccess) {
				if(!array_key_exists($groupOfForumWithModificationAccess, $groupsOfSubforumWithModificationAccess)) {
					$GLOBALS['TYPO3_DB']->exec_INSERTquery(
						'tx_agora_forum_groupswithmodificationaccess_mm',
						array(
							'uid_local' => $subforum['uid'],
							'uid_foreign' => $groupOfForumWithModificationAccess
						)
					);
				}
			}
			if(count($this->groupsOfForumWithModificationAccessToDelete)) {
				$GLOBALS['TYPO3_DB']->exec_DELETEquery(
					'tx_agora_forum_groupswithmodificationaccess_mm',
					'uid_foreign IN (' . implode(',', $this->groupsOfForumWithModificationAccessToDelete) . ') AND uid_local = '.$subforum['uid']
				);
			}
		}

		foreach($subForums as $subforum) {
			$this->updateSubforums($subforum);
		}

	}


}