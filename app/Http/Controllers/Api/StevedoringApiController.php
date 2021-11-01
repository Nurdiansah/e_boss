<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StevedoringDetailResource;
use App\Http\Resources\StevedoringResource;
use App\Models\Stevedoring;
use Illuminate\Http\Request;

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

        $result = Stevedoring::where('id', $id)->update([
            "status" => '3'
        ]);



        // $query = mysqli_query($koneksi, "INSERT INTO timeline_joborder ( id_joborder, waktu_stop, keterangan_jeda ) VALUES 
        // 								( '$id_joborder', '$tanggal', '$alasan');
        //     ");

        // $queryJ = mysqli_query($koneksi, "UPDATE job_order SET status_jo='3' WHERE id_joborder='$id_joborder' ");		
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
