<?php

namespace App\Http\Controllers;

use App\Models\StevedoringUseEquipment;
use Illuminate\Http\Request;

class StevedoringUseEquipmentController extends Controller
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
            'equipment_id' => 'required'
        ]);

        $result = StevedoringUseEquipment::create([
            'stevedoring_id' => $request->stevedoring_id,
            'equipment_id' => $request->equipment_id,
            'created_at' => NOW(),
            'updated_at' => NOW()
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
     * @param  \App\Models\StevedoringUseEquipment  $stevedoringUseEquipment
     * @return \Illuminate\Http\Response
     */
    public function show(StevedoringUseEquipment $stevedoringUseEquipment)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\StevedoringUseEquipment  $stevedoringUseEquipment
     * @return \Illuminate\Http\Response
     */
    public function edit(StevedoringUseEquipment $stevedoringUseEquipment)
    {
        //
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\StevedoringUseEquipment  $stevedoringUseEquipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, StevedoringUseEquipment $stevedoringUseEquipment)
    {
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\StevedoringUseEquipment  $stevedoringUseEquipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(StevedoringUseEquipment $stevedoringUseEquipment)
    {
        //
    }
}
