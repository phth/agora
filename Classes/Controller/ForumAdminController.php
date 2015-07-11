<?php

namespace AgoraTeam\Agora\Controller;

	/***************************************************************
	 *  Copyright notice
	 *  (c) 2015 Dinis Alexandru Catalin <dinisalexandrucatalin@gmail.com>
	 *
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
 * Class ForumAdminController
 *
 * @package AgoraTeam\Agora\Controller
 */
class ForumAdminController extends ActionController {

	/**
	 * ForumRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ForumRepository
	 * @inject
	 */
	protected $forumRepository = NULL;

	/**
	 * UserRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository = NULL;

	/**
	 * GroupRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\GroupRepository
	 * @inject
	 */
	protected $groupRepository = NULL;

	/**
	 * Keeps the selected page id
	 *
	 * @var $id
	 */
	protected $id;

	/**
	 * Function initializeAction
	 */
	protected function initializeAction() {
		$this->id = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
	}

	/**
	 * Action list
	 *
	 * @return void
	 */
	public function listAction() {
		$forums = $this->forumRepository->findByPid($this->id);
		$this->view->assign('forums', $forums);
	}

	/**
	 * Action show
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 *
	 * @return void
	 */
	public function showAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$this->view->assign('forum', $forum);
	}

	/**
	 * Action new
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $newForum
	 *
	 * @return void
	 */
	public function newAction(\AgoraTeam\Agora\Domain\Model\Forum $newForum = NULL) {
		$users = $this->userRepository->findAll();
		$groups = $this->groupRepository->findAll();
		$forums = $this->forumRepository->findAll();
		$this->view->assignMultiple(
			array(
				'newForum' => $newForum,
				'users' => $users,
				'groups' => $groups,
				'forums' => $forums
			)
		);
	}

	/**
	 * Action create
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $newForum
	 *
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Forum $newForum) {
		$this->forumRepository->add($newForum);
		$this->addFlashMessage('The form was succesfully created!!');
		$this->redirect('list');
	}

	/**
	 * Action edit
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @ignorevalidation $forum
	 *
	 * @return void
	 */
	public function editAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$users = $this->userRepository->findAll();
		$groups = $this->groupRepository->findAll();
		$forums = $this->forumRepository->findFormusWithDiferentdId($forum);
		$this->view->assignMultiple(
			array(
				'forum' => $forum,
				'users' => $users,
				'groups' => $groups,
				'forums' => $forums
			)
		);
	}

	/**
	 * Action update
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 *
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$this->forumRepository->update($forum);
		$this->addFlashMessage('The forum was succesfully edited!!');
		$this->redirect('list');
	}

	/**
	 * Action delete
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 *
	 * @return void
	 */
	public function deleteAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {

		if (($forum->getThreads()->count() == 0) && ($forum->getSubForums()->count() == 0)) {
			$this->forumRepository->remove($forum);
			$this->redirect('list');
		} else {
			$this->addFlashMessage(
				'You cannot delete the forum beacause it has subforums or threads!',
				'',
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list');
		}
	}
}