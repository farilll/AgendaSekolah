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
       Schema::create('profile', function (Blueprint $table) {
        $table->foreignId('user_id')->primary()->constrained()->onDelete('cascade');
        $table->string('nis')->nullable(); 
        $table->string('alamat')->nullable();
        $table->string('no_hp')->nullable();
        $table->timestamps();
});

    }
                                                                                                                 
    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('profile');
    }
};
