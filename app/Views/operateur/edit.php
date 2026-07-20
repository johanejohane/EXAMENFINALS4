<?= $this->include('operateur/partials/header', ['title' => 'Modifier operateur']) ?>
<div class="row justify-content-center"><div class="col-md-7 col-lg-5"><div class="card shadow-sm"><div class="card-body p-4">
    <h1 class="h4 mb-4">Modifier l'operateur</h1>
    <form action="<?= site_url('operateurs/' . $operateur['id']) ?>" method="post">
        <?= csrf_field() ?>
        <div class="mb-3"><label for="nom" class="form-label">Nom</label><input type="text" name="nom" id="nom" value="<?= esc($operateur['nom']) ?>" class="form-control" required></div>
        <div class="mb-4"><label for="commission_transfert" class="form-label">Commission transfert (%)</label><input type="number" step="0.01" min="0" name="commission_transfert" id="commission_transfert" value="<?= esc($operateur['commission_transfert']) ?>" class="form-control" required></div>
        <div class="d-flex gap-2"><button type="submit" class="btn btn-primary">Enregistrer</button><a href="<?= site_url('operateurs') ?>" class="btn btn-outline-secondary">Annuler</a></div>
    </form>
</div></div></div></div>
<?= $this->include('operateur/partials/footer') ?>
