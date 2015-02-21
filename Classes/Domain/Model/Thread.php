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
 * Thread
 */
class Thread extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 *
	 * @var string
	 */
	protected $title = '';

	/**
	 * solved
	 *
	 * @var boolean
	 */
	protected $solved = FALSE;

	/**
	 * closed
	 *
	 * @var boolean
	 */
	protected $closed = FALSE;

	/**
	 * sticky
	 *
	 * @var boolean
	 */
	protected $sticky = FALSE;

	/**
	 * creator
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 */
	protected $creator = NULL;

	/**
	 * posts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
	 * @cascade remove
	 */
	protected $posts = NULL;

	/**
	 * views
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User>
	 * @cascade remove
	 */
	protected $views = NULL;

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
		$this->posts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->views = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the title
	 *
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 *
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the solved
	 *
	 * @return boolean $solved
	 */
	public function getSolved() {
		return $this->solved;
	}

	/**
	 * Sets the solved
	 *
	 * @param boolean $solved
	 * @return void
	 */
	public function setSolved($solved) {
		$this->solved = $solved;
	}

	/**
	 * Returns the boolean state of solved
	 *
	 * @return boolean
	 */
	public function isSolved() {
		return $this->solved;
	}

	/**
	 * Returns the closed
	 *
	 * @return boolean $closed
	 */
	public function getClosed() {
		return $this->closed;
	}

	/**
	 * Sets the closed
	 *
	 * @param boolean $closed
	 * @return void
	 */
	public function setClosed($closed) {
		$this->closed = $closed;
	}

	/**
	 * Returns the boolean state of closed
	 *
	 * @return boolean
	 */
	public function isClosed() {
		return $this->closed;
	}

	/**
	 * Returns the sticky
	 *
	 * @return boolean $sticky
	 */
	public function getSticky() {
		return $this->sticky;
	}

	/**
	 * Sets the sticky
	 *
	 * @param boolean $sticky
	 * @return void
	 */
	public function setSticky($sticky) {
		$this->sticky = $sticky;
	}

	/**
	 * Returns the boolean state of sticky
	 *
	 * @return boolean
	 */
	public function isSticky() {
		return $this->sticky;
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

	/**
	 * Adds a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $post
	 * @return void
	 */
	public function addPost(\AgoraTeam\Agora\Domain\Model\Post $post) {
		$this->posts->attach($post);
	}

	/**
	 * Removes a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $postToRemove The Post to be removed
	 * @return void
	 */
	public function removePost(\AgoraTeam\Agora\Domain\Model\Post $postToRemove) {
		$this->posts->detach($postToRemove);
	}

	/**
	 * Returns the posts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $posts
	 */
	public function getPosts() {
		return $this->posts;
	}

	/**
	 * Sets the posts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $posts
	 * @return void
	 */
	public function setPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $posts) {
		$this->posts = $posts;
	}

	/**
	 * Adds a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $view
	 * @return void
	 */
	public function addView(\AgoraTeam\Agora\Domain\Model\User $view) {
		$this->views->attach($view);
	}

	/**
	 * Removes a User
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $viewToRemove The User to be removed
	 * @return void
	 */
	public function removeView(\AgoraTeam\Agora\Domain\Model\User $viewToRemove) {
		$this->views->detach($viewToRemove);
	}

	/**
	 * Returns the views
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $views
	 */
	public function getViews() {
		return $this->views;
	}

	/**
	 * Sets the views
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\User> $views
	 * @return void
	 */
	public function setViews(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $views) {
		$this->views = $views;
	}

}