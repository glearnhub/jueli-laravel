<?php

namespace Database\Seeders;

use App\Models\ContactMessage;
use App\Models\Leader;
use App\Models\Product;
use App\Models\ProductCategory;
use App\Models\Role;
use App\Models\Setting;
use App\Models\User;
use Illuminate\Database\Seeder;

class DatabaseSeeder extends Seeder
{
    public function run(): void
    {
        $this->call(RolePermissionSeeder::class);

        $superAdminRole = Role::where('slug', 'super-admin')->first();

        User::create([
            'name' => 'Admin',
            'email' => 'admin@jueli.test',
            'password' => 'password',
            'role_id' => $superAdminRole->id,
        ]);

        $settings = [
            'site_name' => 'Jueli Engineering Ltd',
            'contact_email' => 'info@jueliengineeringltd.co.ke',
            'contact_phone' => '+254 704 553 400',
            'contact_address' => '15976-00100, Nairobi Industrial Area, Kenya',
            'facebook_url' => '',
            'twitter_url' => '',
            'linkedin_url' => '',
            'instagram_url' => '',
        ];

        foreach ($settings as $key => $value) {
            Setting::create(['key' => $key, 'value' => $value]);
        }

        $mechanical = ProductCategory::create([
            'category_name' => 'Mechanical & Cutting Tools',
            'description' => 'Cutting tools, sprinklers, and general mechanical equipment for industrial and commercial use.',
            'picture' => 'categories/mechanical.png',
            'status' => 'active',
        ]);

        $agricultural = ProductCategory::create([
            'category_name' => 'Agricultural Implements',
            'description' => 'Hand tools and implements for farm, garden, and landscaping work.',
            'picture' => 'categories/agricultural.jpg',
            'status' => 'active',
        ]);

        $hardware = ProductCategory::create([
            'category_name' => 'Hardware & Fasteners',
            'description' => 'Bolts, wheels, and other hardware components for construction and fabrication.',
            'picture' => 'categories/hardware.jpg',
            'status' => 'active',
        ]);

        $cleaning = ProductCategory::create([
            'category_name' => 'Cleaning Equipment',
            'description' => 'Tools and equipment for site cleaning and maintenance.',
            'picture' => 'categories/cleaning.jpg',
            'status' => 'draft',
        ]);

        $products = [
            ['category_id' => $mechanical->id, 'product_name' => 'Rossel Sprinkler', 'product_description' => 'Durable garden sprinkler for irrigation projects.', 'product_picture' => 'products/sprinkler-rossel.jpg', 'price' => 1250.00, 'status' => 'active', 'is_featured' => true],
            ['category_id' => $agricultural->id, 'product_name' => 'Metal Hedge Shear 10"', 'product_description' => 'Heavy-duty hedge shear with a metal handle for landscaping work.', 'product_picture' => 'products/hedge-shear.jpg', 'price' => 950.00, 'status' => 'active', 'is_featured' => true],
            ['category_id' => $hardware->id, 'product_name' => 'Castor Wheels', 'product_description' => 'Industrial-grade castor wheels for trolleys and equipment.', 'product_picture' => 'products/castor-wheels.jpg', 'price' => 600.00, 'status' => 'active', 'is_featured' => false],
            ['category_id' => $agricultural->id, 'product_name' => 'Agricultural Hand Tool', 'product_description' => 'General-purpose hand tool for farm and garden use.', 'product_picture' => 'products/agri-tool.png', 'price' => 480.00, 'status' => 'inactive', 'is_featured' => false],
            ['category_id' => $hardware->id, 'product_name' => 'Assorted Bolts', 'product_description' => 'Mixed sizes of galvanized bolts for construction and fabrication.', 'product_picture' => 'products/bolts.jpg', 'price' => 320.00, 'status' => 'active', 'is_featured' => true],
            ['category_id' => $mechanical->id, 'product_name' => 'Plumbing Accessories Kit', 'product_description' => 'Fittings and accessories for residential and commercial plumbing.', 'product_picture' => 'products/plumbing-accessories.jpg', 'price' => 2100.00, 'status' => 'active', 'is_featured' => false],
            ['category_id' => $mechanical->id, 'product_name' => 'Roofing Screws', 'product_description' => 'Corrosion-resistant screws for roofing sheet installation.', 'product_picture' => 'products/roofing-screws.jpg', 'price' => 150.00, 'status' => 'draft', 'is_featured' => false],
            ['category_id' => $cleaning->id, 'product_name' => 'Construction Tool Set', 'product_description' => 'Essential tool set for site construction and maintenance work.', 'product_picture' => 'products/construction-tools.jpg', 'price' => 3400.00, 'status' => 'archived', 'is_featured' => true],
        ];

        foreach ($products as $product) {
            Product::create($product);
        }

        $leaders = [
            ['fullname' => 'Eliud Kiprotich', 'position' => 'Chief Executive Officer', 'department' => 'Executive', 'phone_number' => '+254704553400', 'email' => 'eliud@jueliengineeringltd.co.ke', 'profile_picture' => 'leaders/ceo.jpg', 'status' => 'active'],
            ['fullname' => 'Judy Wanjiru', 'position' => 'Operations Manager', 'department' => 'Operations', 'phone_number' => '+254700000001', 'email' => 'judy@jueliengineeringltd.co.ke', 'profile_picture' => 'leaders/leader-2.jpg', 'status' => 'active'],
            ['fullname' => 'Peter Mwangi', 'position' => 'Head of Engineering', 'department' => 'Engineering', 'phone_number' => '+254700000002', 'email' => 'peter@jueliengineeringltd.co.ke', 'profile_picture' => 'leaders/leader-3.jpg', 'status' => 'active'],
        ];

        foreach ($leaders as $leader) {
            Leader::create($leader);
        }

        ContactMessage::create([
            'name' => 'John Doe',
            'email' => 'john.doe@example.com',
            'subject' => 'Quote for steel fabrication',
            'message' => "Hi, I'd like a quote for a steel structure fabrication project. Can someone get back to me?",
        ]);

        ContactMessage::create([
            'name' => 'Mary Achieng',
            'email' => 'mary.a@example.com',
            'subject' => 'HVAC installation inquiry',
            'message' => 'We are looking for HVAC installation services for a new commercial building in Nairobi. Please advise on availability.',
        ]);
    }
}
