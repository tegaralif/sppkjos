<?php

namespace App\Models;

use Eloquent as Model;
use Illuminate\Database\Eloquent\SoftDeletes;

/**
 * Class SapiSub
 * @package App\Models
 * @version October 17, 2017, 12:19 am UTC
 *
 * @property integer sapi1_id
 * @property float nilai
 * @property integer sapi2_id
 * @property integer kriteria_id
 */
class SapiSub extends Model
{
    use SoftDeletes;

    public $table = 'sapi_subs';


    protected $dates = ['deleted_at'];


    public $fillable = [
        'sapi1_id',
        'nilai',
        'sapi2_id',
        'kriteria_id',
        'expert_id',
        'sub_kriteria_id'
    ];

    /**
     * The attributes that should be casted to native types.
     *
     * @var array
     */
    protected $casts = [
        'sapi1_id' => 'integer',
        'nilai' => 'float',
        'sapi2_id' => 'integer',
        'kriteria_id' => 'integer',
        'expert_id' => 'integer',
        'sub_kriteria_id' => 'integer'
    ];

    /**
     * Validation rules
     *
     * @var array
     */
    public static $rules = [
        'sapi1_id' => 'required',
        'nilai' => 'required',
        'sapi2_id' => 'required',
        'kriteria_id' => 'required',
        'expert_id' => 'required',
        'sub_kriteria_id' => 'required'
    ];

    public function kriteria()
    {
        return $this->belongsTo('App\Models\Kriteria', 'kriteria_id', 'id');
    }

    public function expert()
    {
        return $this->belongsTo('App\Models\Expert', 'expert_id', 'id');
    }

    public function subKriteria(){
      return $this->belongsTo('App\Models\SubKriteria', 'sub_kriteria_id', 'id');
    }
}
