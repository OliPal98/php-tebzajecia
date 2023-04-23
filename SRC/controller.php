<?php

declare(strict_types=1);

namespace App;

include_once('./SRC/view.php');
require_once('./config/config.php');
require_once('./src/Database.php');

use App\Exception\NotFoundException;

class controller
{
    const DEFAULT_ACTION = 'list';
    private Request $request;
    private static $configuration = [];
    private Database $database;
    private View $view;


    public function __construct(Request $request)
    {
        $this->request = $request;
        $this->view = new View();
        $this->database = new Database(self::$configuration);
    }

    public static function initConfiguration(array $configuration):void
    {
        self::$configuration = $configuration;
    }

    public function run(): void
    {

        $viewParams = [];

        switch ($this->action()){
            case 'create':
                $page = 'create';
                if ($this->request->hasPost()){
                    $noteData = [
                        'title' => $this->request->postParam('title'),
                        'description' => $this->request->postParam('description'),
                    ];
                    $this->database->createNote($noteData);
                    header('Location: /?before=created');
                    exit;
                }
                break;
            case 'show';
            $page = 'show';
            $noteId = (int) $this->request->getParam('id') ?? null;
            if (!$noteId) {
                header('Location: /?error=missingNoteId');
                exit;
            }
            try {
                $note = $this->database->getNote($noteId);
            } catch (NotFoundException $e) {
                header('Location: /?error=noteNotFound');
            }
            $viewParams = [
                'note' => $note,
            ];
            break;
            default:
                $page = 'list';
                $viewParams = [
                    'notes' => $this->database->getNotes(),
                    'before' => $this->request->getParam('before') ?? null,
                    'error' => $this->request->getParam('error') ?? null,
                ];
        }

        $this->view->render($page, $viewParams);
    }

    private function action(): string
    {
        return $this->request->getParam('action') ?? self::DEFAULT_ACTION;
    }
}