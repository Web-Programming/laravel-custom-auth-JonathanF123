<?php

namespace App\Http\Controllers;

use App\Models\Prodi;
use Illuminate\Support\Facades\DB;

use Illuminate\Http\Request;

class prodicontroller extends Controller
{
    // public function index(){
    //     $kampus = "Universitas MDP";
    //     return view("prodi.index")->with('KAMPUS', $kampus);
    // }

    public function allJoinFacade(){
        $kampus = "Universitas Multi Data Palembang";
        $result = DB::select('select mahasiswas.*, prodis.nama as nama_prodi from prodis, mahasiswas where prodis.id = mahasiswas.prodi_id');
        return view('prodi.index',['allmahasiswa' => $result, 'kampus' => $kampus]);
    }

    public function allJoinElq(){
        //$prodis = Prodi::all();
        $prodis = Prodi::with('mahasiswas')->get();
        foreach ($prodis as $prodi) {
            echo "<h3>{$prodi->nama}</h3>";
            echo "<hr>Mahasiswa: ";
            foreach ($prodi ->mahasiswas as $mhs ) {
                echo $mhs->nama. ", ";
            }
            echo "<hr>";
        }
    }
    public function create(){
        return view('prodi.create');
    }

    public function store(Request $request){
        // dump($request);
        // echo $request->nama;

        // $validateData = $request->validate([
        //     'nama' => 'required|min:5|max:20',
        // ]);
        // // dump($valitedata);
        // // echo $valitedata['nama'];

        // $prodi = new Prodi(); //Nilai Buat Objek
        // $prodi->nama = $validateData['nama']; //Simpan Nilai input ($valitedata['nama']) ke dalam propert nama prodi ($prodi->nama)
        // $prodi->save(); //Simpan ke dalam tabel prodis

        // //Retrun "Data prodi $prodi->nama berhasil disimpan ke database"; //tampilkan pesan berhasil
        // $request->session()->flash('info',"Data prodi $prodi->nama berhasil disimpan ke database");
        // return redirect('prodi/create');
        $validateData = $request->validate([
            'nama' => 'required|min:5|max:20',
            'foto' => 'required|file|image|max:5000',
        ]);

        //ambil ekstensi file
        $ext = $request->foto->getClientOriginalExtension();

        // rename nama file
        $nama_file = "foto-" . time() . ".".$ext;
        $path = $request->foto->storeAs('public', $nama_file);
        $prodi = new Prodi(); //buat objek prodi
        $prodi->nama = $validateData['nama'];//simpan nilai unput ($validateData['nama]) ke dalam property nama prodi ($prodi->nama)
        $prodi->foto = $nama_file;
        $prodi->save(); // simpan ke dalam prodis

        $request->session()->$request->flash('info', "Data Prodi $prodi->nama berhasil disimpan ke database");
        return redirect()->route('prodi.create');
    }

    public function index(){
        $prodis = Prodi::all();
        return view('prodi.index')->with('prodis', $prodis);
    }

    public function show(Prodi $prodi){
        return view('prodi.show', ['prodi' => $prodi]);
    }

    public function edit(Prodi $prodi){
        return view('prodi.edit', ['prodi'=> $prodi]);
    }

    public function update (Request $request, Prodi $prodi){
        //dump($request)->all();
        //dump($prodi)
        $validateData = $request->validate([
            'nama'=> 'required|min:5|max:20',
        ]);

        Prodi::where('id', $prodi->id)->update($validateData);
        $request->session()->flash('info',"Data Prodi $prodi->nama berhasil diubah");
        return redirect()->route('prodi.index');
    }

    public function destroy(Prodi $prodi){
        $prodi->delete();
        return redirect()->route('prodi.index')->with("info", "Prodi $prodi->nama berhasil dihapus.");
    }




}