<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;

class AwardSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $data = [
            [
                'name' => 'Gold',
                'description' => 'Gold Award',
                'path_image' => 'gold.png',
                'rules' => json_encode([
                    'member' => 'Gold',
                    'band' => '40M',
                    'qso' => '2',
                    'mode' => 'SSB'
                ])
            ],
            [
                'name' => 'Premium',
                'description' => 'Premium Award',
                'path_image' => 'premium.png',
                'rules' => json_encode([
                    'member' => 'Premium',
                    'band' => '40M',
                    'qso' => '2',
                    'mode' => 'SSB'
                ])
            ],
            [
                'name' => 'Platinum',
                'description' => 'Platinum Award',
                'path_image' => 'platinum.png',
                'rules' => json_encode([
                    'member' => 'Platinum',
                    'band' => '40M',
                    'qso' => '2',
                    'mode' => 'SSB'
                ])
            ],
        ];
        DB::table('awards')->insert($data);
    }
}
