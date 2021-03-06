<?php

namespace App\Http\Resources;

use Illuminate\Http\Resources\Json\JsonResource;

class UserResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id.'',
            'name' => $this->name,
            'email' => $this->email,
            'role' => $this->role,
            'role_name' => $this->role == '1'? 'Admin': ($this->role == '2'? 'Manager':'Employee'),
            'group_id' => $this->group_id?$this->group_id:($this->managed_group?$this->managed_group->id:null),
            'group_name' => $this->group? $this->group->name: ($this->managed_group?$this->managed_group->name:null),
            'created_by' => $this->created_by,
            'updated_by' => $this->updated_by,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
