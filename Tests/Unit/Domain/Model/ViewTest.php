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
 * Test case for class \AgoraTeam\Agora\Domain\Model\View.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Philipp Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class ViewTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \AgoraTeam\Agora\Domain\Model\View
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \AgoraTeam\Agora\Domain\Model\View();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getThreadReturnsInitialValueForThread() {
		$this->assertEquals(
			NULL,
			$this->subject->getThread()
		);
	}

	/**
	 * @test
	 */
	public function setThreadForThreadSetsThread() {
		$threadFixture = new \AgoraTeam\Agora\Domain\Model\Thread();
		$this->subject->setThread($threadFixture);

		$this->assertAttributeEquals(
			$threadFixture,
			'thread',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getUserReturnsInitialValueForUser() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getUser()
		);
	}

	/**
	 * @test
	 */
	public function setUserForObjectStorageContainingUserSetsUser() {
		$user = new \AgoraTeam\Agora\Domain\Model\User();
		$objectStorageHoldingExactlyOneUser = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneUser->attach($user);
		$this->subject->setUser($objectStorageHoldingExactlyOneUser);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneUser,
			'user',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addUserToObjectStorageHoldingUser() {
		$user = new \AgoraTeam\Agora\Domain\Model\User();
		$userObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$userObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($user));
		$this->inject($this->subject, 'user', $userObjectStorageMock);

		$this->subject->addUser($user);
	}

	/**
	 * @test
	 */
	public function removeUserFromObjectStorageHoldingUser() {
		$user = new \AgoraTeam\Agora\Domain\Model\User();
		$userObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$userObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($user));
		$this->inject($this->subject, 'user', $userObjectStorageMock);

		$this->subject->removeUser($user);

	}
}
