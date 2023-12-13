<?php

namespace App\Imports;

use App\Models\District;
use App\Models\Village;
use App\Models\Voter;
use App\Models\VotingPlace;
use Maatwebsite\Excel\Concerns\Importable;
use Maatwebsite\Excel\Concerns\SkipsOnFailure;
use Maatwebsite\Excel\Concerns\SkipsFailures;
use Maatwebsite\Excel\Concerns\ToModel;
use Maatwebsite\Excel\Concerns\WithHeadingRow;
use Maatwebsite\Excel\Concerns\WithValidation;

class VoterImport implements ToModel, WithHeadingRow, WithValidation, SkipsOnFailure
{
    use Importable, SkipsFailures;

    private $rows = 0;
    private $location = ' ';

    public function model(array $row)
    {
        ++$this->rows;
        $district = District::where('name', $row['kecamatan'])->first();
        $village = Village::where('name', $row['kelurahan'])->first();

        $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $row['tps'])->first();

        $this->location = $village->name . ' TPS ' . $voting_place->name;

        return new Voter([
            'name' => ucwords(strtolower($row['nama'])),
            'rt' => (strlen($row['rt']) != 2) ? '00' . $row['rt'] : '0' . $row['rt'],
            'rw' => (strlen($row['rw']) != 2) ? '00' . $row['rw'] : '0' . $row['rw'],
            'age' => $row['usia'],
            'gender' => $row['jenis_kelamin'],
            'district_id' => $district->id,
            'village_id' => $village->id,
            'voting_place_id' => $voting_place->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama' => 'required',
            'jenis_kelamin' => 'required',
            'usia' => 'required',
            'rt' => 'required',
            'rw' => 'required',
            'kecamatan' => 'required',
            'kelurahan' => 'required',
            'tps' => 'required',
        ];
    }

    public function getRowCount(): int
    {
        return $this->rows;
    }

    public function getLocation()
    {
        return $this->location;
    }
}
