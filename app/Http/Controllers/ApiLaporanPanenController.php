<?php

namespace App\Http\Controllers;

use App\Models\LaporanPanen;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\File;
use Intervention\Image\Facades\Image;

class ApiLaporanPanenController extends Controller
{
    public function getAll(){
        $laporan = LaporanPanen::all();
        return response()->json($laporan, 201);
    }
    public function getSpecData($id){
        $laporan = LaporanPanen::find($id);

        return response()->json($laporan, 200);
    }

    public function createData(Request $request){
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
            "gambar_tanaman" => $fileName,
        ]);
        
        return response()->json([
            'status' => 'ok',
            'message' => 'Laporan berhasil ditambahkan'
        ], 201);
    }

    public function updateData($id, Request $request){
        $data = LaporanPanen::find($id);

        $path = public_path('img/gambar_tanaman');
        

        if($request->hasFile('file')){
            $file = $request->file('file');

            $fileName = $data->gambar_tanaman;

            $canvas = Image::canvas(200, 200);

            $resizeImage = Image::make($file)->resize(null, 200, function($constraint) {
                $constraint->aspectRatio();
            });

            $canvas->insert($resizeImage, 'center');

            $canvas->save($path . '/' . $fileName);    
            $data->update([
                "nama_tanaman" => $request->nama_tanaman,
                "berat_panen" => $request->berat_panen,
                "tahun_panen" => $request->tahun_panen,
                "kondisi_tanaman" => $request->kondisi_tanaman,
                "gambar_tanaman" => $fileName,
            ]);

        }else{

            $data->update([
                "nama_tanaman" => $request->nama_tanaman,
                "berat_panen" => $request->berat_panen,
                "tahun_panen" => $request->tahun_panen,
                "kondisi_tanaman" => $request->kondisi_tanaman,
            ]);

        }

        $data->save();

        return response()->json([
            'status' => 'ok',
            'message' => 'Data berhasil diubah'
        ], 200);
    }

    public function deleteData($id){
        $data = LaporanPanen::find($id);
        $path = public_path('img/gambar_tanaman');

        $data->delete(); 
        
        File::delete($path . '/' . $data->gambar_tanaman);

        return response()->json([
            'status' => 'ok',
            'message' => 'Data berhasil dihapus!'
        ], 200);
    }
}
