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
 * PostController
 */
class PostController extends ActionController {

	/**
	 * postService
	 *
	 * @var \AgoraTeam\Agora\Domain\Service\PostService
	 * @inject
	 */
	protected $postService;

	/**
	 * postRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\PostRepository
	 * @inject
	 */
	protected $postRepository;

	/**
	 * userRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository;

	/**
	 * action list
	 *
	 * @todo Mark post as read
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 *
	 * @return void
	 */
	public function listAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		if(!$thread->isAccessibleForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.accessDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.accessDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Thread', 'agora', array('forum' => $thread->getForum()));
		}
		$posts = $this->postRepository->findByThread($thread);

		// Check if current user observes thread
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User') && $user->getObservedThreads() !== NULL) {
			$observedThread = $user->getObservedThreads()->offsetExists($thread);
		}
		$this->view->assignMultiple(
			array(
				'thread' => $thread,
				'posts' => $posts,
				'user' => $user,
				'observedThread' => $observedThread
			)
		);
	}

	/**
	 * action show
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 *
	 * @return void
	 */
	public function showAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
		if(!$post->isAccessibleForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.accessDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.accessDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $post->getThread()));
		}

		$user = $this->getUser();
		$this->view->assign('post', $post);
		$this->view->assign('user', $user);
	}

	/**
	 * action showHistory
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 *
	 * @return void
	 */
	public function showHistoryAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
		if(!$post->isAccessibleForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.accessDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.accessDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $post->getThread()));
		}

		$this->view->assign('post', $post);
	}

	/**
	 * action new
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post   $newPost
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @param \AgoraTeam\Agora\Domain\Model\Post   $quotedPost
	 * @ignorevalidation $newPost
	 *
	 * @return void
	 */
	public function newAction(\AgoraTeam\Agora\Domain\Model\Post $newPost = NULL,
							  \AgoraTeam\Agora\Domain\Model\Post $quotedPost = NULL,
							  \AgoraTeam\Agora\Domain\Model\Thread $thread = NULL) {

		if(!$thread->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $thread));
		}

		$this->view->assign('newPost', $newPost);
		$this->view->assign('quotedPost', $quotedPost);
		$this->view->assign('thread', $thread);
	}

	/**
	 * action create
	 *
	 * @todo send info mails for subscribed users
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $newPost
	 *
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Post $newPost) {

		if(!$newPost->getThread()->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $newPost->getThread()));
		}

		$user = $this->getUser();

		$newPost->setCreator($user);
		$now = new \DateTime();
		$newPost->setPublishingDate($now);
		$this->postRepository->add($newPost);

		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.created', 'agora'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK
		);

		$this->redirect(
			'list',
			'Post',
			'agora',
			array('thread' => $newPost->getThread())
		);
	}

	/**
	 * action edit
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $originalPost
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @ignorevalidation $post
	 *
	 * @return void
	 */
	public function editAction(\AgoraTeam\Agora\Domain\Model\Post $originalPost, \AgoraTeam\Agora\Domain\Model\Post $post = NULL) {

		if(!$originalPost->getThread()->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $originalPost->getThread()));
		}

		if ($post === NULL) {
			$post = $this->postService->copy($originalPost);
		}

		$this->view->assign('originalPost', $originalPost);
		$this->view->assign('post', $post);
	}

	/**
	 * action update
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $originalPost
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 *
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Post $originalPost, \AgoraTeam\Agora\Domain\Model\Post $post) {

		if(!$originalPost->getThread()->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $originalPost->getThread()));
		}

		$newPost = $this->postService->copy($originalPost);
		$newPost->setTopic($post->getTopic());
		$newPost->setText($post->getText());

		foreach ($originalPost->getReplies()->toArray() as $reply) {
			$newPost->addReply($reply);
			$reply->setQuotedPost($newPost);
			$this->postRepository->update($reply);
		}

		$this->postService->archive($originalPost);
		$newPost->addHistoricalVersion($originalPost);
		$this->postRepository->update($originalPost);
		$this->postRepository->add($newPost);

		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.updated', 'agora'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK
		);

		$this->redirect(
			'list',
			'Post',
			'agora',
			array('thread' => $newPost->getThread())
		);
	}

	/**
	 * action delete
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 *
	 * @return void
	 */
	public function deleteAction(\AgoraTeam\Agora\Domain\Model\Post $post) {

		if(!$post->getThread()->isWritableForUser($this->getUser())) {
			$this->addFlashMessage(
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.text', 'agora'),
				\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_thread.flashMessages.editDenied.headline', 'agora'),
				\TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR
			);
			$this->redirect('list', 'Post', 'agora', array('thread' => $post->getThread()));
		}

		$this->addFlashMessage(
			\TYPO3\CMS\Extbase\Utility\LocalizationUtility::translate('tx_agora_domain_model_post.flashMessages.deleted', 'agora'),
			'',
			\TYPO3\CMS\Core\Messaging\AbstractMessage::OK
		);
		$this->postRepository->remove($post);
		$this->redirect('list');
	}

	/**
	 * action listLatest
	 *
	 * @return void
	 */
	public function listLatestAction() {
		$user = $this->getUser();
		$limit = $this->settings['thread']['numberOfItemsInLatestView'];
		$latestPosts = $this->postRepository->findLatestPostsForUser($limit);

		$this->view->assign('user', $user);
		$this->view->assign('latestPosts', $latestPosts);
	}
}