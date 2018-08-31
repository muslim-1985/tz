<?php
    try {
        $connection = new PDO('mysql:host=localhost;dbname=test_update;charset=utf8', 'root', 'root');
        $connection->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);
    } catch (PDOException $e) {
        echo 'Подключение не удалось: ' . $e->getMessage();
    }

    $doc = new DOMDocument();

    foreach($connection->query('SELECT news, id FROM reports limit 700') as $row) {
        if (!empty($row['news'])) {
            $news = unserialize($row['news']);
            //var_dump($row);
            //var_dump($news);

            foreach ($news as &$new) {
                $doc->loadHTML($new['description']);
                $tag = $doc->getElementsByTagName('a');
                $new += ['new_link' => '<p><a href="' . $tag[0]->getAttribute('href') . '">Source</a></p>'];
            }
            $ser_news = serialize($news);
            //var_dump($ser_news);
//            $stmt = $connection->prepare('UPDATE reports set news = ? WHERE id = ?');
//            $stmt->execute(array($ser_news, $row['id']));
        }
    }
/**
 * Laravel - A PHP Framework For Web Artisans
 *
 * @package  Laravel
 * @author   Taylor Otwell <taylor@laravel.com>
 */

//define('LARAVEL_START', microtime(true));
//
///*
//|--------------------------------------------------------------------------
//| Register The Auto Loader
//|--------------------------------------------------------------------------
//|
//| Composer provides a convenient, automatically generated class loader for
//| our application. We just need to utilize it! We'll simply require it
//| into the script here so that we don't have to worry about manual
//| loading any of our classes later on. It feels great to relax.
//|
//*/
//
//require __DIR__.'/../vendor/autoload.php';
//
///*
//|--------------------------------------------------------------------------
//| Turn On The Lights
//|--------------------------------------------------------------------------
//|
//| We need to illuminate PHP development, so let us turn on the lights.
//| This bootstraps the framework and gets it ready for use, then it
//| will load up this application so that we can run it and send
//| the responses back to the browser and delight our users.
//|
//*/
//
//$app = require_once __DIR__.'/../bootstrap/app.php';
//
///*
//|--------------------------------------------------------------------------
//| Run The Application
//|--------------------------------------------------------------------------
//|
//| Once we have the application, we can handle the incoming request
//| through the kernel, and send the associated response back to
//| the client's browser allowing them to enjoy the creative
//| and wonderful application we have prepared for them.
//|
//*/
//
//$kernel = $app->make(Illuminate\Contracts\Http\Kernel::class);
//
//$response = $kernel->handle(
//    $request = Illuminate\Http\Request::capture()
//);
//
//$response->send();
//
//$kernel->terminate($request, $response);
