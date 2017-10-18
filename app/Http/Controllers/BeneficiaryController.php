<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateBeneficiaryRequest;
use App\Http\Requests\UpdateBeneficiaryRequest;
use App\Repositories\BeneficiaryRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\Beneficiary;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class BeneficiaryController extends InfyOmBaseController
{
    /** @var  BeneficiaryRepository */
    private $beneficiaryRepository;

    public function __construct(BeneficiaryRepository $beneficiaryRepo)
    {
        $this->beneficiaryRepository = $beneficiaryRepo;
    }

    /**
     * Display a listing of the Beneficiary.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->beneficiaryRepository->pushCriteria(new RequestCriteria($request));
        $beneficiaries = $this->beneficiaryRepository->all();
        return view('admin.beneficiaries.index')
            ->with('beneficiaries', $beneficiaries);
    }

    /**
     * Show the form for creating a new Beneficiary.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.beneficiaries.create');
    }

    /**
     * Store a newly created Beneficiary in storage.
     *
     * @param CreateBeneficiaryRequest $request
     *
     * @return Response
     */
    public function store(CreateBeneficiaryRequest $request)
    {
        $input = $request->all();

        $beneficiary = $this->beneficiaryRepository->create($input);

        Flash::success('Beneficiary saved successfully.');

        return redirect(route('admin.beneficiaries.index'));
    }

    /**
     * Display the specified Beneficiary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $beneficiary = $this->beneficiaryRepository->findWithoutFail($id);

        if (empty($beneficiary)) {
            Flash::error('Beneficiary not found');

            return redirect(route('beneficiaries.index'));
        }

        return view('admin.beneficiaries.show')->with('beneficiary', $beneficiary);
    }

    /**
     * Show the form for editing the specified Beneficiary.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $beneficiary = $this->beneficiaryRepository->findWithoutFail($id);

        if (empty($beneficiary)) {
            Flash::error('Beneficiary not found');

            return redirect(route('beneficiaries.index'));
        }

        return view('admin.beneficiaries.edit')->with('beneficiary', $beneficiary);
    }

    /**
     * Update the specified Beneficiary in storage.
     *
     * @param  int              $id
     * @param UpdateBeneficiaryRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateBeneficiaryRequest $request)
    {
        $beneficiary = $this->beneficiaryRepository->findWithoutFail($id);

        

        if (empty($beneficiary)) {
            Flash::error('Beneficiary not found');

            return redirect(route('beneficiaries.index'));
        }

        $beneficiary = $this->beneficiaryRepository->update($request->all(), $id);

        Flash::success('Beneficiary updated successfully.');

        return redirect(route('admin.beneficiaries.index'));
    }

    /**
     * Remove the specified Beneficiary from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.beneficiaries.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Beneficiary::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.beneficiaries.index'))->with('success', Lang::get('message.success.delete'));

       }

}
