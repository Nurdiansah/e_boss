<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Stevedoring extends Model
{
    use HasFactory;

    protected $fillable = [
        'name',
        'code',
        'area_id',
        'client_id',
        'vessel_id',
        'agent_id',
        'jetty_id',
        'stevedoringcategory_id',
        'checker_id',
        'entry_date',
        'exit_date',
        'orign_port',
        'destination_port',
        'command_document',
        'wo_number',
        'plan_amount',
        'final_amount',
        'doc_ptw',
        'doc_pjsm',
        'doc_lsap',
        'start_activity',
        'finish_activity',
        'number_duration',
        'text_duration',
        'komentar',
        'status',
    ];
}
