<?php

namespace Database\Seeders;

use App\Models\Organisation;
use App\Models\Team;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        $this->organisationsAndTeams();
    }

    protected function organisationsAndTeams()
    {
        // an array of organisation and teams
        $data = [
            'Ministry of Justice HQ' => [
                'Central Digital',
                'DEX - Engage',
                'DEX - Uhura',
                'DEX - Voyager',
                'HMCTS Partnership',
                'JotW - Digital Accessibility Team',
                'JotW - MoJ Forms',
                'JotW - Websites and Content',
                'Platforms and Architecture',
                'Product Management - Workplace Technology',
                'UCPD - Prisons Team',
                'UCPD - Access to Justice and Family Justice Team',
                'UCPD - Cross-justice Delivery Team',
                'UCPD - Prison Leavers Programme',
                'UCPD - Youth Justice & Vulnerable Offenders Team',
                'User Research',
                'Staff Services',
                'Shared Services Programme Digital Team'
            ],
            'Legal Aid Agency' => [
                'LAA Digital',
                'Get Access',
                'Service Operation'
            ],
            'HM Prison and Probation Service' => [
                'Digital & Change Directorate',
                'DevOps',
                'Digital'
            ],
            'HM Courts and Tribunals Service' => [
                'Digital and Technology Services',
                'Crime Digital Change',
                'Digital Operations'
            ],
            'Office of the Public Guardian' => [
                'OPG Digital'
            ]
        ];

        foreach ($data as $organisation => $teams) {
            $the_org = Organisation::create(['name' => $organisation, 'slug' => Str::slug($organisation)]);
            foreach($teams as $team) {
                Team::create([
                    'name' => $team,
                    'slug' => Str::slug($team),
                    'organisation_id' => $the_org->id
                ]);
            }
        }
    }
}
