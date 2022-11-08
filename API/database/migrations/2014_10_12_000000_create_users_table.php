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
        Schema::create('users', function (Blueprint $table) {
            $table->id();
            $table->text('first_name', 255);
            $table->text('last_name', 255);
            $table->string('email', 150)->unique();
            $table->string('password', 255);
            $table->string('address', 255);
            $table->string('postal_code', 255);
            $table->text('city', 255);
            $table->string('country_code', 255);
            $table->string('phone', 255)->unique();
            $table->boolean('is_employee')->default(false);
            $table->rememberToken();
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
        Schema::dropIfExists('users');
    }
};
