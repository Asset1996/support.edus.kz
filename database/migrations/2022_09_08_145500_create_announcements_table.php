<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateAnnouncementsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('announcements', function (Blueprint $table) {
            $table->id();
            $table->string('theme_kk')->length(50)->comment('Тема аннонса');
            $table->string('theme_ru')->length(50)->comment('Тема аннонса');
            $table->string('message_kk')->length(255)->comment('Тело аннонса');
            $table->string('message_ru')->length(255)->comment('Тело аннонса');
            $table->date('date')->comment('Дата аннонса')->nullable();
            $table->string('link')->length(255)->default('#')->comment('Ссылка аннонса');
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
        Schema::dropIfExists('announcements');
    }
}
