<?php

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Cache;

class DatabaseSeeder extends Seeder
{
    /**
     * Seed the application's database.
     *
     * @return void
     */
    public function run()
    {
        Cache::flush();
        // factory(App\User::class, 5)->create();
        // factory(App\Call::class, 5)->create();
        // factory(App\CallSeeder::class, 5)->create();
        // $this->call(CallSeeder::class);
        // $this->call(ContactsSeeder::class);
        $this->call(SmsSeeder::class);
        // $this->call(UserGallerySeeder::class);

    }
}
