<?php
require_once __DIR__ . '/../../config/config.php';

$basePublicUrl = BASE_URL . 'public/';

// Define buttons with the same structure as sidebar

?>

<div class="button-menu">
    <?php foreach ($buttons as $btn): ?>
        <?php
            $href = $basePublicUrl . 'index.php?page=' . $btn['page'];
            $label = $btn['label'];
            $logo = $btn['logo'] ?? '';
        ?>
        <a href="<?= $href ?>" >
            
                <i class="<?= $logo ?>"></i>
                <p>
                <?= $label ?>
                </p> 
        
        </a>
    <?php endforeach; ?>
</div>
