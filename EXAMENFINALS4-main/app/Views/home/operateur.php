<?= $this->include('operateur/partials/header', ['title' => 'Espace operateur']) ?>
<div class="mb-4"><h1 class="h3 mb-1">Espace operateur</h1><p class="text-muted mb-0">Configuration et suivi de l'activite Mobile Money.</p></div>
<div class="row g-3">
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('reglements-operateurs') ?>"><div class="card-body"><h2 class="h5 text-dark">Reglements operateurs</h2><p class="text-muted mb-0">Montants a envoyer ou recevoir.</p></div></a></div>
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('operateurs') ?>"><div class="card-body"><h2 class="h5 text-dark">Operateurs</h2><p class="text-muted mb-0">Commissions et operateurs partenaires.</p></div></a></div>
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('prefixes') ?>"><div class="card-body"><h2 class="h5 text-dark">Prefixes</h2><p class="text-muted mb-0">Numeros et operateurs associes.</p></div></a></div>
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('types-operation') ?>"><div class="card-body"><h2 class="h5 text-dark">Types d'operation</h2><p class="text-muted mb-0">Depot, retrait et transfert.</p></div></a></div>
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('baremes') ?>"><div class="card-body"><h2 class="h5 text-dark">Baremes de frais</h2><p class="text-muted mb-0">Tranches et frais applicables.</p></div></a></div>
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('gains') ?>"><div class="card-body"><h2 class="h5 text-dark">Situation des gains</h2><p class="text-muted mb-0">Frais et commissions par periode.</p></div></a></div>
    <div class="col-md-6 col-lg-4"><a class="card h-100 shadow-sm text-decoration-none" href="<?= site_url('comptes') ?>"><div class="card-body"><h2 class="h5 text-dark">Comptes clients</h2><p class="text-muted mb-0">Soldes des comptes clients.</p></div></a></div>
</div>
<?= $this->include('operateur/partials/footer') ?>
