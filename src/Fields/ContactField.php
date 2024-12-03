<?php

/**
 * @package    Fields - KS Yandex Map
 * @version       2.0.0
 * @Author        Sergey Tolkachyov, https://web-tolk.ru
 * @copyright     Copyright (C) 2024 Sergey Tolkachyov
 * @license       GNU/GPL http://www.gnu.org/licenses/gpl-3.0.html
 * @since         1.0.0
 */

namespace Joomla\Plugin\Fields\Contact\Fields;

defined('_JEXEC') or die();

use Joomla\CMS\Form\Field\ListField;
use Joomla\Database\DatabaseAwareInterface;
use Joomla\Database\DatabaseAwareTrait;
use Joomla\CMS\HTML\HTMLHelper;
use Joomla\CMS\Language\Text;

class ContactField extends ListField
{
    use DatabaseAwareTrait;

    protected $type = 'Contact';

    public function getOptions()
    {
        $db    = $this->getDatabase();
        $query = $db->getQuery(true)
            ->select('*')
            ->from($db->quoteName('#__contact_details'))
            ->where('published=1');

        $db->setQuery($query);

        $result = $db->loadObjectList();

        $options = [];

        foreach ($result as $contact) {
            $options[] = HTMLHelper::_('select.option', $contact->id, Text::_($contact->name));
        }

        return array_merge(parent::getOptions(), $options);
    }
}
