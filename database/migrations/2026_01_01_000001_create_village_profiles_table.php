<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('village_profiles', function (Blueprint $table) {
            $table->id();
            $table->string('name');
            $table->string('tagline')->nullable();
            $table->string('district');
            $table->string('regency');
            $table->string('province');
            $table->string('postal_code', 10)->nullable();
            $table->string('head_name');
            $table->string('head_title')->default('Kepala Desa');
            $table->string('head_photo')->nullable();
            $table->text('head_welcome')->nullable();
            $table->text('vision')->nullable();
            $table->text('mission')->nullable();
            $table->longText('history')->nullable();
            $table->string('address');
            $table->string('phone', 30)->nullable();
            $table->string('email')->nullable();
            $table->string('office_hours')->nullable();
            $table->unsignedInteger('population_total')->default(0);
            $table->unsignedInteger('families_total')->default(0);
            $table->unsignedInteger('male_total')->default(0);
            $table->unsignedInteger('female_total')->default(0);
            $table->decimal('area_km2', 8, 2)->default(0);
            $table->unsignedInteger('dusun_count')->default(0);
            $table->unsignedInteger('rw_count')->default(0);
            $table->unsignedInteger('rt_count')->default(0);
            $table->text('map_embed_url')->nullable();
            $table->string('logo')->nullable();
            $table->string('hero_image')->nullable();
            $table->timestamps();
        });
    }

    public function down(): void
    {
        Schema::dropIfExists('village_profiles');
    }
};
