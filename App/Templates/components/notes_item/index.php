<?
$this->setCss('components/notes_item/style');
?>

<?
$author_img = props($props, 'author_img');
$author_img_alt = props($props, 'author_img_alt');
$author_name = props($props, 'author_name', 'username');
$author_link = props($props, 'author_link');
$title = props($props, 'title');
$link = props($props, 'link');
$content = props($props, 'content');
$datetime = props($props, 'datetime');
?>


<div class="notes-item">
    <div class="notes-item-author-img">
        <a href="/">
            <? $this->Ui(
                'image',
                [
                    'src' => $author_img,
                    'alt' => $author_img_alt
                ]
            ); ?>
        </a>
    </div>

    <div class="notes-item-body">

        <div class="notes-item-title">
            <a class="notes-item-author-name" href="/author&id=<?= $author_link; ?>">
                <?= $author_name; ?>
            </a>

            <? $this->Ui(
                'title',
                [
                    'text' => $title,
                    'link' => "/note?id=$link",
                    'level' => 3,
                ]
            ); ?>

        </div>

        <p>
            <span><?= $datetime; ?> — </span>
            <?= $content; ?>
        </p>
    </div>


</div>