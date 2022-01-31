<?php

namespace App\Http\Controllers;

use App\Models\ItemMaster;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ItemMasterController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.itemmasters.itemmaster', [
            'itemmasters' => ItemMaster::all()
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

        $insert = ItemMaster::create([
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
     * @param  \App\Models\ItemMaster  $equipment
     * @return \Illuminate\Http\Response
     */
    public function show(ItemMaster $itemmaster)
    {
        return view('pages.itemmasters.itemmaster-show', [
            'itemmaster' => $itemmaster
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\ItemMaster  $equipment
     * @return \Illuminate\Http\Response
     */
    public function edit(ItemMaster $itemmaster)
    {
        return view('pages.itemmasters.itemmaster-edit', [
            'itemmaster' => $itemmaster
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\ItemMaster  $equipment
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, ItemMaster $itemmaster)
    {

        $validated = $request->validate([
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $update = ItemMaster::where('id', $itemmaster->id)->update([
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
     * @param  \App\Models\ItemMaster  $equipment
     * @return \Illuminate\Http\Response
     */
    public function destroy(ItemMaster $itemmaster)
    {

        DB::beginTransaction();

        $delete = ItemMaster::destroy($itemmaster->id);

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
