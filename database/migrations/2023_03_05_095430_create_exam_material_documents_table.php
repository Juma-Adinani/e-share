<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

return new class extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('exam_material_documents', function (Blueprint $table) {
            $table->id();
            $table->string('title');
            $table->text('thumbnail');
            $table->text('document');
            $table->foreignId('material_id')->constrained('exam_materials');
            $table->foreignId('exam_id')->constrained('examination_categories')->onUpdate('cascade');
            $table->string('year');
            $table->foreignId('teacher_id')->constrained('teachers');
            $table->foreignId('subject_id')->constrained('subjects')->onUpdate('cascade');
            $table->foreignId('class_id')->constrained('classes')->onUpdate('cascade');
            // $table->foreignId('school_id')->constrained('schools')->onUpdate('cascade');
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
        Schema::dropIfExists('exam_material_documents');
    }
};
