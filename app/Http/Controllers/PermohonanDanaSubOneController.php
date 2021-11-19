<?php

namespace App\Http\Controllers;

use App\Models\PermohonanDanaSubOne;
use Illuminate\Http\Request;
use RealRashid\SweetAlert\Facades\Alert;



class PermohonanDanaSubOneController extends Controller
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

        // dd($request->dasar_harga);

        $result = PermohonanDanaSubOne::create([
            'permohonandana_id' => $request->permohonandana_id,
            'deskripsi' => $request->deskripsi,
            'dasar_harga' => $request->dasar_harga,
            'ppn' => $request->ppn,
            'pph' => $request->pph,
            'pengajuan' => str_replace(".", "", $request->pengajuan),
            'kd_transaksi' => $request->kd_transaksi,
            'created_at' => now(),
            'updated_at' => now()
        ]);

        if ($result) {
            # code...
            toast('Data berhasil di simpan!', 'success');
        } else {
            # code...
            toast('Data gagal di simpan!', 'error');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
