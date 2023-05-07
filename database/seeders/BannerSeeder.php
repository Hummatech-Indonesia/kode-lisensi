<?php

namespace Database\Seeders;

use App\Models\Banner;
use Illuminate\Database\Seeder;

class BannerSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Banner::query()
            ->create([
                'first_offer' => '50% special offer',
                'first_title' => 'Chocolate Shake Back in Stock',
                'first_description' => 'Offer Of the Week!',
                'first_product_url' => 'https://127.0.0.1:8000/products',
                'first_image' => 'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80',
                'second_offer' => 'Special hot sale',
                'second_title' => 'Healthy & Fresh Cool Breakfast',
                'second_description' => 'Choose a Nutritious & Healthy Breakfast.',
                'second_product_url' => 'https://127.0.0.1:8000/products',
                'second_image' => 'https://images.unsplash.com/photo-1508739773434-c26b3d09e071?ixlib=rb-4.0.3&ixid=MnwxMjA3fDB8MHxwaG90by1wYWdlfHx8fGVufDB8fHx8&auto=format&fit=crop&w=1170&q=80'
            ]);
    }
}
