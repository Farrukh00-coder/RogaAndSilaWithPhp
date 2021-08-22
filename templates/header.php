<?php
require $_SERVER['DOCUMENT_ROOT'] . '/src/core.php';

// продлеваем жизнь куки
if (isset($_SESSION['isAuth']) && $_SESSION['isAuth'] === true && isset($_COOKIE['email'])) {
    setcookie('email', $_COOKIE['email'], time() + 3600*24*30, "/");
}

if (isset($_GET['login']) && $_GET['login'] == 'no') {
    $_SESSION = [];
    session_destroy();
    header("Location: /");
}


?>

<!DOCTYPE html>
<html class="antialiased" lang="ru">
<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="/assets/css/form.min.css" rel="stylesheet">
    <link href="/assets/css/tailwind.css" rel="stylesheet">
    <link href="/assets/css/base.css" rel="stylesheet">

    <title>Рога и Сила - Главная страница</title>
    <link href="/assets/favicon.ico" rel="shortcut icon" type="image/x-icon">
</head>
<body class="bg-white text-gray-600 font-sans leading-normal text-base tracking-normal flex min-h-screen flex-col">
<div class="wrapper flex flex-1 flex-col bg-gray-100">
    <header class="bg-white">
        <div class="border-b">
            <div class="container mx-auto block overflow-hidden px-4 sm:px-6 sm:flex sm:justify-between sm:items-center py-4 space-y-4 sm:space-y-0">
                <div class="flex justify-center">
                    <a href="/" class="inline-block sm:inline hover:opacity-75">
                        <img src="/assets/images/logo.png" width="222" height="30" alt="">
                    </a>
                </div>
                <div>

                    <?php if (! empty($_SESSION['isAuth'])) {
                        includeTemplate('/auth/_auth.php', [$_SESSION['user_name']]);
                    } else {
                        includeTemplate('/auth/_not_auth.php');
                    }?>

                </div>
            </div>
        </div>
        <div class="border-b">
            <div class="container mx-auto overflow-hidden px-4 sm:px-6">
                <section class="bg-white py-4">
                    <?php includeTemplate('/menu.php', getMenu());?>
                </section>
            </div>
        </div>
    </header>