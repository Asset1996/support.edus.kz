<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;
use Illuminate\Support\Facades\DB;

class CreateSupportReferenceBookTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('support_reference_book', function (Blueprint $table) {
            $table->id();
            $table->string('question_kk')->length(255)->comment('Вопрос kk');
            $table->string('question_ru')->length(255)->comment('Вопрос ru');
            $table->string('answer_kk')->length(1024)->comment('Ответ kk');
            $table->string('answer_ru')->length(1024)->comment('Ответ ru');
            $table->string('link')->length(255)->nullable()->comment('Ссылка');
            $table->timestamp('created_at')->comment('Время создания записи')->useCurrent();
            $table->timestamp('updated_at')->comment('Время обновления записи')->useCurrentOnUpdate()->nullable();
        });
        DB::table('support_reference_book')->insert(
            array(
                'id' => 1,
                'question_kk' => 'Сайтқа қалай тіркелуге болады?',
                'question_ru' => 'Как зарегитрироваться на сайте?',
                'answer_kk' => 'Сайт мәзіріндегі «Тіркелу» түймесін басыңыз. Ашылған терезеде атыңызды, электрондық поштаңызды және құпия сөзіңізді енгізіңіз. Сіздің электрондық поштаңызға растау сілтемесі жіберіледі.',
                'answer_ru' => 'Нажмите в меню сайта кнопку "Зарегистрироваться". В открывшемся окне введите свое имя, почту и пароль. На указанную вами почту будет отправлена ссылка для подтверждения почты.'
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
        Schema::dropIfExists('support_reference_book');
    }
}
