<?
$this->setCss('components/notes_item/style');
?>

<div class="notes-item">
    <header>
        <div class="notes-item-author-img">
            <a href="/">
                <? $this->Ui(
                    'image',
                    [
                        'src' => $props['author_img'],
                        'alt' => $props['author_img_alt'],
                    ]
                ); ?>
            </a>

        </div>

        <div class="notes-item-title">
            <a class="notes-item-author-name" href="/author/cosima-mielke"><?= $props['author_name']; ?></a>
            <? $this->Ui(
                'title',
                [
                    'text' => $props['title'],
                    'link' => $props['link'],
                    'level' => 3,
                ]
            ); ?>

        </div>
    </header>

    <p class="notes-item-body">
        <span><?= $props['date']; ?> — </span><?= $props['content']; ?>
    </p>


</div>