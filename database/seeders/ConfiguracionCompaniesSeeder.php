<?php
namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Company;

class ConfiguracionCompaniesSeeder extends Seeder
{
    public function run()
    {
        Company::create([
            'name' => 'VentasLite',
            'address' => 'Calle Principal, Ciudad',
            'phone' => '123456789',
            'taxpayer_id' => '1231231',
            //'created_at' =>  '2009-01-06 02:40:31',
            //'updated_at' => '2024-03-09 17:26:25'
        ]);
    }
}
