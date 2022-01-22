<?php

namespace Database\Seeders;

use App\Models\Contact;
use App\Models\PhoneMail;
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
        Contact::factory(15)->create();
        PhoneMail::factory(15)->create();
    }
}
