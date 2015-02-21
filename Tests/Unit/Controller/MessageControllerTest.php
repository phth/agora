<?php
namespace AgoraTeam\Agora\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Phillip Thiele <philipp.thiele@phth.de>
 *  			Björn Christopher Bresser <bjoern.bresser@gmail.com>
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
 * Test case for class AgoraTeam\Agora\Controller\MessageController.
 *
 * @author Phillip Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class MessageControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \AgoraTeam\Agora\Controller\MessageController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('AgoraTeam\\Agora\\Controller\\MessageController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMessagesFromRepositoryAndAssignsThemToView() {

		$allMessages = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$messageRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMessages));
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('messages', $allMessages);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenMessageToView() {
		$message = new \AgoraTeam\Agora\Domain\Model\Message();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('message', $message);

		$this->subject->showAction($message);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenMessageToView() {
		$message = new \AgoraTeam\Agora\Domain\Model\Message();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newMessage', $message);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($message);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenMessageToMessageRepository() {
		$message = new \AgoraTeam\Agora\Domain\Model\Message();

		$messageRepository = $this->getMock('', array('add'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('add')->with($message);
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$this->subject->createAction($message);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenMessageFromMessageRepository() {
		$message = new \AgoraTeam\Agora\Domain\Model\Message();

		$messageRepository = $this->getMock('', array('remove'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('remove')->with($message);
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$this->subject->deleteAction($message);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllMessagesFromRepositoryAndAssignsThemToView() {

		$allMessages = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$messageRepository = $this->getMock('', array('findAll'), array(), '', FALSE);
		$messageRepository->expects($this->once())->method('findAll')->will($this->returnValue($allMessages));
		$this->inject($this->subject, 'messageRepository', $messageRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('messages', $allMessages);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
