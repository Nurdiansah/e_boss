<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StevedoringDetailResource;
use App\Http\Resources\StevedoringResource;
use App\Models\Stevedoring;
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
        $validated = $request->validate([
            'id' => 'required',
        ]);

        $result = Stevedoring::where('id', $id)->update([
            "start_activity" => now()
        ]);

        if ($result) {
            return response()->json([
                'success' => true,
                'message' => 'Kegiatan di mulai'
            ]);
        } else {
            return response()->json([
                'success' => false,
                'message' => 'Gagal'
            ]);
        }
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

    public function lolo(Request $request)
    {

        return $request;
        // DB::beginTransaction();

        // $stevedoringtimeline_id = DB::table('stevedoring_timelines')
        //     ->where('stevedoring_id', $request->id)->max('id');

        // $updateT = DB::table('stevedoring_timelines')
        //     ->where('id', $stevedoringtimeline_id)
        //     ->update(['time_start_again' => now()]);

        // $updateS = DB::table('stevedorings')
        //     ->where('id', $request->id)
        //     ->update(['status' => 2]);


        // if ($updateT && $updateS) {

        //     DB::commit();

        //     return response()->json([
        //         'success' => true,
        //         'message' => 'Kegiatan Berlanjut Kembali'
        //     ]);
        // } else {

        //     DB::rollBack();

        //     return response()->json([
        //         'success' => false,
        //         'message' => 'Gagal'
        //     ]);
        // }
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
