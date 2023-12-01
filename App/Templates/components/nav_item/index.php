<?
$active = $props['active'] ? 'active' : '';
?>


<li class="nav-item <?= $active; ?>">
    <b></b>
    <b></b>
    <a href="/<?= $props['link']; ?>">
        <i class="fa fa-house nav-icon"></i>
        <span class="nav-text"><?= $props['text']; ?></span>
    </a>

</li>