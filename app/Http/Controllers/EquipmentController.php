<?php

namespace App\Http\Controllers;

use App\Models\Equipment;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class EquipmentController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.equipments.equipment', [
            'equipments' => Equipment::all()
        ]);
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
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $insert = Equipment::create([
            "name" => $request->name,
            "created_at" => now(),
            "updated_at" => now()
        ]);

        if ($insert) {

            DB::commit();

            cookieSuccess('Added');
        } else {

            DB::rollBack();

            toast('Data gagal di Tambah!', 'error');
        }

        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(Equipment $equipment)
    {
        return view('pages.equipments.equipment-show', [
            'equipment' => $equipment
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(Equipment $equipment)
    {
        return view('pages.equipments.equipment-edit', [
            'equipment' => $equipment
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Equipment $equipment)
    {

        $validated = $request->validate([
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $update = Equipment::where('id', $equipment->id)->update([
            "name" => $request->name,
            "updated_at" => now()
        ]);

        if ($update) {

            DB::commit();

            cookieSuccess('Updated');
        } else {

            DB::rollBack();

            toast('Data gagal di Ubah!', 'error');
        }

        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\Equipment  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(Equipment $equipment)
    {

        DB::beginTransaction();

        $delete = Equipment::destroy($equipment->id);

        if ($delete) {

            DB::commit();

            cookieSuccess('Deleted');
        } else {

            DB::rollBack();

            toast('Data gagal di Hapus!', 'error');
        }

        return back();
    }
}
