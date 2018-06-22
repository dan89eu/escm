<?php

namespace App\Http\Controllers;

use App\Http\Requests;
use App\Http\Requests\CreateCategoryProjectRequest;
use App\Http\Requests\UpdateCategoryProjectRequest;
use App\Repositories\CategoryProjectRepository;
use App\Http\Controllers\AppBaseController as InfyOmBaseController;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Lang;
use App\Models\CategoryProject;
use Flash;
use Prettus\Repository\Criteria\RequestCriteria;
use Response;

class CategoryProjectController extends InfyOmBaseController
{
    /** @var  CategoryProjectRepository */
    private $categoryProjectRepository;

    public function __construct(CategoryProjectRepository $categoryProjectRepo)
    {
        $this->categoryProjectRepository = $categoryProjectRepo;
    }

    /**
     * Display a listing of the CategoryProject.
     *
     * @param Request $request
     * @return Response
     */
    public function index(Request $request)
    {

        $this->categoryProjectRepository->pushCriteria(new RequestCriteria($request));
        $categoryProjects = $this->categoryProjectRepository->all();
        return view('admin.categoryProjects.index')
            ->with('categoryProjects', $categoryProjects);
    }

    /**
     * Show the form for creating a new CategoryProject.
     *
     * @return Response
     */
    public function create()
    {
        return view('admin.categoryProjects.create');
    }

    /**
     * Store a newly created CategoryProject in storage.
     *
     * @param CreateCategoryProjectRequest $request
     *
     * @return Response
     */
    public function store(CreateCategoryProjectRequest $request)
    {
        $input = $request->all();

        $categoryProject = $this->categoryProjectRepository->create($input);

        Flash::success('CategoryProject saved successfully.');

        return redirect(route('admin.categoryProjects.index'));
    }

    /**
     * Display the specified CategoryProject.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function show($id)
    {
        $categoryProject = $this->categoryProjectRepository->findWithoutFail($id);

        if (empty($categoryProject)) {
            Flash::error('CategoryProject not found');

            return redirect(route('categoryProjects.index'));
        }

        return view('admin.categoryProjects.show')->with('categoryProject', $categoryProject);
    }

    /**
     * Show the form for editing the specified CategoryProject.
     *
     * @param  int $id
     *
     * @return Response
     */
    public function edit($id)
    {
        $categoryProject = $this->categoryProjectRepository->findWithoutFail($id);

        if (empty($categoryProject)) {
            Flash::error('CategoryProject not found');

            return redirect(route('categoryProjects.index'));
        }

        return view('admin.categoryProjects.edit')->with('categoryProject', $categoryProject);
    }

    /**
     * Update the specified CategoryProject in storage.
     *
     * @param  int              $id
     * @param UpdateCategoryProjectRequest $request
     *
     * @return Response
     */
    public function update($id, UpdateCategoryProjectRequest $request)
    {
        $categoryProject = $this->categoryProjectRepository->findWithoutFail($id);

        

        if (empty($categoryProject)) {
            Flash::error('CategoryProject not found');

            return redirect(route('categoryProjects.index'));
        }

        $categoryProject = $this->categoryProjectRepository->update($request->all(), $id);

        Flash::success('CategoryProject updated successfully.');

        return redirect(route('admin.categoryProjects.index'));
    }

    /**
     * Remove the specified CategoryProject from storage.
     *
     * @param  int $id
     *
     * @return Response
     */
      public function getModalDelete($id = null)
      {
          $error = '';
          $model = '';
          $confirm_route =  route('admin.categoryProjects.delete',['id'=>$id]);
          return View('admin.layouts/modal_confirmation', compact('error','model', 'confirm_route'));

      }

       public function getDelete($id = null)
       {
           $sample = CategoryProject::destroy($id);

           // Redirect to the group management page
           return redirect(route('admin.categoryProjects.index'))->with('success', Lang::get('message.success.delete'));

       }

}
