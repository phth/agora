<?php
namespace AgoraTeam\Agora\Controller;


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
 * PostController
 */
class PostController extends ActionController {

    /**
     * postService
     *
     * @var \AgoraTeam\Agora\Domain\Service\PostService
     * @inject
     */
    protected $postService = NULL;

	/**
	 * postRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\PostRepository
	 * @inject
	 */
	protected $postRepository = NULL;

	/**
	 * userRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository = NULL;

	/**
	 * action list
	 *
     * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function listAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		//@todo Mark post as read
		$user = $this->getCurrentUser();
		$observedThread = $this->userRepository->findObservedThreadByUser($thread, $user);

        $posts = $this->postRepository->findByThread($thread);

        $this->view->assign('thread', $thread);
        $this->view->assign('posts', $posts);
        $this->view->assign('observedThread', $observedThread);
	}

	/**
	 * action show
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @return void
	 */
	public function showAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
		$this->view->assign('post', $post);
	}

    /**
     * action showHistory
     *
     * @param \AgoraTeam\Agora\Domain\Model\Post $post
     * @return void
     */
    public function showHistoryAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
        $this->view->assign('post', $post);
    }

	/**
	 * action new
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $newPost
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
     * @param \AgoraTeam\Agora\Domain\Model\Post $quotedPost
	 * @ignorevalidation $newPost
	 * @return void
	 */
	public function newAction(  \AgoraTeam\Agora\Domain\Model\Post $newPost = NULL,
                                \AgoraTeam\Agora\Domain\Model\Post $quotedPost = NULL,
                                \AgoraTeam\Agora\Domain\Model\Thread $thread = NULL) {
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
	 * @return void
	 */
	public function createAction(\AgoraTeam\Agora\Domain\Model\Post $newPost) {
		$user = $this->getCurrentUser();
		$newPost->setCreator($user);
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
			array('thread'=> $newPost->getThread())
		);
	}

	/**
	 * action edit
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $originalPost
     * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @ignorevalidation $post
	 * @return void
	 */
	public function editAction(\AgoraTeam\Agora\Domain\Model\Post $originalPost, \AgoraTeam\Agora\Domain\Model\Post $post = NULL) {

        if($post === NULL) {
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
	 * @return void
	 */
	public function updateAction(\AgoraTeam\Agora\Domain\Model\Post $originalPost, \AgoraTeam\Agora\Domain\Model\Post $post) {

        $newPost = $this->postService->copy($originalPost);
        $newPost->setTopic($post->getTopic());
        $newPost->setText($post->getText());

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
            array('thread'=> $newPost->getThread())
        );
	}

	/**
	 * action delete
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @return void
	 */
	public function deleteAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
		$this->addFlashMessage('The object was deleted. Please be aware that this action is publicly accessible unless you implement an access check. See <a href="http://wiki.typo3.org/T3Doc/Extension_Builder/Using_the_Extension_Builder#1._Model_the_domain" target="_blank">Wiki</a>', '', \TYPO3\CMS\Core\Messaging\AbstractMessage::ERROR);
		$this->postRepository->remove($post);
		$this->redirect('list');
	}

	/**
	 * action listLatest
	 *
	 * @return void
	 */
	public function listLatestAction() {

	}

}