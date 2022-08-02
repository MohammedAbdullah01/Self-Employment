<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class AuthClientResource extends JsonResource
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
            "id"             => $this->id,
            "name"           => $this->name,
            "email"          => $this->email,
            "company"        => $this->company,
            "phone"          => $this->phone,
            "country"        => $this->country,
            "link"           => $this->link,
            "avatar"         => asset('storage/clients/'. $this->avatar),
            "about_me"       => $this->about_me,
            "email_verified" => $this->email_verified,
            "created_at"     => $this->created_at,
        ];
    }
}
