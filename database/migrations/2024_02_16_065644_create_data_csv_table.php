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
        Schema::create('csv', function (Blueprint $table) {
            $table->id();
            $table->string('name')->nullable();
            $table->unsignedBigInteger('created_by')->nullable();
            $table->foreign('created_by')->references('id')->on('users')
                ->onUpdate('set null')->onDelete('set null');
            $table->timestamps();
        });

        Schema::create('csv_data', function (Blueprint $table) {
            $table->id();
            $table->String('phone')->nullable();
            $table->string('message')->nullable();
            $table->tinyInteger('status')->default(0);
            $table->unsignedBigInteger('csv_id');
            $table->foreign('csv_id')->references('id')->on('csv')
            ->onUpdate('cascade')->onDelete('cascade');
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
        Schema::dropIfExists('csv_data');
        Schema::dropIfExists('csv');
    }
};
