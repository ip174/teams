<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateUsersTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('users', function (Blueprint $table) {
            $table->increments('id');
            $table->string('email')->unique()->nullable();
			$table->string('username')->unique();
            $table->string('first_name');
            $table->string('last_name')->nullable();
            $table->string('phone_number_code', 5)->nullable();
            $table->string('phone_number', 50)->nullable()->unique();
            $table->string('password')->nullable();
            $table->string('remember_token')->nullable();
            $table->tinyInteger('type')->comment = '1 = Customer, 2 = Seller';
            $table->tinyInteger('login_type')->default(1)->comment = '1 = Normal, 2 = Facebook, 3 = Google';
            $table->enum('is_active', ['Y','N'])->default('N')->comment = 'Y = Active, N = Not Active';

            $table->string('profile_picture')->nullable();
            $table->integer('language_id')->unsigned()->nullable();
            $table->integer('country_id')->unsigned()->nullable();
            $table->string('provider')->nullable();
            $table->string('provider_id')->nullable();
            $table->timestamps();

            $table->foreign('country_id')->references('id')->on('countries');
        });
		
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('users');
    }
}
