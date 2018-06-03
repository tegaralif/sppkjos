<?php

namespace App\Repositories;

use App\Models\SapiSub;
use InfyOm\Generator\Common\BaseRepository;

/**
 * Class SapiSubRepository
 * @package App\Repositories
 * @version October 17, 2017, 12:19 am UTC
 *
 * @method SapiSub findWithoutFail($id, $columns = ['*'])
 * @method SapiSub find($id, $columns = ['*'])
 * @method SapiSub first($columns = ['*'])
*/
class SapiSubRepository extends BaseRepository
{
    /**
     * @var array
     */
    protected $fieldSearchable = [
        'sapi1_id',
        'nilai',
        'sapi2_id',
        'kriteria_id',
        'expert_id',
        'sub_kriteria_id'
    ];

    /**
     * Configure the Model
     **/
    public function model()
    {
        return SapiSub::class;
    }
}
