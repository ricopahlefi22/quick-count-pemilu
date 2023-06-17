<?php

namespace App\Exports;

use App\Models\Voter;
use PhpOffice\PhpSpreadsheet\Style\NumberFormat;
use Maatwebsite\Excel\Concerns\FromCollection;
use Maatwebsite\Excel\Concerns\ShouldAutoSize;
use Maatwebsite\Excel\Concerns\WithHeadings;
use Maatwebsite\Excel\Concerns\WithMapping;
use Maatwebsite\Excel\Concerns\WithColumnFormatting;
use Maatwebsite\Excel\Concerns\WithTitle;

class VotingPlaceVoterExport implements FromCollection, ShouldAutoSize, WithHeadings, WithTitle, WithMapping, WithColumnFormatting
{
    public function __construct(int $votingPlaceId)
    {
        $this->votingPlaceId = $votingPlaceId;
    }

    public function title(): string
    {
        return 'Terdaftar';
    }

    public function columnFormats(): array
    {
        return [
            'A' => NumberFormat::FORMAT_TEXT,
            'B' => NumberFormat::FORMAT_TEXT,
        ];
    }

    public function collection()
    {
        return Voter::where('voting_place_id', $this->votingPlaceId)->whereNotNull('coordinator_id')->orderBy('coordinator_id', 'asc')->orderBy('name', 'asc')->get();
    }

    public function map($voter): array
    {
        return [
            empty($voter->family_card_number) ? '-' : "'" . $voter->family_card_number,
            "'" . $voter->id_number,
            $voter->name,
            empty($voter->birthplace) ? '-' : $voter->birthplace,
            empty($voter->birthday) ? '-' : $voter->birthday,
            empty($voter->gender) ? '-' : $voter->gender,
            empty($voter->marital_status) ? '-' : $voter->marital_status,
            empty($voter->address) ? '-' : $voter->address,
            $voter->district->name,
            $voter->village->name,
            empty($voter->voting_place_id) ? '-' : $voter->votingPlace->name,
            $voter->coordinator->name,
        ];
    }

    public function headings(): array
    {
        return [
            'NO KK',
            'NIK',
            'NAMA LENGKAP',
            'TEMPAT LAHIR',
            'TANGGAL LAHIR',
            'JENIS KELAMIN',
            'STATUS',
            'ALAMAT',
            'KECAMATAN',
            'KELURAHAN',
            'TPS',
            'KOORDINATOR'
        ];
    }
}
