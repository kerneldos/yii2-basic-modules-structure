<?php

/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use app\modules\site\assets\LoginAsset;

LoginAsset::register($this);
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?php $this->registerCsrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
</head>
<body>
<?php $this->beginBody() ?>

<div id="main" class="animated">

    <section id="content_wrapper">

        <section id="content">

            <div class="system-header">
                <div class="system-logo">
                    <a href="https://www.mos.ru/">
                        <?= Html::img('@web/img/system-logo.png', ['alt' => 'mos.ru', 'title' => 'mos.ru']); ?>
                    </a>
                </div>
                <h1 class="system-name">Доступ к&nbsp;информационным ресурсам города Москвы</h1>
            </div>

            <div class="form-wrapper">
                <h1 class="page-title">
                    Вход на Официальный сайт Мэра Москвы
                </h1>

                <div class="lock-ib show"></div>

                <?= $content ?>

                <div class="methods-wrapper">
                    <div class="methods-sep">
                        <span>или</span>
                    </div>

                    <div id="methodsExtList" class="methods-ext">
                        <a href="javascript:void(0)"
                           data-fptype="esia"
                           data-fpname="esia_1"
                           class='btn-meth meth-ext has-logo meth-esia'
                           role="button"
                           title='Госуслуги'>
                            <?= Html::img('@web/img/meth-esia-logo.png', ['alt' => 'Госуслуги']); ?>
                        </a>

                        <a href="javascript:void(0)"
                           data-fptype="sbrf"
                           data-fpname="sbrf_1"
                           class='btn-meth meth-ext has-logo meth-sbrf'
                           role="button"
                           title='Сбербанк ID'>
                            <?= Html::img('@web/img/meth-sbrf-logo.png', ['alt' => 'Сбербанк ID']); ?>
                        </a>
                    </div>

                    <div class="methods-int">
                        <div id="showMethodsList" style='display: ;'>
                            <a href="/sps/login/methods/x509" class="btn-meth meth-int">
                                Вход по электронной подписи
                            </a>
                        </div>
                    </div>
                </div><!-- end .methods-wrapper -->

                <div id="regEnter" class="bc-reg-url">
                    Нет аккаунта? <a href="/sps/reg">Зарегистрироваться</a>
                </div>
            </div><!-- end .form-wrapper -->
        </section><!-- end #content -->
    </section><!-- end #content_wrapper -->

    <footer class="system-footer">
        <ul class="support">
            <li><a href="https://www.mos.ru/otvet-tehnologii/kak-polzovatsya-lichnym-kabinetom-na-mos-ru/" target="_blank">Вопросы по&nbsp;входу в&nbsp;систему</a></li>
            <li><a href="https://www.mos.ru/pgu/common/legal_new.pdf">Расширенная инструкция по&nbsp;регистрации кабинета&nbsp;ЮЛ и&nbsp;ИП</a></li>
            <li><a href="https://www.mos.ru/pgu/common/legal_short.pdf">Сокращенная инструкция по&nbsp;регистрации кабинета&nbsp;ЮЛ и&nbsp;ИП</a></li>
        </ul>
        <div class="copy">
            &copy;&nbsp;Департамент информационных технологий города Москвы
        </div>
    </footer>

</div><!-- end #main -->

<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
