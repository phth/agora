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
 * User
 */
class User extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * signiture
	 *
	 * @var string
	 * @var string
	 */
	protected $signiture = '';

	/**
	 * posts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
	 */
	protected $posts = NULL;

	/**
	 * favoritePosts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
	 */
	protected $favoritePosts = NULL;

	/**
	 * observedThreads
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Thread>
	 * @lazy
	 */
	protected $observedThreads = NULL;

	/**
	 * spamPosts
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post>
	 */
	protected $spamPosts = NULL;

	/**
	 * groups
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group>
	 * @lazy
	 */
	protected $groups = NULL;

	/**
	 * @var string
	 */
	protected $username = '';

	/**
	 * @var string
	 */
	protected $firstName = '';

	/**
	 * @var string
	 */
	protected $lastName = '';

	/**
	 * @var string
	 */
	protected $email = '';


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
		$this->favoritePosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->observedThreads = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->spamPosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->groups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Returns the signiture
	 *
	 * @return string $signiture
	 */
	public function getSigniture() {
		return $this->signiture;
	}

	/**
	 * Sets the signiture
	 *
	 * @param string $signiture
	 * @return void
	 */
	public function setSigniture($signiture) {
		$this->signiture = $signiture;
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
	 * Adds a Thread
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $favoritePost
	 * @return void
	 */
	public function addFavoritePost(\AgoraTeam\Agora\Domain\Model\Post $favoritePost) {
		$this->favoritePosts->attach($favoritePost);
	}

	/**
	 * Removes a Thread
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $favoritePostToRemove The Thread to be removed
	 * @return void
	 */
	public function removeFavoritePost(\AgoraTeam\Agora\Domain\Model\Post $favoritePostToRemove) {
		$this->favoritePosts->detach($favoritePostToRemove);
	}

	/**
	 * Returns the favoritePosts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $favoritePosts
	 */
	public function getFavoritePosts() {
		return $this->favoritePosts;
	}

	/**
	 * Sets the favoritePosts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $favoritePosts
	 * @return void
	 */
	public function setFavoritePosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $favoritePosts) {
		$this->favoritePosts = $favoritePosts;
	}

	/**
	 * Adds a Thread
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $observedThread
	 * @return void
	 */
	public function addObservedThread(\AgoraTeam\Agora\Domain\Model\Thread $observedThread) {
		$this->observedThreads->attach($observedThread);
	}

	/**
	 * Removes a Thread
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $observedThreadToRemove The Thread to be removed
	 * @return void
	 */
	public function removeObservedThread(\AgoraTeam\Agora\Domain\Model\Thread $observedThreadToRemove) {
		$this->observedThreads->detach($observedThreadToRemove);
	}

	/**
	 * Returns the observedThreads
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Thread> $observedThreads
	 */
	public function getObservedThreads() {
		return $this->observedThreads;
	}


	/**
	 * Sets the observedThreads
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Thread> $observedThreads
	 * @return void
	 */
	public function setObservedThreads(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $observedThreads) {
		$this->observedThreads = $observedThreads;
	}

	/**
	 * Adds a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $spamPost
	 * @return void
	 */
	public function addSpamPost(\AgoraTeam\Agora\Domain\Model\Post $spamPost) {
		$this->spamPosts->attach($spamPost);
	}

	/**
	 * Removes a Post
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Post $spamPostToRemove The Post to be removed
	 * @return void
	 */
	public function removeSpamPost(\AgoraTeam\Agora\Domain\Model\Post $spamPostToRemove) {
		$this->spamPosts->detach($spamPostToRemove);
	}

	/**
	 * Returns the spamPosts
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $spamPosts
	 */
	public function getSpamPosts() {
		return $this->spamPosts;
	}

	/**
	 * Sets the spamPosts
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Post> $spamPosts
	 * @return void
	 */
	public function setSpamPosts(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $spamPosts) {
		$this->spamPosts = $spamPosts;
	}

	/**
	 * Adds a Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $group
	 * @return void
	 */
	public function addGroup(\AgoraTeam\Agora\Domain\Model\Group $group) {
		$this->groups->attach($group);
	}

	/**
	 * Removes a Group
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Group $groupToRemove The Group to be removed
	 * @return void
	 */
	public function removeGroup(\AgoraTeam\Agora\Domain\Model\Group $groupToRemove) {
		$this->groups->detach($groupToRemove);
	}

	/**
	 * Returns the groups
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groups
	 */
	public function getGroups() {
		return $this->groups;
	}

	/**
	 * Sets the groups
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group> $groups
	 * @return void
	 */
	public function setGroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $groups) {
		$this->groups = $groups;
	}

	/**
	 * Returns the flattened groups
	 *
	 * @return array $groups
	 */
	public function getFlattenedGroups() {
		$flattenedGroups = array();
		foreach($this->getGroups() as $group) {
			$flattenedGroups[(string)$group] = $group;
			$flattenedGroups = array_merge($flattenedGroups, $group->getFlattenedSubgroups());
		}
		return $flattenedGroups;
	}

	/**
	 * Returns the flattened groups
	 *
	 * @return array $groups
	 */
	public function getFlattenedGroupUids() {
		$flattenedGroupUids = array();
		foreach($this->getFlattenedGroups() as $group) {
			$flattenedGroupUids[] = (int)$group->getUid();
		}
		return $flattenedGroupUids;
	}

	/**
	 * @return string
	 */
	public function getEmail() {
		return $this->email;
	}

	/**
	 * @param string $email
	 */
	public function setEmail($email) {
		$this->email = $email;
	}

	/**
	 * @return string
	 */
	public function getUsername() {
		return $this->username;
	}

	/**
	 * @param string $username
	 */
	public function setUsername($username) {
		$this->username = $username;
	}

	/**
	 * Sets the firstName value
	 *
	 * @param string $firstName
	 * @return void
	 * @api
	 */
	public function setFirstName($firstName) {
		$this->firstName = $firstName;
	}

	/**
	 * Returns the firstName value
	 *
	 * @return string
	 * @api
	 */
	public function getFirstName() {
		return $this->firstName;
	}

	/**
	 * Sets the lastName value
	 *
	 * @param string $lastName
	 * @return void
	 * @api
	 */
	public function setLastName($lastName) {
		$this->lastName = $lastName;
	}

	/**
	 * Returns the lastName value
	 *
	 * @return string
	 * @api
	 */
	public function getLastName() {
		return $this->lastName;
	}

    /**
     * displayName
     *
     * @return string
     */
    public function getDisplayName() {
        $displayName = '';
        $displayNameParts = array();

	    if($this->getFirstName()) {
		    $displayNameParts[] = $this->getFirstName();
	    }
		if($this->getLastName()) {
			$displayNameParts[] = $this->getLastName();
		}
        if(count($displayNameParts) > 0) {
	        $displayName = implode(' ', $displayNameParts);
	        //$displayName .= ' ('.$this->getUsername().')';
        } else {
            $displayName = $this->getUsername();
        }
        return $displayName;
    }

}