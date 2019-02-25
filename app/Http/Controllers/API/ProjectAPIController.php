<?php

	namespace App\Http\Controllers\API;

	use App\Http\Requests\API\CreateProjectAPIRequest;
	use App\Http\Requests\API\UpdateProjectAPIRequest;
	use App\Models\Project;
	use App\Repositories\ProjectRepository;
	use Illuminate\Http\Request;
	use App\Http\Controllers\AppBaseController as InfyOmBaseController;
	use InfyOm\Generator\Criteria\LimitOffsetCriteria;
	use InfyOm\Generator\Utils\ResponseUtil;
	use Prettus\Repository\Criteria\RequestCriteria;
	use Response;

	/**
	 * Class ProjectController
	 * @package App\Http\Controllers\API
	 */
	class ProjectAPIController extends InfyOmBaseController
	{
		/** @var  ProjectRepository */
		private $projectRepository;

		public function __construct(ProjectRepository $projectRepo)
		{
			$this->projectRepository = $projectRepo;
		}

		/**
		 * @param Request $request
		 * @return Response
		 *
		 * @SWG\Get(
		 *      path="/projects",
		 *      summary="Get a listing of the Projects.",
		 *      tags={"Project"},
		 *      description="Get all Projects",
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
		 *                  @SWG\Items(ref="#/definitions/Project")
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
			//$this->projectRepository->pushCriteria(new RequestCriteria($request));
			//$this->projectRepository->pushCriteria(new LimitOffsetCriteria($request));
			$projects = Project::with(['verticals:verticals.id,verticals.name', 'location:id,formatted_address,lat,lng']);

			if ($request->get('location', -1) > -1)
				$projects->whereHas("location", function ($query) use ($request) {
					$query->where("id", "=", $request->get('location', -1));
				});

			if ($request->get('vertical', -1) > -1)
				$projects->whereHas("verticals", function ($query) use ($request) {
					$query->where("verticals.id", "=", $request->get('vertical', -1));
				});

			if ($request->get('keyword', "")!="")
			{
				$projects->where(function($query) use ($request){
					$query->orWhere('name', 'like', '%'.$request->get('keyword', "").'%');
					$query->orWhere('details', 'like', '%'.$request->get('keyword', "").'%');
				});
			}

			//dd($projects->toSql());

			$projects = $projects->get(['id', 'name', 'details', 'status', 'location_id']);

			return $this->sendResponse($projects->toArray(), 'Projects retrieved successfully');
		}

		public function sidebar_results(Request $request)
		{
			$this->projectRepository->pushCriteria(new RequestCriteria($request));
			$this->projectRepository->pushCriteria(new LimitOffsetCriteria($request));

			$search = explode(";", $request->get("ids"));

			$projects = $this->projectRepository->with(['verticals:verticals.id,verticals.name', 'location:id,formatted_address,lat,lng'])->findWhereIn('id', $search)->all(['id', 'name', 'details', 'status', 'location_id']);

			foreach ($projects as $project) {
				echo
					'<div class="result-item" data-id="' . $project->id . '">';

				echo
					'<a href="' . $project->url . '">';

				// Title -------------------------------------------------------------------------------------------

				if (!empty($project->name)) {
					echo
						'<h3>' . $project->name . '</h3>';
				}

				echo
				'<div class="result-item-detail">';

				// Image thumbnail -------------------------------------------------------------------------

				echo
				'<div class="image" style="background-image: url(assets/img/items/default.png)">';
				echo
				'</div>';


				echo
				'<div class="description">';
				if (!empty($project->location)) {
					echo
						'<h5><i class="fa fa-map-marker"></i>' . $project->location->formatted_address . '</h5>';
				}

				// Rating ------------------------------------------------------------------------------


				echo
					'<div class="rating-passive"data-rating="' . (rand(10, 100) % 2 + 4) . '">
                                            <span class="stars"></span>
                                            <span class="reviews">' . rand(5, 20) . '</span>
                                        </div>';


				// Category ----------------------------------------------------------------------------

				echo
					'<div class="label label-default">' . $project->verticals->pluck('name')->implode(', ') . '</div>';


				// Description -------------------------------------------------------------------------

				if (!empty($project->details)) {
					echo
						'<p>' . \Illuminate\Support\Str::words($project->details, 20) . '</p>';
				}
				echo
				'</div>
                        </div>
                    </a>
                    <div class="controls-more">
                        <ul>
                            <li><a href="#" class="add-to-favorites">Add to favorites</a></li>
                            <li><a href="#" class="add-to-watchlist">Add to watchlist</a></li>
                        </ul>
                    </div>
                </div>';
			}

			//return $this->sendResponse($projects->toArray(), 'Projects retrieved successfully');
		}
		public function modal_marker_cluster(Request $request)
		{
			$this->projectRepository->pushCriteria(new RequestCriteria($request));
			$this->projectRepository->pushCriteria(new LimitOffsetCriteria($request));

			$search = explode(";", $request->get("ids"));

			$projects = $this->projectRepository->with(['verticals:verticals.id,verticals.name', 'location:id,formatted_address,lat,lng'])->findWhereIn('id', $search)->all(['id', 'name', 'details', 'status', 'location_id']);

			foreach ($projects as $project) {
				echo
					'<div class="result-item" data-id="' . $project->id . '">';

				echo
					'<a href="' . $project->url . '">';

				// Title -------------------------------------------------------------------------------------------

				if (!empty($project->name)) {
					echo
						'<h3>' . $project->name . '</h3>';
				}

				echo
				'<div class="result-item-detail">';

				// Image thumbnail -------------------------------------------------------------------------

				echo
				'<div class="image" style="background-image: url(assets/img/items/default.png)">';
				echo
				'</div>';


				echo
				'<div class="description">';
				if (!empty($project->location)) {
					echo
						'<h5><i class="fa fa-map-marker"></i>' . $project->location->formatted_address . '</h5>';
				}

				// Rating ------------------------------------------------------------------------------


				echo
					'<div class="rating-passive"data-rating="' . (rand(10, 100) % 2 + 4) . '">
                                            <span class="stars"></span>
                                            <span class="reviews">' . rand(5, 20) . '</span>
                                        </div>';


				// Category ----------------------------------------------------------------------------

				echo
					'<div class="label label-default">' . $project->verticals->pluck('name')->implode(', ') . '</div>';


				// Description -------------------------------------------------------------------------

				if (!empty($project->details)) {
					echo
						'<p>' . \Illuminate\Support\Str::words($project->details, 20) . '</p>';
				}
				echo
				'</div>
                        </div>
                    </a>
                    <div class="controls-more">
                        <ul>
                            <li><a href="#" class="add-to-favorites">Add to favorites</a></li>
                            <li><a href="#" class="add-to-watchlist">Add to watchlist</a></li>
                        </ul>
                    </div>
                </div>';
			}

			//return $this->sendResponse($projects->toArray(), 'Projects retrieved successfully');
		}

		/**
		 * @param CreateProjectAPIRequest $request
		 * @return Response
		 *
		 * @SWG\Post(
		 *      path="/projects",
		 *      summary="Store a newly created Project in storage",
		 *      tags={"Project"},
		 *      description="Store Project",
		 *      produces={"application/json"},
		 *      @SWG\Parameter(
		 *          name="body",
		 *          in="body",
		 *          description="Project that should be stored",
		 *          required=false,
		 *          @SWG\Schema(ref="#/definitions/Project")
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
		 *                  ref="#/definitions/Project"
		 *              ),
		 *              @SWG\Property(
		 *                  property="message",
		 *                  type="string"
		 *              )
		 *          )
		 *      )
		 * )
		 */
		public function store(CreateProjectAPIRequest $request)
		{
			$input = $request->all();

			$projects = $this->projectRepository->create($input);

			return $this->sendResponse($projects->toArray(), 'Project saved successfully');
		}

		/**
		 * @param int $id
		 * @return Response
		 *
		 * @SWG\Get(
		 *      path="/projects/{id}",
		 *      summary="Display the specified Project",
		 *      tags={"Project"},
		 *      description="Get Project",
		 *      produces={"application/json"},
		 *      @SWG\Parameter(
		 *          name="id",
		 *          description="id of Project",
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
		 *                  ref="#/definitions/Project"
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
			/** @var Project $project */
			$project = $this->projectRepository->find($id);

			if (empty($project)) {
				return Response::json(ResponseUtil::makeError('Project not found'), 404);
			}

			return $this->sendResponse($project->toArray(), 'Project retrieved successfully');
		}

		/**
		 * @param int $id
		 * @param UpdateProjectAPIRequest $request
		 * @return Response
		 *
		 * @SWG\Put(
		 *      path="/projects/{id}",
		 *      summary="Update the specified Project in storage",
		 *      tags={"Project"},
		 *      description="Update Project",
		 *      produces={"application/json"},
		 *      @SWG\Parameter(
		 *          name="id",
		 *          description="id of Project",
		 *          type="integer",
		 *          required=true,
		 *          in="path"
		 *      ),
		 *      @SWG\Parameter(
		 *          name="body",
		 *          in="body",
		 *          description="Project that should be updated",
		 *          required=false,
		 *          @SWG\Schema(ref="#/definitions/Project")
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
		 *                  ref="#/definitions/Project"
		 *              ),
		 *              @SWG\Property(
		 *                  property="message",
		 *                  type="string"
		 *              )
		 *          )
		 *      )
		 * )
		 */
		public function update($id, UpdateProjectAPIRequest $request)
		{
			$input = $request->all();

			/** @var Project $project */
			$project = $this->projectRepository->find($id);

			if (empty($project)) {
				return Response::json(ResponseUtil::makeError('Project not found'), 404);
			}

			$project = $this->projectRepository->update($input, $id);

			return $this->sendResponse($project->toArray(), 'Project updated successfully');
		}

		/**
		 * @param int $id
		 * @return Response
		 *
		 * @SWG\Delete(
		 *      path="/projects/{id}",
		 *      summary="Remove the specified Project from storage",
		 *      tags={"Project"},
		 *      description="Delete Project",
		 *      produces={"application/json"},
		 *      @SWG\Parameter(
		 *          name="id",
		 *          description="id of Project",
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
			/** @var Project $project */
			$project = $this->projectRepository->find($id);

			if (empty($project)) {
				return Response::json(ResponseUtil::makeError('Project not found'), 404);
			}

			$project->delete();

			return $this->sendResponse($id, 'Project deleted successfully');
		}
	}
