<?php
namespace AgoraTeam\Agora\Domain\Model;


/***************************************************************
 *
 *  Copyright notice
 *
 *  (c) 2015 Phillip Thiele <philipp.thiele@phth.de>
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
 * Vote
 */
class Vote extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * voting
	 * 
	 * @var \AgoraTeam\Agora\Domain\Model\Voting
	 */
	protected $voting = NULL;

	/**
	 * votingAnswers
	 * 
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\VotingAnswer>
	 * @cascade remove
	 */
	protected $votingAnswers = NULL;

	/**
	 * user
	 * 
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 */
	protected $user = NULL;

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
		$this->votingAnswers = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
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
	 * Adds a VotingAnswer
	 * 
	 * @param \AgoraTeam\Agora\Domain\Model\VotingAnswer $votingAnswer
	 * @return void
	 */
	public function addVotingAnswer(\AgoraTeam\Agora\Domain\Model\VotingAnswer $votingAnswer) {
		$this->votingAnswers->attach($votingAnswer);
	}

	/**
	 * Removes a VotingAnswer
	 * 
	 * @param \AgoraTeam\Agora\Domain\Model\VotingAnswer $votingAnswerToRemove The VotingAnswer to be removed
	 * @return void
	 */
	public function removeVotingAnswer(\AgoraTeam\Agora\Domain\Model\VotingAnswer $votingAnswerToRemove) {
		$this->votingAnswers->detach($votingAnswerToRemove);
	}

	/**
	 * Returns the votingAnswers
	 * 
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\VotingAnswer> $votingAnswers
	 */
	public function getVotingAnswers() {
		return $this->votingAnswers;
	}

	/**
	 * Sets the votingAnswers
	 * 
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\VotingAnswer> $votingAnswers
	 * @return void
	 */
	public function setVotingAnswers(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $votingAnswers) {
		$this->votingAnswers = $votingAnswers;
	}

	/**
	 * Returns the user
	 * 
	 * @return \AgoraTeam\Agora\Domain\Model\User $user
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 * 
	 * @param \AgoraTeam\Agora\Domain\Model\User $user
	 * @return void
	 */
	public function setUser(\AgoraTeam\Agora\Domain\Model\User $user) {
		$this->user = $user;
	}

}