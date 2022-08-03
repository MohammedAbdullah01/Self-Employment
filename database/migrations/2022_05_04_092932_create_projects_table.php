<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateProjectsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('projects', function (Blueprint $table) {
            $table->id();
            $table->string('title')->unique();
            $table->string('slug')->unique();

            $table->foreignId('client_id')->constrained('clients')->cascadeOnDelete();
            $table->foreignId('admin_id')->nullable()->constrained('admins')->cascadeOnDelete();
            $table->foreignId('category_id')->nullable()->constrained('categories')->nullOnDelete();

            $table->boolean('activate')->default(0);
            $table->text('description');
            $table->string('skills');
            $table->enum('status' , ['open','in-progress','closed']);
            $table->enum('type'   , ['hourly','fixed']);
            $table->enum('budget' , ['$50-25','$100-50','$250-100','$500-250','$1000-500','$2500-1000','$5000-2500']);
            $table->unsignedInteger('delivery_period')->nullable();
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
        Schema::dropIfExists('projects');
    }
}
