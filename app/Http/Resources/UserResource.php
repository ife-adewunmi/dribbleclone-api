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
            'id'                   => $this->id,
            'username'             => $this->username,
            'name'                 => $this->name,
            'email'                => $this->email,
            'created_dates'        => [
                'created_at_human' => $this->created_at->diffForHumans(),
                'created_at'       => $this->created_at
            ],
            'formatted_address'    => $this->formatted_address,
            'tagline'              => $this->tagline,
            'bio'                  => $this->bio,
            'location'             => $this->location,
            'hire_me'              => $this->hire_me,
        ];
    }
}
