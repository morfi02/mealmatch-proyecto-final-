<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class AddProfileFieldsToUsersTable extends Migration
{
    public function up()
    {
        Schema::create('dishes', function (Blueprint $table) {
            $table->id();
            $table->foreignId('user_id')->constrained()->onDelete('cascade'); 
            $table->string('nombre');
            $table->text('descripcion');
            $table->string('tipo'); 
            $table->decimal('precio', 8, 2);
            $table->string('imagen')->nullable();
            $table->timestamps();
        });
        
    }

    public function down()
    {
        Schema::table('users', function (Blueprint $table) {
            $table->dropColumn(['bio', 'profile_photo_url']);
        });
    }
}
