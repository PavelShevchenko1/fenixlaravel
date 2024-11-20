<?php

namespace Database\Seeders;

use App\Models\FxStore;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\Http;

class FxStoresSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run(): void
    {
        $stores = [
            [
                "image" => "https://static.tildacdn.com/tild3465-6161-4739-a333-663134646662/photo.jpg",
                "uptitle" => null,
                "title" => "Дуси Ковальчук, 394",
                "phone" => "+7 (383) 2-000-193",
                "hours" => "с 10.00 до 22.00",
                "weekend_plan" => "Без выходных",
                "geo" => "55.064593, 82.926586"
            ],
            [
                "image" => "https://static.tildacdn.com/tild3539-6332-4435-b663-383533653738/photo.jpg",
                "uptitle" => null,
                "title" => "Ленина, 94",
                "phone" => "+7 (383) 381-43-90",
                "hours" => "с 10.00 до 22.00",
                "weekend_plan" => "Без выходных",
                "geo" => "55.038953, 82.896523"
            ],
            [
                "image" => "https://static.tildacdn.com/tild3739-3065-4633-b866-613336346232/noroot.png",
                "uptitle" => null,
                "title" => "ул. Блюхера, 4",
                "phone" => "+7 (953) 888-60-95",
                "hours" => "с 10.00 до 00.00",
                "weekend_plan" => "Без выходных",
                "geo" => "54.985717, 82.893873"
            ],
            [
                "image" => "https://static.tildacdn.com/tild3961-6438-4266-a462-383764316431/_WhatsApp_2023-10-26.jpg",
                "uptitle" => null,
                "title" => "Первомайская, 236",
                "phone" => "+7(913) 397‒68‒88",
                "hours" => "с 10:00 до 02:00",
                "weekend_plan" => "Без выходных",
                "geo" => "54.977436, 83.047918"
            ],
            [
                "image" => "https://static.tildacdn.com/tild3462-3361-4139-a631-373464396537/WhatsApp_Image_2022-.jpeg",
                "uptitle" => "Фирменный отдел в магазине \"Светлое и Темное\"",
                "title" => "ул. Гаранина, 29",
                "phone" => "+7 (923) 190-64-67",
                "hours" => "Пн-Чт, Вс 09.00 до 22.00\nПт-Сб 09.00 до 00.00",
                "weekend_plan" => "Без выходных",
                "geo" => null
            ],
            [
                "image" => "https://static.tildacdn.com/tild6438-3464-4634-a334-356463633463/WhatsApp_Image_2021-.jpeg",
                "uptitle" => "Фирменный отдел в магазине \"Светлое и Темное\"",
                "title" => "Красина 51",
                "phone" => "+7 (923) 148-77-65",
                "hours" => "Вс.-Чт. с 10.00 до 23.00\nПт.-Сб. с 10.00 до 24.00",
                "weekend_plan" => "Без выходных",
                "geo" => "55.046757, 82.961492"
            ],
            [
                "image" => "https://static.tildacdn.com/tild6338-3835-4237-b338-646433356432/WhatsApp_Image_2022-.jpeg",
                "uptitle" => "Фирменный отдел в магазине \"Светлое и Темное\"",
                "title" => "Варшавская, 15",
                "phone" => "+7 (923) 148-77-65",
                "hours" => "Вс.-Чт. с 09.00 до 22.00\nПт.-Сб. с 09.00 до 23.00",
                "weekend_plan" => "Без выходных",
                "geo" => null
            ]
        ];


        
        foreach ($stores as $store) {
            $imageContents = Http::get($store['image'])->body();
            $imageName = basename($store['image']);
            $uniqueString = uniqid();
            $imageName = $uniqueString . '_' . basename($store['image']);
            Storage::disk('public')->put('uploads/stores/' . $imageName, $imageContents);

            FxStore::create([
                'image' => 'public/uploads/stores/' . $imageName,
                'uptitle' => $store['uptitle'],
                'title' => $store['title'],
                'phone' => $store['phone'],
                'hours' => $store['hours'],
                'geo' => $store['geo'],
                'weekend_plan' => $store['weekend_plan']
            ]);
        }
    }
}
