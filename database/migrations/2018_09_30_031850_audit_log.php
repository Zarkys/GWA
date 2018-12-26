<?php
    
    use Illuminate\Support\Facades\Schema;
    use Illuminate\Database\Schema\Blueprint;
    use Illuminate\Database\Migrations\Migration;
    
    class AuditLog extends Migration {
        /**
         * Run the migrations.
         *
         * @return void
         */
        public function up() {
            Schema::create('audit_log', function (Blueprint $table) {
                $table->increments('id');
                $table->integer('idunser')->unsigned();
                $table->integer('idnaction')->unsigned();
                $table->string('description');
                $table->timestamps();
                
                $table->foreign('idunser')->references('id')->on('users')->onDelete('cascade');
                $table->foreign('idnaction')->references('id')->on('audit_action')->onDelete('cascade');
                
                
            });
        }
        
        /**
         * Reverse the migrations.
         *
         * @return void
         */
        public function down() {
            Schema::dropIfExists('audit_log');
        }
    }
