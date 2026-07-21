<?= $this->include('operateur/partials/header', ['title' => 'Prefixes']) ?>
<div class="d-flex justify-content-between align-items-center mb-4"><h1 class="h3 mb-0">Prefixes</h1><div class="d-flex gap-2"><a href="<?= site_url('operateurs') ?>" class="btn btn-outline-secondary">Operateurs</a><a href="<?= site_url('prefixes/new') ?>" class="btn btn-primary">Ajouter un prefixe</a></div></div>
<div class="card shadow-sm"><div class="table-responsive"><table class="table table-hover mb-0 align-middle"><thead class="table-light"><tr><th>Prefixe</th><th>Libelle</th><th>Operateur</th><th class="text-end">Actions</th></tr></thead><tbody>
<?php foreach ($prefixes as $prefixe) : ?><tr><td><?= esc($prefixe['prefixe']) ?></td><td><?= esc($prefixe['libelle']) ?></td><td><?= esc($prefixe['operateur_nom']) ?></td><td class="text-end"><a href="<?= site_url('prefixes/' . $prefixe['id'] . '/edit') ?>" class="btn btn-sm btn-outline-primary">Modifier</a><form action="<?= site_url('prefixes/' . $prefixe['id'] . '/delete') ?>" method="post" class="d-inline"><?= csrf_field() ?><button type="submit" class="btn btn-sm btn-outline-danger">Supprimer</button></form></td></tr><?php endforeach; ?>
<?php if (empty($prefixes)) : ?><tr><td colspan="4" class="text-center text-muted py-4">Aucun prefixe.</td></tr><?php endif; ?>
</tbody></table></div></div>
<?= $this->include('operateur/partials/footer') ?>
