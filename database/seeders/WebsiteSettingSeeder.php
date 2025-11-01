<?php

namespace Database\Seeders;

use App\Models\WebsiteSetting;
use Illuminate\Database\Seeder;

class WebsiteSettingSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        //
        WebsiteSetting::create([
            'logo' => 'logo',
            'company_name' => 'Inaya Trims',
            'head_address' => 'Sector#6, Road#02, House#05, Mirpur, Dhaka-1216, Bangladesh',
            'china_address' => 'Sector#6, Road#02, House#05, Mirpur, Dhaka-1216, Bangladesh',
            'factory_address' => 'Sector#6, Road#02, House#05, Mirpur, Dhaka-1216, Bangladesh',
            'phone' => '+8801XXXXXXXXX',
            'email' => 'info@inayatrims.com',
            'contact_notification_email' => 'info@inayatrims.com',
        ]);
    }
}
