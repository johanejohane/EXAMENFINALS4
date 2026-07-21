<?= $this->include('client/partials/header') ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="mb-3">Transfert</h4>
                <form action="<?= site_url('client/transfert') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Numéro destinataire</label>
                        <input type="text" name="numero_destination" class="form-control"
                            placeholder="0371234567" maxlength="10">
                    </div>
                    <div class="mb-3">
                        <label class="form-label" for="numeros_destinataires">Envoi multiple (un numero par ligne)</label>
                        <textarea name="numeros_destinataires" id="numeros_destinataires" class="form-control" rows="4"
                            placeholder="0331234567&#10;0371234567"></textarea>
                    </div>
                    <div class="mb-3">
                        <label class="form-label">Montant à transférer (Ar)</label>
                        <input type="number" step="0.01" min="1" name="montant" class="form-control" required>
                    </div>
                    
                    <div class="form-check mb-3">
                        <input class="form-check-input" type="checkbox" name="inclure_frais_retrait" value="1" id="inclure_frais_retrait">
                        <label class="form-check-label" for="inclure_frais_retrait">
                            Inclure le frais de retrait du destinataire
                        </label>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Valider le transfert</button>
                    <a href="<?= site_url('client/dashboard') ?>" class="btn btn-link w-100 mt-2">Annuler</a>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('client/partials/footer') ?>
