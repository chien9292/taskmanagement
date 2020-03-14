<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Task extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'approved_at', 'approved_by', 'old_id', 'description', 'start', 'end', 
        'assignee_id', 'status', 'committed_at', 'attached_file', 'comment', 'mark', 'commenter_id', 'commented_at', 
        'created_by', 'updated_by'
    ];

    /**
     * Get the users of group
     */
    public function approver()
    {
        return $this->belongsTo('App\Models\User');
    }

    /**
     * Get the users of group
     */
    public function old_task()
    {
        return $this->belongsTo('App\Models\User');
    }
}
