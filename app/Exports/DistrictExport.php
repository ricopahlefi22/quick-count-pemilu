<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class DistrictExport implements WithMultipleSheets
{
    public function __construct(int $district)
    {
        $this->district = $district;
    }

    public function sheets(): array
    {
        $sheets = [
            'Terdaftar' => new DistrictVoterExport($this->district),
            'Tidak Terdaftar' => new DistrictNotVoterExport($this->district),
            'Semua Data' => new DistrictDPTExport($this->district),
        ];

        return $sheets;
    }
}
