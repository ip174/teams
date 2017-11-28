<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateLanguagesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('languages', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name');
            $table->string('locale')->index();
            $table->integer('weight')->unsigned();
            $table->enum('fallback_locale', ['Y', 'N'])->default('N')->comment = 'Deafult language';
            $table->timestamps();
        });

        // Insert languages.
        DB::table('languages')->insert(
            array(
                [
                    'name' => 'English',
                    'locale' => 'en',
                    'weight' => 1,
                    'fallback_locale' => 'Y',
                    'created_at' => '2017-06-15 14:34:45',
                    'updated_at' => '2017-06-15 14:34:45'
                ],
                [
                    'name' => 'Dutch',
                    'locale' => 'nl',
                    'weight' => 2,
                    'fallback_locale' => 'N',
                    'created_at' => '2017-06-15 14:34:45',
                    'updated_at' => '2017-06-15 14:34:45'
                ]
            )
        );
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('languages');
    }
}
