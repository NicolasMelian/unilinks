<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up()
    {
        Schema::table('appearances', function (Blueprint $table) {
            $table->string('custom_background_image')->nullable();
        });
    }
    
    public function down()
    {
        Schema::table('appearances', function (Blueprint $table) {
            $table->dropColumn('custom_background_image');
        });
    }
};