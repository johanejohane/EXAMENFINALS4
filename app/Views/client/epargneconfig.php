

<div class="row justify-content-center">
    <div class="col-md-5">
        <div class="card shadow-sm">
            <div class="card-body">
                <h4 class="card-title mb-3 text-center">Connexion</h4>
                <p class="text-muted text-center">Saisisser votre pourcentage d'épargne</p>
                <form action="<?= site_url('epargne/new') ?>" method="post">
                    <?= csrf_field() ?>
                    <div class="mb-3">
                        <label class="form-label">Pourcentage Epargne</label>
                        <input type="number" name="pourcentage" class="form-control" placeholder="20"
                            value="<?= old('numero') ?>" maxlength="10" required>
                    </div>
                    <button type="submit" class="btn btn-primary w-100">appliquer l'eparge</button>
                </form>
            </div>
        </div>
    </div>
</div>

<?= $this->include('client/partials/footer') ?>