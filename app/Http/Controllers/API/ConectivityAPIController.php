<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateConectivityAPIRequest;
use App\Http\Requests\API\UpdateConectivityAPIRequest;
use App\Models\Conectivity;
use App\Repositories\ConectivityRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ConectivityController
 * @package App\Http\Controllers\API
 */

class ConectivityAPIController extends InfyOmBaseController
{
    /** @var  ConectivityRepository */
    private $conectivityRepository;

    public function __construct(ConectivityRepository $conectivityRepo)
    {
        $this->conectivityRepository = $conectivityRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/conectivities",
     *      summary="Get a listing of the Conectivities.",
     *      tags={"Conectivity"},
     *      description="Get all Conectivities",
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
     *                  @SWG\Items(ref="#/definitions/Conectivity")
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
        $this->conectivityRepository->pushCriteria(new RequestCriteria($request));
        $this->conectivityRepository->pushCriteria(new LimitOffsetCriteria($request));
        $conectivities = $this->conectivityRepository->all();

        return $this->sendResponse($conectivities->toArray(), 'Conectivities retrieved successfully');
    }

    /**
     * @param CreateConectivityAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/conectivities",
     *      summary="Store a newly created Conectivity in storage",
     *      tags={"Conectivity"},
     *      description="Store Conectivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Conectivity that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Conectivity")
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
     *                  ref="#/definitions/Conectivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateConectivityAPIRequest $request)
    {
        $input = $request->all();

        $conectivities = $this->conectivityRepository->create($input);

        return $this->sendResponse($conectivities->toArray(), 'Conectivity saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/conectivities/{id}",
     *      summary="Display the specified Conectivity",
     *      tags={"Conectivity"},
     *      description="Get Conectivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Conectivity",
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
     *                  ref="#/definitions/Conectivity"
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
        /** @var Conectivity $conectivity */
        $conectivity = $this->conectivityRepository->find($id);

        if (empty($conectivity)) {
            return Response::json(ResponseUtil::makeError('Conectivity not found'), 404);
        }

        return $this->sendResponse($conectivity->toArray(), 'Conectivity retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateConectivityAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/conectivities/{id}",
     *      summary="Update the specified Conectivity in storage",
     *      tags={"Conectivity"},
     *      description="Update Conectivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Conectivity",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Conectivity that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Conectivity")
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
     *                  ref="#/definitions/Conectivity"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateConectivityAPIRequest $request)
    {
        $input = $request->all();

        /** @var Conectivity $conectivity */
        $conectivity = $this->conectivityRepository->find($id);

        if (empty($conectivity)) {
            return Response::json(ResponseUtil::makeError('Conectivity not found'), 404);
        }

        $conectivity = $this->conectivityRepository->update($input, $id);

        return $this->sendResponse($conectivity->toArray(), 'Conectivity updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/conectivities/{id}",
     *      summary="Remove the specified Conectivity from storage",
     *      tags={"Conectivity"},
     *      description="Delete Conectivity",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Conectivity",
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
        /** @var Conectivity $conectivity */
        $conectivity = $this->conectivityRepository->find($id);

        if (empty($conectivity)) {
            return Response::json(ResponseUtil::makeError('Conectivity not found'), 404);
        }

        $conectivity->delete();

        return $this->sendResponse($id, 'Conectivity deleted successfully');
    }
}
