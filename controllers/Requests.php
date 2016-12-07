<?php namespace Hambern\Request\Controllers;

use Backend\Classes\Controller;
use BackendMenu;

/**
 * Class Requests
 *
 * @package Hambern\Request\Controllers
 */
class Requests extends Controller
{

    /**
     * @var array
     */
    public $implement = [
        'Backend\Behaviors\ListController',
        'Backend\Behaviors\FormController',
        'Backend\Behaviors\ReorderController',
    ];

    /**
     * @var string
     */
    public $listConfig = 'config_list.yaml';

    /**
     * @var string
     */
    public $formConfig = 'config_form.yaml';

    /**
     * @var string
     */
    public $reorderConfig = 'config_reorder.yaml';

    /**
     * @var string
     */
    public $filterConfig = 'config_filter.yaml';

    /**
     * @var array
     */
    public $requiredPermissions = [
        'requests',
    ];

    /**
     * Requests constructor.
     */
    public function __construct()
    {
        parent::__construct();
        BackendMenu::setContext('Hambern.Request', 'request', 'requests');
    }
}
