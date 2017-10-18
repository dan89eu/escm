<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateVerticalAPIRequest;
use App\Http\Requests\API\UpdateVerticalAPIRequest;
use App\Models\Vertical;
use App\Repositories\VerticalRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class VerticalController
 * @package App\Http\Controllers\API
 */

class VerticalAPIController extends InfyOmBaseController
{
    /** @var  VerticalRepository */
    private $verticalRepository;

    public function __construct(VerticalRepository $verticalRepo)
    {
        $this->verticalRepository = $verticalRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/verticals",
     *      summary="Get a listing of the Verticals.",
     *      tags={"Vertical"},
     *      description="Get all Verticals",
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
     *                  @SWG\Items(ref="#/definitions/Vertical")
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
        $this->verticalRepository->pushCriteria(new RequestCriteria($request));
        $this->verticalRepository->pushCriteria(new LimitOffsetCriteria($request));
        $verticals = $this->verticalRepository->all();

        return $this->sendResponse($verticals->toArray(), 'Verticals retrieved successfully');
    }

    /**
     * @param CreateVerticalAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/verticals",
     *      summary="Store a newly created Vertical in storage",
     *      tags={"Vertical"},
     *      description="Store Vertical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Vertical that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Vertical")
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
     *                  ref="#/definitions/Vertical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateVerticalAPIRequest $request)
    {
        $input = $request->all();

        $verticals = $this->verticalRepository->create($input);

        return $this->sendResponse($verticals->toArray(), 'Vertical saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/verticals/{id}",
     *      summary="Display the specified Vertical",
     *      tags={"Vertical"},
     *      description="Get Vertical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Vertical",
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
     *                  ref="#/definitions/Vertical"
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
        /** @var Vertical $vertical */
        $vertical = $this->verticalRepository->find($id);

        if (empty($vertical)) {
            return Response::json(ResponseUtil::makeError('Vertical not found'), 404);
        }

        return $this->sendResponse($vertical->toArray(), 'Vertical retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateVerticalAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/verticals/{id}",
     *      summary="Update the specified Vertical in storage",
     *      tags={"Vertical"},
     *      description="Update Vertical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Vertical",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Vertical that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Vertical")
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
     *                  ref="#/definitions/Vertical"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateVerticalAPIRequest $request)
    {
        $input = $request->all();

        /** @var Vertical $vertical */
        $vertical = $this->verticalRepository->find($id);

        if (empty($vertical)) {
            return Response::json(ResponseUtil::makeError('Vertical not found'), 404);
        }

        $vertical = $this->verticalRepository->update($input, $id);

        return $this->sendResponse($vertical->toArray(), 'Vertical updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/verticals/{id}",
     *      summary="Remove the specified Vertical from storage",
     *      tags={"Vertical"},
     *      description="Delete Vertical",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Vertical",
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
        /** @var Vertical $vertical */
        $vertical = $this->verticalRepository->find($id);

        if (empty($vertical)) {
            return Response::json(ResponseUtil::makeError('Vertical not found'), 404);
        }

        $vertical->delete();

        return $this->sendResponse($id, 'Vertical deleted successfully');
    }
}
