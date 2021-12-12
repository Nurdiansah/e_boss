<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StevedoringDetailResource;
use App\Http\Resources\StevedoringManifestResource;
use App\Http\Resources\StevedoringResource;
use App\Models\Stevedoring;
use App\Models\StevedoringManifest;
use App\Models\StevedoringTallysheet;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StevedoringApiController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $stevedoring =  Stevedoring::where('status', 1)->get();

        return response()->json([
            'success' => true,
            'data' => StevedoringResource::collection($stevedoring),
            'message' => 'berhasil'
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
        //
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $stevedoring =  Stevedoring::where('id', $id)->get();

        return response()->json([
            'success' => true,
            'data' => StevedoringDetailResource::collection($stevedoring),
            'message' => 'berhasil'
        ]);
    }

    public function showManifest($id)
    {
        $data =  StevedoringManifest::where('stevedoring_id', $id)->where('qty', '>', 0)->get();


        return response()->json([
            'success' => true,
            'data' => StevedoringManifestResource::collection($data),
            'message' => 'berhasil'
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        //
    }

    public function start(Request $request, $id)
    {

        print_r($request);
        die;

        $validated = $request->validate([
            'id' => 'required',
        ]);

        $result = Stevedoring::where('id', $id)->update([
            "start_activity" => now()
        ]);

        // if ($result) {
        //     return response()->json([
        //         'success' => true,  
        //         'message' => 'Kegiatan di mulai'
        //     ]);
        // } else {
        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Gagal'
        //     ]);
        // }
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

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan Berhenti'
            ]);
        } else {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal'
            ]);
        }
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

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan Berlanjut Kembali'
            ]);
        } else {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal'
            ]);
        }
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

            return response()->json([
                'success' => true,
                'message' => 'Kegiatan Berhasil diselesaikan'
            ]);
        } else {

            return response()->json([
                'success' => false,
                'message' => 'Gagal di finish'
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
