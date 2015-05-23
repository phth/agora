<?php
namespace AgoraTeam\Agora\Tests\Unit\Controller;
/***************************************************************
 *  Copyright notice
 *
 *  (c) 2015 Philipp Thiele <philipp.thiele@phth.de>
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
 * Test case for class AgoraTeam\Agora\Controller\ThreadController.
 *
 * @author Philipp Thiele <philipp.thiele@phth.de>
 * @author Björn Christopher Bresser <bjoern.bresser@gmail.com>
 */
class ThreadControllerTest extends \TYPO3\CMS\Core\Tests\UnitTestCase {

	/**
	 * @var \AgoraTeam\Agora\Controller\ThreadController
	 */
	protected $subject = NULL;

	protected function setUp() {
		$this->subject = $this->getMock('AgoraTeam\\Agora\\Controller\\ThreadController', array('redirect', 'forward', 'addFlashMessage'), array(), '', FALSE);
	}

	protected function tearDown() {
		unset($this->subject);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllThreadsFromRepositoryAndAssignsThemToView() {

		$allThreads = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$threadRepository = $this->getMock('AgoraTeam\\Agora\\Domain\\Repository\\ThreadRepository', array('findAll'), array(), '', FALSE);
		$threadRepository->expects($this->once())->method('findAll')->will($this->returnValue($allThreads));
		$this->inject($this->subject, 'threadRepository', $threadRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('threads', $allThreads);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}

	/**
	 * @test
	 */
	public function showActionAssignsTheGivenThreadToView() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('thread', $thread);

		$this->subject->showAction($thread);
	}

	/**
	 * @test
	 */
	public function newActionAssignsTheGivenThreadToView() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('newThread', $thread);
		$this->inject($this->subject, 'view', $view);

		$this->subject->newAction($thread);
	}

	/**
	 * @test
	 */
	public function createActionAddsTheGivenThreadToThreadRepository() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();

		$threadRepository = $this->getMock('AgoraTeam\\Agora\\Domain\\Repository\\ThreadRepository', array('add'), array(), '', FALSE);
		$threadRepository->expects($this->once())->method('add')->with($thread);
		$this->inject($this->subject, 'threadRepository', $threadRepository);

		$this->subject->createAction($thread);
	}

	/**
	 * @test
	 */
	public function editActionAssignsTheGivenThreadToView() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$this->inject($this->subject, 'view', $view);
		$view->expects($this->once())->method('assign')->with('thread', $thread);

		$this->subject->editAction($thread);
	}

	/**
	 * @test
	 */
	public function updateActionUpdatesTheGivenThreadInThreadRepository() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();

		$threadRepository = $this->getMock('AgoraTeam\\Agora\\Domain\\Repository\\ThreadRepository', array('update'), array(), '', FALSE);
		$threadRepository->expects($this->once())->method('update')->with($thread);
		$this->inject($this->subject, 'threadRepository', $threadRepository);

		$this->subject->updateAction($thread);
	}

	/**
	 * @test
	 */
	public function deleteActionRemovesTheGivenThreadFromThreadRepository() {
		$thread = new \AgoraTeam\Agora\Domain\Model\Thread();

		$threadRepository = $this->getMock('AgoraTeam\\Agora\\Domain\\Repository\\ThreadRepository', array('remove'), array(), '', FALSE);
		$threadRepository->expects($this->once())->method('remove')->with($thread);
		$this->inject($this->subject, 'threadRepository', $threadRepository);

		$this->subject->deleteAction($thread);
	}

	/**
	 * @test
	 */
	public function listActionFetchesAllThreadsFromRepositoryAndAssignsThemToView() {

		$allThreads = $this->getMock('TYPO3\\CMS\\Extbase\\Persistence\\ObjectStorage', array(), array(), '', FALSE);

		$threadRepository = $this->getMock('AgoraTeam\\Agora\\Domain\\Repository\\ThreadRepository', array('findAll'), array(), '', FALSE);
		$threadRepository->expects($this->once())->method('findAll')->will($this->returnValue($allThreads));
		$this->inject($this->subject, 'threadRepository', $threadRepository);

		$view = $this->getMock('TYPO3\\CMS\\Extbase\\Mvc\\View\\ViewInterface');
		$view->expects($this->once())->method('assign')->with('threads', $allThreads);
		$this->inject($this->subject, 'view', $view);

		$this->subject->listAction();
	}
}
