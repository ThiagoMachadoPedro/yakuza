<?php
$filename = '../storage/test.txt'; // Caminho para um arquivo dentro da pasta storage

if (file_exists($filename)) {
          echo "O arquivo $filename existe";
} else {
          echo "O arquivo $filename não existe";
}
