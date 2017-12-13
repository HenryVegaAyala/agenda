<?php

use app\helpers\Utils;
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
                        <img src="<?php echo Utils::imagenCliente(Yii::$app->user->identity->cliente_id); ?>"
                             alt="Usuario Default"
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
                            <?php switch (Yii::$app->user->identity->type) { ?>
<?php case 1: ?>
                                    <li>
                                        <a>
                                            <i class="fa fa-list-alt"></i> Incidencia <span
                                                    class="fa fa-chevron-down"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <li>
                                                <a href="<?php echo Url::to(['/incidencia/create']) ?>">Registrar
                                                    Incidencia</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['/incidencia/index']) ?>">Lista de
                                                    Incidencia</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li>
                                        <a>
                                            <i class="fa fa-list-alt"></i> Requerimiento <span
                                                    class="fa fa-chevron-down"></span>
                                        </a>
                                        <ul class="nav child_menu">
                                            <li>
                                                <a href="<?php echo '11' ?>">Registrar
                                                    Requerimiento</a>
                                            </li>
                                            <li>
                                                <a href="<?php echo '12' ?>">Lista de
                                                    Requerimiento</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php break; ?>
                                <?php case 2: ?>
                                    <li><a><i class="fa fa-list-alt"></i> Clientes
                                            <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo Url::to(['/cliente/create']) ?>">Registrar
                                                    Cliente</a>
                                            </li>
                                            <li><a href="<?php echo Url::to(['/cliente/index']) ?>">Lista de
                                                    Clientes</a>
                                            </li>
                                            <li><a href="<?php echo Url::to(['/cliente/import']) ?>">Exportar
                                                    Clientes</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i> Proveedores
                                            <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo Url::to(['/cliente/personal']) ?>">Registrar
                                                    Proveedores</a>
                                            </li>
                                            <li><a href="<?php echo Url::to(['/cliente/lista']) ?>">Lista de
                                                    Proveedores</a>
                                            </li>
                                            <li><a href="<?php echo Url::to(['/cliente/proveedor']) ?>">Exportar
                                                    Proveedores</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i> Análisis de Inc. y Req.
                                            <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li>
                                                <a href="<?php echo Url::to(['/incidencia/lista']) ?>">Priorizar
                                                    Incidencias</a>
                                            </li>
                                            <!--<li><a href="--><?php //echo '4' ?><!--">Priorizar Requerimientos</a>-->
                                            </li>
                                            <li>
                                                <a href="<?php echo Url::to(['/incidencia/tecnico']) ?>">Asignar
                                                    Técnicos</a>
                                            </li>
                                            <!--<li><a href="--><?php //echo '6' ?><!--">Asignar Proveedor</a>-->
                                            </li>
                                            <!--<li><a href="-->
                                            <?php //echo '7' ?><!--">Realizar Pedido al Proveedor</a>-->
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i> Reporte
                                            <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo Url::to(['/incidencia/exportareporte']) ?>">Reporte
                                                    General</a>
                                            </li>
                                            <!--                                            <li><a href="-->
                                            <?php //echo '9' ?><!--">Buscar Inc. y Req.</a>-->
                                            <!--                                            </li>-->
                                            <!--                                            <li><a href="-->
                                            <?php //echo '10' ?><!--">Exportar Inc. y Req.</a>-->
                                            <!--                                            </li>-->
                                        </ul>
                                    </li>
                                    <?php break; ?>
                                <?php case 0: ?>
                                    <li><a><i class="fa fa-list-alt"></i> Analista <span
                                                    class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo Url::to(['/cliente/create']) ?>">Registrar
                                                    Analista</a>
                                            </li>
                                            <li><a href="<?php echo Url::to(['/cliente/index']) ?>">Lista de
                                                    Analista</a>
                                            </li>
                                            <!--<li><a href="-->
                                            <?php //echo Url::to(['/user/index']) ?><!--">Lista de Usuarios</a>-->
                                            <!--</li>-->
                                            <li><a href="<?php echo Url::to(['/user/export']) ?>">Exportar
                                                    Analistas</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <li><a><i class="fa fa-list-alt"></i> Técnico <span
                                                    class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo Url::to(['/cliente/tecnico']) ?>">Registrar
                                                    Técnicos</a>
                                            </li>
                                            <li><a href="<?php echo Url::to(['/cliente/listatecnico']) ?>">Lista de
                                                    Técnicos</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php break; ?>
                                <?php case 3: ?>
                                    <li><a><i class="fa fa-list-alt"></i> Incidencias
                                            <span class="fa fa-chevron-down"></span></a>
                                        <ul class="nav child_menu">
                                            <li><a href="<?php echo Url::to(['/incidencia/end']) ?>">Incidencias
                                                    Asignadas</a>
                                            </li>
                                        </ul>
                                    </li>
                                    <?php break; ?>
                                <?php } ?>
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
