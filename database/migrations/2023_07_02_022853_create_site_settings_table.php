<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('site_settings', function (Blueprint $table) {
            $table->increments('site_id');
            $table->string('title');
            $table->mediumText('description')->nullable();
            $table->string('url')->nullable(); //uploads/site_settings/siteId/images.extension
            $table->tinyInteger('status')->default('0')->comment('0=Visible, 1=Hidden');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('site_settings');
    }
};
