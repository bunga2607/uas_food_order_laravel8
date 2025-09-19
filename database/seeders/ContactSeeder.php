<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use App\Models\Contact;

class ContactSeeder extends Seeder
{
    public function run()
    {
        Contact::create([
            'phone' => '081234567890',
            'email' => 'admin@levia.com',
            'bank_account' => '1234567890 - BCA a.n Admin Levia',
        ]);
    }
}
