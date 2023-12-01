<?
$this->setCss('components/notes_item/style');
?>

<div class="notes-item">

    <div class="notes-item-day">
        <h1>13</h1>
        <p>mon</p>
    </div>
    <div class="notes-item-activity">
        <h2>Swimming</h2>
        <div class="notes-item-participants">
            <? $this->Ui(
                'image',
                [
                    'src' => "img/users/098098/3.jpg",
                    'alt' => "",
                ]
            ); ?>
        </div>
    </div>
    <button class="notes-item-btn">Join</button>

</div>