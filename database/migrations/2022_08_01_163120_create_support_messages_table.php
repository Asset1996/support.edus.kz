<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSupportMessagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_messages', function (Blueprint $table) {
            $table->id();
            $table->integer('tickets_id')->comment('ID тикета');
            $table->integer('user_id')->comment('ID автора');
            $table->integer('user_type')->comment('Тип автора: 0 - Клиаент, 1 - Оператор');
            $table->string('message_body')->length(1024)->comment('Тело сообщения');
            $table->integer('order_num')->default(0)->comment('Порядок сообщения');
            $table->integer('replied_message_id')
                ->comment('ID сообщения, которому данное сообшение является ответом')
                ->nullable();
            $table->tinyInteger('evaluation')
                ->lenght(6)
                ->comment('Оценка сообшения (от 1 до 5)')
                ->nullable();
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
        Schema::dropIfExists('support_messages');
    }
}