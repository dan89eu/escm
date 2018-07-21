<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Models\Location;
use App\Models\ProjectImport;
use App\Repositories\ProjectRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Carbon\Carbon;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\Models\Project;
use Flash;
use Maatwebsite\Excel\Facades\Excel;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;
use App\File;

class ProjectController extends InfyOmBaseController
{
    /** @var  ProjectRepository */
    private $projectRepository;

    public function __construct(ProjectRepository $projectRepo)
    {
        $this->projectRepository = $projectRepo;
    }

    /**
     * Display a listing of the Project.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->projectRepository->pushCriteria(new RequestCriteria($request));
        $projects = $this->projectRepository->all();
        return view('admin.projects.index')
            ->with('projects', $projects);
    }

	/**
	 * Show the form for creating a new Project.
	 *
	 * @return Response
	 */
	public function create()
	{
		return view('admin.projects.create');
	}

	/**
	 * Show the form for creating a new Project.
	 *
	 * @return Response
	 */
	public function import()
	{
		return view('admin.projects.importer');
	}

	/**
	 * Show the form for creating a new Project.
	 *
	 * @return Response
	 */
	public function importPreview(File $file)
	{

		//$file = File::find($id);
		$path = public_path('uploads/files/'.$file->filename);

		$data = Excel::load($path, function($reader) {
		})->get();


		$return = [];
		$index = 0;


		foreach ($data as $row){
			//$return[] = $row;
			if(isset($row->city)){

				$row["date"] = (new Carbon($row->implementation_date))->toDateString();
				$row["item_no"] = $index++;

				$pi = new ProjectImport(json_decode(json_encode($row), true));



				$return[] = $pi;
			}
		}

		return $this->sendResponse($return,"");
	}

	/**
	 * Store a newly created Project in storage.
	 *
	 * @param CreateProjectRequest $request
	 *
	 * @return Response
	 */
	public function importStore(File $file)
	{
		$path = public_path('uploads/files/'.$file->filename);

		$data = Excel::load($path, function($reader) {
		})->get();

		$return = [];
		$index = 0;
		$skipped = 0;

		foreach ($data as $row){
			if($row->city){

				$row["date"] = (new Carbon($row->implementation_date))->toDateString();
				$row["item_no"] = $index++;
				$pi = new ProjectImport(json_decode(json_encode($row), true));

				if(count($pi->errors)>0)
				{
					$return[] = $pi;
					$skipped++;
					continue;
				}
				try {

					$project = $this->projectRepository->create($pi->projectArray());

					$location = Location::where('locality_name',$pi->city)->first();
					$project->location()->associate($location);
					$project->save();

					$verticals  = $pi->getVerticalsArray(); // related ids
					$pivotData = array_fill(0, count($verticals), ['user_id' => Sentinel::getUser()->id]);
					$syncVerticals  = array_combine($verticals, $pivotData);

					$project->verticals()->sync($syncVerticals);

					$category  = $pi->getCategoryArray(); // related ids
					$pivotData = array_fill(0, count($category), ['user_id' => Sentinel::getUser()->id]);
					$syncCategory  = array_combine($category, $pivotData);

					$project->categories()->sync($syncCategory);

					$connectivities  = $pi->getConnectivityArray(); // related ids
					$pivotData = array_fill(0, count($connectivities), ['user_id' => Sentinel::getUser()->id]);
					$syncConnectivities  = array_combine($connectivities, $pivotData);
					$project->conectivities()->sync($syncConnectivities);

					$beneficiaries  = $pi->getBeneficiaryArray(); // related ids
					$pivotData = array_fill(0, count($beneficiaries), ['user_id' => Sentinel::getUser()->id]);
					$syncBeneficiaries  = array_combine($beneficiaries, $pivotData);

					$providers  = $pi->getProvidersArray(); // related ids
					$pivotData = array_fill(0, count($providers), ['user_id' => Sentinel::getUser()->id]);
					$syncProviders  = array_combine($providers, $pivotData);


					$project->beneficiaries()->sync($syncBeneficiaries);
					$project->providers()->sync($syncProviders);


					$return[] = $project;
				}
				catch (\Exception $e){
					$return[] = $pi;
					$skipped++;
				}
			}
		}


		return $this->sendResponse(["total"=>$index,"skipped"=>$skipped,"data"=>$return],"");
		/*$input = $request->all();

		$project = $this->projectRepository->create($input);

		$this->updateRelations($project,$request);

		Flash::success('Project saved successfully.');*/

		//return redirect(route('admin.projects.index'));
	}

    /**
     * Store a newly created Project in storage.
     *
     * @param CreateProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateProjectRequest $request)
    {
        $input = $request->all();

        $project = $this->projectRepository->create($input);

	    $this->updateRelations($project,$request);

	    Flash::success('Project saved successfully.');

        return redirect(route('admin.projects.index'));
    }

    /**
     * Display the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        return view('admin.projects.show')->with('project', $project);
    }

    /**
     * Show the form for editing the specified Project.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $project = $this->projectRepository->findWithoutFail($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        return view('admin.projects.edit')->with('project', $project);
    }

    /**
     * Update the specified Project in storage.
     *
     * @param  int              $id
     * @param UpdateProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateProjectRequest $request)
    {
        $project = $this->projectRepository->findWithoutFail($id);

        if (empty($project)) {
            Flash::error('Project not found');

            return redirect(route('projects.index'));
        }

        $project = $this->projectRepository->update($request->all(), $id);

	    $this->updateRelations($project,$request);

        Flash::success('Project updated successfully.');

        return redirect(route('admin.projects.index'));
    }

    private function updateRelations($project,$request)
    {
    	$location = Location::firstOrNew(['place_id'=>$request->get('g_place_id')],['formatted_address'=>$request->get('g_formatted_address'),'county_name'=>$request->get('g_county_name'),'country_name'=>$request->get('g_country_name'),'locality_name'=>$request->get('g_locality_name'),'lat'=>$request->get('g_lat'),'lng'=>$request->get('g_lng'),'user_id'=>Sentinel::getUser()->id]);

	    if(!$location->id)
	    	$location->save();

	    $project->location()->associate($location);
	    $project->save();

	    $connectivities  = (array) Input::get('conectivities'); // related ids
	    $pivotData = array_fill(0, count($connectivities), ['user_id' => Sentinel::getUser()->id]);
	    $syncConnectivities  = array_combine($connectivities, $pivotData);

	    $verticals  = (array) Input::get('verticals'); // related ids
	    $pivotData = array_fill(0, count($verticals), ['user_id' => Sentinel::getUser()->id]);
	    $syncVerticals  = array_combine($verticals, $pivotData);

	    $beneficiaries  = (array) Input::get('beneficiaries'); // related ids
	    $pivotData = array_fill(0, count($beneficiaries), ['user_id' => Sentinel::getUser()->id]);
	    $syncBeneficiaries  = array_combine($beneficiaries, $pivotData);

	    $providers  = (array) Input::get('providers'); // related ids
	    $pivotData = array_fill(0, count($providers), ['user_id' => Sentinel::getUser()->id]);
	    $syncProviders  = array_combine($providers, $pivotData);

	    $infrastucture  = (array) Input::get('infrastructures'); // related ids
	    $pivotData = array_fill(0, count($infrastucture), ['user_id' => Sentinel::getUser()->id]);
	    $syncInfrastucture  = array_combine($infrastucture, $pivotData);

	    $project->conectivities()->sync($syncConnectivities);
	    $project->verticals()->sync($syncVerticals);
	    $project->beneficiaries()->sync($syncBeneficiaries);
	    $project->providers()->sync($syncProviders);
	    $project->infrastructures()->sync($syncInfrastucture);

    }

    /**
     * Remove the specified Project from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.projects.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = Project::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.projects.index'))->with('success', Lang::get('message.success.delete'));

       }

}
