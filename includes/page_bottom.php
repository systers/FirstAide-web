<?php
	foreach($javascripts as $j) {
		if (file_exists($APPLICATION_DIR.'/javascripts/'.$j)) {
			echo '<script type="text/javascript" src="javascripts/'.$j.'"></script>';
		}
	}
	echo '<script>CSRF_TOKEN="'.$csrf_token.'";</script>';
?>
</body>
</html>
