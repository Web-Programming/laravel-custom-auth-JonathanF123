@extends('layout.master')
@section('title', 'Halaman Prodi')

@section('content')
<div class="row pt-4">
    <div class="col">
        <h2>Prodi</h2>
        <div class="d-md flex justify-content-md-end">
            <a href="{{route('prodi.create')}}" class="btn btn-primary">Tambah</a>
        </div>
        <table class="table table-stripped table-hover">
            <thead>
                <tr>
                    <th>Nama</th><th>Aksi</th>
                </tr>
            </thead>
            <tbody>
                @foreach($prodis as $item)
                <tr>
                    <td>
                        <img src="{{asset('storage/' .$item->foto)}}" width="100px">
                    </td>
                    <td>{{$item->nama }}</td>
                     <td>
                        <form action="{{route('prodi.destroy', ['prodi' =>$item->id])}}" method="post">
                        <a href="{{url('/prodi/'.$item->id)}}" class="btn btn-warning">Detail</a>
                        <a href="{{url('/prodi/'.$item->id.'/edit')}}" class="btn btn-info">Ubah</a>
                            @method('DELETE')
                            @csrf
                            <button type="submit" class="btn btn-danger">Hapus</button>
                        </form>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
</div>
@endsection
