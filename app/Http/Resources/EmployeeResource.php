<?php

namespace App\Http\Resources;

use Carbon\Carbon;
use Illuminate\Http\Resources\Json\JsonResource;

class EmployeeResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        return [
            'id' => $this->id,
            'firstname' => $this->firstname,
            'lastname' => $this->lastname,
            'middlename' => $this->middlename,
            'email' => $this->email,
            'gender' => $this->gender,
            'dob' => $this->dob,
            'status' => $this->status,
            'mentor' => $this->mentor,
            'created_by' => $this->user,
            'branch' => new BranchResource($this->branch),
            'created_at' => $this->created_at->toDateString(),
        ];
    }
}
