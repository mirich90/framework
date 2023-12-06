<?
$this->setCss('ui/card/style');
$this->setCss('components/note/style');
?>

<section class="ui-card notes container">

    <? $this->Component(
        'notes_item',
        $this->note
    ); ?>

</section>