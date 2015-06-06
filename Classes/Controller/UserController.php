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
 * UserController
 */
class UserController extends ActionController {

	/**
	 * userRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository = NULL;


	/**
	 * action favoritePosts
	 *
	 * @return void
	 */
	public function favoritePostsAction() {
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User') && $user->getFavoritePosts() !== NULL) {
			$limit = $this->settings['post']['numberOfItemsInFavoritePostsWidget'];
			$AllFavoritedPosts = $user->getFavoritePosts()->toArray();
			$favoritedPosts = array();
			$i = 0;

			foreach ($AllFavoritedPosts as $post) {
				if ($post->isAccessibleForUser($user)) {
					$favoritedPosts[] = $post;
					$i++;
				}
				if ($limit == $i) continue;
			}
		}

		$this->view->assign('user', $user);
		$this->view->assign('favoritePosts', array_reverse($favoritedPosts));
		$this->view->assign('listPid', $this->settings['listView']);
	}

	/**
	 * action observedThreads
	 *
	 * @return void
	 */
	public function observedThreadsAction() {
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User') && $user->getObservedThreads() !== NULL) {
			$limit = $this->settings['thread']['numberOfItemsInObservedThreadsWidget'];
			$allObservedThreads = $user->getObservedThreads()->toArray();
			$observedThreads = array();
			$i = 0;

			foreach ($allObservedThreads as $thread) {
				if ($thread->isAccessibleForUser($user)) {
					$observedThreads[] = $thread;
					$i++;
				}
				if ($limit == $i) continue;
			}
		}
		$this->view->assign('user', $user);
		$this->view->assign('observedThreads', $observedThreads);
		$this->view->assign('listPid', $this->settings['listView']);
	}

	/**
	 * action listObservedThreads
	 * @return void
	 */
	public function listObservedThreadsAction() {
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			$observedThreads = $user->getObservedThreads();
		}
		$this->view->assign('user', $user);
		$this->view->assign('observedThreads', $observedThreads);
	}


	/**
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function addObservedThreadAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			$user->addObservedThread($thread);
			$this->userRepository->update($user);
		}
		$this->redirect('list', 'Post', 'Agora', array('thread' => $thread));
	}

	/**
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @return void
	 */
	public function removeObservedThreadAction(\AgoraTeam\Agora\Domain\Model\Thread $thread) {
			// @todo Back to refere redirect
		$user = $this->getUser();
		$user->removeObservedThread($thread);
		$this->userRepository->update($user);
		$this->redirect('list', 'Post', 'Agora', array('thread' => $thread));
	}

	/**
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @return void
	 */
	public function addFavoritePostAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
			// @todo Back to refere redirect
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			$user->addFavoritePost($post);
			$this->userRepository->update($user);
		}
		$this->redirect('list', 'Post', 'Agora', array('thread' => $post->getThread()));
	}

	/**
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @return void
	 */
	public function removeFavoritePostAction(\AgoraTeam\Agora\Domain\Model\Post $post) {
			// @todo Back to refere redirect
		$user = $this->getUser();
		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			$user->removeFavoritePost($post);
			$this->userRepository->update($user);
		}
		$this->redirect('list', 'Post', 'Agora', array('thread' =>  $post->getThread()));
	}


}