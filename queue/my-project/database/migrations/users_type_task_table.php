
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
        
        Schema::create("users_type_task", function (Blueprint $table) {
            $table->id();
            $table->unsignedBigInteger("users_id");
            $table->unsignedBigInteger("type_task_id");
            $table->foreign("users_id")->references("id")->on("users");
            $table->foreign("type_task_id")->references("id")->on("type_task");
        });
    }

    /**
    * Reverse the migrations.
    *
    * @return void
    */
    public function down()
    {
        Schema::dropIfExists("users_type_task");
    }
};
        