<?php

use Illuminate\Database\Schema\Blueprint;
use Illuminate\Database\Migrations\Migration;

class CreateInvoicesTable extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
      Schema::dropIfExists('invoices');
      Schema::create('invoices', function($table)
      {
          $table->increments('id');
          $table->unsignedInteger('user_id')->index();
          $table->unsignedInteger('account_id')->index();
          $table->unsignedInteger('invoice_status_id')->default(1);
          $table->timestamps();
          $table->softDeletes();

          $table->string('invoice_number');
          $table->float('discount');
          $table->string('po_number');
          $table->date('invoice_date')->nullable();
          $table->date('due_date')->nullable();
          $table->text('terms');
          $table->text('public_notes');
          $table->boolean('is_deleted')->default(false);
          $table->boolean('is_recurring')->default(false);
          $table->unsignedInteger('frequency_id');
          $table->date('start_date')->nullable();
          $table->date('end_date')->nullable();
          $table->timestamp('last_sent_date')->nullable();
          $table->unsignedInteger('recurring_invoice_id')->index()->nullable();
          $table->string('tax_name1');
          $table->decimal('tax_rate1', 13, 3);

          $table->decimal('amount', 13, 2);
          $table->decimal('balance', 13, 2);

          $table->foreign('user_id')->references('id')->on('users')->onDelete('cascade');
          $table->foreign('account_id')->references('id')->on('accounts')->onDelete('cascade');
          $table->foreign('invoice_status_id')->references('id')->on('invoice_statuses');
          $table->foreign('recurring_invoice_id')->references('id')->on('invoices')->onDelete('cascade');

          $table->unsignedInteger('public_id')->index();
          $table->unique( array('user_id','public_id') );
          $table->unique( array('user_id','invoice_number') );
      });
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::dropIfExists('invoices');
    }
}
