<?php
foreach ($page['javascripts'] as $j) {
    if (file_exists($APPLICATION_DIR.'/js/'.$j)) {
        echo '<script type="text/javascript" src="js/'.$j.'"></script>';
    }
}
    echo '<script>CSRF_TOKEN="'.$csrf_token.'";</script>';
?>
</body>
</html>
