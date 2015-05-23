<?php
namespace AgoraTeam\Agora\Domain\Model;


/***************************************************************
 *
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
 * Attachment
 */
class Attachment extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * title
	 * 
	 * @var string
	 */
	protected $title = '';

	/**
	 * file
	 * 
	 * @var \TYPO3\CMS\Extbase\Domain\Model\FileReference
	 * @validate NotEmpty
	 */
	protected $file = NULL;

	/**
	 * Returns the title
	 * 
	 * @return string $title
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the title
	 * 
	 * @param string $title
	 * @return void
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the file
	 * 
	 * @return \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 */
	public function getFile() {
		return $this->file;
	}

	/**
	 * Sets the file
	 * 
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FileReference $file
	 * @return void
	 */
	public function setFile(\TYPO3\CMS\Extbase\Domain\Model\FileReference $file) {
		$this->file = $file;
	}

}