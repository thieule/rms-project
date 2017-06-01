<?php
namespace App\Api\V1\Models;
use Illuminate\Database\Eloquent\Model as Eloquent;
/**
 * ProjectBooking Model class
 * @author Thieu Le Quang <quangthieuagu@gmail.com>
 */
class ProjectBooking extends Eloquent
{
    protected $table = 'project_booking';
    protected $dates = ['created_at', 'updated_at', 'start_date', 'end_date'];
    protected $fillable = ['id','employee_id','project_id','take_part_per','project_role_id','start_date','end_date','spent_hour','request_type','book_type','user_id','note','created_at','updated_at'];

    public static function getTableColumns() {
        return \DB::connection()->getSchemaBuilder()->getColumnListing('project');
    }

    /**
     * Get the phone record associated with the user.
     */
    public function project()
    {
        return $this->belongsTo('App\Api\V1\Models\Project');
    }

    public function getUserRelated()
    {
        $project = Project::find($this->project_id);
        return $project->user;
    }

    public function getPerOfSpentDay()
    {
        $current = \Carbon\Carbon::now();
        $spend_days = $current->diffInDays($this->start_date);
        if ($spend_days <= 0) {
            return 0;
        }
        $total_days = $this->end_date->diffInDays($this->start_date);
        $per = $spend_days/$total_days;
        $per = ($per >= 1) ? 1 : $per;
        return ($per) * 100;

    }

    public function getSpentDay()
    {
        $current = \Carbon\Carbon::now();
        $spend_days = $current->diffInDays($this->start_date);
        if ($spend_days <= 0) {
            return 0;
        }
        return $spend_days;

    }

    /**
     * Get the phone record associated with the user.
     */
    public function role()
    {
        return $this->belongsTo('App\Modules\Project\Models\ProjectRole', 'project_role_id');
    }

    public function joinLable()
    {
        if ($this->book_type == 'Reserve') {
            return $this->book_type . ' for 1 week';
        }

        if ($this->take_part_per == 100) {
            return 'Fulltime';
        }

        return $this->take_part_per . '%';

    }

    public function per()
    {
        if ($this->take_part_per == 100) {
            return 'Fulltime';
        }

        return $this->take_part_per . '%';

    }

    public static function convertDataGanttChart($project_booking)
    {
        $gantt_data = [];
        foreach ($project_booking as $item) {
            $gantt_data[] = [
                'name' => $item->role->code,
                'desc' => $item->employee->first_name . ' ' . $item->employee->last_name,
                'values' => [
                    [
                        'from' => "/Date(" . strtotime($item->start_date) * 1000 . ")/",
                        'to' => "/Date(" . strtotime($item->end_date) * 1000 . ")/",
                        'label' => $item->role->name . " - " . $item->joinLable(),
                        'customClass' => "ganttGreen",
                        'dataObj' => ['employee_id' => $item->employee->id, 'booking_id' => $item->id]
                    ]]
            ];
        }
        return $gantt_data;
    }



}

