@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                    <div class="d-flex justify-content-center align-items-center" style="width: 200px; height: 250px; border-radius: 20%; position: relative;">
                        <img src="{{ \Storage::url($model->foto ?? 'image/default.jpg')}}" style="max-width: 100%; max-height: 100%; border-radius: 20%; position: absolute; top: 0; bottom: 0; left: 0; right: 0; margin: auto;">
                    </div>
                    
                        <table class="table table-borderless table-striped mt-3">
                            <tbody>
                                <tr>
                                    <td width="15%"><strong>ID</strong></td>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>NISN</strong></td>
                                    <td>{{ $model->nisn}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>{{ $model->nama}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Kelas</strong></td>
                                    <td>{{ $model->kelas}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Jurusan</strong></td>
                                    <td>{{ $model->jurusan}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Angkatan</strong></td>
                                    <td>{{ $model->angkatan}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama Wali</strong></td>
                                    <td>{{ $model->wali->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Tanggal Dibuat</strong></td>
                                    <td>{{ $model->created_at->format('d/m/Y H:i')}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Dibuat Oleh</strong></td>
                                    <td>{{ $model->user->name}}</td>
                                </tr>
                            </tbody>
                        </table>
                        
                </div>
                
            </div>
        </div>
    </div>
@endsection
