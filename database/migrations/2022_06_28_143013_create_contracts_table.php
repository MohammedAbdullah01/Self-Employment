<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateContractsTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('contracts', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained('users')->cascadeOnDelete();
            $table->foreignId('project_id')->constrained('projects')->cascadeOnDelete();
            $table->foreignId('comment_id')->unique()->nullable()->constrained('comments')->cascadeOnDelete();
            $table->unsignedFloat('cost');
            $table->enum('type',['fixed','hourly']);
            $table->enum('status',['active','completed','terminated']);
            $table->unsignedFloat('hours')->nullable()->default(0);
            $table->date('start_on');
            $table->date('end_on');
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
        Schema::dropIfExists('contracts');
    }
}
