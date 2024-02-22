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
        Schema::create('cars', function (Blueprint $table) {
            $table -> increments('id') -> unique();
            $table -> string('name',255) -> required();
            $table -> integer('brand_id') -> unsigned();
            $table -> string('model_name') -> nullable();
            $table -> string('image_name') -> nullable();
            $table -> string('image_path') -> nullable();
            $table -> integer('type_id') -> unsigned() -> required();
            $table -> integer('year') -> unsigned() -> nullable();
            $table -> integer('fuel_id') -> unsigned() -> required();
            $table -> integer('seater') -> unsigned() -> nullable();
            $table -> longText('option') -> nullable();
            $table -> integer('age_limit') -> unsigned() -> required();
            $table -> integer('experience_limit') -> unsigned() -> required();
            $table -> integer('rental_fee') -> unsinged() -> required();
            $table -> integer('total_quantity') -> unsigned() -> default(0);
            $table -> integer('available_quantity') -> unsigned() -> default(0);
            $table -> timestamps();

            $table -> foreign('brand_id') -> references('id') -> on('brands');
            $table -> foreign('type_id') -> references('id') -> on('types');
            $table -> foreign('fuel_id') -> references('id') -> on('fuels');
        });
 
        DB::table('cars') -> insert([
            'name' => '모닝',
            'model_name' => '더 뉴 모닝',
            'image_path' => '/images/kia-morning.png',
            'image_name' => '더 뉴 모닝 사진',
            'year' => '2023',
            'brand_id' => '1',
            'type_id' => '1',
            'fuel_id' => '1',
            'seater' => '5',
            'age_limit' => '21',
            'experience_limit' => '1',
            'rental_fee' => '300000',
            'option' => '에어백, 열선시트',
            'total_quantity' => '10',
            'available_quantity' => '8',
            'created_at' => now(),
            'updated_at' => now(),
        ]);

        DB::table('cars') -> insert([
            'name' => '아반떼',
            'model_name' => '페이스리프트 : 더 뉴 아반떼 CN7 (하이브리드)',
            'image_path' => '/images/hyundai-avante.png',
            'image_name' => '아반떼 사진',
            'year' => '2023',
            'brand_id' => '2',
            'type_id' => '1',
            'fuel_id' => '4',
            'seater' => '5',
            'age_limit' => '21',
            'experience_limit' => '1',
            'rental_fee' => '345000',
            'option' => '에어백, 열선시트, 후방카메라, 스마트 키, 선루프',
            'total_quantity' => '2',
            'available_quantity' => '1',
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
        Schema::dropIfExists('cars');
    }
};
