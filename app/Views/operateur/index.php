<?= $this->include('operateur/partials/header', ['title' => 'Operateurs']) ?>

<div class="d-flex justify-content-between align-items-center mb-4">
    <h1 class="h3 mb-0">Operateurs</h1>
    <a href="<?= site_url('operateurs/new') ?>" class="btn btn-primary">Ajouter un operateur</a>
</div>

<div class="card shadow-sm">
    <div class="table-responsive">
        <table class="table table-hover mb-0 align-middle">
            <thead class="table-light"><tr><th>ID</th><th>Nom</th><th>Commission transfert</th><th class="text-end">Actions</th></tr></thead>
            <tbody>
            <?php foreach ($operateurs as $operateur) : ?>
                <tr>
                    <td><?= $operateur['id'] ?></td>
                    <td><?= esc($operateur['nom']) ?></td>
                    <td><?= number_format((float) $operateur['commission_transfert'], 2, ',', ' ') ?> %</td>
                    <td class="text-end">
                        <a href="<?= site_url('operateurs/' . $operateur['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">Modifier</a>
                        <form action="<?= site_url('operateurs/' . $operateur['id'] . '/delete') ?>" method="post" class="d-inline">
                            <?= csrf_field() ?><button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button>
                        </form>
                    </td>
                </tr>
            <?php endforeach; ?>
            <?php if (empty($operateurs)) : ?><tr><td colspan="4" class="text-center text-muted py-4">Aucun operateur.</td></tr><?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?= $this->include('operateur/partials/footer') ?>
