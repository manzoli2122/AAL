# AAL Autenticação e Autorização Laravel

[![License]](https://packagist.org/packages/manzoli2122/all)


Open your config/app.php and add the following to the providers array:

Manzoli2122\AAL\AALServiceProvider::class,

'AAL'   => Manzoli2122\AAL\AALFacade::class,

php artisan vendor:publish



php artisan aal:migration