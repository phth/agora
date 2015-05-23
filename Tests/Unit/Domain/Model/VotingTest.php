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
 * Test case for class \AgoraTeam\Agora\Domain\Model\Voting.
 *
 * @copyright Copyright belongs to the respective authors
 * @license http://www.gnu.org/licenses/gpl.html GNU General Public License, version 3 or later
 *
 * @author Philipp Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class VotingTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {
	/**
	 * @var \AgoraTeam\Agora\Domain\Model\Voting
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = new \AgoraTeam\Agora\Domain\Model\Voting();
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function getQuestionReturnsInitialValueForString() {
		$this->assertSame(
			'',
			$this->subject->getQuestion()
		);
	}

	/**
	 * @test
	 */
	public function setQuestionForStringSetsQuestion() {
		$this->subject->setQuestion('Conceived at T3CON10');

		$this->assertAttributeEquals(
			'Conceived at T3CON10',
			'question',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function getAnswersReturnsInitialValueForVotingAnswer() {
		$newObjectStorage = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$this->assertEquals(
			$newObjectStorage,
			$this->subject->getAnswers()
		);
	}

	/**
	 * @test
	 */
	public function setAnswersForObjectStorageContainingVotingAnswerSetsAnswers() {
		$answer = new \AgoraTeam\Agora\Domain\Model\VotingAnswer();
		$objectStorageHoldingExactlyOneAnswers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
		$objectStorageHoldingExactlyOneAnswers->attach($answer);
		$this->subject->setAnswers($objectStorageHoldingExactlyOneAnswers);

		$this->assertAttributeEquals(
			$objectStorageHoldingExactlyOneAnswers,
			'answers',
			$this->subject
		);
	}

	/**
	 * @test
	 */
	public function addAnswerToObjectStorageHoldingAnswers() {
		$answer = new \AgoraTeam\Agora\Domain\Model\VotingAnswer();
		$answersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('attach'), array(), '', FALSE);
		$answersObjectStorageMock->expects($this->once())->method('attach')->with($this->equalTo($answer));
		$this->inject($this->subject, 'answers', $answersObjectStorageMock);

		$this->subject->addAnswer($answer);
	}

	/**
	 * @test
	 */
	public function removeAnswerFromObjectStorageHoldingAnswers() {
		$answer = new \AgoraTeam\Agora\Domain\Model\VotingAnswer();
		$answersObjectStorageMock = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array('detach'), array(), '', FALSE);
		$answersObjectStorageMock->expects($this->once())->method('detach')->with($this->equalTo($answer));
		$this->inject($this->subject, 'answers', $answersObjectStorageMock);

		$this->subject->removeAnswer($answer);

	}
}
