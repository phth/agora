<?php
namespace AgoraTeam\Agora\Controller;

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
 * ActionController
 */
class ActionController extends \TYPO3\CMS\Extbase\Mvc\Controller\ActionController {

	/**
	 * persistenceManager
	 *
	 * @var \TYPO3\CMS\Extbase\Persistence\Generic\PersistenceManager
	 * @inject
	 */
	protected $persistenceManager;

	/**
	 * userRepository
	 *
	 * @var \AgoraTeam\Agora\Domain\Repository\UserRepository
	 * @inject
	 */
	protected $userRepository;

	/**
	 * user
	 *
	 * the logged in frontend user, if there is any
	 *
	 * @var mixed
	 */
	protected $user;

	/**
	 * initialize object
	 *
	 * @return void
	 */
	public function initializeObject() {
		$user = $this->getCurrentUser();
		if(is_a($user, '\AgoraTeam\Agora\Domain\Model\User')) {
			$this->setUser($user);
		}
	}

	/**
	 * Get current logged in user
	 *
	 * @return null|\AgoraTeam\Agora\Domain\Repository\User
	 */
	public function getCurrentUser() {

		if (!is_array($GLOBALS['TSFE']->fe_user->user)) {
			return NULL;
		}
		return $this->userRepository->findByUid($GLOBALS['TSFE']->fe_user->user['uid']);
	}

	/**
	 * Returns the user
	 *
	 * @return mixed
	 */
	public function getUser() {
		return $this->user;
	}

	/**
	 * Sets the user
	 *
	 * @param mixed $user
	 */
	public function setUser($user) {
		$this->user = $user;
	}

	/**
	 * Get Usergroups from current user
	 *
	 * @return array
	 */
	public function getCurrentUsergroupUids() {
		$currentUser = $this->getUser();
		$usergroupUids = array();
		if ($currentUser !== NULL) {
			foreach ($currentUser->getUsergroup() as $usergroup) {
				$usergroupUids[] = $usergroup->getUid();
			}
		}
		return $usergroupUids;
	}

    /**
     * sendMail
     *
     * sends a mail via TYPO3 mailing API (swiftmailer)
     *
     * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
     * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
     * @param string $subject subject of the email
     * @param string $templateName template name (UpperCamelCase)
     * @param array $variables variables to be passed to the Fluid view
     * @param array $replyTo reply to forthe email in the format array('reply@domain.tld' => 'Reply To Name')
     * @return boolean TRUE on success, otherwise false
     */
    public function sendMail(array $recipient, array $sender, $subject, $templateName, array $variables = array(), $replyTo = array()) {
        $emailView = $this->objectManager->get('\\TYPO3\\CMS\\Fluid\\View\\StandaloneView');
        $extensionName = $this->request->getControllerExtensionName();
        $emailView->getRequest()->setControllerExtensionName($extensionName);
        $emailView->setFormat('html');
        $extbaseFrameworkConfiguration = $this->configurationManager->getConfiguration(\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK);
        $layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['layoutRootPath']).'../Email/Layouts/';
        $emailView->setLayoutRootPath($layoutRootPath);
        $partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['partialRootPath']).'../Email/Partials/';
        $emailView->setPartialRootPath($partialRootPath);
        $templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName($extbaseFrameworkConfiguration['view']['templateRootPath']).'../Email/Templates/';
        $templatePathAndFilename = $templateRootPath . $templateName . '.html';
        $emailView->setTemplatePathAndFilename($templatePathAndFilename);
        $emailView->assign('subject', $subject);
        $emailView->assign('settings', $this->settings);
        $emailView->assignMultiple($variables);
        $emailBody = $emailView->render();

        $message = $this->objectManager->get('\\TYPO3\\CMS\\Core\\Mail\\MailMessage');
        $message->setTo($recipient)
            ->setFrom($sender)
            ->setSubject('Confirmation email');

        if(!empty($replyTo)) {
            $message->setReplyTo($replyTo);
        }
        // Plain text example
        #$message->setBody($emailBody, 'text/plain')
        // HTML Email
        $message->setBody($emailBody, 'text/html');
        $message->send();
        return $message->isSent();
    }

    protected function getPostsDefaultSender(){
        return array(  $this->settings['post']['defaultPostEmailAdress'] => $this->settings['post']['defaultPostEmailUserName']);
    }

    protected function getThreadDefaultSender(){
        return array(  $this->settings['thread']['defaultThreadEmailAdress'] => $this->settings['thread']['defaultThreadEmailUserName']);
    }

}