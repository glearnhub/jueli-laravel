<?php

namespace Database\Seeders;

use App\Models\Service;
use App\Models\ServiceHeroSlide;
use Illuminate\Database\Seeder;

class ServicesSeeder extends Seeder
{
    public function run(): void
    {
        if (ServiceHeroSlide::count() === 0) {
            $slides = [
                ['title' => 'Our Vision', 'description' => 'Delivering high-quality mechanical services and steel fabrication for industrial and commercial projects.', 'image' => 'img/steel_tower.jpeg'],
                ['title' => 'Mission Statement', 'description' => 'To offer exceptional, innovative, and dependable engineering services.', 'image' => 'img/bg_2.jpg'],
                ['title' => 'Core Values', 'description' => 'Integrity, Excellence, Innovation, Customer Centricity.', 'image' => 'img/bg_3.jpg'],
            ];

            foreach ($slides as $order => $slide) {
                ServiceHeroSlide::create($slide + ['sort_order' => $order + 1, 'status' => 'active']);
            }
        }

        if (Service::count() === 0) {
            $services = [
                ['title' => 'Mechanical Services', 'description' => 'Design, installation, and ongoing maintenance of mechanical systems for various applications.', 'image' => 'img/mechanic_service.jpg'],
                ['title' => 'Steel Structure Design & Fabrication', 'description' => 'Providing top-quality steel structures tailored for residential, commercial, and industrial applications.', 'image' => 'img/fabrication.jpg'],
                ['title' => 'HVAC Systems', 'description' => 'Delivering energy-efficient heating, ventilation, and air conditioning systems for all building types.', 'image' => 'img/hvac.jpg'],
                ['title' => 'Plumbing & Piping Solutions', 'description' => 'Comprehensive installation and maintenance of plumbing and piping systems for water, gas, and waste.', 'image' => 'img/plumbing.jpg'],
                ['title' => 'Welding & MIG Fabrication', 'description' => 'Specializing in precision welding for construction and heavy-duty applications.', 'image' => 'img/welding.jpg'],
                ['title' => 'Lift Installation Services', 'description' => 'Complete lift design, installation, and maintenance for residential and commercial buildings.', 'image' => 'img/lift.jpg'],
            ];

            foreach ($services as $order => $service) {
                Service::create($service + ['sort_order' => $order + 1, 'status' => 'active']);
            }
        }
    }
}
