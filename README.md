# AAL - Autenticação e Autorização Laravel

[![Latest Stable Version](https://poser.pugx.org/manzoli2122/all/v/stable)](https://packagist.org/packages/manzoli2122/all)
[![Latest Unstable Version](https://poser.pugx.org/manzoli2122/all/v/unstable)](https://packagist.org/packages/manzoli2122/all)
[![License](https://poser.pugx.org/manzoli2122/all/license)](https://packagist.org/packages/manzoli2122/all)
[![Total Downloads](https://poser.pugx.org/manzoli2122/all/downloads)](https://packagist.org/packages/manzoli2122/all)
[![composer.lock](https://poser.pugx.org/manzoli2122/all/composerlock)](https://packagist.org/packages/manzoli2122/all)

## Instalação

1) Para instalar o Laravel 5 AAL, basta adicionar o seguinte ao seu  `composer.json`. Em seguida, execute `composer update`:

```json
"minimum-stability": "dev",
```

```json
"manzoli2122/aal": "dev-master"
```

2) Abra seu `config/app.php`  e adicione o seguinte ao array  `providers`:

```php
Manzoli2122\AAL\AALServiceProvider::class,
```

3) No mesmo `config/app.php` adicione o seguinte ao array `aliases `: 

```php
'AAL'   => Manzoli2122\AAL\AALFacade::class,
```

php artisan vendor:publish ???

4) Excute o comando abaixo para gerar a migration das tabelas perfis e pemissoes:

```json
php artisan aal:migration
```

5) Configure a conexão com banco de dados e excute o comando para criar as tabelas:

```json
php artisan migrate
```

6) Abra o `config/auth.php` e adicione o seguinte:

```php
'perfil' => \Manzoli2122\AAL\Middleware\AALPerfil::class,
'permissao' => \Manzoli2122\AAL\Middleware\AALPermissao::class,
```


7) Adicione o seguinte codigo na sua classe User

```php
<?php

use Manzoli2122\AAL\Traits\AALUsuarioTrait;

class User extends Authenticatable
{
    use AALUsuarioTrait;

    ...
}
```

8) Abra `database/seeds/DatabaseSeeder.php` e adicione o seguinte codigo:

```php
        use Manzoli2122\AAL\Models\Perfil;
        use App\User;
```

```php
        $user = new User();
        $user->name = 'Usuario Admnistrador';
        $user->email = 'user.admin@gmail.com';
        $user->password = bcrypt('senha123');
        $user->save();

    	$perfil = new Perfil();
        $perfil->nome = 'Admin';
        $perfil->descricao = 'Super Usuario';
        $perfil->save();

        $user->perfis()->attach($perfil->id);         
 ```
 
 9) excute o seguinte comando para criar o usuario e o perfil configurado acima: 

```json
php artisan db:seed
```

10) Excute o seguinte comando: 

```json
php artisan make:auth
```




Não esqueça do:
```bash
composer dump-autoload
```

