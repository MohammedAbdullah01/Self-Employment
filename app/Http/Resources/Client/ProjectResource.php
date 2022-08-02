<?php

namespace App\Http\Resources\Client;

use Illuminate\Http\Resources\Json\JsonResource;

class ProjectResource extends JsonResource
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
                "id"              => $this->id,
                "title"           => $this->title,
                "client_name"     => $this->client->name,
                "category_name"   => $this->category->name,
                "activate"        => $this->activate,
                "description"     => $this->description,
                "skills"          => $this->skills,
                "status"          => $this->status,
                "type"            => $this->type,
                "budget"          => $this->budget,
                "delivery_period" => $this->delivery_period,
                "created_at"      => $this->created_at,
                '_links'          => [
                    '_show' => route('api.client.show.project', $this->id),
                    '_delete' => route('api.client.delete.project', $this->id),
                ]
        ];
    }
}
