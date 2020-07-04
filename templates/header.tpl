{* Encabezado del HTML y de la página, nav y div de clase main para el contenido *}

<!DOCTYPE html>
<html lang="en">
<head>
    <base href={$baseURL}>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <link rel="stylesheet" type="text/css" href="css/style.css">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.3.1/css/bootstrap.min.css" integrity="sha384-ggOyR0iXCbMQv3Xipma34MD+dH/1fQ784/j6cY/iJTQUOhcWr7x9JvoRxT2MZw1T" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <title>{$pageName} - CORADOR Musical Instruments</title>
</head>
<body>    
    <header>
        {*<nav class="navbar navbar-expand-lg navbar navbar-dark bg-primary mb-3">*}
        <nav class="navbar navbar-expand-xl navbar-dark bg-primary mb-3">
            <ul class="navbar-nav mr-auto">
                <li class="nav-item">
                    <a class="navbar-brand" href="{$baseURL}home">Home</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="{$baseURL}instruments">Instruments</a>
                </li>
                <li class="nav-item">
                    <a class="nav-item nav-link" href="{$baseURL}categories">Categories</a>
                </li>
            </ul>
            {if isset($username)}
                <span class="navbar-text"><a class="nav-item nav-link" href="{$baseURL}user">{$username} (control panel)</a></span>
                <span class="navbar-text"><a class="nav-item nav-link" href="{$baseURL}logout">Logout</a></span>
            {else}
                <span class="navbar-text"><a class="nav-item nav-link" href="{$baseURL}signup">Sign up</a></span>
                <span class="navbar-text"><a class="nav-item nav-link" href="{$baseURL}login">Log in</a></span>
            {/if}
        </nav>
        <h1>{$pageTitle}</h1>
    </header>
    <div class="main">