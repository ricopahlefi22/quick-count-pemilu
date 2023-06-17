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
    /**
     * @param array $row
     *
     * @return \Illuminate\Database\Eloquent\Model|null
     */
    private $rows = 0;
    private $location = ' ';

    public function model(array $row)
    {
        ++$this->rows;
        $date_normalize = str_replace('|', '-', $row['tanggal_lahir']);
        $create_date = date_create($date_normalize);

        $district = District::where('name', 'LIKE', '%' . $row['kecamatan'] . '%')->first();
        $village = Village::where('name', 'LIKE', '%' . $row['kelurahan'] . '%')->first();

        $voting_place = VotingPlace::where('village_id', $village->id)->where('name', $row['tps'])->first();

        $this->location = $village->name. ' TPS '.$voting_place->name;

        return new Voter([
            'name' => ucwords(strtolower($row['nama_lengkap'])),
            'id_number' => $row['nik'],
            'family_card_number' => $row['no_kk'],
            'address' => ucwords(strtolower($row['alamat'])),
            'rt' => $row['rt'],
            'rw' => $row['rw'],
            'birthplace' => ucwords(strtolower($row['tempat_lahir'])),
            'birthday' => date_format($create_date, 'Y-m-d'),
            'marital_status' => $row['status'],
            'gender' => $row['jenis_kelamin'],
            'district_id' => $district->id,
            'village_id' => $village->id,
            'voting_place_id' => $voting_place->id,
        ]);
    }

    public function rules(): array
    {
        return [
            'nama_lengkap' => 'required',
            'nik' => 'required|unique:voters,id_number,NULL,id,deleted_at,NULL|min:16',
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
