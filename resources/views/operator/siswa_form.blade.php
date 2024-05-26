@extends('layouts.app_sneat')

@section('content')
    <div class="row justify-content-center">
        <div class="col-md-12">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                    {!! Form::model($model, ['route' => $route, 'method' => $method, 'files' => true]) !!}
                    @if ($model->foto != null)
                        <div class="m-3" style="width: 150px; height: 150px; overflow: hidden; border-radius: 20%;">
                            <img src="{{ \Storage::url($model->foto)}}" alt="" style="width: 100%; height: auto;">
                        </div>
                    @endif


                    {{-- nisn --}}
                    <div class="form-group mt-3">
                        <label for="nisn">NISN</label>
                        {!! Form::text('nisn', null, ['class' => 'form-control','autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nisn') }}</span>
                    </div>
                    {{-- name --}}
                    <div class="form-group mt-2">
                        <label for="nama">Name</label>
                        {!! Form::text('nama', null, ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('nama') }}</span>
                    </div>
                    {{-- kelas --}}
                    <div class="form-group mt-2">
                        <label for="kelas">Kelas</label>
                        {!! Form::selectRange('kelas',10,12, null, ['class' => 'form-control'])!!}
                        <span class="text-danger">{{ $errors->first('kelas') }}</span>
                    </div>
                    {{-- jurusan --}}
                    <div class="form-group mt-2">
                        <label for="jurusan">Jurusan</label>
                        {!! Form::select(
                            'jurusan',
                            [
                            'RPL' => 'Rekayasa Perangkat Lunak',
                            'TKJ' => 'Teknik Komputer Jaringan',
                            'TKR' => 'Teknik Kendaraan Ringan',
                            'TE' => 'Teknik Elektro',
                        ], 
                        null,
                         ['class' => 'form-control', 'autofocus']) !!}
                        <span class="text-danger">{{ $errors->first('jurusan') }}</span>
                    </div>
                    {{-- kelas --}}
                    <div class="form-group mt-2">
                        <label for="angkatan">Angkatan</label>
                        {!! Form::selectRange('angkatan',2023, date('Y') +1, null, ['class' => 'form-control'])!!}
                        <span class="text-danger">{{ $errors->first('angkatan') }}</span>
                    </div>
                    {{-- wali --}}
                    <div class="form-group mt-2">
                        <label for="wali_id">Wali (optional)</label>
                       {!! Form::select('wali_id', $wali, null, ['class' => 'form-control select2', 'placeholder' => 'Pilih Wali Murid']) !!}
                        <span class="text-danger">{{ $errors->first('wali_id') }}</span>
                    </div>

                    {{-- foto --}}
                    <div class="form-group mt-3">
                        <label for="foto">Foto (Format: jpg, jpeg, png, Ukuran Maks : 2 Mb)</label>
                        {!! Form::file('foto', ['class' => 'form-control', 'accept' => 'image/*']) !!}
                        <span class="text-denger">{{$errors->first('foto')}}</span>
                    </div>
                    {!! Form::submit($button, ['class' => 'btn btn-primary btn-sm mt-3']) !!}
                    {!! Form::close() !!}
                </div>
            </div>
        </div>
    </div>
@endsection
