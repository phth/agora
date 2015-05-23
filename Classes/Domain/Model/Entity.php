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
 * Post
 */
class Entity extends \TYPO3\CMS\Extbase\DomainObject\AbstractEntity {

    /**
     * crdate
     *
     * @var \DateTime
     */
    protected $crdate;

	/**
	 * crdate
	 *
	 * @var \DateTime
	 */
	protected $tstamp;

    /**
     * Returns the crdate
     *
     * @return \DateTime $crdate
     */
    public function getCrdate() {
        return $this->crdate;
    }

    /**
     * Sets the crdate
     *
     * @param \DateTime $crdate
     * @return void
     */
    public function setCrdate($crdate) {
        $this->crdate = $crdate;
    }

	/**
	 * Returns the tstamp
	 *
	 * @return \DateTime $tstamp
	 */
	public function getTstamp() {
		return $this->tstamp;
	}

	/**
	 * Sets the tstamp
	 *
	 * @param \DateTime $tstamp
	 * @return void
	 */
	public function setTstamp($tstamp) {
		$this->tstamp = $tstamp;
	}

}