ï»¿
<?php
// Destruira sessão existentes//
session_start("AB");
session_unset();
echo "<meta http-equiv='refresh' content='0.1; URL=index.html'>";
?>
