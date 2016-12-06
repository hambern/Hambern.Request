<?php namespace Hambern\Request;

use Backend;
use Hambern\Request\Models\Request;
use Hambern\Request\Models\Settings;
use System\Classes\PluginBase;

class Plugin extends PluginBase
{
    public function registerComponents()
    {
        return [
            'Hambern\Request\Components\Form'    => 'Form',
        ];
    }

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

    public function registerMailTemplates()
    {
        return [
            'hambern.request::mail.notice'   => 'A request notice to send to administrators',
        ];
    }

    public function newRequests()
    {
        $id = Settings::get('default_status') ?: null;
        return Request::whereHas('status', function ($status) use ($id) {
            $status->whereId($id);
        })->count() ?: null;
    }
}
