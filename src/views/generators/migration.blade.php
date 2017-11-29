<?php echo '<?php' ?>

use Illuminate\Database\Migrations\Migration;
use Illuminate\Database\Schema\Blueprint;

class AalSetupPerfilPermissaoTables extends Migration
{
   



    public function up()
    {
        DB::beginTransaction();

        
        Schema::create('{{ $perfisTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 60)->unique();
            $table->string('descricao')->nullable();
            $table->boolean('ativo')->default(true);
            $table->timestamps();
        });

        
        Schema::create('{{ $perfilUsuarioTable }}', function (Blueprint $table) {
            $table->integer('user_id')->unsigned();
            $table->integer('perfil_id')->unsigned();

            $table->foreign('user_id')->references('id')->on('{{ $usuarioTable }}')
                ->onUpdate('cascade')->onDelete('cascade');
            $table->foreign('perfil_id')->references('id')->on('{{ $perfisTable }}')
                ->onUpdate('cascade')->onDelete('cascade');

            $table->primary(['user_id', 'perfil_id']);
        });






       
        Schema::create('{{ $permissoesTable }}', function (Blueprint $table) {
            $table->increments('id');
            $table->string('nome', 60)->unique();
            $table->boolean('ativo')->default(true);
            $table->string('descricao')->nullable();
            $table->timestamps();
        });

       
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

    

    
    public function down()
    {
        Schema::drop('{{ $permissaoPerfilTable }}');
        Schema::drop('{{ $permissoesTable }}');
        Schema::drop('{{ $perfilUsuarioTable }}');
        Schema::drop('{{ $perfisTable }}');
    }
}
