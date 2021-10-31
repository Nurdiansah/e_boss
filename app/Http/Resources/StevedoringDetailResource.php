<?php

namespace App\Http\Resources;

use App\Models\StevedoringManifest;
use Illuminate\Http\Resources\Json\JsonResource;

class StevedoringDetailResource extends JsonResource
{
    /**
     * Transform the resource into an array.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return array|\Illuminate\Contracts\Support\Arrayable|\JsonSerializable
     */
    public function toArray($request)
    {
        $stevedoringmanifests = StevedoringManifest::where('stevedoring_id', $this->id)->get();

        return [
            'id' => $this->id,
            'code' => $this->code,
            'area' => $this->area->name,
            'client' => $this->client->name,
            'vessel' => $this->vessel->name,
            'agent' => $this->agent->name,
            'jetty' => $this->jetty->name,
            'stevedoringcategory' => $this->stevedoringcategory->name,
            'checker' => $this->checker->name,
            'entry_date' => $this->entry_date,
            'exit_date' => $this->exit_date,
            'orign_port' => $this->orign_port,
            'destination_port' => $this->destination_port,
            'command_document' => $this->command_document,
            'wo_number' => $this->wo_number,
            'plan_amount' => $this->plan_amount,
            'final_amount' => $this->final_amount,
            'doc_ptw' => $this->doc_ptw,
            'doc_pjsm' => $this->doc_pjsm,
            'doc_lsap' => $this->doc_lsap,
            'start_activity' => $this->start_activity,
            'finish_activity' => $this->finish_activity,
            'number_duration' => $this->number_duration,
            'text_duration' => $this->text_duration,
            'komentar' => $this->komentar,
            'status' => $this->status,
            'created_at' => $this->created_at,
            'updated_at' => $this->updated_at,
            'stevedoringmanifests' => $stevedoringmanifests
        ];
    }
}
