<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateSettingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('settings', function (Blueprint $table) {
            $table->increments('id');
            $table->string('admin_name', 255);
            $table->string('admin_email', 255);
            $table->string('site_title', 255);
            $table->string('contact_email', 255);
            $table->string('contact_name', 255);
            $table->string('contact_phone', 255);
            $table->string('site_logo', 255);

            $table->string('site_fb_link', 255);
            $table->string('site_twitter_link', 255);
            $table->string('site_gplus_link', 255);
            $table->string('site_linkedin_link', 255);
            $table->string('site_pinterest_link', 255);

            /*$table->text('site_meta_descriptions');
            $table->text('googleanalytic');*/

            $table->timestamps();
        });

        // Insert settings
        DB::table('settings')->insert(
            array(
                'admin_name' => 'Admin',
                'admin_email' => 'admin@admin.com',
                'site_title' => 'Scribs',
                'contact_email' => 'info@admin.com',
                'contact_name' => 'Contact Scribs',
                'contact_phone' => '1234567890',
                'site_logo' => '',
                'site_fb_link' => 'https://www.facebook.com/example',
                'site_twitter_link' => 'https://www.twitter.com/example',
                'site_gplus_link' => 'https://plus.google.com/u/0/+example',
                'site_linkedin_link' => 'https://www.linkedin.com/example',
                'site_pinterest_link' => 'https://www.pinterest.com/example'
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
        Schema::dropIfExists('settings');
    }
}
