<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateProviderAPIRequest;
use App\Http\Requests\API\UpdateProviderAPIRequest;
use App\Models\Provider;
use App\Repositories\ProviderRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class ProviderController
 * @package App\Http\Controllers\API
 */

class ProviderAPIController extends InfyOmBaseController
{
    /** @var  ProviderRepository */
    private $providerRepository;

    public function __construct(ProviderRepository $providerRepo)
    {
        $this->providerRepository = $providerRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/providers",
     *      summary="Get a listing of the Providers.",
     *      tags={"Provider"},
     *      description="Get all Providers",
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
     *                  @SWG\Items(ref="#/definitions/Provider")
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
        $this->providerRepository->pushCriteria(new RequestCriteria($request));
        $this->providerRepository->pushCriteria(new LimitOffsetCriteria($request));
        $providers = $this->providerRepository->all();

        return $this->sendResponse($providers->toArray(), 'Providers retrieved successfully');
    }

    /**
     * @param CreateProviderAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/providers",
     *      summary="Store a newly created Provider in storage",
     *      tags={"Provider"},
     *      description="Store Provider",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Provider that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Provider")
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
     *                  ref="#/definitions/Provider"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateProviderAPIRequest $request)
    {
        $input = $request->all();

        $providers = $this->providerRepository->create($input);

        return $this->sendResponse($providers->toArray(), 'Provider saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/providers/{id}",
     *      summary="Display the specified Provider",
     *      tags={"Provider"},
     *      description="Get Provider",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Provider",
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
     *                  ref="#/definitions/Provider"
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
        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return Response::json(ResponseUtil::makeError('Provider not found'), 404);
        }

        return $this->sendResponse($provider->toArray(), 'Provider retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateProviderAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/providers/{id}",
     *      summary="Update the specified Provider in storage",
     *      tags={"Provider"},
     *      description="Update Provider",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Provider",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="Provider that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/Provider")
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
     *                  ref="#/definitions/Provider"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateProviderAPIRequest $request)
    {
        $input = $request->all();

        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return Response::json(ResponseUtil::makeError('Provider not found'), 404);
        }

        $provider = $this->providerRepository->update($input, $id);

        return $this->sendResponse($provider->toArray(), 'Provider updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/providers/{id}",
     *      summary="Remove the specified Provider from storage",
     *      tags={"Provider"},
     *      description="Delete Provider",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of Provider",
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
        /** @var Provider $provider */
        $provider = $this->providerRepository->find($id);

        if (empty($provider)) {
            return Response::json(ResponseUtil::makeError('Provider not found'), 404);
        }

        $provider->delete();

        return $this->sendResponse($id, 'Provider deleted successfully');
    }
}
