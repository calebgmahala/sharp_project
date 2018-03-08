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

<header class="row">
    <div class="header-title">
        <h1>This is a list of users</h1>
    </div>
</header>
<div>
	<ol class="left_column">
	<?php
		foreach($users as $u) {
			echo '<li>';
			echo '<a class="body_nav_links" href=/user/'.$u['id'].'>'.$u['name'].'</a>';
			echo '</li>';
		}
	?>
	</ol>
	<ul class="right_column">
		<?php
			echo '<a class="" href="/signup/">Signup!</a> | ';
			echo '<a class="" href="/logout/">Logout!</a>';
		?>
	</ul>
</div>