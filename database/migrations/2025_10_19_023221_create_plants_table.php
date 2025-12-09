<?php
use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    public function up(): void
    {
        Schema::create('plants', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->onDelete('cascade');
            $table->foreignId('category_id')->constrained('plant_categories')->onDelete('cascade');
            $table->string('plant_name');
            $table->string('latin_name')->nullable();
            $table->string('location')->nullable();
            $table->string('photo')->nullable();
            $table->string('barcode')->nullable()->unique();
            $table->date('planting_date')->nullable();
            $table->enum('condition', ['healthy', 'sick', 'dead'])->default('healthy');
            $table->integer('stock')->default(0);
            $table->text('description')->nullable();
            $table->text('health_benefits')->nullable();
            $table->text('cultural_benefits')->nullable();
            $table->text('habitat')->nullable();
            $table->timestamps();
            $table->softDeletes();
        });
    }
    public function down(): void
    {
        Schema::dropIfExists('plants');
    }
};