<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class Sapi
 * @package App\Models
 * @version October 16, 2017, 10:45 pm UTC
 *
 * @property string nama_sapi
 */
class Sapi extends Model
{
    use SoftDeletes;

    public $table = 'sapis';
    

    protected $dates = ['deleted_at'];


    public $fillable = [
        'nama_sapi'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'nama_sapi' => 'string'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'nama_sapi' => 'required'
    ];

    
}
