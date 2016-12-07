<?php namespace Hambern\Request;

use Backend;
use Hambern\Request\Models\Request;
use Hambern\Request\Models\Settings;
use System\Classes\PluginBase;

/**
 * Class Plugin
 *
 * @package Hambern\Request
 */
class Plugin extends PluginBase
{

    /**
     * @return array
     */
    public function registerComponents()
    {
        return [
            'Hambern\Request\Components\Form' => 'Form',
        ];
    }

    /**
     * @return array
     */
    public function registerSettings()
    {
        return [
            'request' => [
                'label'       => 'hambern.request::lang.plugin.name',
                'description' => 'hambern.request::lang.settings.description',
                'category'    => 'system::lang.system.categories.system',
                'icon'        => 'icon-inbox',
                'class'       => 'Hambern\Request\Models\Settings',
                'order'       => 600,
                'keywords'    => 'hambern.request::lang.plugin.name',
                'permissions' => ['settings'],
            ],
        ];
    }

    /**
     * @return array
     */
    public function registerNavigation()
    {
        $configuration = $this->getConfigurationFromYaml();

        if (array_key_exists('navigation', $configuration)) {
            $navigation = $configuration['navigation'];

            if (is_array($navigation)) {
                array_walk_recursive($navigation, function (&$item, $key) {

                    if ($key === 'url') {
                        $item = Backend::url($item);
                    } elseif ($key === 'counter') {
                        $item = $this->{$item}();
                    }
                });
            }

            return $navigation;
        }
    }

    /**
     * @return array
     */
    public function registerMailTemplates()
    {
        return [
            'hambern.request::mail.notice' => 'A request notice to send to administrators',
        ];
    }

    /**
     * @return null
     */
    public function newRequests()
    {
        $id = Settings::get('default_status') ?: null;

        return Request::whereHas('status', function ($status) use ($id) {
            $status->whereId($id);
        })->count() ?: null;
    }
}
