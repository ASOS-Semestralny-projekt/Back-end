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
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob1.webp',
            'short_description' => 'Apple Iphone 14 Pro Max',
            'long_description' => 'Mobile phone – 6.7" OLED 2796 × 1290 (120Hz), internal memory 256 GB, single SIM + eSIM, Apple A16 Bionic processor, camera: 48 Mpx (f/1.78) main + 12 Mpx wide-angle + 12 Mpx telephoto lens, front camera 12Mpx, GPS, NFC, LTE, 5G, Lightning port, waterproof according to IP68, fast charging 15W, wireless charging, model 2022, iOS.',
            'price' => 1099.99,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'Samsung Galaxy A35 5G 6 GB/128 GB2 Black',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob2.webp',
            'short_description' => 'Samsung Galaxy A35',
            'long_description' => 'Mobile phone - 6.6" AMOLED 2340 × 1080 (120Hz), 6 GB RAM, 128 GB internal memory, hybrid slot, Samsung Exynos 1380 processor, camera: 50 Mpx (f/1.8) main + 8 Mpx USB-C, waterproof according to IP67, fast charging 25W, battery 5000 mAh, model 2024, Android',
            'price' => 299.90,
            'stock' => 40
        ]);

        Product::create([
            'name' => 'Samsung Galaxy S23 Ultra 256GB Green',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob3.jpg',
            'short_description' => 'Samsung Galaxy S23 Ultra',
            'long_description' => 'Mobile phone – 6.8" AMOLED 3200 × 1440 (120Hz), internal memory 256 GB, dual SIM, Snapdragon 8 Gen 2 processor, camera: 200 Mpx main + 12 Mpx ultra-wide + 10 Mpx telephoto, front camera 40Mpx, GPS, NFC, LTE, 5G, USB-C, waterproof according to IP68, fast charging 45W, wireless charging, model 2023, Android.',
            'price' => 1199.99,
            'stock' => 15
        ]);

        Product::create([
            'name' => 'Google Pixel 8 Pro 128GB Obsidian',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob4.webp',
            'short_description' => 'Google Pixel 8 Pro',
            'long_description' => 'Mobile phone – 6.7" OLED 3120 × 1440 (120Hz), internal memory 128 GB, single SIM, Google Tensor G3 processor, camera: 50 Mpx main + 12 Mpx ultra-wide + 48 Mpx telephoto, front camera 11.1Mpx, GPS, NFC, LTE, 5G, USB-C, waterproof according to IP68, fast charging 30W, wireless charging, model 2023, Android.',
            'price' => 999.99,
            'stock' => 20
        ]);

        Product::create([
            'name' => 'OnePlus 11 5G 256GB Eternal Green',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob5.jpg',
            'short_description' => 'OnePlus 11 5G',
            'long_description' => 'Mobile phone – 6.7" AMOLED 3216 × 1440 (120Hz), internal memory 256 GB, dual SIM, Snapdragon 8 Gen 2 processor, camera: 50 Mpx main + 48 Mpx ultra-wide + 32 Mpx telephoto, front camera 16Mpx, GPS, NFC, LTE, 5G, USB-C, waterproof according to IP68, fast charging 100W, wireless charging, model 2023, Android.',
            'price' => 899.99,
            'stock' => 12
        ]);

        Product::create([
            'name' => 'Sony Xperia 1 V 256GB Black',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob6.jpg',
            'short_description' => 'Sony Xperia 1 V',
            'long_description' => 'Mobile phone – 6.5" OLED 3840 × 1644 (120Hz), internal memory 256 GB, dual SIM, Snapdragon 8 Gen 2 processor, camera: 12 Mpx main + 12 Mpx ultra-wide + 12 Mpx telephoto, front camera 8Mpx, GPS, NFC, LTE, 5G, USB-C, waterproof according to IP68, fast charging 30W, wireless charging, model 2023, Android.',
            'price' => 1099.99,
            'stock' => 8
        ]);

        Product::create([
            'name' => 'Huawei P60 Pro 256GB Rococo Pearl',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob7.webp',
            'short_description' => 'Huawei P60 Pro',
            'long_description' => 'Mobile phone – 6.6" OLED 2700 × 1228 (120Hz), internal memory 256 GB, dual SIM, Snapdragon 8+ Gen 1 processor, camera: 48 Mpx main + 13 Mpx ultra-wide + 48 Mpx telephoto, front camera 13Mpx, GPS, NFC, LTE, 5G, USB-C, waterproof according to IP68, fast charging 88W, wireless charging, model 2023, HarmonyOS.',
            'price' => 1099.99,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'Motorola Edge 40 Pro 256GB Lunar Blue',
            'category_id' => 1,
            'category_name' => 'Mobily',
            'img_path' => 'storage/products/phones/mob8.jpg',
            'short_description' => 'Motorola Edge 40 Pro',
            'long_description' => 'Mobile phone – 6.67" OLED 2400 × 1080 (165Hz), internal memory 256 GB, dual SIM, Snapdragon 8 Gen 2 processor, camera: 50 Mpx main + 50 Mpx ultra-wide + 12 Mpx telephoto, front camera 60Mpx, GPS, NFC, LTE, 5G, USB-C, waterproof according to IP68, fast charging 125W, wireless charging, model 2023, Android.',
            'price' => 899.99,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'ASUS Vivobook 17 X1704VA-AU179W Quiet Blue',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb1.jpg',
            'short_description' => 'ASUS Vivobook 17',
            'long_description' => 'Notebook - Intel Core i5 1335U Raptor Lake, 17.3" IPS matte 1920 × 1080, RAM 16GB DDR4, Intel Iris Xe Graphics, SSD 512GB, numeric keyboard, backlit keyboard, webcam, USB 3.2 Gen 1, USB-C, WiFi 5, Bluetooth , weight 2.1 kg, Windows 11 Home',
            'price' => 669,
            'stock' => 4
        ]);

        Product::create([
            'name' => 'MacBook Air 13" M3 SK 2024 Space Gray',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb2.jfif',
            'short_description' => 'MacBook Air 13"',
            'long_description' => 'MacBook - Apple M3 (8-core), 13.6" IPS glossy 2560 × 1664 px, RAM 16GB, Apple M3 10-core GPU, SSD 512GB, backlit keyboard, webcam, USB-C, fingerprint reader, WiFi 6, weight 1.51 kg, macOS',
            'price' => 1599,
            'stock' => 2
        ]);

        Product::create([
            'name' => 'Dell XPS 15 9520 Silver',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb3.jpg',
            'short_description' => 'Dell XPS 15',
            'long_description' => 'Notebook - Intel Core i7 12700H, 15.6" OLED 3456 × 2160, RAM 16GB DDR5, NVIDIA GeForce RTX 3050 Ti, SSD 1TB, backlit keyboard, webcam, Thunderbolt 4, WiFi 6, Bluetooth, weight 1.8 kg, Windows 11 Pro',
            'price' => 1899,
            'stock' => 5
        ]);

        Product::create([
            'name' => 'HP Spectre x360 14-ea1000nc Nightfall Black',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb4.jfif',
            'short_description' => 'HP Spectre x360',
            'long_description' => 'Convertible Notebook - Intel Core i7 1165G7, 13.5" OLED 3000 × 2000, RAM 16GB DDR4, Intel Iris Xe Graphics, SSD 1TB, backlit keyboard, touchscreen, webcam, Thunderbolt 4, WiFi 6, Bluetooth, weight 1.36 kg, Windows 11 Home',
            'price' => 1599,
            'stock' => 7
        ]);

        Product::create([
            'name' => 'Lenovo ThinkPad X1 Carbon Gen 10 Black',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb5.jpg',
            'short_description' => 'Lenovo ThinkPad X1 Carbon',
            'long_description' => 'Notebook - Intel Core i7 1260P, 14" IPS 1920 × 1200, RAM 16GB LPDDR5, Intel Iris Xe Graphics, SSD 512GB, backlit keyboard, webcam, Thunderbolt 4, WiFi 6E, Bluetooth, weight 1.13 kg, Windows 11 Pro',
            'price' => 1799,
            'stock' => 6
        ]);

        Product::create([
            'name' => 'Apple MacBook Pro 14" M2 Pro Space Gray',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb6.webp',
            'short_description' => 'Apple MacBook Pro 14"',
            'long_description' => 'Notebook - Apple M2 Pro, 14.2" Liquid Retina XDR 3024 × 1964, RAM 16GB, Apple M2 Pro GPU, SSD 512GB, backlit keyboard, webcam, Thunderbolt 4, WiFi 6E, Bluetooth, weight 1.6 kg, macOS',
            'price' => 2499,
            'stock' => 3
        ]);

        Product::create([
            'name' => 'Acer Swift 3 SF314-511-70TU Pure Silver',
            'category_id' => 2,
            'category_name' => 'Notebooky',
            'img_path' => 'storage/products/laptops/ntb7.jfif',
            'short_description' => 'Acer Swift 3',
            'long_description' => 'Notebook - Intel Core i7 1165G7, 14" IPS 1920 × 1080, RAM 16GB LPDDR4X, Intel Iris Xe Graphics, SSD 1TB, backlit keyboard, webcam, USB-C, WiFi 6, Bluetooth, weight 1.2 kg, Windows 11 Home',
            'price' => 999,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'HP LaserJet Pro MFP M428fdw',
            'category_id' => 3,
            'category_name' => 'Tlačiarne',
            'img_path' => 'storage/products/printers/pt1.webp',
            'short_description' => 'HP LaserJet Pro MFP M428fdw',
            'long_description' => 'Multifunction laser printer, monochrome, A4, copy, scan, fax, black and white print speed (ISO) 38 pages/min., print resolution 1200 x 1200 DPI, duplex printing, display, AirPrint, USB, Ethernet, and WiFi',
            'price' => 299,
            'stock' => 8
        ]);

        Product::create([
            'name' => 'Canon PIXMA G6020',
            'category_id' => 3,
            'category_name' => 'Tlačiarne',
            'img_path' => 'storage/products/printers/pt2.webp',
            'short_description' => 'Canon PIXMA G6020',
            'long_description' => 'Multifunction inkjet printer, color, A4, copy and scan, black and white print speed (ISO) 13 pages/min., color print speed (ISO) 6.8 pages/min., print resolution 4800 x 1200 DPI, tank system, display, AirPrint, USB, and WiFi',
            'price' => 229,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'Brother HL-L2350DW',
            'category_id' => 3,
            'category_name' => 'Tlačiarne',
            'img_path' => 'storage/products/printers/pt3.webp',
            'short_description' => 'Brother HL-L2350DW',
            'long_description' => 'Laser printer, monochrome, A4, black and white print speed (ISO) 32 pages/min., print resolution 2400 x 600 DPI, duplex printing, AirPrint, USB, and WiFi',
            'price' => 149,
            'stock' => 15
        ]);

        Product::create([
            'name' => 'Dell UltraSharp U2723QE',
            'category_id' => 4,
            'category_name' => 'Monitory',
            'img_path' => 'storage/products/monitors/mn1.webp',
            'short_description' => 'Dell UltraSharp U2723QE',
            'long_description' => 'Monitor – 27" IPS, 3840 × 2160 (4K UHD), 60Hz, 5ms, 1000:1, 400 cd/m², HDR, USB-C, HDMI, DisplayPort, USB hub, height adjustable, pivot, VESA mount, built-in speakers',
            'price' => 699,
            'stock' => 10
        ]);

        Product::create([
            'name' => 'LG UltraGear 34GN850-B',
            'category_id' => 4,
            'category_name' => 'Monitory',
            'img_path' => 'storage/products/monitors/mn2.webp',
            'short_description' => 'LG UltraGear 34GN850-B',
            'long_description' => 'Monitor – 34" Nano IPS, 3440 × 1440 (UWQHD), 144Hz, 1ms, 1000:1, 400 cd/m², HDR, G-Sync, FreeSync, HDMI, DisplayPort, height adjustable, VESA mount',
            'price' => 899,
            'stock' => 5
        ]);

        Product::create([
            'name' => 'Samsung Odyssey G7 LC32G75TQSNXZA',
            'category_id' => 4,
            'category_name' => 'Monitory',
            'img_path' => 'storage/products/monitors/mn3.webp',
            'short_description' => 'Samsung Odyssey G7',
            'long_description' => 'Monitor – 32" QLED, 2560 × 1440 (QHD), 240Hz, 1ms, 2500:1, 600 cd/m², HDR, G-Sync, FreeSync, HDMI, DisplayPort, height adjustable, VESA mount, curved screen',
            'price' => 799,
            'stock' => 7
        ]);

        Product::create([
            'name' => 'Samsung QN90A Neo QLED 55"',
            'category_id' => 5,
            'category_name' => 'Televízory',
            'img_path' => 'storage/products/tvs/tv1.webp',
            'short_description' => 'Samsung QN90A Neo QLED',
            'long_description' => 'Televízor – 55" Neo QLED, 4K UHD (3840 × 2160), 120Hz, HDR10+, Quantum Processor 4K, Tizen OS, HDMI, USB, WiFi, Bluetooth, Smart TV, voice control, VESA mount',
            'price' => 1299,
            'stock' => 7
        ]);

        Product::create([
            'name' => 'LG OLED evo"',
            'category_id' => 5,
            'category_name' => 'Televízory',
            'img_path' => 'storage/products/tvs/tv2.webp',
            'short_description' => 'LG OLED C1',
            'long_description' => 'Televízor – 65" OLED, 4K UHD (3840 × 2160), 120Hz, HDR10, Dolby Vision, α9 Gen 4 AI Processor 4K, webOS, HDMI, USB, WiFi, Bluetooth, Smart TV, voice control, VESA mount',
            'price' => 1999,
            'stock' => 5
        ]);

        Product::create([
            'name' => 'Sony Bravia XR A80J 77"',
            'category_id' => 5,
            'category_name' => 'Televízory',
            'img_path' => 'storage/products/tvs/tv3.webp',
            'short_description' => 'Sony Bravia XR A80J',
            'long_description' => 'Televízor – 77" OLED, 4K UHD (3840 × 2160), 120Hz, HDR10, Dolby Vision, Cognitive Processor XR, Google TV, HDMI, USB, WiFi, Bluetooth, Smart TV, voice control, VESA mount',
            'price' => 2999,
            'stock' => 3
        ]);

        Product::create([
            'name' => 'Philips 55PUS8506/12 55"',
            'category_id' => 5,
            'category_name' => 'Televízory',
            'img_path' => 'storage/products/tvs/tv4.webp',
            'short_description' => 'Philips 55PUS8506/12',
            'long_description' => 'Televízor – 55" LED, 4K UHD (3840 × 2160), 60Hz, HDR10+, P5 Perfect Picture Engine, Android TV, HDMI, USB, WiFi, Bluetooth, Smart TV, voice control, Ambilight, VESA mount',
            'price' => 899,
            'stock' => 10
        ]);
    }
}
