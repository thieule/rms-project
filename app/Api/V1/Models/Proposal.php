<?php
namespace App\Api\V1\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * Propasal Model class
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
class Proposal extends Eloquent
{
    protected $table = 'proposal';
    protected $dates = ['created_at', 'updated_at'];
    protected $fillable = ['project_id','user_id','request_id'];


    /**
     * Get the user record associated with the propasal.
     */
    public function project()
    {
        return $this->belongsTo('App\Api\V1\Models\Project');
    }

}

