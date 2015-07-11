<?php
namespace AgoraTeam\Agora\Domain\Model;


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
 * Post
 */
class Post extends Entity {

	/**
	 * topic
	 *
	 * @var string
	 */
	protected $topic = '';

	/**
	 * text
	 *
	 * @var string
	 */
	protected $text = '';

    /**
     * publishingDate
     *
     * @var \DateTime
     */
    protected $publishingDate;

	/**
	 * quotedPost
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\Post
	 * @lazy
	 */
	protected $quotedPost = NULL;

	/**
	 * originalPost
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\Post
	 * @lazy
	 */
	protected $originalPost = NULL;

    /**
     * replies
     *
     * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
     * @lazy
     */
    protected $replies = NULL;

	/**
	 * voting
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\Voting
	 * @lazy
	 */
	protected $voting = NULL;

	/**
	 * attachments
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Attachment>
	 * @cascade remove
	 * @lazy
	 */
	protected $attachments = NULL;

	/**
	 * creator
     *
     * may be NULL if post is anonymous
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 * @lazy
	 */
	protected $creator = NULL;

    /**
     * thread
     *
     * @var \AgoraTeam\Agora\Domain\Model\Thread
     * @lazy
     */
    protected $thread = NULL;

	/**
	 * historicalVersions
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
	 * @cascade remove
	 * @lazy
	 */
	protected $historicalVersions = NULL;

    /**
     * rootline
     *
     * @var array
     */
    protected $rootline = array();

	/**
	 * isFavorite
	 *
	 * @var bool
	 */
	protected $isFavorite = FALSE;

	/**
	 * @var \AgoraTeam\Agora\Domain\Model\Forum
	 * @lazy
	 */
	protected $forum = NULL;


	/**
	 * __construct
	 */
	public function __construct() {
		$this->initStorageObjects();
	}

	/**
	 * Initializes all ObjectStorage properties
	 * Do not modify this method!
	 * It will be rewritten on each save in the extension builder
	 * You may modify the constructor of this class instead
	 *
	 * @return void
	 */
	protected function initStorageObjects() {
		$this->replies = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->attachments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->historicalVersions = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the topic
	 *
	 * @return string $topic
	 */
	public function getTopic() {
		return $this->topic;
	}

	/**
	 * Sets the topic
	 *
	 * @param string $topic
	 * @return void
	 */
	public function setTopic($topic) {
		$this->topic = $topic;
	}

	/**
	 * Returns the text
	 *
	 * @return string $text
	 */
	public function getText() {
		return $this->text;
	}

	/**
	 * Sets the text
	 *
	 * @param string $text
	 * @return void
	 */
	public function setText($text) {
		$this->text = $text;
	}

    /**
     * Returns the publishingDate
     *
     * @return \DateTime $publishingDate
     */
    public function getPublishingDate() {
        if(!$this->publishingDate) {
            return $this->getCrdate();
        }
        return $this->publishingDate;
    }

    /**
     * Sets the publishingDate
     *
     * @param \DateTime $publishingDate
     * @return void
     */
    public function setPublishingDate($publishingDate) {
        $this->publishingDate = $publishingDate;
    }

	/**
	 * Returns the quotedPost
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\Post $quotedPost
	 */
	public function getQuotedPost() {
		return $this->quotedPost;
	}

    /**
     * Sets the quotedPost
     *
     * @param \AgoraTeam\Agora\Domain\Model\Post $quotedPost
     * @return void
     */
    public function setQuotedPost(\AgoraTeam\Agora\Domain\Model\Post $quotedPost) {
        $this->quotedPost = $quotedPost;
    }

	/**
	 * Returns the originalPost
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\Post $originalPost
	 */
	public function getOriginalPost() {
		return $this->originalPost;
	}

	/**
	 * Sets the originalPost
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $originalPost
	 * @return void
	 */
	public function setOriginalPost(\AgoraTeam\Agora\Domain\Model\Post $originalPost) {
		$this->originalPost = $originalPost;
	}

    /**
     * Adds a Reply
     *
     * @param \AgoraTeam\Agora\Domain\Model\Post $reply
     * @return void
     */
    public function addReply(\AgoraTeam\Agora\Domain\Model\Post $reply) {
        $this->replies->attach($reply);

    }

    /**
     * Removes a Reply
     *
     * @param \AgoraTeam\Agora\Domain\Model\Post $replyToRemove The Reply to be removed
     * @return void
     */
    public function removeReply(\AgoraTeam\Agora\Domain\Model\Post $replyToRemove) {
        $this->replies->detach($replyToRemove);
    }

    /**
     * Returns the replies
     *
     * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $replies
     */
    public function getReplies() {
        return $this->replies;
    }

	/**
	 * Sets the replies
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $replies
	 * @return void
	 */
	public function setReplies(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $replies) {
		$this->replies = $replies;
	}

	/**
	 * Returns the voting
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\Voting $voting
	 */
	public function getVoting() {
		return $this->voting;
	}

	/**
	 * Sets the voting
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Voting $voting
	 * @return void
	 */
	public function setVoting(\AgoraTeam\Agora\Domain\Model\Voting $voting) {
		$this->voting = $voting;
	}

	/**
	 * Adds a Attachment
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Attachment $attachment
	 * @return void
	 */
	public function addAttachment(\AgoraTeam\Agora\Domain\Model\Attachment $attachment) {
		$this->attachments->attach($attachment);

	}

	/**
	 * Removes a Attachment
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Attachment $attachmentToRemove The Attachment to be removed
	 * @return void
	 */
	public function removeAttachment(\AgoraTeam\Agora\Domain\Model\Attachment $attachmentToRemove) {
		$this->attachments->detach($attachmentToRemove);
	}

	/**
	 * Returns the attachments
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Attachment> $attachments
	 */
	public function getAttachments() {
		return $this->attachments;
	}

	/**
	 * Sets the attachments
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Attachment> $attachments
	 * @return void
	 */
	public function setAttachments(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $attachments) {
		$this->attachments = $attachments;
	}

	/**
	 * Returns the creator
	 *
	 * @return mixed $creator
	 */
	public function getCreator() {
		return $this->creator;
	}

	/**
	 * Sets the creator
	 *
	 * @param mixed $creator
	 * @return void
	 */
	public function setCreator($creator) {
		$this->creator = $creator;
	}

    /**
     * Returns the thread
     *
     * @return \AgoraTeam\Agora\Domain\Model\Thread $thread
     */
    public function getThread() {
        if(is_object($this->thread)) {
            $thread = $this->thread;
        } else {
            $thread = $this->detectThread();
        }
        return $thread;
    }

    /**
     * Sets the thread
     *
     * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
     * @return void
     */
    public function setThread($thread) {
        $this->thread = $thread;
    }

	/**
	 * Adds a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $historicalVersion
	 * @return void
	 */
	public function addHistoricalVersion(\AgoraTeam\Agora\Domain\Model\Post $historicalVersion) {
		$this->historicalVersions->attach($historicalVersion);
	}

	/**
	 * Removes a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $historicalVersionToRemove The Post to be removed
	 * @return void
	 */
	public function removeHistoricalVersion(\AgoraTeam\Agora\Domain\Model\Post $historicalVersionToRemove) {
		$this->historicalVersions->detach($historicalVersionToRemove);
	}

	/**
	 * Returns the historicalVersions
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $historicalVersions
	 */
	public function getHistoricalVersions() {
		return $this->historicalVersions;
	}

	/**
	 * Sets the historicalVersions
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $historicalVersions
	 * @return void
	 */
	public function setHistoricalVersions(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $historicalVersions) {
		$this->historicalVersions = $historicalVersions;
	}

    /**
     * Detects the Thread recursively
     *
     * @return Thread|bool
     */
    public function detectThread() {
        $thread = FALSE;
        if(is_object($this->thread)) {
            $thread = $this->thread;
        } else {
            if(is_object($this->quotedPost)) {
                $thread = $this->quotedPost->detectThread();
            }
        }
        return $thread;
    }

    /**
     * Returns the rootline
     *
     * @return array
     */
    public function getRootline() {
        if(empty($this->rootline)) {
            $this->fetchNextRootlineLevel();
        }
        return $this->rootline;
    }

    /**
     * fetches next rootline level recursively
     *
     * @return void
     */
    public function fetchNextRootlineLevel() {

        if(empty($this->rootline)) {
            if (is_object($this->getQuotedPost())) {
                array_push($this->rootline, current($this->getQuotedPost()->getRootline()));
                array_push($this->rootline, $this);
            } else {
                array_push($this->rootline, $this);
            }
        }
    }

	/**
	 * @return boolean
	 */
	public function isIsFavorite() {
		return $this->isFavorite;
	}

	/**
	 * @param boolean $isFavorite
	 */
	public function setIsFavorite($isFavorite) {
		$this->isFavorite = $isFavorite;
	}

	/**
	 * checks if the post is accessible for the given user
	 *
	 * @param mixed $user
	 * @return bool
	 */
	public function isAccessibleForUser($user) {
		return $this->getThread()->isAccessibleForUser($user);
	}

	/**
	 * @return Forum
	 */
	public function getForum() {
		return $this->forum;
	}

	/**
	 * @param Forum $forum
	 */
	public function setForum($forum) {
		$this->forum = $forum;
	}

}