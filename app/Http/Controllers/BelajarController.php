<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class BelajarController extends Controller
{
    public function index() {
        $title = "Belajar Laravel asoyy";
        return view('belajar', compact('title'));
    }

    public function tambah() {
        $title = "Tambah-tambahan";
        return view('tambah', compact('title'));
        
    }

    public function actionTambah(Request $request) {
        $title = "Tambah-tambahan";
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $jumlah = $angka1 + $angka2;
        return view('tambah', compact('jumlah', 'title'));
        return view('tambah', compact('jumlah', 'title'));
    }

    public function pengurangan() {
        $title = "Pengurangan";
        return view('kurang', compact('title'));
    }

    public function actionKurang(Request $request){
        $title = "Pengurangan";
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $kurang = $angka1 - $angka2;
        return view('kurang', compact('kurang', 'title'));

    }

    public function pembagian() {
        $title = "Bagi-Bagian";
        return view('bagi', compact('title'));
    }

    public function actionBagi(Request $request) {
        $title = "Bagi-Bagian";
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $pembagian = $angka1/$angka2;
        return view('bagi', compact('pembagian', 'title'));
    }

    public function perkalian() {
        $title = "Perkalian";
        return view('kali', compact('title'));
    }
    
    public function actionKali(Request $request) {
        $title = "Perkalian";
        $angka1 = $request->angka1;
        $angka2 = $request->angka2;
        $perkalian = $angka1 * $angka2;
        return view('kali', compact('perkalian', 'title'));
    }
}
