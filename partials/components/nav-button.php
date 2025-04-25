<?php if (isset($href, $label, $logo)) : ?>
    <a href="<?= htmlspecialchars($href) ?>" class="nav-button">
    
    <i class="<?= htmlspecialchars($logo) ?>"></i>   
    <P><?= htmlspecialchars($label) ?></p>
    </a>

<?php endif; ?>