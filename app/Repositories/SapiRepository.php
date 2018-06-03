<?php

namespace App\Repositories;

use App\Models\Sapi;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SapiRepository
 * @package App\Repositories
 * @version October 16, 2017, 10:45 pm UTC
 *
 * @method Sapi findWithoutFail($id, $columns = ['*'])
 * @method Sapi find($id, $columns = ['*'])
 * @method Sapi first($columns = ['*'])
*/
class SapiRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'nama_sapi'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return Sapi::class;
    }
}
