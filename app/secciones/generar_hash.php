<?php
// Generar el hash de la contraseña
$hashed_password = password_hash('ecotec', PASSWORD_DEFAULT);

// Mostrar el hash en pantalla
echo $hashed_password;
