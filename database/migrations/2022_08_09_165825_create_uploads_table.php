<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateUploadsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('uploads', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(255)->comment('Наименование файла');
            $table->string('original_name')->length(255)->comment('Оригинальное наименование файла');
            $table->string('ticket_uid')->length(20)->comment('Уникальный ID тикета');
            $table->integer('messages_id')->default(0)->comment('ID сообщения');
            $table->string('path')->length(1024)->comment('Путь файла');
            $table->string('type')->length(50)->default('image')->comment('Тип файла (изображение или рисунок)');
            $table->string('extention')->length(50)->comment('Расширение файла');
            $table->integer('size')->comment('Размер файла в байтах');
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
        Schema::dropIfExists('uploads');
    }
}
