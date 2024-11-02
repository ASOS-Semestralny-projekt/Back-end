<?php

namespace Database\Seeders;

use App\Models\Product;
use Illuminate\Database\Seeder;

class ProductSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        Product::create([
            'name' => 'Apple Iphone 14 Pro Max 128GB Deep Purple',
            'description' => 'Mobile phone – 6.7" OLED 2796 × 1290 (120Hz), internal memory 256 GB, single SIM + eSIM, Apple A16 Bionic processor, camera: 48 Mpx (f/1.78) main + 12 Mpx wide-angle + 12 Mpx telephoto lens, front camera 12Mpx, GPS, NFC, LTE, 5G, Lightning port, waterproof according to IP68, fast charging 15W, wireless charging, model 2022, iOS.',
            'category' => 'Phones',
            'price' => 990,
            'quantity' => 20,
            'image' => 'private/products/phones/apple-iphone-14-pro-max-128gb-deep-purple.jpg'
        ]);

        Product::create([
            'name' => 'Samsung Galaxy A35 5G 6 GB/128 GB2 Black',
            'description' => 'Mobile phone - 6.6" AMOLED 2340 × 1080 (120Hz), 6 GB RAM, 128 GB internal memory, hybrid slot, Samsung Exynos 1380 processor, camera: 50 Mpx (f/1.8) main + 8 Mpx USB-C, waterproof according to IP67, fast charging 25W, battery 5000 mAh, model 2024, Android',
            'category' => 'Phones',
            'price' => 299,
            'quantity' => 40,
            'image' => 'private/products/phones/SAMSUNGO0262b3.webp'
        ]);

        Product::create([
            'name' => 'ASUS Vivobook 17 X1704VA-AU179W Quiet Blue',
            'description' => 'Notebook - Intel Core i5 1335U Raptor Lake, 17.3" IPS matte 1920 × 1080, RAM 16GB DDR4, Intel Iris Xe Graphics, SSD 512GB, numeric keyboard, backlit keyboard, webcam, USB 3.2 Gen 1, USB-C, WiFi 5, Bluetooth , weight 2.1 kg, Windows 11 Home',
            'category' => 'Labtops',
            'price' => 669,
            'quantity' => 4,
            'image' => 'private/products/laptops/NA575f31k4.webp'
        ]);

        Product::create([
            'name' => 'MacBook Air 13" M3 SK 2024 Space Gray',
            'description' => 'MacBook - Apple M3 (8-core), 13.6" IPS glossy 2560 × 1664 px, RAM 16GB, Apple M3 10-core GPU, SSD 512GB, backlit keyboard, webcam, USB-C, fingerprint reader, WiFi 6, weight 1.51 kg, macOS',
            'category' => 'Labtops',
            'price' => 1599,
            'quantity' => 2,
            'image' => 'private/products/laptops/NL250b1d1.webp'
        ]);

        Product::create([
            'name' => 'Epson EcoTank L3260',
            'description' => 'Multifunction inkjet printer, color, A4, copy and scan, black and white print speed (ISO) 10 pages/min., color print speed (ISO) 5 pages/min., print resolution 5760 x 1440 DPI, tank system, display, AirPrint, USB and WiFi',
            'category' => 'Printes',
            'price' => 177,
            'quantity' => 12,
            'image' => 'private/products/printers/PE124a23i7.webp'
        ]);
    }
}
