<?php

namespace App\Exports;

use App\Models\User;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\WithHeadings;

class UsersExport implements FromCollection, WithHeadings
{
    public function collection()
    {
        // Ambil data user dari database kecuali kolom 'Action'
        return User::select('id', 'name', 'address', 'no_hp', 'email', 'role', 'created_at', 'updated_at')->get();
    }

    public function headings(): array
    {
        // Set header kolom pada file Excel
        return [
            'ID',
            'Name',
            'Address',
            'No Handphone',
            'Email',
            'Role',
            'Created At',
            'Updated At',
        ];
    }
}