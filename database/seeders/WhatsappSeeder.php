<?php

namespace Database\Seeders;

use App\Models\Data\Whatsapp;
use App\Models\Data\WhatsappGroup;
use Haruncpi\LaravelIdGenerator\IdGenerator;
use Illuminate\Database\Seeder;

class WhatsappSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        $id = IdGenerator::generate(['table' => 'whatsapps', 'field' => 'uid', 'length' => 6, 'prefix' => 'WA']);
        Whatsapp::create([
            'uid' => $id,
            'code' => 'whatsapp',
            'name' => 'Whatsapp Admin',
            'server' => '103.169.188.27:8001',
            'phone' => '6285155099250',
        ]);
        WhatsappGroup::create([
            'uid' => IdGenerator::generate(['table' => 'whatsapp_groups', 'field' => 'uid', 'length' => 6, 'prefix' => 'WG']),
            'code' => '120363025022516437@g.us',
            'name' => 'App Group',
            'status' => '1',
        ]);
    }
}
