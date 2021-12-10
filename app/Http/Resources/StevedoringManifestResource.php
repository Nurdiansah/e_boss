<?php

namespace App\Http\Resources;

use App\Models\StevedoringManifest;
use Illuminate\Http\Resources\Json\JsonResource;

class StevedoringManifestResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        // $stevedoringmanifests = StevedoringManifest::where('stevedoring_id', $this->id)->get();

        return [

            'id' => $this->id,
            'stevedoring_id' => $this->stevedoring_id,
            'itemmaster_id' => $this->itemmaster_id,
            'description' => $this->description,
            'doc_no' => $this->doc_no,
            'qty' => $this->qty,
            'long' => $this->itemmaster->long,
            'width' => $this->itemmaster->widht,
            'height' => $this->itemmaster->height,
            'm3' => $this->m3,
            'ton' => $this->ton,
            'revton' => $this->revton,
            'remarks' => $this->remarks,
            'status' => $this->status,
            'cargo_final' => $this->cargo_final,
            'row_version' => $this->row_version,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
        ];
    }
}
