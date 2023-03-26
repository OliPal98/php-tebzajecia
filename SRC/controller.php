<?php

declare(strict_types=1);

namespace App;

include_once('./SRC/view.php');

class controller
{
    const DEFAULT_ACTION = 'list';
    private array $getData;
    private array $postData;


    public function __construct(array $getData, array $postData)
    {
        $this->getData = $getData;
        $this->postData = $postData;
    }

    public function run(): void
    {
        $action = $this->getData['action'] ?? self:: DEFAULT_ACTION;
        $view = new view();

        $viewParams = [];

        switch ($action){
            case 'create':
                $page = 'create';
                $created = false;
                if(!empty($_POST)){
                    $viewParams = [
                        'title' => $_POST['title'],
                        'description' => $_POST['description'],
                    ];
                    $created = true;
                }
                $viewParams['created'] = $created;
                break;
                default:
                $page = 'list';
                $viewParams['resultList'] = 'Wyświetlamy listę notatek';
        }

        $view->render($page, $viewParams);
    }
}