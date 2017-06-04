<?php
	foreach($javascripts as $j) {
		if (file_exists($APPLICATION_DIR.'/javascripts/'.$j)) {
			echo '<script type="text/javascript" src="javascripts/'.$j.'"></script>';
		}
	}
?>
</body>
</html>
