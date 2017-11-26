# AAL Autenticação e Autorização Laravel


[![Latest Stable Version](https://poser.pugx.org/manzoli2122/all/v/stable)](https://packagist.org/packages/manzoli2122/all)
[![Latest Unstable Version](https://poser.pugx.org/manzoli2122/all/v/unstable)](https://packagist.org/packages/manzoli2122/all)
[![License](https://poser.pugx.org/manzoli2122/all/license)](https://packagist.org/packages/manzoli2122/all)
[![Total Downloads](https://poser.pugx.org/manzoli2122/all/downloads)](https://packagist.org/packages/manzoli2122/all)
[![composer.lock](https://poser.pugx.org/manzoli2122/all/composerlock)](https://packagist.org/packages/manzoli2122/all)


## Instalação

1) Para instalar o Laravel 5 AAL, basta adicionar o seguinte ao seu  composer.json. Em seguida, execute `composer update`:

```json
"manzoli2122/aal": "*"
```

2) Abra seu `config/app.php`  e adicione o seguinte ao array  `providers`:

```php
Manzoli2122\AAL\AALServiceProvider::class,
```

3) No mesmo `config/app.php` adicione o seguinte ao array `aliases `: 

```php
'AAL'   => Manzoli2122\AAL\AALFacade::class,
```




php artisan vendor:publish



php artisan aal:migration