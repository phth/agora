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
 * Test case for class \AgoraTeam\Agora\Domain\Model\Forum.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Philipp Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class ForumTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \AgoraTeam\Agora\Domain\Model\Forum
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \AgoraTeam\Agora\Domain\Model\Forum();
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
	public function getDescriptionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getDescription()
		);
	}

	/**
	 * @test
	 */
	public function setDescriptionForStringSetsDescription() {
		$this->subject->setDescription('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'description',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getPublicReturnsInitialValueForBoolean() {
		$this->assertSame(
			FALSE,
			$this->subject->getPublic()
		);
	}

	/**
	 * @test
	 */
	public function setPublicForBooleanSetsPublic() {
		$this->subject->setPublic(TRUE);

		$this->assertAttributeEquals(
			TRUE,
			'public',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getParentReturnsInitialValueForForum() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getParent()
		);
	}

	/**
	 * @test
	 */
	public function setParentForObjectStorageContainingForumSetsParent() {
		$parent = new \AgoraTeam\Agora\Domain\Model\Forum();
		$objectStorageHoldingExactlyOneParent = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneParent->attach($parent);
		$this->subject->setParent($objectStorageHoldingExactlyOneParent);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneParent,
			'parent',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addParentToObjectStorageHoldingParent() {
		$parent = new \AgoraTeam\Agora\Domain\Model\Forum();
		$parentObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$parentObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($parent));
		$this->inject($this->subject, 'parent', $parentObjectStorageMock);

		$this->subject->addParent($parent);
	}

	/**
	 * @test
	 */
	public function removeParentFromObjectStorageHoldingParent() {
		$parent = new \AgoraTeam\Agora\Domain\Model\Forum();
		$parentObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$parentObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($parent));
		$this->inject($this->subject, 'parent', $parentObjectStorageMock);

		$this->subject->removeParent($parent);

	}

	/**
	 * @test
	 */
	public function getThreadsReturnsInitialValueForThread() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getThreads()
		);
	}

	/**
	 * @test
	 */
	public function setThreadsForObjectStorageContainingThreadSetsThreads() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();
		$objectStorageHoldingExactlyOneThreads = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneThreads->attach($thread);
		$this->subject->setThreads($objectStorageHoldingExactlyOneThreads);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneThreads,
			'threads',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addThreadToObjectStorageHoldingThreads() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();
		$threadsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$threadsObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($thread));
		$this->inject($this->subject, 'threads', $threadsObjectStorageMock);

		$this->subject->addThread($thread);
	}

	/**
	 * @test
	 */
	public function removeThreadFromObjectStorageHoldingThreads() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();
		$threadsObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$threadsObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($thread));
		$this->inject($this->subject, 'threads', $threadsObjectStorageMock);

		$this->subject->removeThread($thread);

	}

	/**
	 * @test
	 */
	public function getGroupsWithReadAccessReturnsInitialValueForGroup() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getGroupsWithReadAccess()
		);
	}

	/**
	 * @test
	 */
	public function setGroupsWithReadAccessForObjectStorageContainingGroupSetsGroupsWithReadAccess() {
		$groupsWithReadAcces = new \AgoraTeam\Agora\Domain\Model\Group();
		$objectStorageHoldingExactlyOneGroupsWithReadAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneGroupsWithReadAccess->attach($groupsWithReadAcces);
		$this->subject->setGroupsWithReadAccess($objectStorageHoldingExactlyOneGroupsWithReadAccess);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneGroupsWithReadAccess,
			'groupsWithReadAccess',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addGroupsWithReadAccesToObjectStorageHoldingGroupsWithReadAccess() {
		$groupsWithReadAcces = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupsWithReadAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$groupsWithReadAccessObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($groupsWithReadAcces));
		$this->inject($this->subject, 'groupsWithReadAccess', $groupsWithReadAccessObjectStorageMock);

		$this->subject->addGroupsWithReadAcces($groupsWithReadAcces);
	}

	/**
	 * @test
	 */
	public function removeGroupsWithReadAccesFromObjectStorageHoldingGroupsWithReadAccess() {
		$groupsWithReadAcces = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupsWithReadAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$groupsWithReadAccessObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($groupsWithReadAcces));
		$this->inject($this->subject, 'groupsWithReadAccess', $groupsWithReadAccessObjectStorageMock);

		$this->subject->removeGroupsWithReadAcces($groupsWithReadAcces);

	}

	/**
	 * @test
	 */
	public function getGroupWithWriteAccesssReturnsInitialValueForGroup() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getGroupWithWriteAccesss()
		);
	}

	/**
	 * @test
	 */
	public function setGroupWithWriteAccesssForObjectStorageContainingGroupSetsGroupWithWriteAccesss() {
		$groupWithWriteAccess = new \AgoraTeam\Agora\Domain\Model\Group();
		$objectStorageHoldingExactlyOneGroupWithWriteAccesss = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneGroupWithWriteAccesss->attach($groupWithWriteAccess);
		$this->subject->setGroupWithWriteAccesss($objectStorageHoldingExactlyOneGroupWithWriteAccesss);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneGroupWithWriteAccesss,
			'groupWithWriteAccess',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addGroupWithWriteAccessToObjectStorageHoldingGroupWithWriteAccesss() {
		$groupWithWriteAccess = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupWithWriteAccesssObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$groupWithWriteAccesssObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($groupWithWriteAccess));
		$this->inject($this->subject, 'groupWithWriteAccess', $groupWithWriteAccesssObjectStorageMock);

		$this->subject->addGroupWithWriteAccess($groupWithWriteAccess);
	}

	/**
	 * @test
	 */
	public function removeGroupWithWriteAccessFromObjectStorageHoldingGroupWithWriteAccesss() {
		$groupWithWriteAccess = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupWithWriteAccesssObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$groupWithWriteAccesssObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($groupWithWriteAccess));
		$this->inject($this->subject, 'groupWithWriteAccess', $groupWithWriteAccesssObjectStorageMock);

		$this->subject->removeGroupWithWriteAccess($groupWithWriteAccess);

	}

	/**
	 * @test
	 */
	public function getGroupsWithModificationAccessReturnsInitialValueForGroup() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getGroupsWithModificationAccess()
		);
	}

	/**
	 * @test
	 */
	public function setGroupsWithModificationAccessForObjectStorageContainingGroupSetsGroupsWithModificationAccess() {
		$groupsWithModificationAcces = new \AgoraTeam\Agora\Domain\Model\Group();
		$objectStorageHoldingExactlyOneGroupsWithModificationAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneGroupsWithModificationAccess->attach($groupsWithModificationAcces);
		$this->subject->setGroupsWithModificationAccess($objectStorageHoldingExactlyOneGroupsWithModificationAccess);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneGroupsWithModificationAccess,
			'groupsWithModificationAccess',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addGroupsWithModificationAccesToObjectStorageHoldingGroupsWithModificationAccess() {
		$groupsWithModificationAcces = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupsWithModificationAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$groupsWithModificationAccessObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($groupsWithModificationAcces));
		$this->inject($this->subject, 'groupsWithModificationAccess', $groupsWithModificationAccessObjectStorageMock);

		$this->subject->addGroupsWithModificationAcces($groupsWithModificationAcces);
	}

	/**
	 * @test
	 */
	public function removeGroupsWithModificationAccesFromObjectStorageHoldingGroupsWithModificationAccess() {
		$groupsWithModificationAcces = new \AgoraTeam\Agora\Domain\Model\Group();
		$groupsWithModificationAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$groupsWithModificationAccessObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($groupsWithModificationAcces));
		$this->inject($this->subject, 'groupsWithModificationAccess', $groupsWithModificationAccessObjectStorageMock);

		$this->subject->removeGroupsWithModificationAcces($groupsWithModificationAcces);

	}

	/**
	 * @test
	 */
	public function getUsersWithReadAccessReturnsInitialValueForUser() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getUsersWithReadAccess()
		);
	}

	/**
	 * @test
	 */
	public function setUsersWithReadAccessForObjectStorageContainingUserSetsUsersWithReadAccess() {
		$usersWithReadAcces = new \AgoraTeam\Agora\Domain\Model\User();
		$objectStorageHoldingExactlyOneUsersWithReadAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneUsersWithReadAccess->attach($usersWithReadAcces);
		$this->subject->setUsersWithReadAccess($objectStorageHoldingExactlyOneUsersWithReadAccess);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneUsersWithReadAccess,
			'usersWithReadAccess',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addUsersWithReadAccesToObjectStorageHoldingUsersWithReadAccess() {
		$usersWithReadAcces = new \AgoraTeam\Agora\Domain\Model\User();
		$usersWithReadAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$usersWithReadAccessObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($usersWithReadAcces));
		$this->inject($this->subject, 'usersWithReadAccess', $usersWithReadAccessObjectStorageMock);

		$this->subject->addUsersWithReadAcces($usersWithReadAcces);
	}

	/**
	 * @test
	 */
	public function removeUsersWithReadAccesFromObjectStorageHoldingUsersWithReadAccess() {
		$usersWithReadAcces = new \AgoraTeam\Agora\Domain\Model\User();
		$usersWithReadAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$usersWithReadAccessObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($usersWithReadAcces));
		$this->inject($this->subject, 'usersWithReadAccess', $usersWithReadAccessObjectStorageMock);

		$this->subject->removeUsersWithReadAcces($usersWithReadAcces);

	}

	/**
	 * @test
	 */
	public function getUsersWthWriteAccessiiReturnsInitialValueForUser() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getUsersWthWriteAccessii()
		);
	}

	/**
	 * @test
	 */
	public function setUsersWthWriteAccessiiForObjectStorageContainingUserSetsUsersWthWriteAccessii() {
		$usersWthWriteAccessii = new \AgoraTeam\Agora\Domain\Model\User();
		$objectStorageHoldingExactlyOneUsersWthWriteAccessii = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneUsersWthWriteAccessii->attach($usersWthWriteAccessii);
		$this->subject->setUsersWthWriteAccessii($objectStorageHoldingExactlyOneUsersWthWriteAccessii);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneUsersWthWriteAccessii,
			'usersWthWriteAccessii',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addUsersWthWriteAccessiiToObjectStorageHoldingUsersWthWriteAccessii() {
		$usersWthWriteAccessii = new \AgoraTeam\Agora\Domain\Model\User();
		$usersWthWriteAccessiiObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$usersWthWriteAccessiiObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($usersWthWriteAccessii));
		$this->inject($this->subject, 'usersWthWriteAccessii', $usersWthWriteAccessiiObjectStorageMock);

		$this->subject->addUsersWthWriteAccessii($usersWthWriteAccessii);
	}

	/**
	 * @test
	 */
	public function removeUsersWthWriteAccessiiFromObjectStorageHoldingUsersWthWriteAccessii() {
		$usersWthWriteAccessii = new \AgoraTeam\Agora\Domain\Model\User();
		$usersWthWriteAccessiiObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$usersWthWriteAccessiiObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($usersWthWriteAccessii));
		$this->inject($this->subject, 'usersWthWriteAccessii', $usersWthWriteAccessiiObjectStorageMock);

		$this->subject->removeUsersWthWriteAccessii($usersWthWriteAccessii);

	}

	/**
	 * @test
	 */
	public function getUsersWithModificationAccessReturnsInitialValueForUser() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getUsersWithModificationAccess()
		);
	}

	/**
	 * @test
	 */
	public function setUsersWithModificationAccessForObjectStorageContainingUserSetsUsersWithModificationAccess() {
		$usersWithModificationAcces = new \AgoraTeam\Agora\Domain\Model\User();
		$objectStorageHoldingExactlyOneUsersWithModificationAccess = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneUsersWithModificationAccess->attach($usersWithModificationAcces);
		$this->subject->setUsersWithModificationAccess($objectStorageHoldingExactlyOneUsersWithModificationAccess);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneUsersWithModificationAccess,
			'usersWithModificationAccess',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addUsersWithModificationAccesToObjectStorageHoldingUsersWithModificationAccess() {
		$usersWithModificationAcces = new \AgoraTeam\Agora\Domain\Model\User();
		$usersWithModificationAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$usersWithModificationAccessObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($usersWithModificationAcces));
		$this->inject($this->subject, 'usersWithModificationAccess', $usersWithModificationAccessObjectStorageMock);

		$this->subject->addUsersWithModificationAcces($usersWithModificationAcces);
	}

	/**
	 * @test
	 */
	public function removeUsersWithModificationAccesFromObjectStorageHoldingUsersWithModificationAccess() {
		$usersWithModificationAcces = new \AgoraTeam\Agora\Domain\Model\User();
		$usersWithModificationAccessObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$usersWithModificationAccessObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($usersWithModificationAcces));
		$this->inject($this->subject, 'usersWithModificationAccess', $usersWithModificationAccessObjectStorageMock);

		$this->subject->removeUsersWithModificationAcces($usersWithModificationAcces);

	}
}
