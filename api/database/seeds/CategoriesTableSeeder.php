<?php

use Illuminate\Database\Seeder;
use App\Category;

class CategoriesTableSeeder extends Seeder
{
    private $categories = [
        "Add-on Cards",
        "Cables and Adapters",
        "Casings and Power Supplies",
        "CD/DVD-R/RW Drives",
        "Cooling Devices",
        "Desktops Systems",
        "Digital Media Players",
        "Digital and Web Cameras",
        "Game Consoles",
        "Game Controllers",
        "Games and Software",
        "Graphics Cards",
        "Hard Disk Drives",
        "IT Books and References",
        "LAN and Net Devices",
        "Laptops and PDAs",
        "Laptops/PDA Accessories/Parts",
        "Media Players",
        "Memory Modules",
        "Mice, Keyboards",
        "Monitors, CRT/LCD ",
        "Motherboards",
        "Multiple Items/Combos",
        "Portable Media Drives",
        "Portable Media and Storage",
        "Printers /Scanners",
        "Printers Inks/CIS/Toner",
        "Processors",
        "Repair Services PC/Laptop",
        "Sound Cards",
        "Speakers, Headsets, Mics",
        "Tech/IT Services",
        "UPS and AVRs",
        "Other PC Devices",
        "Smartphones"
    ];
    
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {
        Category::truncate();

        foreach ($this->categories as $categories) {
            Category::create([
                'name' => $categories
            ]);
        }
    }
}
