<?php

/**
 * @package     Joomla.Plugin
 * @subpackage  Fields.Contact
 *
 * @copyright   (C) 2024 Sergey Kuznetsov. All rights reserved.
 * @license     GNU General Public License version 2 or later; see LICENSE.txt
 */

\defined('_JEXEC') or die;

use Joomla\CMS\Extension\PluginInterface;
use Joomla\CMS\Factory;
use Joomla\CMS\Plugin\PluginHelper;
use Joomla\DI\Container;
use Joomla\DI\ServiceProviderInterface;
use Joomla\Event\DispatcherInterface;
use Joomla\CMS\WebAsset\WebAssetRegistry;
use Joomla\Plugin\Fields\Contact\Extension\Contact;

return new class() implements ServiceProviderInterface {
    /**
     * Registers the service provider with a DI container.
     *
     * @param   Container  $container  The DI container.
     *
     * @return  void
     *
     * @since   1.0.0
     */
    public function register(Container $container)
    {
        $container->set(
            PluginInterface::class,
            function (Container $container) {
                $plugin = new Contact(
                    $container->get(DispatcherInterface::class),
                    (array) PluginHelper::getPlugin('fields', 'contact')
                );
                $plugin->setApplication(Factory::getApplication());

                $wa = $container->get(WebAssetRegistry::class);
                $wa->addRegistryFile('media/plg_fields_contact/joomla.asset.json');
                $plugin->setApplication(Factory::getApplication());

                return $plugin;
            }
        );
    }
};
