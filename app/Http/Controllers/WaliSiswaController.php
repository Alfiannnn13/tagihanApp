<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class WaliSiswaController extends Controller
{

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'wali_id' => 'required|exists:users,id',
            'siswa_id' => 'required',

        ]);
        $wali = \App\Models\User::find($request->wali_id);
        $siswa = \App\Models\Siswa::find($request->siswa_id);
        $siswa->wali_id = $request->wali_id;
        $siswa->wali_status = 'ok';
        $siswa->save();
        flash('Data sudah ditambahkan')->success();
        return back();
    }
}
