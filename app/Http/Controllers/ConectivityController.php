<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateConectivityRequest;
use App\Http\Requests\UpdateConectivityRequest;
use App\Repositories\ConectivityRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Conectivity;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ConectivityController extends InfyOmBaseController
{
    /** @var  ConectivityRepository */
    private $conectivityRepository;

    public function __construct(ConectivityRepository $conectivityRepo)
    {
        $this->conectivityRepository = $conectivityRepo;
    }

    /**
     * Display a listing of the Conectivity.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->conectivityRepository->pushCriteria(new RequestCriteria($request));
        $conectivities = $this->conectivityRepository->all();
        return view('admin.conectivities.index')
            ->with('conectivities', $conectivities);
    }

    /**
     * Show the form for creating a new Conectivity.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.conectivities.create');
    }

    /**
     * Store a newly created Conectivity in storage.
     *
     * @param CreateConectivityRequest $request
     *
     * @return Response
     */
    public function store(CreateConectivityRequest $request)
    {
        $input = $request->all();

        $conectivity = $this->conectivityRepository->create($input);

        Flash::success('Conectivity saved successfully.');

        return redirect(route('admin.conectivities.index'));
    }

    /**
     * Display the specified Conectivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $conectivity = $this->conectivityRepository->findWithoutFail($id);

        if (empty($conectivity)) {
            Flash::error('Conectivity not found');

            return redirect(route('conectivities.index'));
        }

        return view('admin.conectivities.show')->with('conectivity', $conectivity);
    }

    /**
     * Show the form for editing the specified Conectivity.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $conectivity = $this->conectivityRepository->findWithoutFail($id);

        if (empty($conectivity)) {
            Flash::error('Conectivity not found');

            return redirect(route('conectivities.index'));
        }

        return view('admin.conectivities.edit')->with('conectivity', $conectivity);
    }

    /**
     * Update the specified Conectivity in storage.
     *
     * @param  int              $id
     * @param UpdateConectivityRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateConectivityRequest $request)
    {
        $conectivity = $this->conectivityRepository->findWithoutFail($id);

        

        if (empty($conectivity)) {
            Flash::error('Conectivity not found');

            return redirect(route('conectivities.index'));
        }

        $conectivity = $this->conectivityRepository->update($request->all(), $id);

        Flash::success('Conectivity updated successfully.');

        return redirect(route('admin.conectivities.index'));
    }

    /**
     * Remove the specified Conectivity from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.conectivities.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Conectivity::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.conectivities.index'))->with('success', Lang::get('message.success.delete'));

       }

}
