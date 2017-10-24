<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateProjectRequest;
use App\Http\Requests\UpdateProjectRequest;
use App\Repositories\ProjectRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Cartalyst\Sentinel\Laravel\Facades\Sentinel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Input;
use Illuminate\Support\Facades\Lang;
use App\Models\Project;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

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

	    $this->updateRelations($project);

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

	    $this->updateRelations($project);

        Flash::success('Project updated successfully.');

        return redirect(route('admin.projects.index'));
    }

    private function updateRelations($project)
    {

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
