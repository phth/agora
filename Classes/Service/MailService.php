<?php

namespace AgoraTeam\Agora\Service;

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
 * Class Mailservice
 *
 * @package AgoraTeam\Agora\Domain\Service
 */
class MailService {

	/**
	 * sendMail
	 * sends a mail via TYPO3 mailing API (swiftmailer)
	 *
	 * @param array $recipient recipient of the email in the format array('recipient@domain.tld' => 'Recipient Name')
	 * @param array $sender sender of the email in the format array('sender@domain.tld' => 'Sender Name')
	 * @param string $subject subject of the email
	 * @param string $templateName template name (UpperCamelCase)
	 * @param array $variables variables to be passed to the Fluid view
	 * @param array $replyTo reply to forthe email in the format array('reply@domain.tld' => 'Reply To Name')
	 * @param array $settings
	 * @return boolean TRUE on success, otherwise false
	 */
	public static function sendMail(array $recipient, array $sender, $subject, $templateName, array $variables = array(), $replyTo = array(), $settings = array()) {
		$extensionName = 'tx_agora';
		$objectManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Object\\ObjectManager');
		$configurationManager = \TYPO3\CMS\Core\Utility\GeneralUtility::makeInstance('TYPO3\\CMS\\Extbase\\Configuration\\ConfigurationManager');

		$emailView = $objectManager->get('\\TYPO3\\CMS\\Fluid\\View\\StandaloneView');
		$extbaseFrameworkConfiguration = $configurationManager->getConfiguration(
			\TYPO3\CMS\Extbase\Configuration\ConfigurationManagerInterface::CONFIGURATION_TYPE_FRAMEWORK
		);

		$emailView->getRequest()->setControllerExtensionName($extensionName);
		$emailView->setFormat('html');

			//@todo Change to variable paths!
		$layoutRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
				$extbaseFrameworkConfiguration['settings']['email']['layoutRootPath']);
		$partialRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
				$extbaseFrameworkConfiguration['settings']['email']['partialRootPath']);
		$templateRootPath = \TYPO3\CMS\Core\Utility\GeneralUtility::getFileAbsFileName(
				$extbaseFrameworkConfiguration['settings']['email']['templateRootPath']);
		$templatePathAndFilename = $templateRootPath . $templateName . '.html';

		$emailView->setPartialRootPath($partialRootPath);
		$emailView->setLayoutRootPath($layoutRootPath);
		$emailView->setTemplatePathAndFilename($templatePathAndFilename);
		$emailView->assign('subject', $subject);
		$emailView->assign('settings', $settings);
		$emailView->assignMultiple($variables);
		$emailBody = $emailView->render();

		$message = $objectManager->get('\\TYPO3\\CMS\\Core\\Mail\\MailMessage');
		$message->setTo($recipient)
			->setFrom($sender)
			->setSubject($subject);

		if (!empty($replyTo)) {
			$message->setReplyTo($replyTo);
		}

			// Plain text example
			// $message->setBody($emailBody, 'text/plain')
			// HTML Email
		$message->setBody($emailBody, 'text/html');
		$message->send();

		return $message->isSent();
	}




}
