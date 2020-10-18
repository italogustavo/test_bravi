<?php

use Illuminate\Support\Facades\Schema;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreatePeopleContactsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('people_contacts', function (Blueprint $table) {
            $table->increments('id');
            $table->unsignedInteger('people_id');
            $table->string('phone', 20)->default('');
            $table->string('whatsapp', 20)->default('');
            $table->string('email', 100)->default('');
            $table->boolean('is_active')->default(true);
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
        Schema::dropIfExists('people_contacts');
    }
}
