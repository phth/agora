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
 * Test case for class \AgoraTeam\Agora\Domain\Model\Vote.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Philipp Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class VoteTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \AgoraTeam\Agora\Domain\Model\Vote
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \AgoraTeam\Agora\Domain\Model\Vote();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getVotingReturnsInitialValueForVoting() {
		$this->assertEquals(
			NULL,
			$this->subject->getVoting()
		);
	}

	/**
	 * @test
	 */
	public function setVotingForVotingSetsVoting() {
		$votingFixture = new \AgoraTeam\Agora\Domain\Model\Voting();
		$this->subject->setVoting($votingFixture);

		$this->assertAttributeEquals(
			$votingFixture,
			'voting',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getVotingAnswersReturnsInitialValueForVotingAnswer() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getVotingAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setVotingAnswersForObjectStorageContainingVotingAnswerSetsVotingAnswers() {
		$votingAnswer = new \AgoraTeam\Agora\Domain\Model\VotingAnswer();
		$objectStorageHoldingExactlyOneVotingAnswers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneVotingAnswers->attach($votingAnswer);
		$this->subject->setVotingAnswers($objectStorageHoldingExactlyOneVotingAnswers);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneVotingAnswers,
			'votingAnswers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addVotingAnswerToObjectStorageHoldingVotingAnswers() {
		$votingAnswer = new \AgoraTeam\Agora\Domain\Model\VotingAnswer();
		$votingAnswersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$votingAnswersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($votingAnswer));
		$this->inject($this->subject, 'votingAnswers', $votingAnswersObjectStorageMock);

		$this->subject->addVotingAnswer($votingAnswer);
	}

	/**
	 * @test
	 */
	public function removeVotingAnswerFromObjectStorageHoldingVotingAnswers() {
		$votingAnswer = new \AgoraTeam\Agora\Domain\Model\VotingAnswer();
		$votingAnswersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$votingAnswersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($votingAnswer));
		$this->inject($this->subject, 'votingAnswers', $votingAnswersObjectStorageMock);

		$this->subject->removeVotingAnswer($votingAnswer);

	}

	/**
	 * @test
	 */
	public function getUserReturnsInitialValueForUser() {
		$this->assertEquals(
			NULL,
			$this->subject->getUser()
		);
	}

	/**
	 * @test
	 */
	public function setUserForUserSetsUser() {
		$userFixture = new \AgoraTeam\Agora\Domain\Model\User();
		$this->subject->setUser($userFixture);

		$this->assertAttributeEquals(
			$userFixture,
			'user',
			$this->subject
		);
	}
}
