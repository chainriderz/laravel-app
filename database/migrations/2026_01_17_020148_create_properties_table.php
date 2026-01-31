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
        Schema::create('properties', function (Blueprint $table) {
            $table->id(); // auto increment primary key

            $table->string('flat', 50);
            $table->string('floor', 20);
            $table->string('plot', 50);
            $table->string('bldg_no', 50);
            $table->string('bldg_name', 150);
            $table->string('sector_no', 50);
            $table->string('landmark', 150);
            $table->string('zip', 10);
            $table->string('amount', 200);
            $table->enum('category', ['buy', 'rent']);

            $table->foreignId('property_type_id')
                  ->constrained('property_types')
                  ->cascadeOnDelete();

            $table->foreignId('property_sub_type_id')
                  ->constrained('property_sub_types')
                  ->cascadeOnDelete();

            $table->foreignId('area_id')
                  ->constrained('areas')
                  ->cascadeOnDelete();

            $table->foreignId('city_id')
                  ->constrained('cities')
                  ->cascadeOnDelete();

            $table->enum('showtohome', ['0', '1'])->default('0');

            // property status
            $table->boolean('is_active')->default(true);

            // expiry date
            $table->date('active_till');

            // Optional timestamps (recommended)
            $table->timestamps();

            // indexes
            $table->index('bldg_name');
            $table->index(['is_active', 'active_till']);
        });
    }

    /**
     * Reverse the migrations.
     */
    public function down(): void
    {
        Schema::dropIfExists('properties');
    }
};
