<?php 


namespace Manzoli2122\AAL;

use Illuminate\Console\Command;
use Illuminate\Support\Facades\Config;

class MigrationCommand extends Command
{
  
    protected $name = 'aal:migration';

    
    protected $description = 'Creates a migration following the AAL specifications.';
   
    
    public function fire()
    {
        $this->handle();
    }

    
    public function handle()
    {
        $this->laravel->view->addNamespace('aal', substr(__DIR__, 0, -8).'views');

        $perfisTable              = Config::get('aal.perfis_table');
        $perfilUsuarioTable       = Config::get('aal.perfil_usuario_table');
        $permissoesTable          = Config::get('aal.permissoes_table');
        $permissaoPerfilTable     = Config::get('aal.permissoen_perfil_table');

        $this->line('');
        $this->info( "Tables: $perfisTable, $perfilUsuarioTable, $permissoesTable, $permissaoPerfilTable" );

        $message = "A migration that creates '$perfisTable', '$perfilUsuarioTable', '$permissoesTable', '$permissaoPerfilTable'".
        " tables will be created in database/migrations directory";

        $this->comment($message);
        $this->line('');

        if ($this->confirm("Proceed with the migration creation? [Yes|no]", "Yes")) {

            $this->line('');

            $this->info("Creating migration...");
            if ($this->createMigration($perfisTable, $perfilUsuarioTable, $permissoesTable, $permissaoPerfilTable)) {

                $this->info("Migration successfully created!");
            } else {
                $this->error(
                    "Couldn't create migration.\n Check the write permissoes".
                    " within the database/migrations directory."
                );
            }

            $this->line('');

        }
    }

    
    protected function createMigration($perfisTable, $perfilUsuarioTable, $permissoesTable, $permissaoPerfilTable)
    {
        $migrationFile = base_path("/database/migrations")."/".date('Y_m_d_His')."_aal_setup_perfil_permissao_tables.php";

        $usuarioModelName = Config::get('auth.providers.users.model');

        $usuarioModel = new $usuarioModelName();
        $usuarioTable = $usuarioModel->getTable();
        $usuarioKeyName = $usuarioModel->getKeyName();

        $data = compact('perfisTable', 'perfilUsuarioTable', 'permissoesTable', 'permissaoPerfilTable', 'usuarioTable', 'usuarioKeyName');

        $output = $this->laravel->view->make('aal::generators.migration')->with($data)->render();

        if (!file_exists($migrationFile) && $fs = fopen($migrationFile, 'x')) {
            fwrite($fs, $output);
            fclose($fs);
            return true;
        }

        return false;
    }
}
