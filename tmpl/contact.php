<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.User
 *
 * @copyright   (C) 2017 Open Source Matters, Inc. <https://www.joomla.org>
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

defined('_JEXEC') or die;

use Joomla\CMS\Layout\LayoutHelper;
use Joomla\CMS\Router\Route;
use Joomla\Component\Contact\Site\Helper\RouteHelper;

/** @var \Joomla\CMS\Layout\FileLayout $this */
$value = $field->value;

if ($value == '') return;

$value = (array) $value;

if ((int) $field->fieldparams->get('styles') === 1) {
    $this->getApplication()->getDocument()->getWebAssetManager()->useStyle('plg_fields_contact.contact-field');
}

foreach ($value as $contactId):

    if (!$contactId) continue;

    $contactModel = $this->getApplication()->bootComponent('com_contact')->getMVCFactory()->createModel('Contact', 'Site', ['ignore_request' => false]);
    $contact = $contactModel->getItem($contactId);

    if ($contact):
        $contact->slug    = $contact->id . ':' . $contact->alias;
        $contact->link = Route::_(RouteHelper::getContactRoute($contact->slug, $contact->catid)); ?>

        <a class="contact-fld" href="<?= $contact->link; ?>" title="<?= $contact->name; ?>">
            <?php if ((int) $field->fieldparams->get('show_img') === 1 && !empty($contact->image))
                echo LayoutHelper::render(
                    'joomla.html.image',
                    [
                        'src' => $contact->image,
                        'alt' => $contact->name,
                        'class' => 'contact-fld__img'
                    ]
                ); ?>
            <div class="contact-fld__body">
                <h5 class="contact-fld__title"><?= $contact->name; ?></h5>
                <?php if ((int) $field->fieldparams->get('show_position') === 1 && !empty($contact->con_position)): ?>
                    <span class="contact-fld__info"><?= $contact->con_position; ?></span>
                <?php endif; ?>
            </div>
        </a>

    <?php endif; ?>
<?php endforeach; ?>