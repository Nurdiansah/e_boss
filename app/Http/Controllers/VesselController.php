<?php

namespace App\Http\Controllers;

use App\Models\Vessel;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class VesselController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.vessels.vessel', [
            'vessels' => Vessel::all()
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

        $insert = Vessel::create([
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
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function show(Vessel $vessel)
    {
        return view('pages.vessels.vessel-show', [
            'vessel' => $vessel
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function edit(Vessel $vessel)
    {
        return view('pages.vessels.vessel-edit', [
            'vessel' => $vessel
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Vessel $vessel)
    {

        $validated = $request->validate([
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $update = Vessel::where('id', $vessel->id)->update([
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
     * @param  \App\Models\Vessel  $vessel
     * @return \Illuminate\Http\Response
     */
    public function destroy(Vessel $vessel)
    {

        DB::beginTransaction();

        $delete = Vessel::destroy($vessel->id);

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
