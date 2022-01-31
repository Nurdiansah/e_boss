<?php

namespace App\Http\Controllers;

use App\Models\Jetty;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class JettyController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.jetties.jetty', [
            'jetties' => Jetty::all()
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

        $insert = Jetty::create([
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
     * @param  \App\Models\Jetty  $jetty
     * @return \Illuminate\Http\Response
     */
    public function show(Jetty $jetty)
    {
        return view('pages.jetties.jetty-show', [
            'jetty' => $jetty
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Jetty  $jetty
     * @return \Illuminate\Http\Response
     */
    public function edit(Jetty $jetty)
    {
        return view('pages.jetties.jetty-edit', [
            'jetty' => $jetty
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Jetty  $jetty
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Jetty $jetty)
    {

        $validated = $request->validate([
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $update = Jetty::where('id', $jetty->id)->update([
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
     * @param  \App\Models\Jetty  $jetty
     * @return \Illuminate\Http\Response
     */
    public function destroy(Jetty $jetty)
    {

        DB::beginTransaction();

        $delete = Jetty::destroy($jetty->id);

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
