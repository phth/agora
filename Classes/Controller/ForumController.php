<?php
namespace AgoraTeam\Agora\Controller;

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
 * Class ForumController
 *
 * @package AgoraTeam\Agora\Controller
 */
class ForumController extends ActionController {

	/**
	 * ForumRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ForumRepository
	 * @inject
	 */
	protected $forumRepository = NULL;

	/**
	 * Action list
	 *
	 * @return void
	 */
	public function listAction() {
		$forums = $this->forumRepository->findVisibleRootForums();
		$this->view->assignMultiple(
			array(
				'forums' => $forums,
				'user' => $this->getUser()
			)
		);
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
	 * @ignorevalidation $newForum
	 *
	 * @return void
	 */
	public function newAction(\AgoraTeam\Agora\Domain\Model\Forum $newForum = NULL) {
		$this->view->assign('newForum', $newForum);
	}

	/**
	 * Action create
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $newForum
	 *
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Forum $newForum) {
		$this->addFlashMessage('The object was created.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->forumRepository->add($newForum);
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
		$this->view->assign('forum', $forum);
	}

	/**
	 * Action update
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$this->addFlashMessage('The object was updated.', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->forumRepository->update($forum);
		$this->redirect('list');
	}
}