@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body d-flex justify-content-center align-items-center flex-column">
                        <table class="table table-borderless table-striped mt-3">
                            <tbody>
                                <tr>
                                    <td width="15%"><strong>ID</strong></td>
                                    <td>{{ $model->id }}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nama</strong></td>
                                    <td>{{ $model->name}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Email</strong></td>
                                    <td>{{ $model->email}}</td>
                                </tr>
                                <tr>
                                    <td><strong>Nomor Hp</strong></td>
                                    <td>{{ $model->nohp}}</td>
                                </tr>
                                
                                <tr>
                                    <td><strong>Tanggal Dibuat</strong></td>
                                    <td>{{ $model->created_at->format('d/m/Y H:i')}}</td>
                                </tr>
                            </tbody>
                        </table>
                </div>
            </div>
        </div>
    </div>

    <h4 class="mt-3">Tambah Data Anak</h4>
{!! Form::open(['route' => 'walisiswa.store', 'method' => 'POST']) !!}
{!! Form::hidden('wali_id', $model->id, []) !!}
<div class="form-group">
    {!! Form::select('siswa_id', ['' => 'Pilih Data Siswa'] + $siswa, null, ['class' => 'form-control select2']) !!}
    <span class="text-danger">{{ $errors->first('siswa_id') }}</span>
</div>
{!! Form::submit('Simpan', ['class' => 'btn btn-outline-primary btn-sm mt-2']) !!}
{!! Form::close() !!}


    <div class="col-md-12 mt-3">
        <div class="card ">
            <h5 class="card-header justify-content-center align-items-center">Data Anak</h5>
            <div class="card-body d-flex  flex-column">
                <table class="table table-borderless table-striped mt-3">
                    <thead>
                        <th>NO</th>
                        <th>NISN</th>
                        <th>Nama</th>
                    </thead>
                    <tbody>
                        @foreach ($model->siswa as $item)
                            <tr>
                                <td>{{ $loop->iteration}}</td>
                                <td>{{ $item->nisn}}</td>
                                <td>{{ $item->nama}}</td>
                            </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
    
    
    
@endsection
