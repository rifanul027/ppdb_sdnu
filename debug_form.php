<?php

// Debug Script untuk troubleshoot form submission
// Letakkan ini di awal method processDaftar() untuk debugging

echo "<h2>DEBUG INFORMATION</h2>";
echo "<h3>Request Method:</h3>";
var_dump($this->request->getMethod());

echo "<h3>Is POST:</h3>";
var_dump($this->request->is('post'));

echo "<h3>POST Data:</h3>";
var_dump($this->request->getPost());

echo "<h3>FILES Data:</h3>";
var_dump($_FILES);

echo "<h3>Session Data:</h3>";
var_dump(session()->get());

echo "<h3>CSRF Token:</h3>";
echo "Token: " . csrf_token() . "<br>";
echo "Hash: " . csrf_hash() . "<br>";

die("Debug stopped here");

?>
