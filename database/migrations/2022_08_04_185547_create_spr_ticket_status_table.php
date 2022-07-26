<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprTicketStatusTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_ticket_status', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru')->length(50)->comment('Наименование статуса RU');
            $table->string('name_kk')->length(50)->comment('Наименование статуса KK');
            $table->string('css_color')->length(20)->comment('Цвет статуса');
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        $ticket_statuses = [
            ['id' => 1, 'name_ru' => 'Создан', 'name_kk' => 'Құрылды', 'css_color' => 'blue'],
            ['id' => 2, 'name_ru' => 'В процессе', 'name_kk' => 'Өңделуде', 'css_color' => 'red'],
            ['id' => 3, 'name_ru' => 'Отвечен', 'name_kk' => 'Жауап берілді', 'css_color' => 'green'],
            ['id' => 4, 'name_ru' => 'Закрыто', 'name_kk' => 'Жабылды', 'css_color' => 'black'],
        ];
        \App\Models\Spr\SprTicketStatus::insert($ticket_statuses);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spr_ticket_status');
    }
}
