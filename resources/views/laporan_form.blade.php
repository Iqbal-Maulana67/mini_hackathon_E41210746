@extends('template')

@section('content')
<div class="container-fluid">
    <div class="d-sm-flex align-items-center justify-content-between mb-4">
        <h1 class="h3 mb-0 text-gray-800">{{ isset($laporan) ? 'Ubah' : 'Tambah' }} Laporan Panen</h1>
    </div>

    <div class="card shadow col-xl-8 mr-2">
        <div class="card-body p-3">
            <div class="row">
                {{-- Data Diri Formulir --}}
                <div class="col-xl-12 p-2 m-2 rounded" id="data-diri-form">
                    <form action="{{ isset($laporan) ? route('laporan.update', $laporan->id_laporan) : route('laporan.store') }}" method="post" enctype="multipart/form-data">
                        @csrf
                        {!! isset($laporan) ? method_field('PUT') : '' !!}

                        <input type="hidden" name="id_laporan" id="" value="{{ isset($laporan) ? $laporan->id_laporan : '' }}">

                        <div class="form-group">
                            <label for="nisn" class="col-form-label">Tanaman</label>
                            <input type="text" name="nama_tanaman" id="nama_tanaman" class="form-control" value="{{ isset($laporan) ? $laporan->nama_tanaman : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="jenis_kelamin" class="col-form-label col-xl-12">Berat Panen (KG)</label>
                            <input type="text" name="berat_panen" id="berat_panen" class="form-control" value="{{ isset($laporan) ? $laporan->berat_panen : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="alamat" class="col-form-label">Tahun Panen </label>
                            <input type="text" name="tahun_panen" id="tahun_panen" class="form-control" value="{{ isset($laporan) ? $laporan->tahun_panen : '' }}">
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-form-label">Kondisi Tanaman</label>
                            <select class="custom-select" id="kondisi_tanaman" name="kondisi_tanaman" required>
                                <option {{ isset($laporan) ? '' : 'selected' }} value="">Kondisi</option>
                                <option {{ isset($laporan) ? (($laporan->kondisi_tanaman == "Baik")) ? 'selected' : '' : '' }} value="baik">Baik</option>
                                <option {{ isset($laporan) ? (($laporan->kondisi_tanaman == "Buruk")) ? 'selected' : '' : '' }} value="buruk">Buruk</option>
                            </select>
                        </div>
                        <div class="form-group">
                            <label for="no_hp" class="col-form-label">Gambar Tanaman</label>
                            <input type="file" name="file" id="gambar_tanaman" class="form-control border-0" value="">
                        </div>
                        <button type="submit" class="btn btn-primary">{{ isset($laporan) ? 'Ubah' : 'Tambah' }} Data</button>
                    </form>
                </div> 
            </div>
        </div>
    </div>

</div>
@endsection
