<?php

namespace App\Core;

use Twig\Environment;
use Twig\Loader\FilesystemLoader;

class View {
    private Environment $twig;

    //Carrega o Twig e define o caminho das views na pasta definida como Views
    public function __construct()
    {
        $loader = new FilesystemLoader(__DIR__ . '/../Views');
        $this->twig = new Environment($loader);
    }

    public function render(string $template, array $data = []) {
        echo $this->twig->render($template, $data);
    }
}