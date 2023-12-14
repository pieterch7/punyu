<?php
namespace App\Http\Controllers;
use Illuminate\Http\Request;

// use Validator;
use App\Siswa;
use App\Telepon;
use App\Kelas;
use App\Hobi;
use App\Http\Requests;
use App\Http\Requests\SiswaRequest;
use Storage;
use Session;


class SiswaController extends Controller
{
    //
    public function index()
    {
        $siswa_list = Siswa::orderBy('nisn', 'asc')->paginate(5);
        $jumlah_siswa = Siswa::count();
        return view('siswa.index', compact('siswa_list', 'jumlah_siswa'));
    }

    public function create()
    {
        return view('siswa.create');
    }

    public function store(SiswaRequest $request)
    {
        $input = $request->all();

        if($request->hasFile('foto')) {
            $foto = $request->file('foto');
            $ext = $foto->getClientOriginalExtension();
            
            if($request->file('foto')->isValid()) {
                $foto_name = date('YmdHis'). ".$ext";
                $upload_path = 'fotoupload';
                $request->file('foto')->move($upload_path, $foto_name);
                $input['foto'] = $foto_name;
            }
        }

        // Simpan data siswa
        $siswa = Siswa::create($input);

        // Simpan data telepon
        $telepon = new Telepon;
        $telepon->nomor_telepon = $request->input('nomor_telepon');
        $siswa->telepon()->save($telepon);

        //simpan data hobi
        $siswa->hobi()->attach($request->input('hobi_siswa'));

        Session::flash('flash_message', 'Data siswa berhasil disimpan');

        return redirect('siswa');
    }   

    public function edit(Siswa $siswa)
    {
        $siswa->nomor_telepon = $siswa->telepon->nomor_telepon;
        return view('siswa.edit', compact('siswa'));
    }
    
    public function update(Siswa $siswa, SiswaRequest $request)
{
    $input = $request->all();

    // Cek apakah ada foto baru di form
    if ($request->hasFile('foto')) {
        // Hapus foto lama jika ada foto baru
        $exist = Storage::disk('foto')->exists($siswa->foto);
        if (isset($siswa->foto) && $exist) {
            $delete = Storage::disk('foto')->delete($siswa->foto);
        }

        // Upload foto baru
        $foto = $request->file('foto');
        $ext = $foto->getClientOriginalExtension();
        if ($request->file('foto')->isValid()) {
            $foto_name = date('YmdHis') . ".$ext";
            $upload_path = 'fotoupload';
            $request->file('foto')->move($upload_path, $foto_name);
            $input['foto'] = $foto_name;
        }
    } else {
        // Jika tidak ada foto baru, tetap gunakan nama file yang sudah ada
        $input['foto'] = $siswa->foto;
    }

    // Update data siswa
    $siswa->update($input);

    // Update telepon
    $telepon = $siswa->telepon;
    $telepon->nomor_telepon = $request->input('nomor_telepon');
    $siswa->telepon()->save($telepon);

    // Sync table hobi_siswa untuk siswa ini
    $siswa->hobi()->sync($request->input('hobi_siswa'));

    Session::flash('flash_message', 'Data siswa berhasil diperbarui');
    return redirect('siswa');
}


    public function destroy(Siswa $siswa)
    {
        $siswa->delete();
        Session::flash('flash_message', 'Data siswa berhasil dihapus');
        Session::flash('penting', true);
        return redirect('siswa');
    }
    
    public function show(Siswa $siswa)
    {
        return view('siswa.show', compact('siswa'));
    }

    public function cari(Request $request)
    {
        $kata_kunci = trim($request->input('kata_kunci'));

        if(! empty($kata_kunci))
        {
            $jenis_kelamin = $request->input('jenis_kelamin');
            $id_kelas = $request->input('id_kelas');

            //query
            $query = Siswa::where('nama_siswa', 'LIKE', '%' . 
            $kata_kunci . '%');
            (! empty($jenis_kelamin)) ? $query->JenisKelamin($jenis_kelamin) : '';
            (! empty($id_kelas)) ? $query->Kelas($id_kelas) : '';
            $siswa_list = $query->paginate(2);

            //URL links pagination
            $pagination = (! empty($jenis_kelamin)) ?
            $siswa_list->appends(['jenis_kelamin' => $jenis_kelamin]) : '';
            $pagination = (! empty($id_kelas)) ? $pagination =
            $siswa_list->appends(['id_kelas' => $id_kelas]) : '';
            $pagination = $siswa_list->appends(['kata_kunci' => $kata_kunci]);

            $jumlah_siswa = $siswa_list->total();
            return view ('siswa.index', compact ('siswa_list',
            'kata_kunci','pagination','jumlah_siswa','id_kelas','jenis_kelamin'));
        }
        return redirect('siswa');
    }

    public function __construct()
    {
        $this->middleware('auth', ['except' => ['index','show', 'cari', ]]);
    }

    public function tesCollection()
    {
        $data = [
            ['nisn' =>'1001', 'nama_siswa' => 'Agus Yulianto'],
            ['nisn' =>'1002', 'nama_siswa' => 'Agustina Anggraeni'],
            ['nisn' =>'1003', 'nama_siswa' => 'Bayu Firmansyah'],
            ['nisn' =>'1004', 'nama_siswa' => 'Citra Rahmawati'],
        ];
        $koleksi = collect($data);
        $koleksi->toJson();
        return $koleksi;
    }

    public function dateMutator()
    {
        $siswa = Siswa::findOrFail(1);
        $str ='Tanggal Lahir: '.
            $siswa->tanggal_lahir->format('d-m-Y') . '<br>' . 'Ulang tahun ke-30 akan jatuh pada tanggal: '. '<strong>' .$siswa->tanggal_lahir->addYears(30)->format('d-m-Y').'<strong>';
        return $str;
    }
    
}
//public function tesCollection()
    /*{
        $collection = Siswa::select('nisn','nama_siswa')->take(10)->get();
        $koleksi = $collection->toArray();
        foreach($koleksi as $siswa)
        {
            echo $siswa['nisn']. '-'. $siswa['nama_siswa']. '<br>';
        }
    }*/