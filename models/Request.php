<?php namespace Hambern\Request\Models;

use Model;

/**
 * Model
 */
class Request extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
      'title'         => 'required|min:5',
      'name'          => 'required|regex:/[a-ö A-Ö]/|min:5',
      'phone'         => '',
      'email'         => 'required|email',
      'content'       => 'required|regex:/[^@]/|min:5',
      'homepage'      => 'max:0',
    ];

    public $guarded = [];

    public $table = 'hambern_request_requests';

    public $belongsTo = [
      'status' => 'Hambern\Request\Models\Status'
    ];
}
