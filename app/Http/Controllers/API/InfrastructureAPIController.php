<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateInfrastructureAPIRequest;
use App\Http\Requests\API\UpdateInfrastructureAPIRequest;
use App\Models\Infrastructure;
use App\Repositories\InfrastructureRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class InfrastructureController
 * @package App\Http\Controllers\API
 */

class InfrastructureAPIController extends InfyOmBaseController
{
    /** @var  InfrastructureRepository */
    private $infrastructureRepository;

    public function __construct(InfrastructureRepository $infrastructureRepo)
    {
        $this->infrastructureRepository = $infrastructureRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/infrastructures",
     *      summary="Get a listing of the Infrastructures.",
     *      tags={"Infrastructure"},
     *      description="Get all Infrastructures",
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
     *                  @SWG\Items(ref="#/definitions/Infrastructure")
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
        $this->infrastructureRepository->pushCriteria(new RequestCriteria($request));
        $this->infrastructureRepository->pushCriteria(new LimitOffsetCriteria($request));
        $infrastructures = $this->infrastructureRepository->all();

        return $this->sendResponse($infrastructures->toArray(), 'Infrastructures retrieved successfully');
    }

    /**
     * @param CreateInfrastructureAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/infrastructures",
     *      summary="Store a newly created Infrastructure in storage",
     *      tags={"Infrastructure"},
     *      description="Store Infrastructure",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Infrastructure that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Infrastructure")
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
     *                  ref="#/definitions/Infrastructure"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateInfrastructureAPIRequest $request)
    {
        $input = $request->all();

        $infrastructures = $this->infrastructureRepository->create($input);

        return $this->sendResponse($infrastructures->toArray(), 'Infrastructure saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/infrastructures/{id}",
     *      summary="Display the specified Infrastructure",
     *      tags={"Infrastructure"},
     *      description="Get Infrastructure",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Infrastructure",
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
     *                  ref="#/definitions/Infrastructure"
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
        /** @var Infrastructure $infrastructure */
        $infrastructure = $this->infrastructureRepository->find($id);

        if (empty($infrastructure)) {
            return Response::json(ResponseUtil::makeError('Infrastructure not found'), 404);
        }

        return $this->sendResponse($infrastructure->toArray(), 'Infrastructure retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateInfrastructureAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/infrastructures/{id}",
     *      summary="Update the specified Infrastructure in storage",
     *      tags={"Infrastructure"},
     *      description="Update Infrastructure",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Infrastructure",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Infrastructure that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Infrastructure")
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
     *                  ref="#/definitions/Infrastructure"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateInfrastructureAPIRequest $request)
    {
        $input = $request->all();

        /** @var Infrastructure $infrastructure */
        $infrastructure = $this->infrastructureRepository->find($id);

        if (empty($infrastructure)) {
            return Response::json(ResponseUtil::makeError('Infrastructure not found'), 404);
        }

        $infrastructure = $this->infrastructureRepository->update($input, $id);

        return $this->sendResponse($infrastructure->toArray(), 'Infrastructure updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/infrastructures/{id}",
     *      summary="Remove the specified Infrastructure from storage",
     *      tags={"Infrastructure"},
     *      description="Delete Infrastructure",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Infrastructure",
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
        /** @var Infrastructure $infrastructure */
        $infrastructure = $this->infrastructureRepository->find($id);

        if (empty($infrastructure)) {
            return Response::json(ResponseUtil::makeError('Infrastructure not found'), 404);
        }

        $infrastructure->delete();

        return $this->sendResponse($id, 'Infrastructure deleted successfully');
    }
}
