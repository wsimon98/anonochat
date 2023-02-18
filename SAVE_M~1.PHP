<?php
session_start();

if (!isset($_SESSION['session_name'])) {
  $_SESSION['session_name'] = "517" . rand(1000000, 9999999);
}

$session_name = $_SESSION['session_name'];

if (isset($_POST["message"])) {
  $message = $_POST["message"];
  $message = htmlentities($message);
  $message = str_replace(["\n", "\r"], "", $message);
  $message = trim($message);

  if (!empty($message)) {
    $handle = fopen("messages.txt", "a");
    fwrite($handle, $session_name . ": " . $message . "\n");
    fclose($handle);

    $lines = file("messages.txt", FILE_IGNORE_NEW_LINES);
    if (count($lines) >= 10) {
      array_shift($lines);
      $handle = fopen("messages.txt", "w");
      foreach ($lines as $line) {
        fwrite($handle, $line . "\n");
      }
      fclose($handle);
    }
  }
}
