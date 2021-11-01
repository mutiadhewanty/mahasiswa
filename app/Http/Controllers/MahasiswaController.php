<?php

namespace App\Http\Controllers;

use App\Models\Mahasiswa;
use Illuminate\Http\Request;
use App\Models\Kelas;

class MahasiswaController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        //$keyword = $request->search;
        //fungsi eloquent menampilkan data menggunakan pagination
        // $mahasiswas = Mahasiswa::where('Nama', 'like', '%' . $keyword . '%')->paginate(5); // Mengambil semua isi tabel       
        // $posts = Mahasiswa::orderBy('Nim', 'desc');
        // return view('mahasiswas.index', compact('mahasiswas'));
        // with('i', (request()->input('page', 1) - 1) * 5);

        $mahasiswas = Mahasiswa::with('kelas')->get();
        $paginate = Mahasiswa::orderBy('Nim', 'asc')->paginate(3);
        return view('mahasiswas.index', ['mahasiswas' => $mahasiswas,'paginate' => $paginate]);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //return view('mahasiswas.create');
        $kelas = Kelas::all(); //mendapatkan data dari tabel kelas
        return view('mahasiswas.create', ['kelas' => $kelas]);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required']);
        
            $mahasiswas = new Mahasiswa;
            $mahasiswas->nim = $request->get('Nim');
            $mahasiswas->nama = $request->get('Nama');
            $mahasiswas->jurusan = $request->get('Jurusan');
            $mahasiswas->save();

            $kelas = new Kelas;
            $kelas->id = $request->get('Kelas');

        // fungsi eloquent untuk menambah data dengan relasi belongsTo
            $mahasiswas->kelas()->associate($kelas);
            $mahasiswas->save();
        //fungsi eloquent untuk menambah data
        // Mahasiswa::create($request->all());

        //jika data berhasil ditambahkan, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Ditambahkan');
 
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($Nim)
    {
        //menampilkan detail data dengan menemukan/berdasarkan Nim Mahasiswa
        //$Mahasiswa = Mahasiswa::find($Nim);
        $mahasiswas = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
        //return view('mahasiswas.detail', compact('Mahasiswa'));
        return view('mahasiswas.detail', ['Mahasiswa' => $mahasiswas]);
    }
    

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($Nim)
    {
       //menampilkan detail data dengan menemukan berdasarkan Nim Mahasiswa untuk diedit
       $Mahasiswa = Mahasiswa::with('kelas')->where('nim', $Nim)->first();
       $kelas = Kelas::all();
       return view('mahasiswas.edit', compact('Mahasiswa', 'kelas'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $Nim)
    {
        //melakukan validasi data
        $request->validate([
            'Nim' => 'required',
            'Nama' => 'required',
            'Kelas' => 'required',
            'Jurusan' => 'required',
            'No_Handphone' => 'required',
            'Email' => 'required',
            'Tanggal_Lahir' => 'required'
        ]);

        $mahasiswas = Mahasiswa::with('kelas')->where('nim', $Nim)->first();;
            $mahasiswas->nim = $request->get('Nim');
            $mahasiswas->nama = $request->get('Nama');
            $mahasiswas->jurusan = $request->get('Jurusan');
            $mahasiswas->save();

            $kelas = new Kelas;
            $kelas->id = $request->get('Kelas');

        // fungsi eloquent untuk menambah data dengan relasi belongsTo
            $mahasiswas->kelas()->associate($kelas);
            $mahasiswas->save();
        //fungsi eloquent untuk mengupdate data inputan kita
        Mahasiswa::find($Nim)->update($request->all());

        //jika data berhasil diupdate, akan kembali ke halaman utama
        return redirect()->route('mahasiswas.index')
        ->with('success', 'Mahasiswa Berhasil Diupdate');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($Nim)
    {
        //fungsi eloquent untuk menghapus data
        Mahasiswa::find($Nim)->delete();
        return redirect()->route('mahasiswas.index')
        -> with('success', 'Mahasiswa Berhasil Dihapus');
    }
};
