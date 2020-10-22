<?php

namespace App\Imports;

use App\Book;
use App\Category;
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
            'isbn'           => $row[12],
            'callnumber'     => $row[13],
            'deskripsi'      => $row[11],
            'categories_id'  => Category::where('kategori', 'like', $row[14])->exists() ? Category::where('kategori', 'like', $row[14])->first()->id : 1,
        ]);
    }
}
