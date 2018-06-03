<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSapiSubRequest;
use App\Http\Requests\UpdateSapiSubRequest;
use App\Repositories\SapiSubRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\SubKriteria;
use App\Models\SapiSub;
use App\Models\Kriteria;
use App\Models\Sapi;
use App\Models\Expert;

class SapiSubController extends AppBaseController
{
    /** @var  SapiSubRepository */
    private $sapiSubRepository;

    public function __construct(SapiSubRepository $sapiSubRepo)
    {
        $this->sapiSubRepository = $sapiSubRepo;
    }

    /**
     * Display a listing of the SapiSub.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sapiSubRepository->pushCriteria(new RequestCriteria($request));
        $sapiSubs = $this->sapiSubRepository->all();
        $kriterias = Kriteria::pluck('nama_kriteria', 'id');
        $subKriterias = SubKriteria::pluck('nama_sub_kriteria', 'id');
        $experts = Expert::pluck('nama', 'id');

        return view('sapi_subs.index')
            ->with('sapiSubs', $sapiSubs)
            ->with('kriterias', $kriterias)
            ->with('subKriterias', $subKriterias);
    }

    /**
     * Show the form for creating a new SapiSub.
     *
     * @return Response
     */
    public function create($id)
    {
      $expert = Expert::find($id);
      $experts = Expert::all();
      $hit = 0;
      foreach ($experts as $key => $value) {
        $hit++;
        if($value->id == $id){
          break;
        }
      }
      // dd($hit);
      $ps = SapiSub::where('expert_id','=',$id)->orderBy('kriteria_id','ASC')->orderBy('sub_kriteria_id','ASC')->orderBy('sapi1_id','ASC')->get();
      $sapis = Sapi::all();
      $subKriterias = SubKriteria::all();
      //dd($kriterias);
      $p = Sapi::all()->pluck('nama_sapi', 'id');
      //dd($k);
      $sapi1 = null;
      $kriterias = Kriteria::all();
      $selectedKri = null;
      foreach ($kriterias as $kk => $vk) {
        $ck = SapiSub::all()->where('kriteria_id','=', $vk->id)->count();
        $csub = SubKriteria::all()->where('kriteria_id','=',$vk->id)->count();
          // dd($csub);
        if($ck < countTable($sapis->count())*$csub* Expert::all()->count()){
          $selectedKri = $vk;
          break;
        }
      }
      $selectedSub = null;
      $hms = $subKriterias->where('kriteria_id','=',$selectedKri->id);
      // dd($hms);
      foreach ($hms as $key => $value) {
        $cSub = SapiSub::all()->where('sub_kriteria_id', '=', $value->id)->where('expert_id','=',$id)->count();
        // dd($cSub);
        if($cSub  <= countTable($sapis->count()) * $hit){
          $selectedSub = $value;
          break;
        }
      }
      // dd($selectedSub);
      $sapiSubs = SapiSub::all()->where("expert_id",'=', $id);
      $sapi2 = null;
      $ketemu = false;
      $full = countTable($sapis->count()) == $sapiSubs->count() ? true : false;
      foreach ($sapis as $p1) {
        if($selectedKri==null || $selectedSub==null) break;
        $count = $sapiSubs->where('sapi1_id', '=', $p1->id)->where('kriteria_id', '=', $selectedKri->id)->where('sub_kriteria_id', '=', $selectedSub->id)->count() +
                  $sapiSubs->where('sapi2_id', '=', $p1->id)->where('kriteria_id', '=', $selectedKri->id)->where('sub_kriteria_id', '=', $selectedSub->id)->count();
        $countKri = $subKriterias->where('kriteria_id','=', $selectedKri->id);
                // var_dump($countKri->count());
        // dd($count);
        // if($count < $kriterias->count()*$countKri->count()){
          // dd($count);
          foreach ($sapis as $p2) {
              if($p1->id != $p2->id){
                // dd($selectedSub);
                $ada1 = $sapiSubs->where('sapi1_id', '=', "$p1->id")->where('sapi2_id', '=', "$p2->id")->where('sub_kriteria_id', '=', $selectedSub->id)->count();
                $ada2 = $sapiSubs->where('sapi1_id', '=', "$p2->id")->where('sapi2_id', '=', "$p1->id")->where('sub_kriteria_id', '=', $selectedSub->id)->count();
                if($ada1 == 0 && $ada2 == 0 ){
                  $sapi1 = $p1;
                  $sapi2 = $p2;
                  $ketemu = true;
                  break;
                }
              }
          }
        // }
        if($ketemu==true) break;
      }
      // dd($count);
      // dd($id);
      return view('sapi_subs.create')->with('expert', $expert)
                  ->with('sapi1', $sapi1)->with('sapi2', $sapi2)
                  ->with('full', $full)->with('sapiSubs', $sapiSubs)
                  ->with('kriterias', $kriterias)->with('sapis', $sapis)
                  ->with('subKriteria', $selectedSub)->with('selectedSub', $selectedSub)
                  ->with('selectedKri', $selectedKri)->with('ps', $ps)
                  ->with('p', $p);
    }


    /**
     * Store a newly created SapiSub in storage.
     *
     * @param CreateSapiSubRequest $request
     *
     * @return Response
     */
    public function store(CreateSapiSubRequest $request)
    {
        $input = $request->all();
        //dd($input);
        $sapiSub = $this->sapiSubRepository->create($input);

        Flash::success('Sapi Sub saved successfully.');

        return \App::make('redirect')->back();
    }

    /**
     * Display the specified SapiSub.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sapiSub = $this->sapiSubRepository->findWithoutFail($id);

        if (empty($sapiSub)) {
            Flash::error('Sapi Sub not found');

            return redirect(route('sapiSubs.index'));
        }
        $sapi1 = Sapi::find($sapiSub->sapi1_id);
        $sapi2 = Sapi::find($sapiSub->sapi2_id);
        return view('sapi_subs.show')->with('sapiSub', $sapiSub)
                  ->with('sapi1',$sapi1)
                  ->with('sapi2',$sapi2);
    }

    /**
     * Show the form for editing the specified SapiSub.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sapiSub = $this->sapiSubRepository->findWithoutFail($id);

        if (empty($sapiSub)) {
            Flash::error('Sapi Sub not found');

            return redirect(route('sapiSubs.index'));
        }
        $sapi1 = Sapi::find($sapiSub->sapi1_id);
        $sapi2 = Sapi::find($sapiSub->sapi2_id);
        $subKriteria = SubKriteria::find($sapiSub->sub_kriteria_id);
        $expert = Expert::find($sapiSub->expert_id);
        return view('sapi_subs.edit')->with('sapiSub', $sapiSub)
                ->with('sapi1',$sapi1)
                ->with('sapi2',$sapi2)
                ->with('subKriteria', $subKriteria)
                ->with('expert', $expert);
    }

    /**
     * Update the specified SapiSub in storage.
     *
     * @param  int              $id
     * @param UpdateSapiSubRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSapiSubRequest $request)
    {
        $sapiSub = $this->sapiSubRepository->findWithoutFail($id);

        if (empty($sapiSub)) {
            Flash::error('Sapi Sub not found');

            return redirect(route('sapiSubs.index'));
        }
        $expert_id = $sapiSub->expert_id;
        $sapiSub = $this->sapiSubRepository->update($request->all(), $id);

        Flash::success('Sapi Sub updated successfully.');

        return redirect(route('experts.sapiSubs.create', [$id=>$expert_id]));
    }

    public function destroyAllByExpertId($expert_id){
        $sapiSub = SapiSub::where('expert_id','=',$expert_id);

      if (empty(count($sapiSub->get()))) {
          Flash::error('Sapi Sub not found');

          return \App::make('redirect')->back();
      }

      $sapiSub->delete();

      Flash::success('Sapi Sub deleted successfully.');

      return \App::make('redirect')->back();
    }
}
