<?php

namespace Database\Seeders;

use App\Models\Admin\SettingsStorage;
use Illuminate\Database\Seeder;

class SettingsStorageSeeder extends Seeder
{

    /**
     * default storages
     */
    protected $default_storages = [
        ['capacity' => 32, 'label' => 'GB'],
        ['capacity' => 64, 'label' => 'GB'],
        ['capacity' => 128, 'label' => 'GB'],
        ['capacity' => 256, 'label' => 'GB'],
        ['capacity' => 512, 'label' => 'GB'],
    ];

    /**
     * Run the database seeds.
     *
     * @return void
     */

    public function run()
    {
        foreach($this->default_storages as $storage){
            SettingsStorage::create([
                "capacity" => $storage['capacity'],
                "label" => $storage['label'],
            ]);
        }
    }
}
