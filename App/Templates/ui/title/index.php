<?
$this->setCss('ui/title/style');

// level - number (from 1 to 5). if 1, to tag 'h1'
$level = props($props, 'level', '1');
$text = props($props, 'text');
$link = props($props, 'link');
?>

<a class="title" href="<?= $link; ?>">
    <h<?= $level; ?>><?= $text; ?></h<?= $level; ?>>
</a>