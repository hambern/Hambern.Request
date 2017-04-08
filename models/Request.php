<?php namespace Hambern\Request\Models;

use Model;

/**
 * Model
 */
class Request extends Model
{

    use \October\Rain\Database\Traits\Validation;

    /**
     * @var array
     */
    public $rules = [
        'subject'  => 'filled|min:5',
        'name'     => 'filled|regex:/[a-ö A-Ö]/|min:5',
        'phone'    => 'filled|min:9',
        'email'    => 'required|email',
        'content'  => 'required|regex:/[^@]/|min:9',
        'homepage' => 'max:0',
    ];

    /**
     * @var array
     */
    public $fillable = ['subject', 'name', 'phone', 'email', 'content'];

    /**
     * @var array
     */
    public $jsonable = ['notes'];
    
    /**
     * @var string
     */
    public $table = 'hambern_request_requests';

    /**
     * @var array
     */
    public $belongsTo = [
        'status' => 'Hambern\Request\Models\Status'
    ];
}
