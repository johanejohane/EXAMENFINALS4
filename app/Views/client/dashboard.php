<?= $this->include('client/partials/header') ?>

<div class="row">
    <div class="col-md-4 mb-4">
        <!-- Carte affichant le solde actuel du client -->
        <div class="card text-white bg-primary shadow-sm">
            <div class="card-body">
                <h6 class="mb-1">Solde disponible</h6>
                <h2 class="mb-0"><?= number_format((float) $client['solde'], 0, ',', ' ') ?> Ar</h2>
                <small>Numéro : <?= esc($client['numero']) ?></small>
            </div>
        </div>

        <!-- Menu de navigation vers les différentes opérations -->
        <div class="list-group mt-3">
            <a href="<?= site_url('client/depot') ?>" class="list-group-item list-group-item-action">➕ Dépôt</a>
            <a href="<?= site_url('client/retrait') ?>" class="list-group-item list-group-item-action">➖ Retrait</a>
            <a href="<?= site_url('client/transfert') ?>" class="list-group-item list-group-item-action">🔁 Transfert</a>
            <a href="<?= site_url('client/historique') ?>" class="list-group-item list-group-item-action">📜 Historique complet</a>
        </div>
    </div>

    <div class="col-md-8">
        <!-- Tableau des 10 dernières opérations -->
        <div class="card shadow-sm">
            <div class="card-header">Dernières opérations</div>
            <div class="card-body p-0">
                <table class="table mb-0">
                    <thead>
                        <tr><th>Date</th><th>Type</th><th>Montant</th><th>Frais</th></tr>
                    </thead>
                    <tbody>
                        <?php foreach ($historique as $h): ?>
                            <tr>
                                <td><?= date('d/m/Y H:i', strtotime($h['date_operation'])) ?></td>
                                <td><?= esc($h['type_libelle']) ?></td>
                                <td><?= number_format((float) $h['montant'], 0, ',', ' ') ?> Ar</td>
                                <td><?= number_format((float) $h['frais'], 0, ',', ' ') ?> Ar</td>
                            </tr>
                        <?php endforeach; ?>
                        <?php if (empty($historique)): ?>
                            <tr><td colspan="4" class="text-center text-muted py-3">Aucune opération.</td></tr>
                        <?php endif; ?>
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>

<?= $this->include('client/partials/footer') ?>