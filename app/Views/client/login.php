<?= $this->include('client/partials/header') ?>

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">Connexion</h4>
                <p class="text-muted text-center">Entrez votre numéro de téléphone pour accéder à votre compte.</p>
                <!-- Formulaire de connexion : envoie le numéro au contrôleur AuthController::process -->
                <form action="<?= site_url('client/login') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Numéro de téléphone</label>
                        <input type="text" name="numero" class="form-control" placeholder="0331234567"
                            value="<?= old('numero') ?>" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">Se connecter</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('client/partials/footer') ?>