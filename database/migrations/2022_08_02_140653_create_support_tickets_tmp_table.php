<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTmpTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets_tmp', function (Blueprint $table) {
            $table->id();
            $table->string('title')->length(150)->comment('Наименование тикета');
            $table->text('initial_message')->comment('Вводный текст тикета');
            $table->integer('service_types_id')->comment('Тип сервиса (Колледж, школа, абитуриент)');
            $table->integer('created_by')->comment('ID Создателя тикета');
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_tickets_tmp');
    }
}
