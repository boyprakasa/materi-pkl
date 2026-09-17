<?php

function redirect(string $url): never
{
    header("Location: $url", true, 302);
    exit;
}

function success(string $message, string $url = 'index.php'): never
{
    $_SESSION['success'] = $message;

    redirect($url);
}

function error(string $message, string $url = 'index.php'): never
{
    $_SESSION['error'] = $message;

    redirect($url);
}
