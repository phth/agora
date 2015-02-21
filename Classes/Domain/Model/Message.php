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
 * Message
 */
class Message extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * subject
	 *
	 * @var string
	 */
	protected $subject = '';

	/**
	 * message
	 *
	 * @var string
	 */
	protected $message = '';

	/**
	 * read
	 *
	 * @var boolean
	 */
	protected $read = FALSE;

	/**
	 * sender
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 */
	protected $sender = NULL;

	/**
	 * reciever
	 *
	 * @var \AgoraTeam\Agora\Domain\Model\User
	 */
	protected $reciever = NULL;

	/**
	 * Returns the subject
	 *
	 * @return string $subject
	 */
	public function getSubject() {
		return $this->subject;
	}

	/**
	 * Sets the subject
	 *
	 * @param string $subject
	 * @return void
	 */
	public function setSubject($subject) {
		$this->subject = $subject;
	}

	/**
	 * Returns the message
	 *
	 * @return string $message
	 */
	public function getMessage() {
		return $this->message;
	}

	/**
	 * Sets the message
	 *
	 * @param string $message
	 * @return void
	 */
	public function setMessage($message) {
		$this->message = $message;
	}

	/**
	 * Returns the read
	 *
	 * @return boolean $read
	 */
	public function getRead() {
		return $this->read;
	}

	/**
	 * Sets the read
	 *
	 * @param boolean $read
	 * @return void
	 */
	public function setRead($read) {
		$this->read = $read;
	}

	/**
	 * Returns the boolean state of read
	 *
	 * @return boolean
	 */
	public function isRead() {
		return $this->read;
	}

	/**
	 * Returns the sender
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\User $sender
	 */
	public function getSender() {
		return $this->sender;
	}

	/**
	 * Sets the sender
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $sender
	 * @return void
	 */
	public function setSender(\AgoraTeam\Agora\Domain\Model\User $sender) {
		$this->sender = $sender;
	}

	/**
	 * Returns the reciever
	 *
	 * @return \AgoraTeam\Agora\Domain\Model\User $reciever
	 */
	public function getReciever() {
		return $this->reciever;
	}

	/**
	 * Sets the reciever
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\User $reciever
	 * @return void
	 */
	public function setReciever(\AgoraTeam\Agora\Domain\Model\User $reciever) {
		$this->reciever = $reciever;
	}

}