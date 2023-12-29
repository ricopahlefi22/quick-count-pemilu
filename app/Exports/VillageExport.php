<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class VillageExport implements WithMultipleSheets
{
    public function __construct(int $village)
    {
        $this->village = $village;
    }

    public function sheets(): array
    {
        $sheets = [
            'Terdaftar' => new VillageVoterExport($this->village),
            'Tidak Terdaftar' => new VillageNotVoterExport($this->village),
            // 'Semua Data' => new VillageDPTExport($this->village),
        ];

        return $sheets;
    }
}
