@extends('layouts.app_sneat')

@section('content')
<a href="{{ route($routePrefix . '.create')}}" class="btn btn-outline-primary mb-2">Tambah Data</a>
{!! Form::open(['route' => $routePrefix . '.index', 'method' => 'GET']) !!}
<div class="input-group">
    <input name="q" type="text" class="form-control" placeholder="Cari Nama Siswa" aria-label="Cari Nama Siswa" aria-describedby="button-addon2"> 
    <button type="submit" class="btn btn-outline-primary" id="button-addon2">
        <i class="bx bx-search"></i>
    </button>
</div>
{!! Form::close() !!}
    <div class="row justify-content-center">
        <div class="col-md-12 mt-4">
            <div class="card">
                <h5 class="card-header">{{ $title }}</h5>

                <div class="card-body">
                   <div class="table-responsive">
                    <table class="table table-striped">
                        <thead>
                            <tr>
                                <th>No</th>
                                <th>NISN</th>
                                <th>Nama</th>
                                <th>Kelas</th>
                                <th>Jurusan</th>
                                <th>Angkatan</th>
                                <th>Nama Wali</th>
                                <th>Aksi</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse ($models as $item)
                                <tr>
                                    <td>{{ $loop->iteration }}</td>
                                    <td>{{ $item->nisn }}</td>
                                    <td>{{ $item->nama }}</td>
                                    <td>{{ $item->kelas }}</td>
                                    <td>{{ $item->jurusan }}</td>
                                    <td>{{ $item->angkatan }}</td>
                                    <td>{{ $item->wali->name }}</td>
                                    <td>
                                        
                                        {!! Form::open([
                                            'route' => [$routePrefix . '.destroy', $item->id],
                                            'method' => 'DELETE',
                                            'onsubmit' => 'return confirm("Yakin Ingin Menghapus???")',
                                        ]) !!}
                                        <a href="{{ route ($routePrefix .'.edit', $item->id) }}" 
                                            class="btn btn btn-outline-info btn-sm"><i class="fa fa-edit"></i> Edit
                                        </a>
                                        <button type="submit" 
                                            class="btn btn-outline-danger btn-sm">
                                            <i class="fa fa-trash"></i> Hapus
                                        </button>
                                        <a href="{{ route ($routePrefix .'.show', $item->id) }}" 
                                            class="btn btn-outline-dark btn-sm"><i class="fa fa-eye"></i> Detail
                                        </a>
                                        {!! Form::close() !!}
                                    </td>
                                </tr>
                            @empty
                            <tr>
                                <td coolspan="4">Data Tidak Ada</td>
                            </tr>
                                
                            @endforelse
                        </tbody>
                    </table>
                    {!! $models->links() !!}
                   </div>
                </div>
            </div>
        </div>
    </div>
@endsection
