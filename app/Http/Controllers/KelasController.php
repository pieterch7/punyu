<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\Http\Requests\KelasRequest;
use App\Kelas;
use Session;

class KelasController extends Controller
{
    public function __consturct()
    {
        $this->middleware('auth');
    }
    public function index()
    {
        //
        $kelas_list = Kelas::all();
        return view('kelas/index', compact('kelas_list'));
    }

    public function create()
    {
        return view('kelas.create');
    }

    public function store(KelasRequest $request)
    {
        Kelas::create($request->all());
        Session::flash('flash_message', 'Data Kelas berhasil disimpan.');
        return redirect('kelas');
    }

    public function show($id)
    {
        //
    }

    public function edit(Kelas $kelas)
    {
        return view('kelas.edit', compact('kelas'));
    }

    public function update(Kelas $kelas, KelasRequest $request)
    {
        $kelas->update($request->all());
        Session::flash('flash_message','Data Kelas berhasil diperbarui');
        return redirect('kelas');
    }


    public function destroy(Kelas $kelas)
    {
        //
        $kelas->delete();
        Session::flash('flash_message','Data Kelas berhasil dihapus');
        Session::flash('penting',true);
        return redirect('kelas');
    }

    
}
