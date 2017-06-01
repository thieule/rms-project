<?php
namespace App\Api\V1\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;

/**
 * Project Model class
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
class Project extends Eloquent
{
   protected $table = 'project';
   protected $fillable = ['id','name','client','desc','created_at','user_id','icon','status','updated_at', 'estimate_time', 'estimate_type', 'estimate_resource'];

}
