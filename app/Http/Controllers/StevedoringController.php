<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Area;
use App\Models\Checker;
use App\Models\Client;
use App\Models\ItemMaster;
use App\Models\Jetty;
use App\Models\Port;
use App\Models\Stevedoring;
use App\Models\StevedoringCategory;
use App\Models\StevedoringManifest;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;


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

    public function lolo()
    {
        return view('pages.stevedorings.stevedoring-lolo', [
            'stevedorings' => Stevedoring::where([
                'status' => '1'
            ])->get()
        ]);
    }

    public function lolodetail(Stevedoring $stevedoring)
    {

        return view('pages.stevedorings.stevedoring-lolo-detail', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => StevedoringManifest::where('stevedoring_id', $stevedoring->id)->get(),
            'areas' => Area::all(),
            'clients' => Client::all(),
            'vessels' => Vessel::all(),
            'agents' => Agent::all(),
            'ports' => Port::all(),
            'jetties' => Jetty::all(),
            'stevedoringcategories' => StevedoringCategory::all(),
            'itemmasters' => ItemMaster::all(),
            'checkers' => Checker::all()
        ]);
    }

    public function start(Request $request, $id)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);


        $result = Stevedoring::where('id', $id)->update([
            "start_activity" => now()
        ]);

        if ($result) {
            // var state = 'danger';
            // var body = 'Updated';
            cookieSuccess('Update');
        } else {
            # code...
            toast('Data gagal di mulai!', 'error');
        }

        return back();
    }

    public function proses()
    {
        return view('pages.stevedorings.stevedoring-proses', [
            'stevedorings' => Stevedoring::Where('status', '>', 0)->get()
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

        return redirect('/stevedoring/draft');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Stevedoring  $stevedoring
     * @return \Illuminate\Http\Response
     */
    public function show(Stevedoring $stevedoring)
    {
        return view('pages.stevedorings.stevedoring-show', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => StevedoringManifest::where('stevedoring_id', $stevedoring->id)->get(),
            'areas' => Area::all(),
            'clients' => Client::all(),
            'vessels' => Vessel::all(),
            'agents' => Agent::all(),
            'ports' => Port::all(),
            'jetties' => Jetty::all(),
            'stevedoringcategories' => StevedoringCategory::all(),
            'itemmasters' => ItemMaster::all(),
            'checkers' => Checker::all()
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Stevedoring  $stevedoring
     * @return \Illuminate\Http\Response
     */
    public function edit(Stevedoring $stevedoring)
    {
        return view('pages.stevedorings.stevedoring-edit', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => StevedoringManifest::where('stevedoring_id', $stevedoring->id)->get(),
            'areas' => Area::all(),
            'clients' => Client::all(),
            'vessels' => Vessel::all(),
            'agents' => Agent::all(),
            'ports' => Port::all(),
            'jetties' => Jetty::all(),
            'stevedoringcategories' => StevedoringCategory::all(),
            'itemmasters' => ItemMaster::all(),
            'checkers' => Checker::all()
        ]);
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

        // setcookie('pesan', 'Data Berhasil di Update!', time() + (3), '/');
        // setcookie('warna', 'alert-success', time() + (3), '/');

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
            'doc_ptw' => 'file|max:10240',
            'doc_pjsm' => 'file|max:10240',
            'doc_lsap' => 'file|max:10240',
        ]);

        // doc_ptw
        $path_doc_ptw = $stevedoring->doc_ptw;
        if ($request->doc_ptw != null) {
            $path_doc_ptw = Storage::putFileAs(
                '',
                $request->file('doc_ptw'),
                $path_doc_ptw
            );
        }

        // doc_pjsm
        $path_doc_pjsm = $stevedoring->doc_pjsm;
        if ($request->doc_pjsm != null) {
            $path_doc_pjsm = Storage::putFileAs(
                '',
                $request->file('doc_pjsm'),
                $path_doc_pjsm
            );
        }

        // doc_lsap
        $path_doc_lsap = $stevedoring->doc_lsap;
        if ($request->doc_lsap != null) {
            $path_doc_lsap = Storage::putFileAs(
                '',
                $request->file('doc_lsap'),
                $path_doc_lsap
            );
        }


        $result = Stevedoring::find($stevedoring->id)->update([
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
            "doc_ptw" => $path_doc_ptw,
            "doc_pjsm" => $path_doc_pjsm,
            "doc_lsap" => $path_doc_lsap,
        ]);

        if ($result) {
            # code...
            toast('Data berhasil di update!', 'success');
        } else {
            # code...
            toast('Data gagal di update!', 'error');
        }
        return back();
    }

    public function release(Request $request)
    {
        // dd($request);
        $validated = $request->validate([
            'id' => 'required',
            'checker_id' => 'required',
        ]);


        $result = Stevedoring::find($request->id)->update([
            "status" => '1',
            'checker_id' => $request->checker_id,
        ]);

        if ($result) {
            # code...
            toast('Data berhasil di Release!', 'success');
        } else {
            # code...
            toast('Data gagal di Release!', 'error');
        }

        return redirect('/stevedoring/draft');
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
