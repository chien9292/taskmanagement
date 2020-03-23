<?php

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;
use Illuminate\Support\Facades\Schema;

class CreateTasksTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        Schema::create('tasks', function (Blueprint $table) {
            $table->id();
            $table->string('name')->unique();
            $table->string('approved_status')->nullable();
            $table->dateTime('approved_at')->nullable();//Datetime Manager/Admin approved the creation of task from user
            $table->unsignedBigInteger('approved_by')->nullable();//Manager/Admin approved the creation of task from user
            $table->unsignedBigInteger('old_id')->nullable();//If old, get old task id
            $table->text('description');//Description of task
            $table->dateTime('start')->nullable();//Start time in schedule
            $table->dateTime('end')->nullable();//End time in schedule(deadline)
            $table->unsignedBigInteger('assignee_id')->nullable();//The assignee of task
            $table->unsignedBigInteger('assigned_by')->nullable();//The assigner (Manager/Admin) of task
            $table->string('status')->nullable();//Status: Pending, Doing, Finished, Overdue...
            $table->text('content')->nullable();//Content of task processing of assignee
            $table->string('fail_reason')->nullable();//Reason to doing task fail
            $table->string('committed_at')->nullable();//Datetime assignee committed
            $table->text('attached_file')->nullable();//Attached image when committing
            $table->string('comment')->nullable();//Comment of Manager/Admin
            $table->string('mark')->nullable();//Mark given by Manager/Admin
            $table->unsignedBigInteger('commenter_id')->nullable();//Id of user who commentted
            $table->dateTime('commented_at')->nullable();//Datetime Manager/Admin commented
            $table->unsignedBigInteger('created_by');//created_by
            $table->unsignedBigInteger('updated_by');
            $table->string('update_detail')->nullable();//Detail of updating
            $table->softDeletes();
            $table->timestamps();

            //Foreign key constrains
            $table->foreign('approved_by')->references('id')->on('users');
            $table->foreign('old_id')->references('id')->on('tasks');
            $table->foreign('assignee_id')->references('id')->on('users');
            $table->foreign('assigned_by')->references('id')->on('users');
            $table->foreign('commenter_id')->references('id')->on('users');
            $table->foreign('created_by')->references('id')->on('users');
            $table->foreign('updated_by')->references('id')->on('users');
        });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('tasks');
    }
}
