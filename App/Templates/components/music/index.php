<?
$this->setCss('components/music/style');
$this->setCss('ui/card/style');
?>

<section class="container container-lg ui-card ui-card-style-violet ui-card-style-gradient ui-card-right music">
    <!-- <div class="music-gradient"></div> -->
    <div class="music-scroll">
        <p>Слушайте чужие треки</p>
        <p>Загружайте свои</p>
    </div>
    <div class="music-title">
        <h1>Музыка, треки</h1>
        <p>
            Welcome to RetroBeats, the ultimate destination for all things
            80's music! We've
            carefully collected the top unforgettable hits from this golden
            era for a nostalgic journey. Join us to relive the magic of the
            80's!
        </p>

        <? $this->Ui(
            'button',
            [
                'text' => 'Подробнее',
                'href' => "/music",
                'color' => 'primary',
                'flat' => true,
            ]
        ); ?>
    </div>
    <div class="ui-card ui-card-style-blur music-body">
        <h2>Популярные</h2>
        <ul>
            <li>
                <div class="music-body-item">
                    <? $this->Ui(
                        'image',
                        [
                            'src' => '/img/users/098098/3.jpg',
                            'alt' => '',
                        ]
                    ); ?>
                    <div class="music-body-item-title">
                        <h4>Shape of You</h4>
                        <p>Ed Sheeran</p>
                    </div>
                    <a href="#">
                        <ion-icon class="play-icon md hydrated" name="play-circle-outline" role="img"></ion-icon></a>
                </div>
            </li>
            <li>
                <div class="music-body-item">
                    <? $this->Ui(
                        'image',
                        [
                            'src' => '/img/users/098098/1.jpg',
                            'alt' => '',
                        ]
                    ); ?>
                    <div class="music-body-item-title">
                        <h4>Shape of You</h4>
                        <p>Ed Sheeran</p>
                    </div>
                    <a href="#">
                        <ion-icon class="play-icon md hydrated" name="play-circle-outline" role="img"></ion-icon></a>
                </div>
            </li>
            <li>
                <div class="music-body-item">
                    <? $this->Ui(
                        'image',
                        [
                            'src' => '/img/users/098098/2.jpg',
                            'alt' => '',
                        ]
                    ); ?>
                    <div class="music-body-item-title">
                        <h4>Shape of You</h4>
                        <p>Ed Sheeran</p>
                    </div>
                    <a href="#">
                        <ion-icon class="play-icon md hydrated" name="play-circle-outline" role="img"></ion-icon></a>
                </div>
            </li>

            </li>

        </ul>
    </div>

</section>