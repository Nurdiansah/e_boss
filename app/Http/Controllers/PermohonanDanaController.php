<?php

namespace App\Http\Controllers;

use App\Models\PermohonanDana;
use App\Models\PermohonanDanaSubOne;
use Barryvdh\DomPDF\PDF;
use Illuminate\Http\Request;

class PermohonanDanaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        //
        return view('pages.danas.dana-index', [
            'permohonandanas' => PermohonanDana::get()
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {


        return view('pages.danas.dana-create', [
            'permohonandanasubones' => PermohonanDanaSubOne::get()
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

        $result = PermohonanDana::create([
            'order_no' => $request->order_no,
            'tanggal_pengajuan' => $request->tanggal_pengajuan,
            'tanggal_transfer' => $request->tanggal_transfer,
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
        return redirect('/permohonan-dana');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        return view('pages.danas.form-permohonan', [
            'permohonandanasubones' => PermohonanDanaSubOne::find($id)
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        return view('pages.danas.dana-edit', [
            'permohonandana' => PermohonanDana::find($id),
            'permohonandanasubones' => PermohonanDanaSubOne::where('permohonandana_id', $id)->get()
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

        $validated = $request->validate([
            'order_no' => 'required',
            'tanggal_pengajuan' => 'required',
            'tanggal_transfer' => 'required',
        ]);

        $result = PermohonanDana::where('id', $id)
            ->update([
                'order_no' => $request->order_no,
                'tanggal_pengajuan' => $request->tanggal_pengajuan,
                'tanggal_transfer' => $request->tanggal_transfer,
                'updated_at' => now()
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

    public function release(Request $request, $id)
    {

        $result = PermohonanDana::where('id', $id)
            ->update([
                'status' => '1'
            ]);


        if ($result) {
            # code...
            toast('Data berhasil di release!', 'success');
        } else {
            # code...
            toast('Data gagal di release!', 'error');
        }
        return back();
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

    public function cetak()
    {
        // $data['judul'] = 'Laporan PDF';
        // return \PDF::loadView('pages.pdf.dana', $data);
        // return $pdf->download('invoice.pdf');

        //
        // return view('pages.danas.dana-index', [
        //     'permohonandanas' => PermohonanDana::get()
        // ]);
        // return view('pages.pdf.dana', [
        //     'prices' => PermohonanDana::get()
        // ])->with('i');

        // $pdf = App::make('dompdf.wrapper');
        // $pdf->loadHTML('<h1>Test</h1>');
        // return $pdf->stream();

        // $tes = formatRupiah(30000);
        // dd($tes);
        $permohonandanas = PermohonanDana::find(1);
        $permohonandanasubones = PermohonanDanaSubOne::get();

        $html = view('pages.pdf.dana-cetak', [
            'permohonandana' => $permohonandanas,
            'permohonandanasubones' => $permohonandanasubones,
        ])->with('i');
        // $now = Carbon::now();
        // $filename = $vessel->name . " Part". $now->format('d/m/y');        

        $pdf = \App::make('dompdf.wrapper');
        $pdf->loadHTML($html);
        return $pdf->stream('Inventory List');
    }
}
