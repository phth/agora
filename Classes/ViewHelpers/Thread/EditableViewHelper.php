<?php
namespace AgoraTeam\Agora\ViewHelpers\Thread;

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
 * EditableViewHelper
 */
class EditableViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractViewHelper {

	/**
	 * render
	 *
	 * @param \AgoraTeam\Agora\Domain\Model\Thread $thread
	 * @param mixed $user
	 * @return $content the rendered content
	 */
	public function render(\AgoraTeam\Agora\Domain\Model\Thread $thread, $user) {
		$content = '';

		if (is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			if ($thread->isWritableForUser($user)) {
				$content = $this->renderChildren();
			}
		} elseif (!$thread->isWriteProtected()) {
			$content = $this->renderChildren();
		}

		return $content;
	}
}