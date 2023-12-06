<!--
    link
    text
    level - number (from 1 to 5). if 1, to tag 'h1'
-->
<?
$this->setCss('ui/title/style');
?>

<a class="title" href="<?= $props['link']; ?>">
    <h<?= $props['level']; ?>><?= $props['text']; ?></h<?= $props['level']; ?>>
</a>