<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('sub_groups', function (Blueprint $table) {
            $table->id()->autoIncrement();
            $table->unsignedBigInteger('group_id');
            $table->string('name');
            $table->unsignedBigInteger('amount');
            $table->string('source');
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('sub_groups');
    }
};
