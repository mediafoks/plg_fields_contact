<?php

/**
 * @package    Fields - KS Yandex Map
 * @version       2.0.0
 * @Author        Sergey Tolkachyov, https://web-tolk.ru
 * @copyright     Copyright (C) 2024 Sergey Tolkachyov
 * @license       GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @since         1.0.0
 */

namespace Joomla\Plugin\Fields\Contact\Extension;

// No direct access
defined('_JEXEC') or die;

use Joomla\CMS\Form\Form;
use Joomla\CMS\Form\FormHelper;
use Joomla\CMS\Language\Text;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\CMS\WebAsset\WebAssetManager;
use Joomla\Component\Fields\Administrator\Plugin\FieldsPlugin;
use Joomla\Uri\Uri;

class Contact extends FieldsPlugin
{

	protected $autoloadLanguage = true;

	/**
	 * Transforms the field into a DOM XML element and appends it as a child on the given parent.
	 *
	 * @param   \stdClass    $field   The field.
	 * @param   \DOMElement  $parent  The field node parent.
	 * @param   Form         $form    The form.
	 *
	 * @return  \DOMElement
	 *
	 * @since   3.7.0
	 */
	public function onCustomFieldsPrepareDom($field, \DOMElement $parent, Form $form)
	{
		if ($this->getApplication()->isClient('site')) return;

		$fieldNode = parent::onCustomFieldsPrepareDom($field, $parent, $form);

		FormHelper::addFieldPrefix('Joomla\Plugin\Fields\Contact\Fields');
		return $fieldNode;
	}
}
