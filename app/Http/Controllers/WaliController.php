<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use \App\Models\User as Model;

class WaliController extends Controller
{

    private $viewIndex = 'wali_index';
    private $viewCreate = 'user_form';
    private $viewEdit = 'user_form';
    private $viewShow = 'wali_show';
    private $routePrefix = 'wali';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        return view('operator.' .$this->viewIndex, [
           'models' => Model::where('akses', 'wali')
           ->latest()
           ->paginate(50),
           'routePrefix' => $this->routePrefix,
           'title' => 'Data Wali'
        ]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $data = [
            'model' => new Model(),
            'method' => 'POST',
            'route' => $this->routePrefix.'.store',
            'button' => 'SIMPAN',
            'title' => 'FORM DATA WALI'
        ];
        return view('operator.' .$this->viewCreate, $data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users',
            'nohp' => 'required|unique:users',
            'password' => 'required'
        ]);
        $requestData['password'] = bcrypt($requestData['password']);
        $requestData['email_verified_at'] = now();
        $requestData['nohp_verified_at'] = now();
        $requestData['akses'] = 'wali';
        Model::create($requestData);
        flash('Data Berhasil Disimpan');
        return back();
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        $wali = Model::where('akses', 'wali')->where('id', $id)->firstOrFail();
        return view('operator.' .$this->viewShow, [
            'siswa' => \App\Models\Siswa::whereNotIn('wali_id', [$id])->pluck('nama', 'id')->toArray(),
            'model' => Model::findOrFail($id),
            'title' => 'Detail Wali'
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
        $data = [
            'model' => Model::findOrFail($id),
            'method' => 'PUT',
            'route' => [$this->routePrefix. '.update', $id],
            'button' => 'UPDATE',
            'title' => 'EDIT DATA WALI'
        ];
        return view('operator.' .$this->viewEdit, $data);
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
        $requestData = $request->validate([
            'name' => 'required',
            'email' => 'required|unique:users,email,' .$id,
            'nohp' => 'required|unique:users,nohp,' .$id,
            'password' => 'nullable'
        ]);
        $model = Model::findOrFail($id);
        if ($requestData['password'] == "") {
            unset($requestData['password']);
        }else {
            $requestData['password'] = bcrypt($requestData['password']);
        }
        $model->fill($requestData);
        $model->save();
        flash('Data Berhasil Disimpan');
        return redirect()->route('wali.index');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::where('akses', 'wali')->firstOrFail();

        $model->delete();
        flash('User Berhasil Dihapus');
        return back();
    }
}
