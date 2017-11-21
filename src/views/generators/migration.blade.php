<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AALSetupTables extends Migration
{
    /**
     * Run the migrations.
     *
     * @return void
     */
    public function up()
    {
        DB::beginTransaction();

        // Create table for storing roles
        Schema::create('{{ $perfisTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        // Create table for associating roles to users (Many-to-Many)
        Schema::create('{{ $perfilUsuarioTable }}', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('perfil_id')->unsigned();

            $table->foreign('user_id')->references('{{ $usuarioKeyName }}')->on('{{ $usuarioTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('perfil_id')->references('id')->on('{{ $perfisTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'perfil_id']);
        });

        // Create table for storing permissions
        Schema::create('{{ $permissoesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('name')->unique();
            $table->string('display_name')->nullable();
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

        // Create table for associating permissions to roles (Many-to-Many)
        Schema::create('{{ $permissaoPerfilTable }}', function (Blueprint $table) {
            $table->integer('permissao_id')->unsigned();
            $table->integer('perfil_id')->unsigned();

            $table->foreign('permissao_id')->references('id')->on('{{ $permissoesTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('perfil_id')->references('id')->on('{{ $perfisTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['permissao_id', 'perfil_id']);
        });

        DB::commit();
    }

    /**
     * Reverse the migrations.
     *
     * @return void
     */
    public function down()
    {
        Schema::drop('{{ $permissaoPerfilTable }}');
        Schema::drop('{{ $permissoesTable }}');
        Schema::drop('{{ $perfilUsuarioTable }}');
        Schema::drop('{{ $perfisTable }}');
    }
}
