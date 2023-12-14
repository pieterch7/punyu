@extends( 'template')
@section('main')
    <div id="siswa">
        <h2>Detail Siswa</h2>
        <table class="table table-striped">
            <tr>
                <th>NISN</th>
                <td>{{ $siswa->nisn }}</td>
            </tr>
            <tr>
                <th>Nama</th>
                <td>{{ $siswa->nama_siswa }}</td>
            </tr>
            <tr>
                <th>Kelas</th>
                <td>{{ $siswa->kelas->nama_kelas }}</td>
            </tr>
            <tr>
                <th>Tanggal Lahir</th>
                <td>{{ $siswa->tanggal_lahir->format('d-m-Y') }}</td>
            </tr>
            <tr>
                <th>Jenis Kelamin</th>
                <td>{{ $siswa->jenis_kelamin }}</td>
            </tr>
            <tr>
                <th>Telepon</th>
                <td>{{ !empty($siswa->telepon->nomor_telepon) ?
                $siswa->telepon->nomor_telepon : '-' }}</td>
            </tr>
            <tr>
                <th>Hobi</th>
                <td>
                @if(count($siswa->hobi) > 0)
                    <strong><span>{{ implode(', ', $siswa->hobi->pluck('nama_hobi')->toArray()) }}</span></strong>
                @else
                    <span>-</span>
                @endif
                </td>
            </tr>
            <tr>
                <th>Foto</th>
                <td>
                    @if(isset($siswa->foto))
                        <img src="{{ asset('fotoupload/' . $siswa->foto) }}" width="250" height="250">
                    @else
                        @if($siswa->jenis_kelamin == 'L')
                            <img src=" {{ asset('fotoupload/dummymale.jpg') }} " width="250" height="250">
                        @else
                            <img src=" {{ asset('fotoupload/dummyfemale.jpg') }} " width="250" height="250">
                        @endif
                    @endif
                </td>
            </tr>

        </table>
    </div>
@stop

@section('footer')
    <div id="footer">
        <p>&copy; 2018 laravelapp.dev</p>
    </div>
@stop