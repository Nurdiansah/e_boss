<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Area;
use App\Models\Client;
use App\Models\Jetty;
use App\Models\Port;
use App\Models\Stevedoring;
use App\Models\StevedoringCategory;
use App\Models\Vessel;
use Illuminate\Http\Request;

class StevedoringController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('pages.stevedorings.stevedoring-create', [
            'areas' => Area::all(),
            'clients' => Client::all(),
            'vessels' => Vessel::all(),
            'agents' => Agent::all(),
            'ports' => Port::all(),
            'jetties' => Jetty::all(),
            'stevedoringcategories' => StevedoringCategory::all(),
        ]);
    }

    public function draft()
    {
        return view('pages.stevedorings.stevedoring-draft', [
            'stevedorings' => Stevedoring::where([
                'status' => '0'
            ])->get()
        ]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $validated = $request->validate([
            'area_id' => 'required',
            'client_id' => 'required',
            'vessel_id' => 'required',
            'agent_id' => 'required',
            'jetty_id' => 'required',
            'stevedoringcategory_id' => 'required',
            'orign_port' => 'required',
            'destination_port' => 'required',
            'entry_date' => 'required',
            'command_document' => 'required',
            'wo_number' => 'required',
            'doc_ptw' => 'required|file|max:10240',
            'doc_pjsm' => 'required|file|max:10240',
            'doc_lsap' => 'required|file|max:10240',
        ]);

        $pathDocPtw = $request->file('doc_ptw')->store('stevedoring/doc_ptws');
        $pathDocPjsm = $request->file('doc_pjsm')->store('stevedoring/doc_pjsms');
        $pathDocLsap = $request->file('doc_lsap')->store('stevedoring/doc_lsaps');

        $stevedoring = Stevedoring::create([
            "area_id" => $request->area_id,
            "client_id" => $request->client_id,
            "vessel_id" => $request->vessel_id,
            "agent_id" => $request->agent_id,
            "jetty_id" => $request->jetty_id,
            "stevedoringcategory_id" => $request->stevedoringcategory_id,
            "orign_port" => $request->orign_port,
            "destination_port" => $request->destination_port,
            "entry_date" => $request->entry_date,
            "exit_date" => $request->exit_date,
            "command_document" => $request->command_document,
            "wo_number" => $request->wo_number,
            "doc_ptw" => $pathDocPtw,
            "doc_pjsm" => $pathDocPjsm,
            "doc_lsap" => $pathDocLsap,
        ]);
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stevedoring  $stevedoring
     * @return \Illuminate\Http\Response
     */
    public function show(Stevedoring $stevedoring)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stevedoring  $stevedoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Stevedoring $stevedoring)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Stevedoring  $stevedoring
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Stevedoring $stevedoring)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Stevedoring  $stevedoring
     * @return \Illuminate\Http\Response
     */
    public function destroy(Stevedoring $stevedoring)
    {
        //
    }
}
