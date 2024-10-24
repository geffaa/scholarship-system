<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Scholarship;

class ScholarshipSeeder extends Seeder
{
    public function run()
    {
        $scholarships = [
            [
                'name' => 'Beasiswa Akademik',
                'requirements' => 'IPK minimal 3.0, aktif dalam kegiatan akademik, mengikuti lomba akademik',
                'type' => 'academic'
            ],
            [
                'name' => 'Beasiswa Non-Akademik',
                'requirements' => 'IPK minimal 3.0, memiliki prestasi di bidang olahraga/seni/budaya, aktif dalam organisasi kampus',
                'type' => 'non-academic'
            ],
            [
                'name' => 'Beasiswa Penelitian',
                'requirements' => 'IPK minimal 3.0, memiliki proposal penelitian, rekomendasi dari dosen',
                'type' => 'research'
            ]
        ];

        foreach ($scholarships as $scholarship) {
            Scholarship::create($scholarship);
        }
    }
}