<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateLinkMappingsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('link_mappings', function (Blueprint $table) {
            $table->id();
            $table->string('custom_slug')->nullable();
            $table->string('code')->unique();
            $table->string('redirect_url');
            $table->string('shortened_url');
            $table->integer('requested_count')->default(0);
            $table->timestamp('last_requested_date')->nullable();
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
        Schema::dropIfExists('link_mappings');
    }
}
