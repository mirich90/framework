<?
$this->setCss('ui/dropdown/style');
$dropdown = props($props, 'dropdown', []);
?>

<ul class="y-dropdown-menu" style="display: none;">
    <? foreach ($dropdown as $item) : ?>
        <? if (
            !isset($item['is_my']) ||
            (isset($item['is_my']) && $item['is_my'])
        ) : ?>
            <li>
                <? if (isset($item['href'])) : ?>
                    <a class="y-dropdown-menu-item" href="<?= $item['href']; ?>">
                        <?= $item['text']; ?>
                    </a>
                <? else : ?>
                    <span class="y-dropdown-menu-item" data-action="<?= $item['action']; ?>">
                        <?= $item['text']; ?>
                    </span>
                <? endif; ?>
            </li>
        <? endif; ?>
    <? endforeach; ?>
</ul>