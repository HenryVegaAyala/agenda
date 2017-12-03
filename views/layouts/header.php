<?php
use app\helpers\Utils;
use yii\helpers\Html;

?>
<div class="top_nav">
    <div class="nav_menu">
        <nav>
            <div class="nav toggle"><a id="menu_toggle"><i class="fa fa-bars"></i></a></div>
            <ul class="nav navbar-nav navbar-right">
                <li class=""><a href="javascript:;" class="user-profile dropdown-toggle" data-toggle="dropdown"
                                aria-expanded="false"><img src="<?php
                        echo  Utils::imagenCliente(Yii::$app->user->identity->cliente_id);
                        ?>" alt="Usuario Default"> <?php echo ucwords(Yii::$app->user->identity->nombres); ?> <span
                                class="fa fa-angle-down"></span></a>
                    <ul class="dropdown-menu dropdown-usermenu pull-right">
                        <li> <?= Html::a('Mi cuenta', ['/user/change', 'id' => Yii::$app->user->identity->id],
                                ['data-method' => 'post']) ?> </li>
                        <li> <?= Html::a('Cerrar Sesión', ['/site/logout', 'id' => Yii::$app->user->identity->id],
                                ['data-method' => 'post']) ?> </li>
                    </ul>
                </li>
            </ul>
        </nav>
    </div>
</div>