<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        // \App\Models\User::factory(10)->create();
        $this->call(BrandsSeeder::class);
        $this->call(ConfigSeeder::class);
        $this->call(MenusSeeder::class);
        $this->call(PageRowsSeeder::class);
        $this->call(PageSectionsSeeder::class);
        $this->call(PagesSeeder::class);
        $this->call(PageStatisticsSeeder::class);
        $this->call(StatesSeeder::class);
        $this->call(UserSeeder::class);
        $this->call(NetworksSeeder::class);
        $this->call(SettingsStatusSeeder::class);
        $this->call(PageBuildersSeeder::class);
        $this->call(PageMetaTagsSeeder::class);
        $this->call(SMSTemplateSeeder::class);
    }
}
