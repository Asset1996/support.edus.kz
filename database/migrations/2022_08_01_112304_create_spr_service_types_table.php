<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSprServiceTypesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_service_types', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru')->length(50)->comment('Наименование сервиса RU');
            $table->string('name_kk')->length(50)->comment('Наименование сервиса KK');
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        DB::table('spr_service_types')->insert(
            array(
                'id' => 1,
                'name_ru' => 'Электронная школа (Mektep.EDUS)',
                'name_kk' => 'Электронды мектеп (Mektep.EDUS)'
            ),
        );
        DB::table('spr_service_types')->insert(
            array(
                'id' => 2,
                'name_ru' => 'Электронный колледж (College.EDUS)',
                'name_kk' => 'Электронды колледж (College.EDUS)'
            ),
        );
        DB::table('spr_service_types')->insert(
            array(
                'id' => 3,
                'name_ru' => 'Дополнительное образование',
                'name_kk' => 'Қосымша білім беру'
            ),
        );
        DB::table('spr_service_types')->insert(
            array(
                'id' => 4,
                'name_ru' => 'Другие, общие вопросы по платформе EDUS',
                'name_kk' => 'Басқа да EDUS платформасы туралы сұрақтар'
            ),
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spr_service_types');
    }
}
