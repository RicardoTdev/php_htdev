<?php

session_start();


// Remove todas as variáveis da sessão

session_unset();


// Destrói a sessão

session_destroy();


// Volta para o início

header("Location: index.php");

exit;