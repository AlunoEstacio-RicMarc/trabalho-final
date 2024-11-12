<?php
session_start();
session_destroy();
// Redireciona para a página de agradecimento
header("Location: ../adeus.php");
exit();
?>
