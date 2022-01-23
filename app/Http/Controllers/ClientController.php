<?php

namespace App\Http\Controllers;

use App\Models\Client;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ClientController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.clients.client', [
            'clients' => Client::all()
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

        $insert = Client::create([
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function show(Client $client)
    {
        return view('pages.clients.client-show', [
            'client' => $client
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function edit(Client $client)
    {
        return view('pages.clients.client-edit', [
            'client' => $client
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Client $client)
    {

        $validated = $request->validate([
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $update = Client::where('id', $client->id)->update([
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
     * @param  \App\Models\Client  $client
     * @return \Illuminate\Http\Response
     */
    public function destroy(Client $client)
    {

        DB::beginTransaction();

        $delete = Client::destroy($client->id);

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
