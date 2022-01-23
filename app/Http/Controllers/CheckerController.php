<?php

namespace App\Http\Controllers;

use App\Models\Checker;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CheckerController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('pages.checkers.checker', [
            'checkers' => Checker::all()
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

        $insert = Checker::create([
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
     * @param  \App\Models\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function show(Checker $checker)
    {
        return view('pages.checkers.checker-show', [
            'checker' => $checker
        ]);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Models\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function edit(Checker $checker)
    {
        return view('pages.checkers.checker-edit', [
            'checker' => $checker
        ]);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, Checker $checker)
    {

        $validated = $request->validate([
            'name' => 'required'
        ]);

        DB::beginTransaction();

        $update = Checker::where('id', $checker->id)->update([
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
     * @param  \App\Models\Checker  $checker
     * @return \Illuminate\Http\Response
     */
    public function destroy(Checker $checker)
    {

        DB::beginTransaction();

        $delete = Checker::destroy($checker->id);

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
