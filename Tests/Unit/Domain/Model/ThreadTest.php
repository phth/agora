<?php

namespace AgoraTeam\Agora\Tests\Unit\Domain\Model;

/***************************************************************
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
 * Test case for class \AgoraTeam\Agora\Domain\Model\Thread.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Phillip Thiele 
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class ThreadTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \AgoraTeam\Agora\Domain\Model\Thread
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \AgoraTeam\Agora\Domain\Model\Thread();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getTitleReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getTitle()
		);
	}

	/**
	 * @test
	 */
	public function setTitleForStringSetsTitle() {
		$this->subject->setTitle('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'title',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getSolvedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getSolved()
		);
	}

	/**
	 * @test
	 */
	public function setSolvedForBooleanSetsSolved() {
		$this->subject->setSolved(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'solved',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getClosedReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getClosed()
		);
	}

	/**
	 * @test
	 */
	public function setClosedForBooleanSetsClosed() {
		$this->subject->setClosed(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'closed',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getStickyReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getSticky()
		);
	}

	/**
	 * @test
	 */
	public function setStickyForBooleanSetsSticky() {
		$this->subject->setSticky(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'sticky',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getCreatorReturnsInitialValueForUser() {
		$this->assertEquals(
			NULL,
			$this->subject->getCreator()
		);
	}

	/**
	 * @test
	 */
	public function setCreatorForUserSetsCreator() {
		$creatorFixture = new \AgoraTeam\Agora\Domain\Model\User();
		$this->subject->setCreator($creatorFixture);

		$this->assertAttributeEquals(
			$creatorFixture,
			'creator',
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
	public function getViewsReturnsInitialValueForUser() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getViews()
		);
	}

	/**
	 * @test
	 */
	public function setViewsForObjectStorageContainingUserSetsViews() {
		$view = new \AgoraTeam\Agora\Domain\Model\User();
		$objectStorageHoldingExactlyOneViews = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneViews->attach($view);
		$this->subject->setViews($objectStorageHoldingExactlyOneViews);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneViews,
			'views',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addViewToObjectStorageHoldingViews() {
		$view = new \AgoraTeam\Agora\Domain\Model\User();
		$viewsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$viewsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($view));
		$this->inject($this->subject, 'views', $viewsObjectStorageMock);

		$this->subject->addView($view);
	}

	/**
	 * @test
	 */
	public function removeViewFromObjectStorageHoldingViews() {
		$view = new \AgoraTeam\Agora\Domain\Model\User();
		$viewsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$viewsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($view));
		$this->inject($this->subject, 'views', $viewsObjectStorageMock);

		$this->subject->removeView($view);

	}
}
