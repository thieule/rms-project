<?php

namespace App\Api\V1\Controllers;
use App\Api\V1\Models\Project;
use Laravel\Lumen\Routing\Controller as BaseController;
use Illuminate\Http\Request;
use Mockery\Exception;

class IndexController extends BaseController
{

    /**
     * @return \Illuminate\Database\Eloquent\Collection|static[]
     */
    public function index()
    {
        return Project::all();
    }

    /**
     * Add project
     */
    public function add(Request $request)
    {
        $this->validate($request, [
            'name' => 'required',
            'client' => 'required'
        ]);
        return Project::create($request->all());
    }

    /**
     * @param $id
     * @return mixed
     */
    public function get($id)
    {
        return  Project::find($id);
    }

    /**
     * @param Request $request
     * @param $id
     * @return mixed
     */
    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'name' => 'required',
            'client' => 'required'
        ]);

        $project  = Project::find($id);
        $project->name = $request->input('name');
        $project->client = $request->input('client');
        $project->desc = $request->input('desc');
        $project->status = $request->input('status');
        $project->estimate_time = $request->input('estimate_time');
        $project->estimate_type = $request->input('estimate_type');
        $project->estimate_resource = $request->input('estimate_resource');
        $project->save();

        return $project;
    }

    /**
     * @param $id
     * @return bool
     */
    public function delete($id)
    {
        $project  = Project::find($id);
        if (!$project)
            throw new Exception('Not exist project');

        $project->delete();
        return ['Remove successfully'];
    }
}
