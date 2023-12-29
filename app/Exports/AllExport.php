<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class AllExport implements WithMultipleSheets
{
    public function sheets(): array
    {
        $sheets = [
            'Terdaftar' => new AllVoterExport(),
            // 'Tidak Terdaftar' => new AllNotVoterExport(),
            // 'Semua Data' => new AllDPTExport(),
        ];

        return $sheets;
    }
}
