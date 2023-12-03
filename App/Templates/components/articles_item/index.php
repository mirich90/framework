<!--
    id
    title
    description
    img
    img_alt
    link
    is_breadcrumbs
-->
<?
$this->setCss('components/articles_item/style');

if (!isset($props['is_breadcrumbs'])) $props['is_breadcrumbs'] = false;
if (!isset($props['title_level'])) $props['title_level'] = 2;
?>

<div data-id="<?= $props['id']; ?>" class="post">

    <? if ($props['is_breadcrumbs']) {
        $this->Component(
            'breadcrumbs',
            [
                'parent' => 'статьи',
                'text' => $props['category'],
                'link' => $props['category_link'],
            ]
        );
    } ?>

    <? $this->Ui(
        'title',
        [
            'text' => $props['title'],
            'link' => '/article?id=' . $props['link'],
            'level' => $props['title_level'],
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