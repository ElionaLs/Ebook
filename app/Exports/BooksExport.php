<?php

namespace App\Exports;

use App\Models\Buku;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class BooksExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data user dari database kecuali kolom 'Action'
        return Buku::select('id', 'title', 'writer', 'publisher', 'isbn', 'category', 'synopsis', 'cover')->get();
    }

    public function headings(): array
    {
        // Set header kolom pada file Excel
        return [
            'ID',
            'Title',
            'Writer',
            'Publisher',
            'Ssbn',
            'Category',
            'Synopsis',
            'Cover',
        ];
    }
}