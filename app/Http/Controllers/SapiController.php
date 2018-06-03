<?php

namespace App\Http\Controllers;

use App\Http\Requests\CreateSapiRequest;
use App\Http\Requests\UpdateSapiRequest;
use App\Repositories\SapiRepository;
use App\Http\Controllers\AppBaseController;
use Illuminate\Http\Request;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\Models\SapiSub;

class SapiController extends AppBaseController
{
    /** @var  SapiRepository */
    private $sapiRepository;

    public function __construct(SapiRepository $sapiRepo)
    {
        $this->sapiRepository = $sapiRepo;
    }

    /**
     * Display a listing of the Sapi.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {
        $this->sapiRepository->pushCriteria(new RequestCriteria($request));
        $sapis = $this->sapiRepository->all();

        return view('sapis.index')
            ->with('sapis', $sapis);
    }

    /**
     * Show the form for creating a new Sapi.
     *
     * @return Response
     */
    public function create()
    {
        return view('sapis.create');
    }

    /**
     * Store a newly created Sapi in storage.
     *
     * @param CreateSapiRequest $request
     *
     * @return Response
     */
    public function store(CreateSapiRequest $request)
    {
        $input = $request->all();

        $sapi = $this->sapiRepository->create($input);

        Flash::success('Sapi saved successfully.');

        return redirect(route('sapis.index'));
    }

    /**
     * Display the specified Sapi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $sapi = $this->sapiRepository->findWithoutFail($id);

        if (empty($sapi)) {
            Flash::error('Sapi not found');

            return redirect(route('sapis.index'));
        }

        return view('sapis.show')->with('sapi', $sapi);
    }

    /**
     * Show the form for editing the specified Sapi.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $sapi = $this->sapiRepository->findWithoutFail($id);

        if (empty($sapi)) {
            Flash::error('Sapi not found');

            return redirect(route('sapis.index'));
        }

        return view('sapis.edit')->with('sapi', $sapi);
    }

    /**
     * Update the specified Sapi in storage.
     *
     * @param  int              $id
     * @param UpdateSapiRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateSapiRequest $request)
    {
        $sapi = $this->sapiRepository->findWithoutFail($id);

        if (empty($sapi)) {
            Flash::error('Sapi not found');

            return redirect(route('sapis.index'));
        }

        $sapi = $this->sapiRepository->update($request->all(), $id);

        Flash::success('Sapi updated successfully.');

        return redirect(route('sapis.index'));
    }

    /**
     * Remove the specified Sapi from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function destroy($id)
    {
        $sapi = $this->sapiRepository->findWithoutFail($id);
        if (empty($sapi)) {
            Flash::error('Sapi not found');

            return redirect(route('sapis.index'));
        }
        SapiSub::where('sapi1_id','=', $id)->delete();
        SapiSub::where('sapi2_id','=',$id)->delete();
        $this->sapiRepository->delete($id);

        Flash::success('Sapi deleted successfully.');

        return redirect(route('sapis.index'));
    }
}
