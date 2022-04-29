<?php
	// Quick thing for links.
	$maindirectory = '../../';
	$_SESSION['maindirectory'] = $maindirectory;
	$files = array('config.php', 'addons/execute.php');
	
	foreach ($files as $value) {
		require_once($maindirectory . $value);
	}
	$db = mysqli_connect($config['host'], $config['user'], $config['pass'], $config['name']);
	
	
	$filename = 'viewforum.php';
	$id = 0;
	if (isset($_GET['id'])) {
		$id = $_GET['id'];
	} else {
		$id = -1;
	}
	
	// This returns the user information that is logged in. Will return false if they aren't logged in.
	$userinfo = $classes['users']->fetch_user_info($db);
	
	// Made by: [GFL] Roy (Christian Deacon)
	// Notes:
	/*
		This was my first advanced website I actually made. It was started on 9-14-14. I got some information (especially the drop downs and nav bars) from Google but changed them up a bit and made them work correctly.
		Point is, not entirely my custom code, but this website is optimized and unique by me.
	*/
	
	echo '<html>';
		$classes['page']->load_sounds($maindirectory);
		
		$classes['page']->print_header(array($maindirectory . 'styling.css', 'forums.css'), $config);
		echo '<body>';
			$classes['page']->print_navbar($db, $userinfo, $maindirectory, $config);
			echo '<div id="forumcontent">';
				$classes['page']->print_cp($userinfo, $maindirectory, $config);
			
			
				echo '<div id="forums">';
						$classes['forums']->print_forums($db, $id, $userinfo, $maindirectory, $config);
				echo '</div>';

			echo '</div>';
		
			$classes['page']->print_footer($config);
			
		echo '</body>';
	echo '</html>';
?>