<?php
namespace AgoraTeam\Agora\Domain\Factory;

/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Björn Christopher Bresser <bjoern.bresser@gmail.com>
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

class ThreadFactory extends AbstractFactory {

	/**
	 * forumRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ForumRepository
	 * @inject
	 */
	protected $forumRepository;

	/**
	 * threadRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\ThreadRepository
	 * @inject
	 */
	protected $threadRepository;

	/**
	 * postRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\PostRepository
	 * @inject
	 */
	protected $postRepository;



	/**
     * create thread
     *
     * @todo check for permissions, anonymous posts
     *
	 * @param \AgoraTeam\Agora\Domain\Model\Forum $forum
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @param string $text
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\Thread $thread
	 */
	public function createThread(\AgoraTeam\Agora\Domain\Model\Forum $forum,
		                         \AgoraTeam\Agora\Domain\Model\Thread $thread, $text) {

		$user = $this->getCurrentUser();

		/** @var \AgoraTeam\Agora\Domain\Model\Post $post */
		$post = new \AgoraTeam\Agora\Domain\Model\Post;
		$post->setTopic($thread->getTitle());
		$post->setText($text);
        if(is_a($user,'\AgoraTeam\Agora\Domain\Model\User')) {
            $post->setCreator($user);
        }

		$thread->addPost($post);
        if(is_a($user,'\AgoraTeam\Agora\Domain\Model\User')) {
            $thread->setCreator($user);
        }
		$thread->setForum($forum);

		$forum->addThread($thread);
		$this->forumRepository->update($forum);

		return $thread;
	}


}