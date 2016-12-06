<?php namespace Hambern\Request\Models;

use Model;

/**
* Model
*/
class Request extends Model
{
    use \October\Rain\Database\Traits\Validation;

    public $rules = [
        'subject'       => 'filled|min:5',
        'name'          => 'filled|regex:/[a-ö A-Ö]/|min:5',
        'phone'         => 'filled|min:9',
        'email'         => 'required|email',
        'content'       => 'required|regex:/[^@]/|min:9',
        'homepage'      => 'max:0',
    ];

    public $fillable = ['subject', 'name', 'phone', 'email', 'content'];

    public $table = 'hambern_request_requests';

    public $belongsTo = [
        'status' => 'Hambern\Request\Models\Status'
    ];
}
