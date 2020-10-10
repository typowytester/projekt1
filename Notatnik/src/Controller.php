<?php

declare(strict_types=1);

namespace App;

require_once("src/View.php");

class Controller
{
    private const DEFAULT_ACTION = 'list';

    private array $request;
    private View $view;

    public function __construct(array $request)
    {
        $this->request = $request;
        $this->view = new View();

    }

    public function run(): void
    {
        $viewParams = [];
        // var_dump($this->action());
        switch ($this->action()) {
            case 'zadanie':
                
               
                $page = 'zadanie';
                include 'templates/layout.php';
                /*
                $zadaniee = false;

                $data = $this->getRequestPost();
                if (!empty($data)) {
                    $zadaniee = true;
                    $viewParams['resultZadanie'];
                }
                $viewParams['zadaniee'] = $zadaniee;
                */
                break;
            default:
                $page = 'list';
                $liste = false;

                $data = $this->getRequestPost();
                if (!empty($data)) {
                    $liste = true;
                    $viewParams['resultList'];
                }
                $viewParams['liste'] = $liste;
                break;
        }

        $this->view->render($page, $viewParams);
    }

    private function action(): string
    {
        $data = $this->getRequestGet();
        return $data['action'] ?? self::DEFAULT_ACTION;
    }

    private function getRequestGet(): array
    {
        return $this->request['get'] ?? [];
    }

    private function getRequestPost(): array
    {
        return $this->request['post'] ?? [];
    }
}