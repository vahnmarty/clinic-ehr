<?php

namespace Database\Seeders;

use App\Models\MedicalCode;
use Illuminate\Database\Seeder;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;

class MedicalCodesTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $source_file = public_path() . '/data/icd-10-codes.csv';

        $row = 0;
        if (($handle = fopen($source_file, "r")) !== FALSE) {
            while (($data = fgetcsv($handle, 1000, ",")) !== FALSE) {
                $num = count($data);

                MedicalCode::updateOrCreate(
                    [   'code3' => $data[2] ],
                    [
                        'code1' => $data[0],
                        'code2' => $data[1],
                        'description1' => $data[3],
                        'description2' => $data[4],
                        'description3' => $data[5],
                    ]);
                
            }
            fclose($handle);
        }
    }
}
