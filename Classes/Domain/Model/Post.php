<?php
namespace AgoraTeam\Agora\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Phillip Thiele
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
class Post extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

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
	 * quotedPosts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
	 * @cascade remove
	 */
	protected $quotedPosts = NULL;

	/**
	 * voting
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\Voting
	 */
	protected $voting = NULL;

	/**
	 * attachments
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Attachment>
	 * @cascade remove
	 */
	protected $attachments = NULL;

	/**
	 * creator
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 */
	protected $creator = NULL;

	/**
	 * __construct
	 */
	public function __construct() {
		//Do not remove the next line: It would break the functionality
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
		$this->quotedPosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->attachments = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Adds a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $quotedPost
	 * @return void
	 */
	public function addQuotedPost(\AgoraTeam\Agora\Domain\Model\Post $quotedPost) {
		$this->quotedPosts->attach($quotedPost);
	}

	/**
	 * Removes a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $quotedPostToRemove The Post to be removed
	 * @return void
	 */
	public function removeQuotedPost(\AgoraTeam\Agora\Domain\Model\Post $quotedPostToRemove) {
		$this->quotedPosts->detach($quotedPostToRemove);
	}

	/**
	 * Returns the quotedPosts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $quotedPosts
	 */
	public function getQuotedPosts() {
		return $this->quotedPosts;
	}

	/**
	 * Sets the quotedPosts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $quotedPosts
	 * @return void
	 */
	public function setQuotedPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $quotedPosts) {
		$this->quotedPosts = $quotedPosts;
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
	 * @return \AgoraTeam\Agora\Domain\Model\User $creator
	 */
	public function getCreator() {
		return $this->creator;
	}

	/**
	 * Sets the creator
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $creator
	 * @return void
	 */
	public function setCreator(\AgoraTeam\Agora\Domain\Model\User $creator) {
		$this->creator = $creator;
	}

}