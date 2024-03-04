<?
$this->setCss('ui/card/style');
$this->setCss('components/note/style');
?>

<section class="ui-card notes container">

    <? $this->Component(
        'notes_item',
        array_merge(
            $this->note,
            $this->category,
            $this->count_likes,
            $this->count_bookmarks,
            $this->is_likes,
            $this->is_bookmarks,
            $this->author,
            ['is_breadcrumbs' => true],
            ['is_menu' => true]
        )
    ); ?>

</section>