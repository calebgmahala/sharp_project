<?php
/**
 * CakePHP(tm) : Rapid Development Framework (https://cakephp.org)
 * Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 *
 * Licensed under The MIT License
 * For full copyright and license information, please see the LICENSE.txt
 * Redistributions of files must retain the above copyright notice.
 *
 * @copyright     Copyright (c) Cake Software Foundation, Inc. (https://cakefoundation.org)
 * @link          https://cakephp.org CakePHP(tm) Project
 * @since         0.10.0
 * @license       https://opensource.org/licenses/mit-license.php MIT License
 */
use Cake\Cache\Cache;
use Cake\Core\Configure;
use Cake\Core\Plugin;
use Cake\Datasource\ConnectionManager;
use Cake\Error\Debugger;
use Cake\Network\Exception\NotFoundException;

if (!Configure::read('debug')) :
    throw new NotFoundException(
        'Please replace src/Template/Pages/home.ctp with your own version or re-enable debug mode.'
    );
endif;

$cakeDescription = 'CakePHP: the rapid development PHP framework';
?>
<head>
	<?= $this->Html->css('show.css') ?>
</head>

<header class="row">
    <div class="header-title">
        <h1>Users</h1>
    </div>
</header>
<div>
	<ul>
	    <?php 
			echo "<li><h6>Username:</h6><p>".$user['name']."</p></li>";
			echo "<li><h6>Password:</h6><p>".$user['password']."</p></li>";
			echo "<li><h6>ID:</h6><p>".$user['id']."</p></li>";
	    ?>
	</ul>
	<ul>
		<?php
			//echo "<a href='/news/'>Back</a> | ";
			echo "<a href='/users/edit'>Edit Article</a> | ";
			echo "<form action='/users/delete' method='post'>";
			echo "<input type=hidden name='delete_user' value='$user_id'>";
			echo "<input type='submit' value='Destroy'>";
			echo "</form>";
		?>
	</ul>
</div>