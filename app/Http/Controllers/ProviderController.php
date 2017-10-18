<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProviderRequest;
use App\Http\Requests\UpdateProviderRequest;
use App\Repositories\ProviderRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Provider;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class ProviderController extends InfyOmBaseController
{
    /** @var  ProviderRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    /**
     * Display a listing of the Provider.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->providerRepository->pushCriteria(new RequestCriteria($request));
        $providers = $this->providerRepository->all();
        return view('admin.providers.index')
            ->with('providers', $providers);
    }

    /**
     * Show the form for creating a new Provider.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.providers.create');
    }

    /**
     * Store a newly created Provider in storage.
     *
     * @param CreateProviderRequest $request
     *
     * @return Response
     */
    public function store(CreateProviderRequest $request)
    {
        $input = $request->all();

        $provider = $this->providerRepository->create($input);

        Flash::success('Provider saved successfully.');

        return redirect(route('admin.providers.index'));
    }

    /**
     * Display the specified Provider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $provider = $this->providerRepository->findWithoutFail($id);

        if (empty($provider)) {
            Flash::error('Provider not found');

            return redirect(route('providers.index'));
        }

        return view('admin.providers.show')->with('provider', $provider);
    }

    /**
     * Show the form for editing the specified Provider.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $provider = $this->providerRepository->findWithoutFail($id);

        if (empty($provider)) {
            Flash::error('Provider not found');

            return redirect(route('providers.index'));
        }

        return view('admin.providers.edit')->with('provider', $provider);
    }

    /**
     * Update the specified Provider in storage.
     *
     * @param  int              $id
     * @param UpdateProviderRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProviderRequest $request)
    {
        $provider = $this->providerRepository->findWithoutFail($id);

        

        if (empty($provider)) {
            Flash::error('Provider not found');

            return redirect(route('providers.index'));
        }

        $provider = $this->providerRepository->update($request->all(), $id);

        Flash::success('Provider updated successfully.');

        return redirect(route('admin.providers.index'));
    }

    /**
     * Remove the specified Provider from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.providers.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Provider::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.providers.index'))->with('success', Lang::get('message.success.delete'));

       }

}
