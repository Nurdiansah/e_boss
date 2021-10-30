<?php

namespace App\Http\Controllers;

use App\Models\ItemMaster;
use App\Models\StevedoringManifest;
use Illuminate\Http\Request;

class StevedoringManifestController extends Controller
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
        $validated = $request->validate([
            'stevedoring_id' => 'required',
            'description' => 'required',
            'itemmaster_id' => 'required',
            'doc_no' => 'required',
            'qty' => 'required',
            'ton' => 'required',
            'remarks' => 'required',
        ]);

        $item = ItemMaster::find($request->itemmaster_id);

        $m3 = round($request->qty * $item->volume, 2);

        if ($m3 >= $request->ton) {
            $revton = $m3;
        } else {
            $revton = $request->ton;
        }

        $result = StevedoringManifest::create([
            'stevedoring_id' => $request->stevedoring_id,
            'description' => $request->description,
            'itemmaster_id' => $request->itemmaster_id,
            'doc_no' => $request->doc_no,
            'qty' => $request->qty,
            'm3' => $m3,
            'ton' => $request->ton,
            'revton' => $revton,
            'remarks' => $request->remarks

        ]);

        if ($result) {
            # code...
            toast('Data berhasil di tambah!', 'success');
        } else {
            # code...
            toast('Data gagal di tambah!', 'error');
        }
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\StevedoringManifest  $stevedoringManifest
     * @return \Illuminate\Http\Response
     */
    public function show(StevedoringManifest $stevedoringManifest)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StevedoringManifest  $stevedoringManifest
     * @return \Illuminate\Http\Response
     */
    public function edit(StevedoringManifest $stevedoringManifest)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StevedoringManifest  $stevedoringManifest
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StevedoringManifest $stevedoringmanifest)
    {
        $validated = $request->validate([
            'stevedoring_id' => 'required',
            'description' => 'required',
            'itemmaster_id' => 'required',
            'doc_no' => 'required',
            'qty' => 'required',
            'ton' => 'required',
            'remarks' => 'required',
        ]);

        $item = ItemMaster::find($request->itemmaster_id);

        $m3 = round($request->qty * $item->volume, 2);

        if ($m3 >= $request->ton) {
            $revton = $m3;
        } else {
            $revton = $request->ton;
        }

        $result = StevedoringManifest::where('id', $stevedoringmanifest->id)->update([
            'stevedoring_id' => $request->stevedoring_id,
            'description' => $request->description,
            'itemmaster_id' => $request->itemmaster_id,
            'doc_no' => $request->doc_no,
            'qty' => $request->qty,
            'm3' => $m3,
            'ton' => $request->ton,
            'revton' => $revton,
            'remarks' => $request->remarks
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

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StevedoringManifest  $stevedoringManifest
     * @return \Illuminate\Http\Response
     */
    public function destroy(StevedoringManifest $stevedoringManifest)
    {
        //
    }
}
