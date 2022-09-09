<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

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
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        DB::table('spr_ticket_status')->insert(
            array(
                'id' => 1,
                'name_ru' => 'Создан',
                'name_kk' => 'Құрылды'
            ),
        );
        DB::table('spr_ticket_status')->insert(
            array(
                'id' => 2,
                'name_ru' => 'В процессе',
                'name_kk' => 'Өңделуде'
            ),
        );
        DB::table('spr_ticket_status')->insert(
            array(
                'id' => 3,
                'name_ru' => 'Отвечен',
                'name_kk' => 'Жауап берілді'
            ),
        );
        DB::table('spr_ticket_status')->insert(
            array(
                'id' => 4,
                'name_ru' => 'Закрыто',
                'name_kk' => 'Жабылды'
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
        Schema::dropIfExists('spr_ticket_status');
    }
}
