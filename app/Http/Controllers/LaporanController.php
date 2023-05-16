<?php

namespace App\Http\Controllers;

use App\Models\LaporanPanen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class LaporanController extends Controller
{
    public function index(){
        $laporan = LaporanPanen::all();

        return view('laporan', compact('laporan'));
    }
    
    public function create(){
        return view('laporan_form');
    }

    //Method ini digunakan untuk memasukkan data pada database sesuai kolom DB dan name pada input di view.
    public function store(Request $request){

        $this->validate($request, [
            'file' => 'required'
        ]);


        $path = public_path('img/gambar_tanaman');

        if (!File::isDirectory($path)) {
            File::makeDirectory($path, 0777, true);
        }

        $file = $request->file('file');

        $fileName = 'img_'. uniqid() . '.' . $file->getClientOriginalExtension();

        $canvas = Image::canvas(200, 200);

        $resizeImage = Image::make($file)->resize(null, 200, function($constraint) {
            $constraint->aspectRatio();
        });

        $canvas->insert($resizeImage, 'center');

        $canvas->save($path . '/' . $fileName);
        
        LaporanPanen::create([
            "nama_tanaman" => $request->nama_tanaman,
            "berat_panen" => $request->berat_panen,
            "tahun_panen" => $request->tahun_panen,
            "kondisi_tanaman" => $request->kondisi_tanaman,
            "gambar_tanaman" => $request->file('file')->getClientOriginalName(),
        ]);

        return redirect()->route('laporan.index');
    }

    //Method ini digunakan untuk menampilkan view add page dan melontarkan data variabel pegawai dari parameter ke view.
    public function edit(LaporanPanen $laporan){
        return view('laporan_form', compact('laporan'));
    }

    //Method ini digunakan untuk mengubah data sesuai primary key DB dan menjalankan method index dengan route yang telah dibuat.
    public function update(Request $request, LaporanPanen $laporan){
        $laporan->update($request->all());

        return redirect()->route('laporan.index');
    }

    //Method ini digunakan untuk menghapus data sesuai primary key DB dan menjalankan method index dengan route yang telah dibuat.
    public function destroy(LaporanPanen $laporan){
        $laporan->delete(); 
        return redirect()->route('laporan.index');
    }
}
