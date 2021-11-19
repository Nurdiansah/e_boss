<?php

namespace App\Http\Controllers\Api;

use App\Http\Controllers\Controller;
use App\Http\Resources\StevedoringManifestResource;
use App\Models\StevedoringManifest;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class StevedoringManifestApiController extends Controller
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
        $stevedoringmanifest =  StevedoringManifest::where('id', $id)->get();

        return response()->json([
            'success' => true,
            'data' => StevedoringManifestResource::collection($stevedoringmanifest),
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


    public function lolo(Request $request)
    {

        $manifest = StevedoringManifest::find($request->id);

        if ($manifest->qty == 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal Cargo tersebut sudah berjumlah 0 di manifest!'
            ]);
        }

        // tonase actual
        $m3_lolo = ($request->qty / $manifest->qty) * $manifest->m3;
        $ton_lolo = ($request->qty / $manifest->qty) * $manifest->ton;
        $revton_lolo = ($request->qty / $manifest->qty) * $manifest->revton;

        // sisa stok tonase di detail job order
        $qty_stok = $manifest->qty - $request->qty;
        $m3_stok = $manifest->m3 - $m3_lolo;
        $ton_stok = $manifest->ton - $ton_lolo;
        $revton_stok = $manifest->revton - $revton_lolo;

        if ($qty_stok < 0) {
            return response()->json([
                'success' => false,
                'message' => 'Gagal QTY yang anda inputkan melebihi qty yang ada di manifest!, qty cargo ini di manifest ' . $manifest->qty
            ]);
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

            return response()->json([
                'success' => true,
                'message' => 'Data berhasil di update'
            ]);
        } else {

            DB::rollBack();

            return response()->json([
                'success' => false,
                'message' => 'Gagal'
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
