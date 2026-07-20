<?= $this->include('client/partials/header') ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Dépôt</h4>
                <!-- Formulaire de dépôt : envoie le montant au contrôleur OperationController::depotProcess -->
                <form action="<?= site_url('client/depot') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Montant à déposer (Ar)</label>
                        <input type="number" step="0.01" min="1" name="montant" class="form-control" required>
                    </div>
                    <button type="submit" class="btn btn-success w-100">Valider le dépôt</button>
                    <a href="<?= site_url('client/dashboard') ?>" class="btn btn-link w-100 mt-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('client/partials/footer') ?>