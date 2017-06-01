<?php
namespace App\Api\V1\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * ProjectRequest Model class
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
class ProjectRequest extends Eloquent
{
    protected $table = 'project_request';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['user_id','project_id','type','params', 'note','created_at','updated_at', 'start_date', 'end_date'];
    /**
     * Get the phone record associated with the user.
     */
    public function project()
    {
        return $this->belongsTo('App\Api\V1\Models\Project');
    }

    public function params()
    {
        return json_decode($this->params);
    }

    public function titleWithProject()
    {
        return $this->created_at->format('m/d/Y H:i') . ' - ' . $this->project->name;
    }

    public function titleWithUser()
    {
        return $this->created_at->format('m/d/Y H:i') . ' request by ' . $this->user->name;
    }


}

