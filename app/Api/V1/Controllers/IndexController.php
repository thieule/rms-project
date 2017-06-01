<?php

namespace App\Api\V1\Controllers;
use App\Api\V1\Models\Config;
use Laravel\Lumen\Routing\Controller as BaseController;
class IndexController extends BaseController
{
    /**
     * View list of notification config
     * @return \Illuminate\Contracts\View\Factory|\Illuminate\View\View
     */
    public function config(\Illuminate\Http\Request $request)
    {
        $user = $request->user();
        $notify = Config::where('user_id', $user->id)->get();
        return $notify;
    }

    /**
     * @param $id
     */
    public function get($id)
    {

    }

    /**
     *
     */
    public function update()
    {

    }
}
