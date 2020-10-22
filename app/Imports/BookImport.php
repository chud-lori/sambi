<?php

namespace App\Imports;

use App\Book;
use Maatwebsite\Excel\Concerns\ToModel;

class BookImport implements ToModel
{
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    public function model(array $row)
    {
        return new Book([
            'inventaris'     => $row[1],
            'tanggal_terima' => $row[2],
            'judul'          => $row[3],
            'pengarang'      => $row[4],
            'penerbit'       => $row[5],
            'tahun_terbit'   => $row[6],
            'semester'       => $row[7],
            'kelas'          => $row[8],
            'asal'           => $row[9],
            'harga'          => $row[10],
            'callnumber'     => $row[11],
            'isbn'           => $row[12],
            'deskripsi'      => $row[13],
            'categories_id'  => $row[14],
        ]);
    }
}
