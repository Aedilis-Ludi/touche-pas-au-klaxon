<?php

use App\Core\Session;

$flash = Session::getFlash(); // récupère et efface le flash

if ($flash): ?>
    <div class="alert alert-<?= htmlspecialchars($flash['type']) ?> mt-3" role="alert">
        <?= htmlspecialchars($flash['message']) ?>
    </div>
<?php endif; ?>
