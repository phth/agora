<?php

namespace AgoraTeam\Agora\Tests\Unit\Domain\Model;

/***************************************************************
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
 *  the Free Software Foundation; either version 2 of the License, or
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
 * Test case for class \AgoraTeam\Agora\Domain\Model\User.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Philipp Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class UserTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \AgoraTeam\Agora\Domain\Model\User();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getSignitureReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getSigniture()
		);
	}

	/**
	 * @test
	 */
	public function setSignitureForStringSetsSigniture() {
		$this->subject->setSigniture('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'signiture',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPostsReturnsInitialValueForPost() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getPosts()
		);
	}

	/**
	 * @test
	 */
	public function setPostsForObjectStorageContainingPostSetsPosts() {
		$post = new \AgoraTeam\Agora\Domain\Model\Post();
		$objectStorageHoldingExactlyOnePosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOnePosts->attach($post);
		$this->subject->setPosts($objectStorageHoldingExactlyOnePosts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOnePosts,
			'posts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addPostToObjectStorageHoldingPosts() {
		$post = new \AgoraTeam\Agora\Domain\Model\Post();
		$postsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$postsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($post));
		$this->inject($this->subject, 'posts', $postsObjectStorageMock);

		$this->subject->addPost($post);
	}

	/**
	 * @test
	 */
	public function removePostFromObjectStorageHoldingPosts() {
		$post = new \AgoraTeam\Agora\Domain\Model\Post();
		$postsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$postsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($post));
		$this->inject($this->subject, 'posts', $postsObjectStorageMock);

		$this->subject->removePost($post);

	}

	/**
	 * @test
	 */
	public function getFavoritePostsReturnsInitialValueForThread() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getFavoritePosts()
		);
	}

	/**
	 * @test
	 */
	public function setFavoritePostsForObjectStorageContainingThreadSetsFavoritePosts() {
		$favoritePost = new \AgoraTeam\Agora\Domain\Model\Thread();
		$objectStorageHoldingExactlyOneFavoritePosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneFavoritePosts->attach($favoritePost);
		$this->subject->setFavoritePosts($objectStorageHoldingExactlyOneFavoritePosts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneFavoritePosts,
			'favoritePosts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addFavoritePostToObjectStorageHoldingFavoritePosts() {
		$favoritePost = new \AgoraTeam\Agora\Domain\Model\Thread();
		$favoritePostsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$favoritePostsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($favoritePost));
		$this->inject($this->subject, 'favoritePosts', $favoritePostsObjectStorageMock);

		$this->subject->addFavoritePost($favoritePost);
	}

	/**
	 * @test
	 */
	public function removeFavoritePostFromObjectStorageHoldingFavoritePosts() {
		$favoritePost = new \AgoraTeam\Agora\Domain\Model\Thread();
		$favoritePostsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$favoritePostsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($favoritePost));
		$this->inject($this->subject, 'favoritePosts', $favoritePostsObjectStorageMock);

		$this->subject->removeFavoritePost($favoritePost);

	}

	/**
	 * @test
	 */
	public function getObservedThreadsReturnsInitialValueForThread() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getObservedThreads()
		);
	}

	/**
	 * @test
	 */
	public function setObservedThreadsForObjectStorageContainingThreadSetsObservedThreads() {
		$observedThread = new \AgoraTeam\Agora\Domain\Model\Thread();
		$objectStorageHoldingExactlyOneObservedThreads = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneObservedThreads->attach($observedThread);
		$this->subject->setObservedThreads($objectStorageHoldingExactlyOneObservedThreads);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneObservedThreads,
			'observedThreads',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addObservedThreadToObjectStorageHoldingObservedThreads() {
		$observedThread = new \AgoraTeam\Agora\Domain\Model\Thread();
		$observedThreadsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$observedThreadsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($observedThread));
		$this->inject($this->subject, 'observedThreads', $observedThreadsObjectStorageMock);

		$this->subject->addObservedThread($observedThread);
	}

	/**
	 * @test
	 */
	public function removeObservedThreadFromObjectStorageHoldingObservedThreads() {
		$observedThread = new \AgoraTeam\Agora\Domain\Model\Thread();
		$observedThreadsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$observedThreadsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($observedThread));
		$this->inject($this->subject, 'observedThreads', $observedThreadsObjectStorageMock);

		$this->subject->removeObservedThread($observedThread);

	}

	/**
	 * @test
	 */
	public function getSpamPostsReturnsInitialValueForPost() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getSpamPosts()
		);
	}

	/**
	 * @test
	 */
	public function setSpamPostsForObjectStorageContainingPostSetsSpamPosts() {
		$spamPost = new \AgoraTeam\Agora\Domain\Model\Post();
		$objectStorageHoldingExactlyOneSpamPosts = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneSpamPosts->attach($spamPost);
		$this->subject->setSpamPosts($objectStorageHoldingExactlyOneSpamPosts);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneSpamPosts,
			'spamPosts',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addSpamPostToObjectStorageHoldingSpamPosts() {
		$spamPost = new \AgoraTeam\Agora\Domain\Model\Post();
		$spamPostsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$spamPostsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($spamPost));
		$this->inject($this->subject, 'spamPosts', $spamPostsObjectStorageMock);

		$this->subject->addSpamPost($spamPost);
	}

	/**
	 * @test
	 */
	public function removeSpamPostFromObjectStorageHoldingSpamPosts() {
		$spamPost = new \AgoraTeam\Agora\Domain\Model\Post();
		$spamPostsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$spamPostsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($spamPost));
		$this->inject($this->subject, 'spamPosts', $spamPostsObjectStorageMock);

		$this->subject->removeSpamPost($spamPost);

	}

	/**
	 * @test
	 */
	public function getGroupsReturnsInitialValueForGroup() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getGroups()
		);
	}

	/**
	 * @test
	 */
	public function setGroupsForObjectStorageContainingGroupSetsGroups() {
		$group = new \AgoraTeam\Agora\Domain\Model\Group();
		$objectStorageHoldingExactlyOneGroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneGroups->attach($group);
		$this->subject->setGroups($objectStorageHoldingExactlyOneGroups);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneGroups,
			'groups',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addGroupToObjectStorageHoldingGroups() {
		$group = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$groupsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($group));
		$this->inject($this->subject, 'groups', $groupsObjectStorageMock);

		$this->subject->addGroup($group);
	}

	/**
	 * @test
	 */
	public function removeGroupFromObjectStorageHoldingGroups() {
		$group = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$groupsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($group));
		$this->inject($this->subject, 'groups', $groupsObjectStorageMock);

		$this->subject->removeGroup($group);

	}
}
