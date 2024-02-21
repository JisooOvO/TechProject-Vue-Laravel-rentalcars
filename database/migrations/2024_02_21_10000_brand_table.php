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
        Schema::create('brands', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('name');
            $table -> enum('type', ['domestic','foreign']);
        });

        $brandNames = [
            ['기아자동차', 'domestic'],
            ['현대자동차', 'domestic'],
            ['제네시스', 'domestic'],
            ['쉐보레', 'domestic'],
            ['테슬라', 'foreign'],
            ['폭스바겐', 'foreign'],
            ['아우디', 'foreign'],
            ['BMW', 'foreign'],
            ['벤츠', 'foreign'],
        ];

        foreach ( $brandNames as $brandName) {
            DB::table('brands') -> insert([
                'name' => $brandName[0],
                'type' => $brandName[1]
            ]);
        }
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('brands');
    }
};
