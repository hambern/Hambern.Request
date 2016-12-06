<?php namespace Hambern\Request\Models;

use Model;

/**
 * Model
 */
class Status extends Model
{
    use \October\Rain\Database\Traits\Validation;
    use \October\Rain\Database\Traits\Sortable;

    public $rules = [];

    public $guarded = [];

    public $table = 'hambern_request_statuses';

    public $hasMany = [
      'requests' => 'Hambern\Request\Models\Request'
    ];
}
