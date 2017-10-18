<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateInfrastructureRequest;
use App\Http\Requests\UpdateInfrastructureRequest;
use App\Repositories\InfrastructureRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Infrastructure;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class InfrastructureController extends InfyOmBaseController
{
    /** @var  InfrastructureRepository */
    private $infrastructureRepository;

    public function __construct(InfrastructureRepository $infrastructureRepo)
    {
        $this->infrastructureRepository = $infrastructureRepo;
    }

    /**
     * Display a listing of the Infrastructure.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->infrastructureRepository->pushCriteria(new RequestCriteria($request));
        $infrastructures = $this->infrastructureRepository->all();
        return view('admin.infrastructures.index')
            ->with('infrastructures', $infrastructures);
    }

    /**
     * Show the form for creating a new Infrastructure.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.infrastructures.create');
    }

    /**
     * Store a newly created Infrastructure in storage.
     *
     * @param CreateInfrastructureRequest $request
     *
     * @return Response
     */
    public function store(CreateInfrastructureRequest $request)
    {
        $input = $request->all();

        $infrastructure = $this->infrastructureRepository->create($input);

        Flash::success('Infrastructure saved successfully.');

        return redirect(route('admin.infrastructures.index'));
    }

    /**
     * Display the specified Infrastructure.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $infrastructure = $this->infrastructureRepository->findWithoutFail($id);

        if (empty($infrastructure)) {
            Flash::error('Infrastructure not found');

            return redirect(route('infrastructures.index'));
        }

        return view('admin.infrastructures.show')->with('infrastructure', $infrastructure);
    }

    /**
     * Show the form for editing the specified Infrastructure.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $infrastructure = $this->infrastructureRepository->findWithoutFail($id);

        if (empty($infrastructure)) {
            Flash::error('Infrastructure not found');

            return redirect(route('infrastructures.index'));
        }

        return view('admin.infrastructures.edit')->with('infrastructure', $infrastructure);
    }

    /**
     * Update the specified Infrastructure in storage.
     *
     * @param  int              $id
     * @param UpdateInfrastructureRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateInfrastructureRequest $request)
    {
        $infrastructure = $this->infrastructureRepository->findWithoutFail($id);

        

        if (empty($infrastructure)) {
            Flash::error('Infrastructure not found');

            return redirect(route('infrastructures.index'));
        }

        $infrastructure = $this->infrastructureRepository->update($request->all(), $id);

        Flash::success('Infrastructure updated successfully.');

        return redirect(route('admin.infrastructures.index'));
    }

    /**
     * Remove the specified Infrastructure from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.infrastructures.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Infrastructure::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.infrastructures.index'))->with('success', Lang::get('message.success.delete'));

       }

}
