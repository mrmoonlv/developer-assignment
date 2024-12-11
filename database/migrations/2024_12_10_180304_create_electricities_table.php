<?php

declare(strict_types=1);

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class () extends Migration {
    /**
     * Run the migrations.
     */
    public function up(): void
    {
        Schema::create('electricities', function (Blueprint $table) {
            $table->id();
            $table->string('area')->nullable();
            $table->string('currency');
            $table->decimal('price', 20, 6)->default(0)->nullable();
            $table->timestamp('delivery_start');
            $table->timestamp('delivery_end');
            $table->timestamps();

            $table->index('delivery_start');
            $table->index('delivery_end');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('electricities');
    }
};
