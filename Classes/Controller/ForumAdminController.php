<?php
/**
 * Created by PhpStorm.
 * User: Dinis
 * Date: 7/1/2015
 * Time: 4:12 PM
 */

namespace AgoraTeam\Agora\Controller;

/**
 * ForumAdminController
 */
class ForumAdminController  extends ActionController{
	/**
	 * forumRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ForumRepository
	 * @inject
	 */
	protected $forumRepository = NULL;

	/** userRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository = NULL;

	/** groupRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\GroupRepository
	 * @inject
	 */
	protected $groupRepository = NULL;

	/**
	 * @var $id
	 *
	 * keeps the selected page id
	 */
	protected $id;

	protected function initializeAction() {
		$this->id = (int)\TYPO3\CMS\Core\Utility\GeneralUtility::_GP('id');
	}

	/**
	 * action list
	 *
	 * @return void
	 */
	public function listAction() {
		$forums = $this->forumRepository->findByPid($this->id);
		$this->view->assign('forums', $forums);
	}

	/**
	 * action show
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @return void
	 */
	public function showAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$this->view->assign('forum', $forum);
	}

	/**
	 * action new
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $newForum
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
	 * action create
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $newForum
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Forum $newForum) {
		$this->forumRepository->add($newForum);
		$this->addFlashMessage('The form was succesfully created!!');
		$this->redirect('list');

	}

	/**
	 * action edit
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @ignorevalidation $forum
	 * @return void
	 */
	public function editAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$users = $this->userRepository->findAll();
		$groups = $this->groupRepository->findAll();
		$forums = $this->forumRepository-> findFormusWithDiferentdId($forum);
		$this->view->assignMultiple(
			array(
				'forum' => $forum,
				'users' => $users,
				'groups' => $groups,
				'forums' =>$forums
			)
		);
	}

	/**
	 * action update
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {
		$this->forumRepository->update($forum);
		$this->addFlashMessage('The forum was succesfully edited!!');
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 *
	 * @return void
	 */
	public function deleteAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {

		if( ( $forum->getThreads()->count() == 0 ) && (  $forum->getSubForums()->count() == 0) ) {
			$this->forumRepository->remove($forum);
			$this->redirect('list');
		}
		else {
			$this->addFlashMessage('You cannot delete the forum beacause it has subforums or threads!', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
			$this->redirect('list');
		}
	}
}