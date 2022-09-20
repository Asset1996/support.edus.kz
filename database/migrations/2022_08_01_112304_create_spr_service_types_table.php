<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

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
            $table->string('hint_ru')->length(255)->comment('Подсказка RU')->nullable();
            $table->string('hint_kk')->length(255)->comment('Подсказка KK')->nullable();
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        $service_types = [
            [
                'id' => 1,
                'name_ru' => 'Электронная школа (Mektep.EDUS)',
                'name_kk' => 'Электронды мектеп (Mektep.EDUS)',
                'hint_ru' => 'Мое обращение относится к работе системы “Mektep EDUS Электронная школа”.',
                'hint_kk' => 'Менің өтінішім «Электронды мектеп (Mektep.EDUS)» жүйесінің жұмысына қатысты.'
            ],
            [
                'id' => 2,
                'name_ru' => 'Электронный колледж (College.EDUS)',
                'name_kk' => 'Электронды колледж (College.EDUS)',
                'hint_ru' => 'Мое обращение относится к работе системы “Электронный колледж (College.EDUS)”.',
                'hint_kk' => 'Менің өтінішім «Электронды колледж (College.EDUS)» жүйесінің жұмысына қатысты.'
            ],
            [
                'id' => 3,
                'name_ru' => 'Дополнительное образование',
                'name_kk' => 'Қосымша білім беру',
                'hint_ru' => 'Мое обращение относится к работе системы “Дополнительное образование”.',
                'hint_kk' => 'Менің өтінішім «Қосымша білім беру» жүйесінің жұмысына қатысты.'
            ],
            [
                'id' => 4,
                'name_ru' => 'Другие, общие вопросы по платформе EDUS',
                'name_kk' => 'Басқа да EDUS платформасы туралы сұрақтар',
                'hint_ru' => 'Мое обращение относится к работе системы “Другие, общие вопросы по платформе EDUS”.',
                'hint_kk' => 'Менің өтінішім «Басқа да EDUS платформасы туралы сұрақтар» жүйесінің жұмысына қатысты.'
            ],
        ];
        \App\Models\Spr\SprServiceTypes::insert($service_types);
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
