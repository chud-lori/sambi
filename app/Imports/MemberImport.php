<?php

namespace App\Imports;

use App\Member;
use Maatwebsite\Excel\Concerns\ToModel;

class MemberImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Member([
            'nomor_anggota'     => $row[1],
            'nama'              => $row[2],
            'nomor_identitas'   => $row[3],
            'jabatan'           => $row[4],
            'jurusan_gurumapel' => $row[5],
            'kelas'             => $row[6],
            'jenis_kelamin'     => $row[7],
            'tempat_lahir'      => $row[8],
            'tanggal_lahir'     => $row[9],
            'alamat'            => $row[10],
        ]);
    }
}
