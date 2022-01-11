<?php

namespace App\Http\Controllers;

use App\Models\Agent;
use App\Models\Area;
use App\Models\Checker;
use App\Models\Client;
use App\Models\Equipment;
use App\Models\EquipmentCategory;
use App\Models\ItemMaster;
use App\Models\Jetty;
use App\Models\Port;
use App\Models\Stevedoring;
use App\Models\StevedoringCategory;
use App\Models\StevedoringManifest;
use App\Models\StevedoringTallysheet;
use App\Models\StevedoringUseEquipment;
use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
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
            'stevedorings' => Stevedoring::whereIn('status', ['1', '2', '3'])->get()
            // 'stevedorings' => DB::table('stevedorings')->whereBetween('status', [1, 3])
        ]);
    }

    public function lolodetail(Stevedoring $stevedoring)
    {

        $stevedoringmanifests = StevedoringManifest::where('stevedoring_id', $stevedoring->id)->where('qty', '>', 0)->get();

        $cargoQuantity = $stevedoringmanifests->count();

        return view('pages.stevedorings.stevedoring-lolo-detail', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => $stevedoringmanifests,
            'cargoQuantity' => $cargoQuantity,
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
            "start_activity" => now(),
            "status" => '2'
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

    public function stop(Request $request, $id)
    {
        // return $request;        

        DB::beginTransaction();

        $update = DB::table('stevedorings')
            ->where('id', $request->id)
            ->update(['status' => 3]);

        $insert = DB::table('stevedoring_timelines')->insert([
            'stevedoring_id' => $request->id,
            'time_stop' => now(),
            'description' => $request->description,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($update && $insert) {

            DB::commit();

            cookieSuccess('Stop');
        } else {

            DB::rollBack();

            toast('Data gagal di stop!', 'error');
        }

        return back();
    }

    public function continue(Request $request)
    {

        DB::beginTransaction();

        $stevedoringtimeline_id = DB::table('stevedoring_timelines')
            ->where('stevedoring_id', $request->id)->max('id');


        $updateT = DB::table('stevedoring_timelines')
            ->where('id', $stevedoringtimeline_id)
            ->update(['time_start_again' => now()]);

        $updateS = DB::table('stevedorings')
            ->where('id', $request->id)
            ->update(['status' => 2]);

        if ($updateT && $updateS) {

            DB::commit();

            cookieSuccess('Continue');
        } else {

            DB::rollBack();

            toast('Data gagal di Lanjut!', 'error');
        }

        return back();
    }

    public function updatelolo(Request $request, $id)
    {

        $manifest = StevedoringManifest::find($request->id);

        if ($manifest->qty == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Cargo tersebut sudah berjumlah 0 di manifest!'
            ]);
        }

        // tonase actual
        $m3_lolo = ($request->qty_lolo / $manifest->qty) * $manifest->m3;
        $ton_lolo = ($request->qty_lolo / $manifest->qty) * $manifest->ton;
        $revton_lolo = ($request->qty_lolo / $manifest->qty) * $manifest->revton;

        // sisa stok tonase di detail job order
        $qty_stok = $manifest->qty - $request->qty_lolo;
        $m3_stok = $manifest->m3 - $m3_lolo;
        $ton_stok = $manifest->ton - $ton_lolo;
        $revton_stok = $manifest->revton - $revton_lolo;

        if ($qty_stok < 0) {

            toast('Gagal QTY yang anda inputkan melebihi qty yang ada di manifest!, qty cargo ini di manifest ' . $manifest->qty, 'error');

            return back();
        }


        DB::beginTransaction();
        // update
        $updateManifest = DB::table('stevedoring_manifests')
            ->where('id', $manifest->id)
            ->update([
                'qty' => $qty_stok,
                'm3' => $m3_stok,
                'ton' => $ton_stok,
                'revton' => $revton_stok,
            ]);
        // Insert

        $updateTally = DB::table('stevedoring_tallysheets')
            ->insert([
                'stevedoring_id' => $manifest->stevedoring_id,
                'stevedoringmanifest_id' => $manifest->id,
                'itemmaster_id' => $manifest->itemmaster_id,
                'time' => now(),
                'doc_no' => $manifest->doc_no,
                'qty' => $manifest->qty,
                'description' => $manifest->description,
                'm3' => $manifest->m3,
                'ton' => $manifest->ton,
                'revton' => $manifest->revton,
                'remarks' => $manifest->remarks,
                'row_version' => $manifest->row_version,
                'origin_destination' => $request->origin_destination,
                'created_at' => now(),
                'updated_at' => now()
            ]);


        if ($updateTally && $updateManifest) {

            DB::commit();

            cookieSuccess('Update');
        } else {

            DB::rollBack();

            toast('Data gagal di mulai!', 'error');
        }

        return back();
    }

    public function finish(Request $request)
    {

        $sumManifest = StevedoringManifest::where('stevedoring_id', $request->id)->sum('qty');

        // Validasi dulu 
        if ($sumManifest > 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Cargo ada yang belum di update'
            ]);
        }


        // Cari Revton akhir
        $revtonTally = StevedoringTallysheet::where('stevedoring_id', $request->id)
            ->where('origin_destination', '!=', 'Not Available')
            ->sum('revton');

        $stevedoring = Stevedoring::find($request->id);


        $awalK  = date_create($stevedoring->start_activity);
        $akhirK = date_create(now()); // waktu sekarang
        $diffK  = date_diff($awalK, $akhirK);


        if ($diffK->d == 0) {
            if ($diffK->h >= 1) {
                $selisihK = $diffK->h . ' jam ' . $diffK->i . ' menit ';
            } else {
                $selisihK = $diffK->i . ' menit ';
            }
        } else {
            $selisihK = $diffK->d . ' hari ' . $diffK->h . ' jam ' . $diffK->i . ' menit ';
        }
        // 


        $awalan  = strtotime($stevedoring->start_activity);
        $akhiran  = strtotime(now());

        $time = $akhiran - $awalan;

        $updateStv = Stevedoring::where('id', $request->id)->update([
            'finish_activity' => now(),
            'status' => '4',
            'final_amount' => $revtonTally,
            'text_duration' => $selisihK,
            'number_duration' => $time,
        ]);

        if ($updateStv) {

            DB::commit();

            cookieSuccess('Finish');
        } else {

            DB::rollBack();

            toast('Data gagal di Selesaikan!', 'error');
        }

        return redirect('/stevedoring-lolo');
    }

    public function proses()
    {
        return view('pages.stevedorings.stevedoring-proses', [
            'stevedorings' => Stevedoring::Where('status', '>', 0)->get()
        ]);
    }

    public function app_spv()
    {
        return view('pages.stevedorings.stevedoring-app-spv', [
            'stevedorings' => Stevedoring::whereIn('status', ['4'])->get()
        ]);
    }

    public function app_spv_detail(Stevedoring $stevedoring)
    {

        $stevedoringmanifests = StevedoringManifest::where('stevedoring_id', $stevedoring->id)->where('qty', '>', 0)->get();
        $stevedoringtallysheets = StevedoringTallysheet::where('stevedoring_id', $stevedoring->id)->get();

        // dd($stevedoringtallysheets);

        $cargoQuantity = $stevedoringmanifests->count();

        return view('pages.stevedorings.stevedoring-app-spv-detail', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => $stevedoringmanifests,
            'stevedoringtallysheets' => $stevedoringtallysheets,
            'cargoQuantity' => $cargoQuantity,
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

    public function app_spv_app(Request $request, $id)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);


        $result = Stevedoring::where('id', $id)->update([
            "status" => '5'
        ]);

        if ($result) {
            // var state = 'danger';
            // var body = 'Updated';
            cookieSuccess('Update');
        } else {
            # code...
            toast('Data gagal di Approve!', 'error');
        }

        return redirect('/stevedoring-app-spv');
    }

    // app manager ops
    public function app_mgr()
    {
        return view('pages.stevedorings.stevedoring-app-mgr', [
            'stevedorings' => Stevedoring::whereIn('status', ['5'])->get()
        ]);
    }

    public function app_mgr_detail(Stevedoring $stevedoring)
    {

        $stevedoringmanifests = StevedoringManifest::where('stevedoring_id', $stevedoring->id)->where('qty', '>', 0)->get();
        $stevedoringtallysheets = StevedoringTallysheet::where('stevedoring_id', $stevedoring->id)->get();

        // dd($stevedoringtallysheets);

        $cargoQuantity = $stevedoringmanifests->count();

        return view('pages.stevedorings.stevedoring-app-mgr-detail', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => $stevedoringmanifests,
            'stevedoringtallysheets' => $stevedoringtallysheets,
            'cargoQuantity' => $cargoQuantity,
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

    public function app_mgr_app(Request $request, $id)
    {

        $validated = $request->validate([
            'id' => 'required',
        ]);


        $result = Stevedoring::where('id', $id)->update([
            "status" => '6'
        ]);

        if ($result) {
            // var state = 'danger';
            // var body = 'Updated';
            cookieSuccess('Update');
        } else {
            # code...
            toast('Data gagal di Approve!', 'error');
        }

        return redirect('/stevedoring-app-mgr');
    }


    // Stevedoring History
    public function history()
    {
        return view('pages.stevedorings.stevedoring-history', [
            'stevedorings' => Stevedoring::whereIn('status', ['6'])->get()
        ]);
    }

    public function history_detail(Stevedoring $stevedoring)
    {

        $stevedoringmanifests = StevedoringManifest::where('stevedoring_id', $stevedoring->id)->where('qty', '>', 0)->get();
        $stevedoringtallysheets = StevedoringTallysheet::where('stevedoring_id', $stevedoring->id)->get();

        // dd($stevedoringtallysheets);

        $cargoQuantity = $stevedoringmanifests->count();

        return view('pages.stevedorings.stevedoring-history-detail', [
            'stevedoring' => $stevedoring,
            'stevedoringmanifests' => $stevedoringmanifests,
            'stevedoringtallysheets' => $stevedoringtallysheets,
            'cargoQuantity' => $cargoQuantity,
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
            'stevedoringuseequipments' => StevedoringUseEquipment::where('stevedoring_id', $stevedoring->id)->get(),
            'areas' => Area::all(),
            'clients' => Client::all(),
            'vessels' => Vessel::all(),
            'agents' => Agent::all(),
            'ports' => Port::all(),
            'jetties' => Jetty::all(),
            'stevedoringcategories' => StevedoringCategory::all(),
            'itemmasters' => ItemMaster::all(),
            'checkers' => Checker::all(),
            'equipmentcategories' => EquipmentCategory::all(),
            'equipment' => Equipment::all()
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
