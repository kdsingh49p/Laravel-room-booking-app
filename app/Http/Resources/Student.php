<?php

namespace App\Http\Resources;
use Illuminate\Support\Facades\Auth;

use Illuminate\Http\Resources\Json\JsonResource;

class Student extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array
     */
        // public $preserveKeys = true;

    public function toArray($request)
    {
         return [
            'student_id' => $this->student_id,
            'username' => $this->username,
            'password' => $this->password,
            'api_token' => $this->api_token,
            'custom' => Auth::user()->username
         ];
        // return parent::toArray($request);
    }
}


