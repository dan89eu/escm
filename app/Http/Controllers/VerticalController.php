<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateVerticalRequest;
use App\Http\Requests\UpdateVerticalRequest;
use App\Repositories\VerticalRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Vertical;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class VerticalController extends InfyOmBaseController
{
    /** @var  VerticalRepository */
    private $verticalRepository;

    public function __construct(VerticalRepository $verticalRepo)
    {
        $this->verticalRepository = $verticalRepo;
    }

    /**
     * Display a listing of the Vertical.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->verticalRepository->pushCriteria(new RequestCriteria($request));
        $verticals = $this->verticalRepository->all();
        return view('admin.verticals.index')
            ->with('verticals', $verticals);
    }

    /**
     * Show the form for creating a new Vertical.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.verticals.create');
    }

    /**
     * Store a newly created Vertical in storage.
     *
     * @param CreateVerticalRequest $request
     *
     * @return Response
     */
    public function store(CreateVerticalRequest $request)
    {
        $input = $request->all();

        $vertical = $this->verticalRepository->create($input);

        Flash::success('Vertical saved successfully.');

        return redirect(route('admin.verticals.index'));
    }

    /**
     * Display the specified Vertical.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $vertical = $this->verticalRepository->findWithoutFail($id);

        if (empty($vertical)) {
            Flash::error('Vertical not found');

            return redirect(route('verticals.index'));
        }

        return view('admin.verticals.show')->with('vertical', $vertical);
    }

    /**
     * Show the form for editing the specified Vertical.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $vertical = $this->verticalRepository->findWithoutFail($id);

        if (empty($vertical)) {
            Flash::error('Vertical not found');

            return redirect(route('verticals.index'));
        }

        return view('admin.verticals.edit')->with('vertical', $vertical);
    }

    /**
     * Update the specified Vertical in storage.
     *
     * @param  int              $id
     * @param UpdateVerticalRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateVerticalRequest $request)
    {
        $vertical = $this->verticalRepository->findWithoutFail($id);

        

        if (empty($vertical)) {
            Flash::error('Vertical not found');

            return redirect(route('verticals.index'));
        }

        $vertical = $this->verticalRepository->update($request->all(), $id);

        Flash::success('Vertical updated successfully.');

        return redirect(route('admin.verticals.index'));
    }

    /**
     * Remove the specified Vertical from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.verticals.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Vertical::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.verticals.index'))->with('success', Lang::get('message.success.delete'));

       }

}
