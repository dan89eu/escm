<?php

namespace App\Http\Controllers\API;

use App\Http\Requests\API\CreateCategoryProjectAPIRequest;
use App\Http\Requests\API\UpdateCategoryProjectAPIRequest;
use App\Models\CategoryProject;
use App\Repositories\CategoryProjectRepository;
use Illuminate\Http\Request;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use InfyOm\Generator\Criteria\LimitOffsetCriteria;
use InfyOm\Generator\Utils\ResponseUtil;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

/**
 * Class CategoryProjectController
 * @package App\Http\Controllers\API
 */

class CategoryProjectAPIController extends InfyOmBaseController
{
    /** @var  CategoryProjectRepository */
    private $categoryProjectRepository;

    public function __construct(CategoryProjectRepository $categoryProjectRepo)
    {
        $this->categoryProjectRepository = $categoryProjectRepo;
    }

    /**
     * @param Request $request
     * @return Response
     *
     * @SWG\Get(
     *      path="/categoryProjects",
     *      summary="Get a listing of the CategoryProjects.",
     *      tags={"CategoryProject"},
     *      description="Get all CategoryProjects",
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
     *                  @SWG\Items(ref="#/definitions/CategoryProject")
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
        $this->categoryProjectRepository->pushCriteria(new RequestCriteria($request));
        $this->categoryProjectRepository->pushCriteria(new LimitOffsetCriteria($request));
        $categoryProjects = $this->categoryProjectRepository->all();

        return $this->sendResponse($categoryProjects->toArray(), 'CategoryProjects retrieved successfully');
    }

    /**
     * @param CreateCategoryProjectAPIRequest $request
     * @return Response
     *
     * @SWG\Post(
     *      path="/categoryProjects",
     *      summary="Store a newly created CategoryProject in storage",
     *      tags={"CategoryProject"},
     *      description="Store CategoryProject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategoryProject that should be stored",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CategoryProject")
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
     *                  ref="#/definitions/CategoryProject"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function store(CreateCategoryProjectAPIRequest $request)
    {
        $input = $request->all();

        $categoryProjects = $this->categoryProjectRepository->create($input);

        return $this->sendResponse($categoryProjects->toArray(), 'CategoryProject saved successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Get(
     *      path="/categoryProjects/{id}",
     *      summary="Display the specified CategoryProject",
     *      tags={"CategoryProject"},
     *      description="Get CategoryProject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategoryProject",
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
     *                  ref="#/definitions/CategoryProject"
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
        /** @var CategoryProject $categoryProject */
        $categoryProject = $this->categoryProjectRepository->find($id);

        if (empty($categoryProject)) {
            return Response::json(ResponseUtil::makeError('CategoryProject not found'), 404);
        }

        return $this->sendResponse($categoryProject->toArray(), 'CategoryProject retrieved successfully');
    }

    /**
     * @param int $id
     * @param UpdateCategoryProjectAPIRequest $request
     * @return Response
     *
     * @SWG\Put(
     *      path="/categoryProjects/{id}",
     *      summary="Update the specified CategoryProject in storage",
     *      tags={"CategoryProject"},
     *      description="Update CategoryProject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategoryProject",
     *          type="integer",
     *          required=true,
     *          in="path"
     *      ),
     *      @SWG\Parameter(
     *          name="body",
     *          in="body",
     *          description="CategoryProject that should be updated",
     *          required=false,
     *          @SWG\Schema(ref="#/definitions/CategoryProject")
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
     *                  ref="#/definitions/CategoryProject"
     *              ),
     *              @SWG\Property(
     *                  property="message",
     *                  type="string"
     *              )
     *          )
     *      )
     * )
     */
    public function update($id, UpdateCategoryProjectAPIRequest $request)
    {
        $input = $request->all();

        /** @var CategoryProject $categoryProject */
        $categoryProject = $this->categoryProjectRepository->find($id);

        if (empty($categoryProject)) {
            return Response::json(ResponseUtil::makeError('CategoryProject not found'), 404);
        }

        $categoryProject = $this->categoryProjectRepository->update($input, $id);

        return $this->sendResponse($categoryProject->toArray(), 'CategoryProject updated successfully');
    }

    /**
     * @param int $id
     * @return Response
     *
     * @SWG\Delete(
     *      path="/categoryProjects/{id}",
     *      summary="Remove the specified CategoryProject from storage",
     *      tags={"CategoryProject"},
     *      description="Delete CategoryProject",
     *      produces={"application/json"},
     *      @SWG\Parameter(
     *          name="id",
     *          description="id of CategoryProject",
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
        /** @var CategoryProject $categoryProject */
        $categoryProject = $this->categoryProjectRepository->find($id);

        if (empty($categoryProject)) {
            return Response::json(ResponseUtil::makeError('CategoryProject not found'), 404);
        }

        $categoryProject->delete();

        return $this->sendResponse($id, 'CategoryProject deleted successfully');
    }
}
