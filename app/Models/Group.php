<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Group extends Model
{
    /**
     * The attributes that are mass assignable.
     *
     * @var array
     */
    protected $fillable = [
        'name', 'manager_id', 'created_by', 'updated_by'
    ];

    /**
     * Get the users of group
     */
    public function users()
    {
        return $this->hasMany('App\Models\User');
    }
    
    /**
     * Get the manager of group
     */
    public function manager()
    {
        return $this->belongTo('App\Models\User', 'manager_id');
    }

}
