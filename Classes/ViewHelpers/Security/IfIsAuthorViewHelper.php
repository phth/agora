<?php
namespace AgoraTeam\Agora\ViewHelpers\Security;


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
 * IfIsAuthorViewHelper
 */
class IfIsAuthorViewHelper extends \TYPO3\CMS\Fluid\Core\ViewHelper\AbstractConditionViewHelper {

    /**
     * renders <f:then> child if the current logged in FE user is creator of the specified object
     * otherwise renders <f:else> child.
     *
     * @param string $object The object
     * @return string the rendered string
     * @api
     */
    public function render($object) {
        if ($this->frontendUserIsCreator($object)) {
            return $this->renderThenChild();
        } else {
            return $this->renderElseChild();
        }
    }

    /**
     * Determines whether the currently logged in FE user is creator of the specified object
     *
     * @param string $object The object
     * @return boolean TRUE if the currently logged in FE user is creator of the specified object
     */
    protected function frontendUserIsCreator($object) {
        if (!isset($GLOBALS['TSFE']) || !$GLOBALS['TSFE']->loginUser) {
            return FALSE;
        }

        if(is_object($object->getCreator())) {
            if($object->getCreator()->getUid() == $GLOBALS['TSFE']->fe_user->user['uid']) {
                return TRUE;
            }
        }
        return FALSE;
    }

}