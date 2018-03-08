<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link      https://cakephp.org CakePHP(tm) Project
 * @since     0.2.9
 * @license   https://opensource.org/licenses/mit-license.php MIT License
 */
namespace App\Controller;

use Cake\Core\Configure;
use Cake\Network\Exception\ForbiddenException;
use Cake\Network\Exception\NotFoundException;
use Cake\View\Exception\MissingTemplateException;
use Cake\Datasource\ConnectionManager;

/**
 * Static content controller
 *
 * This controller will render views from Template/Pages/
 *
 * @link https://book.cakephp.org/3.0/en/controllers/pages-controller.html
 */
class NewsController extends AppController
{

    /**
     * Displays a view
     *
     * @param array ...$path Path segments.
     * @return \Cake\Http\Response|null
     * @throws \Cake\Network\Exception\ForbiddenException When a directory traversal attempt.
     * @throws \Cake\Network\Exception\NotFoundException When the view file could not
     *   be found or \Cake\View\Exception\MissingTemplateException in debug mode.
     */
    public function index()
    {
        $connection = ConnectionManager::get('default');



        //$this->set(compact('page', 'subpage'));
        $results = $connection->execute('SELECT * FROM articles;')->fetchAll('assoc');
        $this->set('table', $results);
        try {
            $this->render( 'dashboard' );
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }

        //return $this->redirect('/'.$path);
    }

    public function create()
    {
        try {
            $this->render( 'form' );
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function show($path)
    {
        $connection = ConnectionManager::get('default');

        $this->set('article', $path);
        $results = $connection->execute("SELECT * FROM articles WHERE id='$path' ;")->fetch('assoc');
        $this->set('table', $results);
        try {
            $this->render( 'show' );
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }
    }

    public function new() {
        $connection = ConnectionManager::get('default');
        // $result = $connection->prepare('CREATE TABLE articles (id INTEGER PRIMARY KEY AUTOINCREMENT, title TEXT NOT NULL, article TEXT NOT NULL, author TEXT NOT NULL);');
        // $result->execute();
        $title = $_POST["title"];
        $text = $_POST["text"];
        if (!empty($_SESSION)) {
            $author = $_SESSION['username'];
        } else {
            $author = 'Unknown';
        }
        $connection->execute("INSERT INTO articles('title', 'article', 'author') VALUES('$title', '$text.', '$author');");
        $this->redirect('/news/');
    }

    public function delete() {
        $connection = ConnectionManager::get('default');
        $d = $_POST["delete_article"];
        $connection->execute("DELETE FROM articles WHERE id='$d' ;");
        $this->redirect('/news/');
    }
    public function edit () {
        
    }
}