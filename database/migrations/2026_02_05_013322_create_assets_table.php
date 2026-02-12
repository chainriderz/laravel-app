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
        Schema::create('assets', function (Blueprint $table) {

            $table->id();

            // Supports properties + new_properties
            $table->string('table_name'); // App\Models\Property
            $table->unsignedBigInteger('table_id');

            $table->enum('type', [
                'thumbnail',
                'image',
                'video',
                'brochure'
            ]);

            $table->string('file_path');        // storage path / CDN url
            $table->string('original_name')->nullable();
            $table->integer('sort_order')->default(0);

            $table->boolean('is_active')->default(true);

            $table->timestamps();

            // Performance indexes
            $table->index(['table_name', 'table_id']);
            $table->index('type');
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('assets');
    }
};
