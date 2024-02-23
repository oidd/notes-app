<?php

namespace App\Controllers;

use App\Models\NoteModel;
use App\Models\UserModel;

class NoteController extends \App\Core\Controller
{
    function __construct()
    {
        if (!self::isUserLogged())
            self::redirect('/login');
    }

    public function index()
    {
        $u = UserModel::findById($_SESSION['logged_user_id']);
        $n = NoteModel::getNotesByUserId($u->getId());

        $viewData = [
            'notes' => $n,
            'username' => $u->username
        ];

        $this->proceedView('notesPage', $viewData);
    }

    public function show($id)
    {
        $u = UserModel::findById($_SESSION['logged_user_id']);
        $n = NoteModel::findById($id);
        if ($n->user_id !== $u->getId())
            self::redirect('/');

        $viewData = [
            'title' => $n->title,
            'data'  => $n->data
        ];

        $this->proceedView('showNotePage', $viewData);
    }

    public function create()
    {
        $u = UserModel::findById($_SESSION['logged_user_id']);
        
        $viewData = [
            'user' => $u
        ];
        
        if ($this->isDataSent())
        {
            if (!$this->isAllDataSent())
            {
                $viewData['fields'] = [
                    'title' => $_POST['title'],
                    'data' => $_POST['data']
                ];

                $viewData['err'][] = 'Fill all inputs';

                $this->proceedView('createNote', $viewData);
            }
            
            $n = new NoteModel;
            $n->title = $_POST['title'];
            $n->data = $_POST['data'];
            $n->user_id = $u->getId();
            $n->save();
            self::redirect('/note');
        }
        else
            $this->proceedView('createNote', $viewData);
    }

    public function edit($id)
    {
        $u = UserModel::findById($_SESSION['logged_user_id']);
        $n = NoteModel::findById($id);
        if ($n->user_id !== $u->getId())
            self::redirect('/note');

        if (!$this->isDataSent())
        {
            $viewData['fields'] = [
                'title' => $n->title,
                'data' => $n->data
            ];
    
            $this->proceedView('createNote', $viewData);    
        }

        if (!$this->isAllDataSent())
        {
            $viewData['fields'] = [
                'title' => $n->title,
                'data' => $n->data
            ];

            $viewData['err'][] = 'Fill all inputs';
    
            $this->proceedView('createNote', $viewData);
        }

        $n->title = $_POST['title'];
        $n->data = $_POST['data'];
        $n->save();

        self::redirect('/note');
    }

    public function delete($id)
    {
        $u = UserModel::findById($_SESSION['logged_user_id']);
        $n = NoteModel::findById($id);
        if ($n->user_id === $u->getId())
            $n->delete();
        self::redirect('/note');
    }

    private function isDataSent()
    {
        return  isset($_POST['title']) || !empty($_POST['title']) ||
                isset($_POST['data']) || !empty($_POST['data'])
                ;
    }

    private function isAllDataSent()
    {
        return  isset($_POST['title']) && !empty($_POST['title']) &&
                isset($_POST['data']) && !empty($_POST['data'])
                ;
    }
}