<!--
    id
    title
    description
    img
    img_alt
    link
-->
<? $this->setCss('components/articles_item/style'); ?>

<div data-id="<?= $props['id']; ?>" class="post">
    <? $this->Ui(
        'title',
        [
            'text' => $props['title'],
            'link' => $props['link'],
            'level' => 3,
        ]
    ); ?>

    <div class="post-description">
        <div class="post-description-picture">
            <? $this->Ui(
                'image',
                [
                    'src' => $props['img'],
                    'alt' => $props['img_alt'],
                ]
            ); ?>
        </div>


        <p class="post-description-text"><?= $props['description']; ?></p>
    </div>
</div>