<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Espace Client - Mobile Money</title>
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet">
</head>
<body class="bg-light">
<nav class="navbar navbar-dark bg-dark mb-4">
    <div class="container">
        <span class="navbar-brand">💰 Mobile Money</span>
        <?php if (session('isLoggedIn')): ?>
            <div class="text-white d-flex align-items-center gap-2">
                <span><?= esc(session('client_numero')) ?></span>
                <a href="<?= site_url('client/logout') ?>" class="btn btn-sm btn-outline-light">Déconnexion</a>
            </div>
        <?php endif; ?>
    </div>
</nav>
<div class="container mb-5">
    <?php if (session()->getFlashdata('success')): ?>
        <div class="alert alert-success"><?= esc(session()->getFlashdata('success')) ?></div>
    <?php endif; ?>
    <?php if (session()->getFlashdata('error')): ?>
        <div class="alert alert-danger"><?= esc(session()->getFlashdata('error')) ?></div>
    <?php endif; ?>