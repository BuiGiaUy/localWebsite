<?php

namespace Database\Seeders;

use App\Models\Room;
use Illuminate\Database\Console\Seeds\WithoutModelEvents;
use Illuminate\Database\Seeder;

class RoomsTableSeeder extends Seeder
{
    /**
     * Run the database seeds.
     */
    public function run()
    {
        // Thêm dữ liệu mẫu vào bảng rooms
        Room::create([
            'name' => 'Phòng 1',
            'icon' => 'icon1.png',
            'description' => 'Mô tả phòng 1',
            'owner_id' => 1, // ID của chủ phòng
        ]);

        Room::create([
            'name' => 'Phòng 2',
            'icon' => 'icon2.png',
            'description' => 'Mô tả phòng 2',
            'owner_id' => 2, // ID của chủ phòng
        ]);

        // Thêm thêm dữ liệu nếu cần
    }
}
