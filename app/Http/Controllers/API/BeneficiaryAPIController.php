<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateBeneficiaryAPIRequest;
use App\Http\Requests\API\UpdateBeneficiaryAPIRequest;
use App\Models\Beneficiary;
use App\Repositories\BeneficiaryRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class BeneficiaryController
 * @package App\Http\Controllers\API
 */

class BeneficiaryAPIController extends InfyOmBaseController
{
    /** @var  BeneficiaryRepository */
    private $beneficiaryRepository;

    public function __construct(BeneficiaryRepository $beneficiaryRepo)
    {
        $this->beneficiaryRepository = $beneficiaryRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/beneficiaries",
     *      summary="Get a listing of the Beneficiaries.",
     *      tags={"Beneficiary"},
     *      description="Get all Beneficiaries",
     *      produces={"application/json"},
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="array",
     *                  @SWG\Items(ref="#/definitions/Beneficiary")
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function index(Request $request)
    {
        $this->beneficiaryRepository->pushCriteria(new RequestCriteria($request));
        $this->beneficiaryRepository->pushCriteria(new LimitOffsetCriteria($request));
        $beneficiaries = $this->beneficiaryRepository->all();

        return $this->sendResponse($beneficiaries->toArray(), 'Beneficiaries retrieved successfully');
    }

    /**
     * @param CreateBeneficiaryAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/beneficiaries",
     *      summary="Store a newly created Beneficiary in storage",
     *      tags={"Beneficiary"},
     *      description="Store Beneficiary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Beneficiary that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Beneficiary")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Beneficiary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateBeneficiaryAPIRequest $request)
    {
        $input = $request->all();

        $beneficiaries = $this->beneficiaryRepository->create($input);

        return $this->sendResponse($beneficiaries->toArray(), 'Beneficiary saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/beneficiaries/{id}",
     *      summary="Display the specified Beneficiary",
     *      tags={"Beneficiary"},
     *      description="Get Beneficiary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Beneficiary",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Beneficiary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function show($id)
    {
        /** @var Beneficiary $beneficiary */
        $beneficiary = $this->beneficiaryRepository->find($id);

        if (empty($beneficiary)) {
            return Response::json(ResponseUtil::makeError('Beneficiary not found'), 404);
        }

        return $this->sendResponse($beneficiary->toArray(), 'Beneficiary retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateBeneficiaryAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/beneficiaries/{id}",
     *      summary="Update the specified Beneficiary in storage",
     *      tags={"Beneficiary"},
     *      description="Update Beneficiary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Beneficiary",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Beneficiary that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Beneficiary")
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  ref="#/definitions/Beneficiary"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateBeneficiaryAPIRequest $request)
    {
        $input = $request->all();

        /** @var Beneficiary $beneficiary */
        $beneficiary = $this->beneficiaryRepository->find($id);

        if (empty($beneficiary)) {
            return Response::json(ResponseUtil::makeError('Beneficiary not found'), 404);
        }

        $beneficiary = $this->beneficiaryRepository->update($input, $id);

        return $this->sendResponse($beneficiary->toArray(), 'Beneficiary updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/beneficiaries/{id}",
     *      summary="Remove the specified Beneficiary from storage",
     *      tags={"Beneficiary"},
     *      description="Delete Beneficiary",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Beneficiary",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Response(
     *          response=200,
     *          description="successful operation",
     *          @SWG\Schema(
     *              type="object",
     *              @SWG\Property(
     *                  property="success",
     *                  type="boolean"
     *              ),
     *              @SWG\Property(
     *                  property="data",
     *                  type="string"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function destroy($id)
    {
        /** @var Beneficiary $beneficiary */
        $beneficiary = $this->beneficiaryRepository->find($id);

        if (empty($beneficiary)) {
            return Response::json(ResponseUtil::makeError('Beneficiary not found'), 404);
        }

        $beneficiary->delete();

        return $this->sendResponse($id, 'Beneficiary deleted successfully');
    }
}
