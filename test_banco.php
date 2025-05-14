<?php
$pdo = new PDO('pgsql:host=localhost;port=5432;dbname=yii2basic', 'postgres', 'password');
echo "Conexão bem-sucedida!";