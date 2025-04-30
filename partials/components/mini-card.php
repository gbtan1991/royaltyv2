<?php if(isset($label, $logo)) : ?>
    <div class="mini-card">
        <?php if (($iconPosition ?? 'left') === 'left'): ?>
            <i class="<?= htmlspecialchars($logo) ?>"></i>
        <?php endif; ?>
        <div class="mini-card-content">
            <h3><?= htmlspecialchars($label) ?></h3>
            <p>
                <?php
                    $value = $content ?? 0;
                    echo $isCurrency ? 'P ' . htmlspecialchars((string)$value) : htmlspecialchars((string)$value);
                ?>
            </p>   
        </div>
        <?php if (($iconPosition ?? 'left') === 'right'): ?>
            <i class="<?= htmlspecialchars($logo) ?>"></i>

        <?php endif; ?>
    </div>

<?php endif; ?>