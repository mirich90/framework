<?
$this->setCss('components/images/style');
$this->setCss('ui/card/style');
?>

<section class="container container-lg ui-card ui-card-style-dark ui-card-right images">
    <div class="images-best">
        <div class="images-content">
            <h1 class="images-title">Лучшие работы в галерее за месяц</h1>
            <p class="images-description">
                <span class="images-collage-art">2d- и 3d-арт</span> lets you weave magic by
                combining different elements – think photographs, illustrations,
                textures, and patterns – into a visual symphony. Push the boundaries
                of your artistic expression and create a masterpiece with the help of
                AI! Join this artistic journey, where your imagination meets the
                limitless possibilities of AI.
            </p>
            <a href="#featured" class="images-btn">Перейти в галерею</a>
        </div>

        <div class="images-cards">
            <div style="--r: -15; --y: 40; --x: 50" class="images-cards-item">
                <img src="/img/users/098098/3.jpg" alt="" />
            </div>
            <div style="--r: 5; --y: -30; --x: 30" class="images-cards-item">
                <img src="/img/users/098098/2.jpg" alt="" />
            </div>
            <div style="--r: 15; --y: 50; --x: 0" class="images-cards-item">
                <img src="/img/users/098098/1.jpg" alt="" />
            </div>
        </div>
    </div>


    <div class="images-news-wrapper">
        <div class="images-news">

            <div class="images-news-item">
                <? $this->Ui(
                    'image',
                    [
                        'src' => "/img/users/098098/3.jpg",
                        'alt' => '',
                    ]
                ); ?>

                <div class="images-news-item-body">
                    <div class="images-news-item-body-img">
                        <? $this->Ui(
                            'image',
                            [
                                'src' => "/img/users/098098/1.png",
                                'alt' => '',
                            ]
                        ); ?>
                    </div>
                    <div class="images-news-item-body-description">
                        <h3>Обалденное описание фото</h3>
                        <p>Вика Иванова</p>
                    </div>
                </div>
            </div>
            <div class="images-news-item">
                <? $this->Ui(
                    'image',
                    [
                        'src' => "/img/users/098098/3.jpg",
                        'alt' => '',
                    ]
                ); ?>

                <div class="images-news-item-body">
                    <div class="images-news-item-body-img">
                        <? $this->Ui(
                            'image',
                            [
                                'src' => "/img/users/098098/1.png",
                                'alt' => '',
                            ]
                        ); ?>
                    </div>
                    <div class="images-news-item-body-description">
                        <h3>Обалденное описание фото</h3>
                        <p>Вика Иванова</p>
                    </div>
                </div>
            </div>


            <div class="images-news-item">
                <? $this->Ui(
                    'image',
                    [
                        'src' => "/img/users/098098/1.jpg",
                        'alt' => '',
                    ]
                ); ?>

                <div class="images-news-item-body">
                    <div class="images-news-item-body-img">
                        <? $this->Ui(
                            'image',
                            [
                                'src' => "/img/users/098098/1.png",
                                'alt' => '',
                            ]
                        ); ?>
                    </div>
                    <div class="images-news-item-body-description">
                        <h3>Обалденное описание фото</h3>
                        <p>Вика Иванова</p>
                    </div>
                </div>
            </div>


            <div class="images-news-item">
                <? $this->Ui(
                    'image',
                    [
                        'src' => "/img/users/098098/2.jpg",
                        'alt' => '',
                    ]
                ); ?>

                <div class="images-news-item-body">
                    <div class="images-news-item-body-img">
                        <? $this->Ui(
                            'image',
                            [
                                'src' => "/img/users/098098/1.png",
                                'alt' => '',
                            ]
                        ); ?>
                    </div>
                    <div class="images-news-item-body-description">
                        <h3>Обалденное описание фото</h3>
                        <p>Вика Иванова</p>
                    </div>
                </div>
            </div>
            <div class="images-news-item">
                <? $this->Ui(
                    'image',
                    [
                        'src' => "/img/users/098098/2.jpg",
                        'alt' => '',
                    ]
                ); ?>

                <div class="images-news-item-body">
                    <div class="images-news-item-body-img">
                        <? $this->Ui(
                            'image',
                            [
                                'src' => "/img/users/098098/1.png",
                                'alt' => '',
                            ]
                        ); ?>
                    </div>
                    <div class="images-news-item-body-description">
                        <h3>Обалденное описание фото</h3>
                        <p>Вика Иванова</p>
                    </div>
                </div>
            </div>
            <div class="images-news-item">
                <? $this->Ui(
                    'image',
                    [
                        'src' => "/img/users/098098/2.jpg",
                        'alt' => '',
                    ]
                ); ?>

                <div class="images-news-item-body">
                    <div class="images-news-item-body-img">
                        <? $this->Ui(
                            'image',
                            [
                                'src' => "/img/users/098098/1.png",
                                'alt' => '',
                            ]
                        ); ?>
                    </div>
                    <div class="images-news-item-body-description">
                        <h3>Обалденное описание фото</h3>
                        <p>Вика Иванова</p>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>


<section class="ui-card container">

    <? $this->Ui(
        'title_description',
        [
            'text' => '<h1>картинки</h1> за неделю',
        ]
    ); ?>

    <section class="images__header">
        <? $this->Ui(
            'title',
            [
                'text' => 'Последние картинки',
                'link' => '/post?id=',
                'level' => 2,
            ]
        ); ?>

        <? $this->Ui(
            'input',
            ['id' => 'search', 'type' => 'search', 'placeholder' => 'Поиск', 'href' => "/note?search"]
        ); ?>

    </section>

    <div class="row">
        <? $this->Ui(
            'button',
            [
                'text' => "Фильтрация",
                'color' => 'primary',
                'flat' => true,
                'transparent' => true,
                'icon' => "tune"
            ]
        ); ?>
        <? $this->Ui(
            'button',
            [
                'text' => "По дате ↓",
                'color' => 'primary',
                'flat' => true,
                'transparent' => true,
                'icon' => "sort"
            ]
        ); ?>

        <? $this->Ui(
            'button',
            [
                'text' => "Создать картинку",
                'href' => "/image?create",
                'color' => 'primary',
                'transparent' => true
            ]
        ); ?>
    </div>

    <ul class="images_list">
        <? foreach ($this->images as $image) {
            $this->Component(
                'images_item',
                array_merge($image)
            );
        } ?>
    </ul>

</section>