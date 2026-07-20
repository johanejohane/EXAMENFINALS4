<?= $this->include('client/partials/header') ?>

<!-- Tableau complet (jusqu'à 200 lignes) de toutes les opérations du client -->
<div class="card shadow-sm">
    <div class="card-header d-flex justify-content-between align-items-center">
        <span>Historique des opérations</span>
        <a href="<?= site_url('client/dashboard') ?>" class="btn btn-sm btn-outline-secondary">Retour</a>
    </div>
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

<?= $this->include('client/partials/footer') ?>