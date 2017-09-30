<?php
use yii\helpers\Html;
use yii\helpers\Url;

?>
<div class="container body">
    <div class="main_container">
        <div class="col-md-3 left_col">
            <div class="left_col scroll-view">

                <div class="navbar nav_title" style="border: 0;">
                    <a href="<?php echo Url::home() ?>" class="site_title"></i>
                        <span class="pull-center">Sistema de Ticket</span>
                    </a>
                </div>

                <div class="clearfix"></div>

                <div class="profile clearfix">
                    <div class="profile_pic">
                        <img src="<?php
                        //if (Yii::$app->user->identity->genero === 'M') {
                        //    echo Url::to(Yii::getAlias('@LogoHombreDefault'), '');
                        //} else {
                        //    echo Url::to(Yii::getAlias('@LogoMujerDefault'), '');
                        //}
                        ?>" alt="Usuario Default"
                             class="img-circle profile_img">
                    </div>
                    <div class="profile_info">
                        <span>Bienvenido,</span>
                        <h2><?php echo ucwords(Yii::$app->user->identity->nombres); ?></h2>
                    </div>
                </div>

                <br/>

                <div id="sidebar-menu" class="main_menu_side hidden-print main_menu">
                    <div class="menu_section">
                        <h3>Menú General</h3>
                        <ul class="nav side-menu">
                            <?php //if (Yii::$app->user->identity->privilegio === 'G') { ?>
                                <li><a><i class="fa fa-list-alt"></i> Incidencia <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo Url::to(['/incidencia/create']) ?>">Registrar Incidencia</a></li>
                                        <li><a href="<?php echo Url::to(['/incidencia/index']) ?>">Lista de Incidencia</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-list-alt"></i> Clientes <span class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo Url::to(['/cliente/create']) ?>">Registrar Cliente</a></li>
                                        <li><a href="<?php echo Url::to(['/cliente/index']) ?>">Lista de Clientes</a></li>
                                        <li><a href="<?php echo Url::to(['/cliente/import']) ?>">Importar Clientes</a></li>
                                    </ul>
                                </li>
                                <li><a><i class="fa fa-list-alt"></i> Usuario <span
                                                class="fa fa-chevron-down"></span></a>
                                    <ul class="nav child_menu">
                                        <li><a href="<?php echo Url::to(['/user/index']) ?>">Lista de Usuarios</a></li>
                                        <li><a href="<?php echo Url::to(['/user/create']) ?>">Registrar Usuario</a></li>
                                    </ul>
                                </li>
                            <?php //} ?>
                        </ul>
                    </div>
                    <div class="sidebar-footer hidden-small">
                        <?= Html::a('<span class="glyphicon glyphicon-cog" aria-hidden="true"></span>',
                            ['/user/change', 'id' => Yii::$app->user->identity->id],
                            [
                                'data-method' => 'post',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => 'Configuración',
                            ]) ?>
                        <a id="fullScreen" onclick="DoFullScreen()" data-toggle="tooltip" data-placement="top"
                           title="FullScreen">
                            <span class="glyphicon glyphicon-fullscreen" aria-hidden="true"></span>
                        </a>
                        <a data-toggle="tooltip" data-placement="top" title="Chat">
                            <span class="glyphicon glyphicon-user" aria-hidden="true"></span>
                        </a>
                        <?= Html::a('<span class="glyphicon glyphicon-off" aria-hidden="true"></span>',
                            ['/site/logout', 'id' => Yii::$app->user->identity->id],
                            [
                                'data-method' => 'post',
                                'data-toggle' => 'tooltip',
                                'data-placement' => 'top',
                                'title' => 'Cerrar Sesión',
                            ]) ?>
                    </div>
                </div>
            </div>
        </div>
