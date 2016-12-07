<?php namespace Hambern\Request\Models;

use Model;

/**
 * Model
 */
class Status extends Model
{

    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    /**
     * @var array
     */
    public $rules = [];

    /**
     * @var array
     */
    public $guarded = [];

    /**
     * @var string
     */
    public $table = 'hambern_request_statuses';

    /**
     * @var array
     */
    public $hasMany = [
        'requests' => 'Hambern\Request\Models\Request'
    ];
}
