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
        Schema::create('peoplesends', function (Blueprint $table) {
            $table->id();
            $table->string('id_number')->unique();
            $table->string('names');
            $table->string('last_names');
            $table->string('email')->unique();
            $table->string('country');
            $table->string('address');
            $table->string('phone')->unique();
            $table->timestamps();
            $table->unsignedBigInteger('id_categorie')->nullable();
            $table->foreign('id_categorie')
                ->references('id')
                ->on('categories')
                ->onDelete('set null')
                ->onUpdate('cascade');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('peoplesends');
    }
};
