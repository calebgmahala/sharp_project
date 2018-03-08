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
class SessionsController extends AppController
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
        //$this->set(compact('page', 'subpage'));
        try {
            $this->render( 'login' );
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }

        //return $this->redirect('/'.$path);
    }

    public function new()
    {
        $connection = ConnectionManager::get('default');
        $checkName = $connection->execute("SELECT * FROM users WHERE name = '".$_POST['name']."' ;")->fetch('assoc');
        var_dump($checkName);
        var_dump($_POST['password']);
        var_dump($checkName['password']);
    	if ($_POST['password'] = $checkName['password']) {
    		
    		$_SESSION['id'] = $checkName['id'];
    		$_SESSION['username'] = $checkName['name'];
    		var_dump($_SESSION['id']);
    		print_r($_SESSION['username']);
    	}
        try {
            $this->redirect( "user/".$_SESSION['id'] );
        } catch (MissingTemplateException $exception) {
            if (Configure::read('debug')) {
                throw $exception;
            }
            throw new NotFoundException();
        }

        //return $this->redirect('/'.$path);
    }
    public function delete()
    {
    	// if (session_status() != PHP_SESSION_NONE) {
    	// 	$_SESSION = array();
    		
    	// 	echo 'session up';
    		
    	// 	var_dump($_SESSION);
    	// 	var_dump($_SESSION['username']);
    		
    		if (ini_get("session.use_cookies")) {
    			$params = session_get_cookie_params();
    			setcookie(session_name(), '', time() - 42000,
        			$params["path"], $params["domain"],
        			$params["secure"], $params["httponly"]
    		);
    		}
    		session_destroy();
    		session_start();
		// } else {
		// 	var_dump('session not up');
		// }
  //       try {
  //       	$this->render( 'login' );
            $this->redirect( '/login/' );
  //       } catch (MissingTemplateException $exception) {
  //           if (Configure::read('debug')) {
  //               throw $exception;
  //           }
  //           throw new NotFoundException();
  //       }

        //return $this->redirect('/'.$path);
    }
}