<?php if(isset($label, $content, $logo)) : ?>
    <div class="mini-card">
        <?php if (($iconPosition ?? 'left') === 'left'): ?>
            <i class="<?= htmlspecialchars($logo) ?>"></i>
        <?php endif; ?>
        <div class="mini-card-content">
            <h3><?= htmlspecialchars($label) ?></h3>
            <p><?= htmlspecialchars($content) ?></p>
        </div>
        <?php if (($iconPosition ?? 'left') === 'right'): ?>
            <i class="<?= htmlspecialchars($logo) ?>"></i>

        <?php endif; ?>
    </div>

<?php endif; ?>