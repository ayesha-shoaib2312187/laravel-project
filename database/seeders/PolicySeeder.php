<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Str;

class PolicySeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $policies = [
            [
                'title' => 'Privacy Policy',
                'type' => 'Legal',
                'content' => '<h1>Privacy Policy</h1><p>We value your privacy. This policy describes how we collect and use your data...</p>',
            ],
            [
                'title' => 'Terms of Service',
                'type' => 'Legal',
                'content' => '<h1>Terms of Service</h1><p>By using our website, you agree to the following terms and conditions...</p>',
            ],
            [
                'title' => 'Refund Policy',
                'type' => 'Info',
                'content' => '<h1>Refund Policy</h1><p>We offer a 30-day money-back guarantee on all products...</p>',
            ],
            [
                'title' => 'Shipping Policy',
                'type' => 'Info',
                'content' => '<h1>Shipping Information</h1><p>We ship worldwide. Standard shipping takes 3-5 business days...</p>',
            ],
            [
                'title' => 'About Us',
                'type' => 'Page',
                'content' => '<h1>About Us</h1><p>Welcome to Frolic Stitch! We are passionate about creating beautiful designs...</p>',
            ],
        ];

        foreach ($policies as $policy) {
            DB::table('policies')->insert([
                'title' => $policy['title'],
                'type' => $policy['type'],
                'slug' => Str::slug($policy['title']),
                'content' => $policy['content'],
                'updated_date' => now(),
                'created_at' => now(),
                'updated_at' => now(),
            ]);
        }
    }
}
