# AAL
Autenticação e Autorização Laravel



Open your config/app.php and add the following to the providers array:

Manzoli2122\AAL\AALServiceProvider::class,

'AAL'   => Manzoli2122\AAL\AALFacade::class,

php artisan vendor:publish



php artisan aal:migration