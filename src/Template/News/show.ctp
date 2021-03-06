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
        <h1>Here is one news article</h1>
    </div>
</header>
<div>
	<ul>
	    <?php 
			echo "<li>".$table['title']."</li>";
			echo "<li>".$table['article']."</li>";
			echo "<li>".$table['author']."</li>";
	    ?>
	</ul>
	<ul>
		<?php
			echo "<a href='/news/'>Back</a> | ";
			echo "<a href='/news/edit'>Edit Article</a> | ";
			echo "<form action='/news/delete' method='post'>";
			echo "<input type=hidden name='delete_article' value='$article'>";
			echo "<input type='submit' value='Destroy'>";
			echo "</form>";
		?>
	</ul>
</div>