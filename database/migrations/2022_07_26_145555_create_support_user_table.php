<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSupportUserTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_user', function (Blueprint $table) {
            $table->id();
            $table->string('name')->length(50)->comment('Имя пользователя');
            $table->string('surname')->length(50)->comment('Фамилия')->nullable();
            $table->string('lastname')->length(50)->comment('Отчество')->nullable();
            $table->string('email')->length(255)->comment('Электронная почта')->unique();
            $table->integer('phone')->comment('Номер телефона')->nullable();
            $table->integer('iin')->nullable();
            $table->timestamp('email_verified_at')->comment('Время вреификации почты')->nullable();
            $table->timestamp('phone_verified_at')->comment('Время вреификации номера телефона')->nullable();
            $table->string('password')->length(255)->comment('Хэш пароля')->nullable();
            $table->string('verification_token')->comment('Токен верификации почты')->nullable();

            $table->integer('roles_id')->default(1)->comment('Роль пользователя')->nullable();
            $table->integer('organizations_id')->comment('Роль пользователя')->nullable();

            $table->boolean('has_access')->default(0)->comment('Доступ: 1 - Да, 0 - нет')->nullable();
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        DB::statement("ALTER TABLE support_user CHANGE iin iin BIGINT(12) UNSIGNED ZEROFILL COMMENT 'ИИН'");
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('support_user');
    }
}
