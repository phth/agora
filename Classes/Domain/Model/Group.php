<?php
namespace AgoraTeam\Agora\Domain\Model;

	/***************************************************************
	 *  Copyright notice
	 *  (c) 2015 Philipp Thiele <philipp.thiele@phth.de>
	 *           Björn Christopher Bresser <bjoern.bresser@gmail.com>
	 *  All rights reserved
	 *  This script is part of the TYPO3 project. The TYPO3 project is
	 *  free software; you can redistribute it and/or modify
	 *  it under the terms of the GNU General Public License as published by
	 *  the Free Software Foundation; either version 3 of the License, or
	 *  (at your option) any later version.
	 *  The GNU General Public License can be found at
	 *  http://www.gnu.org/copyleft/gpl.html.
	 *  This script is distributed in the hope that it will be useful,
	 *  but WITHOUT ANY WARRANTY; without even the implied warranty of
	 *  MERCHANTABILITY or FITNESS FOR A PARTICULAR PURPOSE.  See the
	 *  GNU General Public License for more details.
	 *  This copyright notice MUST APPEAR in all copies of the script!
	 ***************************************************************/

/**
 * Group
 */
class Group extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

	/**
	 * @var string
	 */
	protected $title = '';

	/**
	 * @var string
	 */
	protected $lockToDomain = '';

	/**
	 * @var string
	 */
	protected $description = '';

	/**
	 * @var \TYPO3\CMS\Extbase\Persistence\ObjectStorage<\AgoraTeam\Agora\Domain\Model\Group>
	 */
	protected $subgroups;

	/**
	 * Constructs a new Frontend User Group
	 *
	 * @param string $title
	 */
	public function __construct($title = '') {
		$this->setTitle($title);
		$this->subgroups = new \TYPO3\CMS\Extbase\Persistence\ObjectStorage();
	}

	/**
	 * Sets the title value
	 *
	 * @param string $title
	 * @return void
	 * @api
	 */
	public function setTitle($title) {
		$this->title = $title;
	}

	/**
	 * Returns the title value
	 *
	 * @return string
	 * @api
	 */
	public function getTitle() {
		return $this->title;
	}

	/**
	 * Sets the lockToDomain value
	 *
	 * @param string $lockToDomain
	 * @return void
	 * @api
	 */
	public function setLockToDomain($lockToDomain) {
		$this->lockToDomain = $lockToDomain;
	}

	/**
	 * Returns the lockToDomain value
	 *
	 * @return string
	 * @api
	 */
	public function getLockToDomain() {
		return $this->lockToDomain;
	}

	/**
	 * Sets the description value
	 *
	 * @param string $description
	 * @return void
	 * @api
	 */
	public function setDescription($description) {
		$this->description = $description;
	}

	/**
	 * Returns the description value
	 *
	 * @return string
	 * @api
	 */
	public function getDescription() {
		return $this->description;
	}

	/**
	 * Sets the subgroups
	 *
	 * @param \TYPO3\CMS\Extbase\Persistence\ObjectStorage $subgroups An object storage containing the subgroups to add
	 * @return void
	 * @api
	 */
	public function setSubgroups(\TYPO3\CMS\Extbase\Persistence\ObjectStorage $subgroups) {
		$this->subgroups = $subgroups;
	}

	/**
	 * Adds a subgroup to the frontend user
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $subgroup
	 * @return void
	 * @api
	 */
	public function addSubgroup(\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $subgroup) {
		$this->subgroups->attach($subgroup);
	}

	/**
	 * Removes a subgroup from the frontend user group
	 *
	 * @param \TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $subgroup
	 * @return void
	 * @api
	 */
	public function removeSubgroup(\TYPO3\CMS\Extbase\Domain\Model\FrontendUserGroup $subgroup) {
		$this->subgroups->detach($subgroup);
	}

	/**
	 * Returns the subgroups
	 *
	 * @return \TYPO3\CMS\Extbase\Persistence\ObjectStorage An object storage containing the subgroups
	 * @api
	 */
	public function getSubgroups() {
		return $this->subgroups;
	}

	/**
	 * Returns the subgroups
	 *
	 * @return \Array An array containing the flattened subgroups
	 * @api
	 */
	public function getFlattenedSubgroups() {
		$flattenedSubgroups = array();
		foreach ($this->getSubgroups() as $subgroup) {
			$flattenedSubgroups[(string)$subgroup] = $subgroup;
			$flattenedSubgroups = array_merge($flattenedSubgroups, $subgroup->getFlattenedSubgroups());
		}

		return $flattenedSubgroups;
	}
}