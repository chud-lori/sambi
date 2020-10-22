<?php

namespace App\Http\Controllers;

use App\Http\Controllers\Controller;
use App\Imports\MemberImport;
use App\Member;
use Illuminate\Http\Request;
use Maatwebsite\Excel\Facades\Excel;

class MemberController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        abort(404);
    }

    public function memberGuru()
    {
        $members = Member::where('jabatan', 'Guru')->get();
        return view('layouts.member.index', compact('members', 'members'));
    }

    public function memberSiswa()
    {
        $members = Member::where('jabatan', 'Siswa')->get();
        return view('layouts.member.index', compact('members', 'members'));
    }

    public function create()
    {
        return view('layouts.member.create');
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'nomor_anggota'     => 'required|unique:members',
            'nama'              => 'required|string',
            'nomor_identitas'   => 'required|unique:members',
            'jabatan'           => 'required|string',
            'jurusan_gurumapel' => 'required|string',
            'kelas'             => 'required',
            'jenis_kelamin'     => 'required',
            'tempat_lahir'      => 'required|string',
            'tanggal_lahir'     => 'required|date',
            'alamat'            => 'required|string',
            'foto'              => 'required|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $imgName = $request->foto->getClientOriginalName() . '-' . time()
        . '.' . $request->foto->extension();
        $request->foto->move(public_path('image/members'), $imgName);

        $member = new Member([
            'nomor_anggota'     => $request->get('nomor_anggota'),
            'nama'              => ucwords($request->get('nama')),
            'nomor_identitas'   => $request->get('nomor_identitas'),
            'jabatan'           => ucwords($request->get('jabatan')),
            'jurusan_gurumapel' => ucwords($request->get('jurusan_gurumapel')),
            'kelas'             => $request->get('kelas'),
            'jenis_kelamin'     => $request->get('jenis_kelamin'),
            'tempat_lahir'      => ucwords($request->get('tempat_lahir')),
            'tanggal_lahir'     => $request->get('tanggal_lahir'),
            'alamat'            => ucwords($request->get('alamat')),
            'foto'              => $imgName,
        ]);

        $member->save();

        if ($member->jabatan == 'Siswa') {
            return redirect('/member/siswa')->with('success', 'Anggota baru berhasil ditambahkan!');
        } else {
            return redirect('/member/guru')->with('success', 'Anggota baru berhasil ditambahkan!');
        }

    }

    public function show($id)
    {
        $members = Member::findOrFail($id);
        return view('layouts.member.show', compact('members'));

    }

    public function edit($id)
    {
        $members = Member::findOrFail($id);
        return view('layouts.member.edit', compact('members'));
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'nomor_anggota'     => 'required|unique:members,nomor_anggota,' . $id,
            'nama'              => 'required|string',
            'nomor_identitas'   => 'required|unique:members,nomor_identitas,' . $id,
            'jabatan'           => 'required|string',
            'jurusan_gurumapel' => 'required|string',
            'kelas'             => 'required',
            'jenis_kelamin'     => 'required',
            'tempat_lahir'      => 'required|string',
            'tanggal_lahir'     => 'required|date',
            'alamat'            => 'required|string',
            'foto'              => 'nullable|image|mimes:jpeg,png,jpg|max:2048',
        ]);

        $update = Member::findOrFail($id);

        if ($request->has('foto')) {
            $imgName = $request->foto->getClientOriginalName() . '-' . time()
            . '.' . $request->foto->extension();
            $request->foto->move(public_path('image/members'), $imgName);
        } else {
            $imgName = $request->get('fotobackup');
        }

        $update = Member::findOrFail($id);
        $update->update([
            'nomor_anggota'     => $request->get('nomor_anggota'),
            'nama'              => ucwords($request->get('nama')),
            'nomor_identitas'   => $request->get('nomor_identitas'),
            'jabatan'           => ucwords($request->get('jabatan')),
            'jurusan_gurumapel' => ucwords($request->get('jurusan_gurumapel')),
            'kelas'             => $request->get('kelas'),
            'jenis_kelamin'     => $request->get('jenis_kelamin'),
            'tempat_lahir'      => ucwords($request->get('tempat_lahir')),
            'tanggal_lahir'     => $request->get('tanggal_lahir'),
            'alamat'            => ucwords($request->get('alamat')),
            'foto'              => $imgName,
        ]);

        $update->update();

        if ($update->jabatan == 'Siswa') {
            return redirect('/member/siswa')->with('update', 'Anggota baru berhasil ditambahkan!');
        } else {
            return redirect('/member/guru')->with('update', 'Anggota baru berhasil ditambahkan!');
        }
    }

    public function destroy($id)
    {
        $del = Member::find($id);
        $del->delete();
        return back()->with('delete', 'Data anggota berhasil dihapus');
    }

    //IMPORT
    public function import(Request $request)
    {
        // validasi
        $this->validate($request, [
            'file' => 'required|mimes:csv,xls,xlsx',
        ]);

        // menangkap file excel
        $file = $request->file('file');

        // membuat nama file unik
        $nama_file = rand() . $file->getClientOriginalName();

        // upload ke folder file_siswa di dalam folder public
        $file->move('file_member', $nama_file);

        // import data
        Excel::import(new MemberImport, public_path('/file_member/' . $nama_file));

        // alihkan halaman kembali
        return redirect('/member/siswa')->with('success', 'Data anggota berhasil diimport');
    }
}
