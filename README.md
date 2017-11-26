# AAL Autenticação e Autorização Laravel

[![License](https://poser.pugx.org/manzoli2122/aal/license.svg)](https://packagist.org/packages/manzoli2122/aal)


Open your config/app.php and add the following to the providers array:

Manzoli2122\AAL\AALServiceProvider::class,

'AAL'   => Manzoli2122\AAL\AALFacade::class,

php artisan vendor:publish



php artisan aal:migration