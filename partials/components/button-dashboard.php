<?php if (isset($logo, $title, $link)) : ?>
    <a href="<?= htmlspecialchars($link) ?>" class="">
    <div class="button-dashboard">
        <div class="tooltip">
            <i class="<?= htmlspecialchars($logo) ?> button-logo"></i>
            <span class="tooltiptext"><?= htmlspecialchars($title) ?></span>
        </div>
    </div>
</a>
<?php endif; ?>
