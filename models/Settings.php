<?php namespace Hambern\Request\Models;

use Backend\Models\UserGroup;
use BackendMenu;
use Model;

/**
 * Class Settings
 *
 * @package Hambern\Request\Models
 */
class Settings extends Model
{

    /**
     * @var array
     */
    public $implement = [
        'System.Behaviors.SettingsModel',
    ];

    /**
     * @var string
     */
    public $settingsCode = 'hambern_request_settings';

    /**
     * @var string
     */
    public $settingsFields = 'fields.yaml';

    /**
     * @return mixed
     */
    public function getDefaultStatusOptions()
    {
        return Status::lists('title', 'id');
    }

    /**
     * @return mixed
     */
    public function getReceiveGroupsOptions()
    {
        return UserGroup::lists('name', 'id');
    }
}
