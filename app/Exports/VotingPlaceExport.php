<?php

namespace App\Exports;

use Maatwebsite\Excel\Concerns\WithMultipleSheets;

class VotingPlaceExport implements WithMultipleSheets
{
    public function __construct(int $tps)
    {
        $this->tps = $tps;
    }

    public function sheets(): array
    {
        $sheets = [
            'Terdaftar' => new VotingPlaceVoterExport($this->tps),
            'Tidak Terdaftar' => new VotingPlaceNotVoterExport($this->tps),
            'Semua Data' => new VotingPlaceDPTExport($this->tps),
        ];

        return $sheets;
    }
}
