<?php
/* @var $this \yii\web\View */
/* @var $content string */

use yii\helpers\Html;
use yii\bootstrap\Nav;
use yii\bootstrap\NavBar;
use yii\widgets\Breadcrumbs;
use frontend\assets\AppAsset;
use yii\widgets\Menu;
use common\widgets\Alert;

AppAsset::register($this);
\macgyer\yii2materializecss\assets\MaterializeAsset::register($this);	
?>
<?php $this->beginPage() ?>
<!DOCTYPE html>
<html lang="<?= Yii::$app->language ?>">
<head>
<style type="text/css">
   table {border-collapse:collapse; table-layout:fixed; width:310px;}
   table td {border:solid 1px #fab; width:100px; word-wrap:break-word;}
   </style>
    <meta charset="<?= Yii::$app->charset ?>">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <?= Html::csrfMetaTags() ?>
    <title><?= Html::encode($this->title) ?></title>
    <?php $this->head() ?>
    <meta name="viewport" id="viewport"
 content="width=device-width, height=device-height,
 initial-scale=1.0, maximum-scale=1.0,
 user-scalable=no;" />
</head>
<body>
<?php $this->beginBody() ?>

<div class="navbar-fixed">
<nav>
          <div class="nav-wrapper" style="padding-left:20px;">
		  <a href="http://sekolah.com" class="brand-logo"><img src="<?= Yii::$app->request->baseUrl ?>/img/logo.png"></a>
		  <a href="#" data-activates="mobile-menu" class="button-collapse"><i class="material-icons">menu</i></a>
						<?php
						if(Yii::$app->user->getIsGuest()){
							$logged=1;
						}
						else
						{
							$logged=0;
						}
							switch($logged){
								case 0:
	  					echo Menu::widget([
	  					  'options' => [
	  					    "class" => "right hide-on-med-and-down"
	  					  ],
						    'items' => [
						        ['label' => 'Home', 'url' => ['site/index']],
						        ['label' => 'Cek Ranking Kata Kunci', 'url' => ['check/index']],
						        ['label' => 'Tracking History', 'url' => ['tracking-history/index']],
						        ['label' => 'Riset Kata Kunci', 'url' => ['riset-keyword/index']],
						        ['label' => 'SEO On Page', 'url' => ['seo-onpage/index']],
						        ['label' => 'SEO Off Page', 'url' => ['riset-keyword/']],
						        ['label' => 'Hubungi', 'url' => ['site/hubungi']],
								['label' => 'Log out ('. Yii::$app->user->identity->username . ')',
								 'url' => ['/site/logout'], 'visible' => !Yii::$app->user->isGuest],
						    ],
		  				]);
						echo Menu::widget([
	  					  'options' => [
						  "class" => "side-nav",
	  					    "id"  => "mobile-menu"
	  					  ],
						    'items' => [
						        ['label' => 'Home', 'url' => ['site/index']],
						        ['label' => 'Cek Ranking Kata Kunci', 'url' => ['check/index']],
						        ['label' => 'Tracking History', 'url' => ['tracking-history/index']],
						        ['label' => 'Riset Kata Kunci', 'url' => ['riset-keyword/index']],
						        ['label' => 'SEO On Page', 'url' => ['seo-onpage/index']],
						        ['label' => 'SEO Off Page', 'url' => ['riset-keyword/']],
						        ['label' => 'Hubungi', 'url' => ['site/hubungi']],
								['label' => 'Log out ('. Yii::$app->user->identity->username . ')',
								 'url' => ['/site/logout'], 'visible' => !Yii::$app->user->isGuest],
						    ],
		  				]);
						break;
								case 1:
								echo Menu::widget([
	  					  'options' => [
	  					    "class" => "right hide-on-med-and-down"
	  					  ],
						    'items' => [
						        ['label' => 'Home', 'url' => ['site/index']],
						        ['label' => 'Cek Ranking Kata Kunci', 'url' => ['check/index']],
						        ['label' => 'Riset Kata Kunci', 'url' => ['riset-keyword/index']],
						        ['label' => 'Tracking History', 'url' => ['tracking-history/index']],
						        ['label' => 'SEO On Page', 'url' => ['seo-onpage/index']],
						        ['label' => 'SEO Off Page', 'url' => ['riset-keyword/']],
						        ['label' => 'Hubungi', 'url' => ['site/hubungi']],
						        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
								['label' => 'Register', 'url' => ['site/register'], 'visible' => Yii::$app->user->isGuest],
						    ],
		  				]);
						echo Menu::widget([
	  					  'options' => [
						  "class" => "side-nav",
	  					    "id"  => "mobile-menu"
	  					  ],
						    'items' => [
						        ['label' => 'Home', 'url' => ['site/index']],
						        ['label' => 'Cek Ranking Kata Kunci', 'url' => ['check/index']],
						        ['label' => 'Riset Kata Kunci', 'url' => ['riset-keyword/index']],
						        ['label' => 'Tracking History', 'url' => ['tracking-history/index']], 
						        ['label' => 'SEO On Page', 'url' => ['seo-onpage/index']],
						        ['label' => 'SEO Off Page', 'url' => ['riset-keyword/']],
						        ['label' => 'Hubungi', 'url' => ['site/hubungi']],
						        ['label' => 'Login', 'url' => ['site/login'], 'visible' => Yii::$app->user->isGuest],
								['label' => 'Register', 'url' => ['site/register'], 'visible' => Yii::$app->user->isGuest],
						    ],
		  				]);
						break;
						}
			  		?>
          </div>
        </nav>
		</div>
				<?php 
		$this->registerJs("$('.button-collapse').sideNav();"); 
		$this->registerJs("$('.modal').modal();");
		$this->registerJs("$('.carousel').carousel();");
?>
		
		<div class="fixed-action-btn">
    <a class="btn-floating blue" onclick="$('#modal1').modal('open');"><i class="material-icons">info_outline</i></a>
    </a>
  </div>
<div id="modal1" class="modal bottom-sheet">
    <div class="modal-content">
      <h4>Bantuan</h4>
      <p>A bunch of text</p>
    </div>
  </div>

		<?php
		$controller = Yii::$app->controller;
	$default_controller = Yii::$app->defaultRoute;
	$isHome = (($controller->id === $default_controller) && ($controller->action->id === $controller->defaultAction)) ? true : false;
?>

	<main class="content" style="min-height: calc(100vh - 120px);">
	<?php
	if($isHome!=true){
    echo '<div class="container" >';
	}
	?>
        <?php echo Breadcrumbs::widget([
            'links' => isset($this->params['breadcrumbs']) ? $this->params['breadcrumbs'] : [],
			'options' => [
	  					    "style"  => "margin-top:10px;padding-left:10px;",
	  					    "class" => "breadcrumb"
	  					  ],
        ]); ?>
        <?= Alert::widget() ?>
        <?= $content ?>
		<?php
		if($isHome!=true){
    echo "</div>";
		}
	?>
</main>



<footer class="page-footer">
          
            <div class="row">
              <div class="col l5 push-l1 m12">
                <h4 class="white-text"><b>Tentang</b></h4><hr>
                <p class="grey-text text-lighten-4">SekolahSEO adalah website pembelajaran dan perencanaan untuk kampanye internet marketing anda dalam bidang SEO.</p>
              </div>
              <div class="col l5 push-l1 m12">
                <h4 class="white-text"><b>Navigasi</b></h4>
                <hr>
				
				
				<div class="row">
    <div class="col l4 m12">
      <div class="card">
        <div class="card-image">
          <a href="<?= Yii::$app->request->baseUrl ?>/buat-artikel"><img src="<?= Yii::$app->request->baseUrl ?>/img/article.jpg" class="responsive-img" style="min-height: 210px;">
        </div>
        </a>
        <div class="card-content">
		<a href="<?= Yii::$app->request->baseUrl ?>/buat-artikel"><span class="card-title"><b>Belajar Buat Artikel</b></span></a>
        </div>
      </div>
    </div>
	
	<div class="col l4 m12">
      <div class="card">
      <a href="<?= Yii::$app->request->baseUrl ?>/riset-keyword">
        <div class="card-image">
          <img src="<?= Yii::$app->request->baseUrl ?>/img/keywordresearch.jpg" class="responsive-img" style="min-height: 210px;">
        </div>
        </a>
        <div class="card-content">
		<a href="<?= Yii::$app->request->baseUrl ?>/riset-keyword"><span class="card-title"><b>Riset Kata Kunci</b></span></a>
        </div>
      </div>
    </div>
	
	<div class="col l4 m12">
      <div class="card">
      <a href="<?= Yii::$app->request->baseUrl ?>/check">
        <div class="card-image">
          <img src="<?= Yii::$app->request->baseUrl ?>/img/kw-track.png" class="responsive-img" style="min-height: 210px;">
        </div>
        </a>
        <div class="card-content">
		<a href="<?= Yii::$app->request->baseUrl ?>/check"><span class="card-title"><b>Tracking Kata Kunci</b></span></a>
        </div>
      </div>
    </div>
  </div>
				
				
				
              </div>
            </div>
          
          <div class="footer-copyright">
            <div class="container">
            © 2017 Copyrighted by SekolahSEO
            <a class="grey-text text-lighten-4 right" href="/site/hubungi">Hubungi Kami</a>
            </div>
          </div>
        </footer>
  
<?php $this->endBody() ?>
</body>
</html>
<?php $this->endPage() ?>
