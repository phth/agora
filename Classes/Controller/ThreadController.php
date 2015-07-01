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
 * ThreadController
 */
class ThreadController extends ActionController {

	/**
	 * threadRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ThreadRepository
	 * @inject
	 */
	protected $threadRepository = NULL;

	/**
	 * action list
	 *
     * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @return void
	 */
	public function listAction(\AgoraTeam\Agora\Domain\Model\Forum $forum) {

		if(!$forum->isAccessibleForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.accessDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.accessDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Forum');
		}

        $threads = $this->threadRepository->findByForum($forum);

        $this->view->assignMultiple(
	        array(
		        'forum' => $forum,
				'threads' => $threads
	        )
        );
	}

	/**
	 * action show
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function showAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$this->view->assign('thread', $thread);
	}

	/**
	 * action new
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @param string $text
	 * @return void
	 */
	public function newAction(\AgoraTeam\Agora\Domain\Model\Forum $forum,
							  \AgoraTeam\Agora\Domain\Model\Thread $thread = NULL, $text = '') {

        if(!$forum->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Thread', 'agora', array('forum' => $forum));
		}


        $this->view->assign('forum', $forum)
					->assign('thread', $thread)
					->assign('text', $text);
	}

	/**
	 * action create
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @param string $text
	 *
	 * @validate $text notEmpty
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Forum $forum,
								 \AgoraTeam\Agora\Domain\Model\Thread $thread, $text) {
		if(!$forum->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Thread', 'agora', array('forum' => $forum));
		}

		/** @var \AgoraTeam\Agora\Domain\Model\Post $post */
		$post = new \AgoraTeam\Agora\Domain\Model\Post;
		$post->setTopic($thread->getTitle());
		$post->setText($text);
		$now = new \DateTime();
		$post->setPublishingDate($now);

		if(is_a($this->getUser(),'\AgoraTeam\Agora\Domain\Model\User')) {
			$post->setCreator($this->getUser());
		}
		$thread->addPost($post);
		if (is_a($this->getUser(),'\AgoraTeam\Agora\Domain\Model\User')) {
			$thread->setCreator($this->getUser());
		}

		$forum->addThread($thread);
		$this->forumRepository->update($forum);

		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_forum.flashMessages.created', 'agora'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK
		);
        if( $this->settings['thread']['notificationsForThreadOwner'] == 1 ) {
            $user = $this->getUser();
            $this->sendMail(
                array(
                    $user->getEmail() => $user->getDisplayName()
                ),
                $this->getThreadDefaultSender(),
                \TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('email.updateDepotType.subject', 'depot'),
                'NotificationToThreadOwner',
                array(
                    'user' => $user,
                    'thread' => $thread
                )
            );
        }
		$this->redirect(
			'list',
			'Thread',
			'Agora',
			array('forum' => $forum)
		);


	}

	/**
	 * action edit
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @ignorevalidation $thread
	 * @return void
	 */
	public function editAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		if(!$thread->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Thread', 'agora', array('forum' => $thread->getForum()));
		}
		$this->view->assign('thread', $thread);
	}

	/**
	 * action update
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		if(!$thread->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Thread', 'agora', array('forum' => $thread->getForum()));
		}
		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.updated', 'agora'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK
		);
		$this->threadRepository->update($thread);
		$this->redirect('list');
	}

	/**
	 * action delete
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function deleteAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		if(!$thread->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Thread', 'agora', array('forum' => $thread->getForum()));
		}
		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.deleted', 'agora'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK
		);
		$this->threadRepository->remove($thread);
		$this->redirect('list');
	}

	/**
	 * action listLatest
	 *
	 * @return void
	 */
	public function listLatestAction() {
		$limit = $this->settings['thread']['numberOfItemsInLatestView'];
		$latestThreads = $this->threadRepository->findLatestThreadsForUser($limit);
		$this->view->assign('latestThreads', $latestThreads);
	}
}