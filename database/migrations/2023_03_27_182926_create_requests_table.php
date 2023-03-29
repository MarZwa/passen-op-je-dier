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
        Schema::create('requests', function (Blueprint $table) {
            $table->id();
            $table->date('start_date');
            $table->date('end_date');
            $table->double('rate', 3, 2);
            $table->boolean('status')->nullable()->comment('null: Nog geen sitter gevonden, false: Geen sitter gevonden, true: Sitter gevonden');
            $table->foreignId('pet_id')->constrained()->cascadeOnUpdate()->cascadeOnDelete();
            $table->foreign('sitter_id')->references('users')->on('users')->nullable()->cascadeOnUpdate()->cascadeOnDelete();
            $table->timestamps();
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::table('pets', function (Blueprint $table) {
            $table->dropForeign('pet_id');
            $table->dropForeign('sitter_id');
        });
        Schema::dropIfExists('requests');
    }
};
