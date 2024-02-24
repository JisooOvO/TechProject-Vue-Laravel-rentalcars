<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('reservations', function (Blueprint $table) {
            $table -> increments('id') -> unique();
            $table -> integer('user_id') -> unsigned() -> required();
            $table -> integer('car_id') -> unsigned() -> required();
            $table -> date('start_at') -> required();
            $table -> date('end_at') -> required();
            $table -> enum('reservation_status', ['canceled', 'used', 'reserved', 'overdue', 'done'] ) -> required();
            $table -> integer('rental_fee') -> unsigned() -> required();
            $table -> string('additional_information') -> nullable();
            $table -> timestamps();

            $table -> foreign('car_id') -> references('id') -> on('cars');
        });

        DB::table('reservations') -> insert([
            'user_id' => '1',
            'car_id' => '1',
            'start_at' => '2024-02-23',
            'end_at' => '2024-03-10',
            'reservation_status' => 'used',
            'rental_fee' => "480000",
            "additional_information" => "제주도 여행",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations') -> insert([
            'user_id' => '5',
            'car_id' => '1',
            'start_at' => '2024-03-07',
            'end_at' => '2024-03-09',
            'reservation_status' => 'reserved',
            'rental_fee' => "103500",
            "additional_information" => "강원도 여행",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations') -> insert([
            'user_id' => '2',
            'car_id' => '2',
            'start_at' => '2024-02-23',
            'end_at' => '2024-03-12',
            'reservation_status' => 'used',
            'rental_fee' => "540000",
            "additional_information" => "서울 여행",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations') -> insert([
            'user_id' => '3',
            'car_id' => '2',
            'start_at' => '2024-03-10',
            'end_at' => '2024-03-11',
            'reservation_status' => 'reserved',
            'rental_fee' => "69000",
            "additional_information" => "서울 여행",
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('reservations') -> insert([
            'user_id' => '4',
            'car_id' => '2',
            'start_at' => '2024-03-15',
            'end_at' => '2024-03-16',
            'reservation_status' => 'reserved',
            'rental_fee' => "69000",
            "additional_information" => "서울 여행",
            'created_at' => now(),
            'updated_at' => now(),
        ]);


    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('reservations');
    }
};
