<?php namespace Hambern\Request\Models;

use Backend\Models\UserGroup;
use BackendMenu;
use Model;

class Settings extends Model
{
    public $implement = [
        'System.Behaviors.SettingsModel',
    ];

    public $settingsCode = 'hambern_request_settings';

    public $settingsFields = 'fields.yaml';

    public function getDefaultStatusOptions()
    {
        return Status::lists('title', 'id');
    }

    public function getReceiveGroupsOptions()
    {
        return UserGroup::lists('name', 'id');
    }
}
