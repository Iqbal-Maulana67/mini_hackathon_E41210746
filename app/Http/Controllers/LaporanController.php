<?php

namespace App\Http\Controllers;

use App\Models\LaporanPanen;
use Illuminate\Http\Request;

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
        LaporanPanen::create($request->all());

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
