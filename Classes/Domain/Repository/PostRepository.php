<?php
namespace AgoraTeam\Agora\Domain\Repository;


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
 * The repository for Posts
 */
class PostRepository extends Repository {

	protected $defaultOrderings = array(
		'publishing_date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_ASCENDING
	);

	/**
	 * Finds the latest Posts
	 *
	 * @param integer $limit The number of threads to return at max
	 * @return \TYPO3\CMS\Extbase\Persistence\QueryResultInterface
	 */
	public function findLatestPostsForUser($limit) {
		$openUserForums = $this->forumRepository->findAccessibleUserForums();

		$query = $this->createQuery();

		$result = $query
			->matching(
				$query->logicalAnd(
					$query->equals('original_post', 0),
					$query->in('forum', $openUserForums)
				)
			)
			->setOrderings(array('publishing_date' => \TYPO3\CMS\Extbase\Persistence\QueryInterface::ORDER_DESCENDING))
			->setLimit((integer)$limit)
			->execute();

		return $result;
	}

}