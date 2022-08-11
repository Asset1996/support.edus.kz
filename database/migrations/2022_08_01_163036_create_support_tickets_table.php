<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportTicketsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_tickets', function (Blueprint $table) {
            $table->id();
            $table->string('ticket_uid')->length(20)->unique()->comment('Уникальный ID тикета');
            $table->string('title')->length(150)->comment('Наименование тикета');
            $table->text('initial_message')->comment('Вводный текст тикета');
            $table->integer('service_types_id')->comment('Тип сервиса (Колледж, школа, абитуриент)');
            $table->integer('status_id')->default(1)->comment('Статус обработки [spr_ticket_status]');
            $table->integer('created_by')->comment('ID создателя тикета');
            $table->integer('answered_by')->comment('ID оператора, ответившии на тикет')->nullable();
            $table->timestamp('answered_at')->comment('Время ответа оператором')->nullable();
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
        Schema::dropIfExists('support_tickets');
    }
}
