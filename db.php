<?php
    if (PHP_SAPI != 'cli') {
        exit('Rodar via CLI');
    }

    require __DIR__ . '/vendor/autoload.php';

    // Instantiate the app
    $settings = require __DIR__ . '/src/settings.php';
    $app = new \Slim\App($settings);

    // Set up dependencies
    require __DIR__ . '/src/dependencies.php';

    $db = $container->get('db');

    $schema = $db->schema();
    $table = 'produtos';

    $schema->dropIfExists( $table );

    // create tabel products
    $schema->create($table, function( $tab ) {

        $tab->increments('id');
        $tab->string('titulo', 100);
        $tab->text('descricao');
        $tab->decimal('preco', 11, 2);
        $tab->string('fabricante', 60);
        $tab->date('dt_criacao');

    });

    $db->table( $table )->insert([
        'titulo' => 'Smartphone Motorola Moto G6 32GB Dual Chip',
        'descricao' => 'Android Oreo - 8.0 Tela 5.7 Octa-Core 1.8 GHz 4G Câmera 12 + 5MP (Dual Traseira) - Índigo',
        'preco' => 899.99,
        'fabricante' => 'Motorola',
        'dt_criacao' => '2021-12-26'
    ]);

    $db->table( $table )->insert([
        'titulo' => 'Iphone X Cinza Espacial 64GB',
        'descricao' => 'Tela 5.8 IOS 12 4G Wi-Fi Câmera 12MP - Apple',
        'preco' => 4999.00,
        'fabricante' => 'Apple',
        'dt_criacao' => '2021-12-26'
    ]);
?>