<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use \App\Models\Siswa as Model;
use Illuminate\Support\Facades\Storage;

class SiswaController extends Controller
{

    private $viewIndex = 'siswa_index';
    private $viewCreate = 'siswa_form';
    private $viewEdit = 'siswa_form';
    private $viewShow = 'siswa_show';
    private $routePrefix = 'siswa';
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
{
    $models = Model::query(); // Menggunakan instance query builder

    if ($request->filled('q')) {
        $models = $models->search($request->q);
    } else {
        $models = $models->latest();
    }

    $models = $models->paginate(50); // Menambahkan paginate() di akhir

    return view('operator.' . $this->viewIndex, [
        'models' => $models, // Menggunakan variabel $models
        'routePrefix' => $this->routePrefix,
        'title' => 'Data Siswa'
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
            'title' => 'FORM DATA SISWA',
            'wali' => User::where('akses', 'wali')->pluck('name', 'id')
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
       'wali_id' => 'nullable',
       'nama' => 'required',
       'nisn' => 'required|unique:siswas',
       'kelas' => 'required',
       'jurusan' => 'required',
       'angkatan' => 'required',
       'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:5000',
    ]);
    if ($request->hasFile('foto')) {
        $requestData['foto'] = $request->file('foto')->store('public');
    } else {
        $requestData['foto'] = null; // Atau Anda bisa memberikan nilai default yang sesuai
    }
    
    // Menambahkan foto ke requestData, bahkan jika tidak ada file yang diunggah
    $requestData['foto'] = $request->file('foto') ? $request->file('foto')->store('public') : null;

    if ($request->filled('wali_id')) {
        $requestData['wali_status'] = 'ok';
    }
    

    $requestData['user_id'] = auth()->user()->id;
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
        return view('operator.' . $this->viewShow, [
            'model' => Model::findOrFail($id),
            'title' => 'Detail Siswa'
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
            'title' => 'EDIT DATA SISWA',
            'wali' => User::where('akses', 'wali')->pluck('name', 'id'),
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
            'wali_id' => 'nullable',
           'nama' => 'required',
           'nisn' => 'required|unique:siswas,nisn,'.$id,
           'kelas' => 'required',
           'jurusan' => 'required',
           'angkatan' => 'required',
           'foto' => 'nullable|image|mimes:jpeg,png,jpg|max:2048'
        ]);
        $model = Model::findOrFail($id);

        if ($request->hasFile('foto')) {
            // Delete the old photo if it exists
            if ($model->foto) {
                Storage::delete($model->foto);
            }
        
            // Store the new photo
            $requestData['foto'] = $request->file('foto')->store('public');
        }
        

        if ($request->filled('wali_id')) {
            $requestData['wali_status'] = 'ok';
        }

        $model->fill($requestData);
        $model->save();
        flash('Data Berhasil Disimpan');
        return back();
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $model = Model::findOrFail($id);
    
        $model->delete();
        flash('User Berhasil Dihapus');
        return back();
    }
    
}
