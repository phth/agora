<?php
namespace AgoraTeam\Agora\ViewHelpers\Form;

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
 * Textarea view helper.
 * The value of the text area needs to be set via the "value" attribute, as with all other form ViewHelpers.
 *
 * = Examples =
 *
 * <code title="Example">
 * <f:form.textarea name="myTextArea" value="This is shown inside the textarea" />
 * </code>
 * <output>
 * <textarea name="myTextArea">This is shown inside the textarea</textarea>
 * </output>
 *
 * @api
 */
class MarkdownViewHelper extends \TYPO3\CMS\Fluid\ViewHelpers\Form\AbstractFormFieldViewHelper  {

	/**
	 * @var string
	 */
	protected $tagName = 'textarea';

	/**
	 * Initialize the arguments.
	 *
	 * @return void
	 * @api
	 */
	public function initializeArguments() {
		parent::initializeArguments();
		$this->registerTagAttribute('data-provide', 'string', '');
		$this->registerTagAttribute('autofocus', 'string', 'Specifies that a text area should automatically get focus when the page loads');
		$this->registerTagAttribute('rows', 'int', 'The number of rows of a text area');
		$this->registerTagAttribute('cols', 'int', 'The number of columns of a text area');
		$this->registerTagAttribute('disabled', 'string', 'Specifies that the input element should be disabled when the page loads');
		$this->registerTagAttribute('placeholder', 'string', 'The placeholder of the textarea');
		$this->registerArgument('errorClass', 'string', 'CSS class to set if there are errors for this view helper', FALSE, 'f3-form-error');
		$this->registerUniversalTagAttributes();
	}

	/**
	 * Renders the textarea.
	 *
	 * @return string
	 * @api
	 */
	public function render() {
		$name = $this->getName();
		$this->registerFieldNameForFormTokenGeneration($name);

		$this->tag->forceClosingTag(TRUE);
		$this->tag->addAttribute('name', $name);
		$this->tag->addAttribute('data-provide', 'markdown');
		$this->tag->setContent(htmlspecialchars($this->getValue()));

		$this->setErrorClassAttribute();

		return $this->tag->render();
	}
}
