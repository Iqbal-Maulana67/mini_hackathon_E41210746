@extends('template')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">Laporan Panen</h1>
    </div>

        <div class="card shadow col-xl-12 mr-3">
            <div class="card-header py-3">
                <h6 class="m-0 font-weight-bold text-primary">Laporan Detail Hasil Panen</h6>
            </div>
            <div class="card-body p-3">
                <div class="row float-right">
                    <a href="{{ route('laporan.create') }}"><button class="btn btn-success mb-3 text-end mr-2"><i class="fa fa-plus mr-2"></i>Tambah Laporan Panen</button></a>
                </div>
                <div class="table-responsive">
                    <table class="table table-bordered" width="100%" cellspacing="0">
                        <thead>
                            <th>Tanaman</th>
                            <th>Berat Panen (KG)</th>
                            <th>Tahun Panen</th>
                            <th>Kondisi Tanaman</th>
                            <th>Gambar</th>
                            <th>Aksi</th>
                        <tbody>
                            @foreach ($laporan as $item)
                            <tr>
                                <td>{{ $item->nama_tanaman }}</td>
                                <td>{{ $item->berat_panen }}</td>
                                <td>{{ $item->tahun_panen }}</td>
                                <td>{{ $item->kondisi_tanaman }}</td>
                                <td><img src="{{ asset('img/gambar_tanaman/'. $item->gambar_tanaman)}}" alt=""></td>
                                <td>
                                    <div class="btn-group">
                                        <a href="{{ route('laporan.edit', $item->id_laporan) }}"><button class="btn btn-warning"><i class="fas fa-edit fa-sm"></i></button></a>
                                        <form action="{{ route('laporan.destroy', $item->id_laporan) }}" method="post">
                                            @csrf
                                            @method('DELETE')
                                            <button class="btn btn-danger" type="submit"><i class="fas fa-trash fa-sm"></i></button>
                                        </form>
                                    </div>
                                </td>
                            </tr>
                            @endforeach
                            
                        </tbody>
                    </table>
                </div>
            </div>
        </div>

</div>
@endsection
