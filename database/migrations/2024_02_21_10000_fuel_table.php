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
        Schema::create('fuels', function (Blueprint $table) {
            $table -> increments('id');
            $table -> string('name');
        });

        $fuelNames = [
            '가솔린(휘발유)',
            '디젤(경유)',
            'LPG',
            '하이브리드',
        ];

        foreach ( $fuelNames as $fuelName) {
            DB::table('fuels') -> insert([
                'name' => $fuelName,
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
        //
    }
};
