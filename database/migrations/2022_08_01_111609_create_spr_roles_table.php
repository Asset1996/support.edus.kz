<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateSprRolesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('spr_roles', function (Blueprint $table) {
            $table->id();
            $table->string('name_ru')->length(50)->comment('Наименование роли RU');
            $table->string('name_kk')->length(50)->comment('Наименование роли KK');
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        $roles = [
            ['id' => 1, 'name_ru' => 'Клиент', 'name_kk' => 'Клиент'],
            ['id' => 2, 'name_ru' => 'Оператор', 'name_kk' => 'Оператор'],
            ['id' => 3, 'name_ru' => 'Модератор', 'name_kk' => 'Модератор'],
            ['id' => 4, 'name_ru' => 'Администратор', 'name_kk' => 'Администратор'],
            ['id' => 5, 'name_ru' => 'Суперадмин', 'name_kk' => 'Суперадмин'],
        ];
        \App\Models\Spr\SprRoles::insert($roles);
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('spr_roles');
    }
}
