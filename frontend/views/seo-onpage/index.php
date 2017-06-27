<?php

use yii\helpers\Html;

$this->title = 'SEO Onpage';
$this->params['breadcrumbs'][] = $this->title;
?>
<center><h1>Belajar SEO Onpage</h1></center>

	<?php
	foreach($posts as $post){
		echo '<div class="row halign-wrapper">';
		echo '<div class="col l4 s12 hide-on-med-and-low">';
		echo '<img class="responsive-img z-depth-1" style="margin-bottom:15px;min-height:250px;" src="'.Yii::$app->request->baseUrl.'/img/'.$post->img_url.'">';
		echo '</div>';
		echo '<div class="col l8 s12">';
		echo '<a style="color:black;" href="'.$post->id.'"><h2 style="margin-top:0px; margin-bottom:5px;">'.$post->title.'</h2></a>';
		echo '<br>';
		echo '<p align="justify" style="font-size:150%;">'.strip_tags(substr($post->content,0,300)).'...</p></div></div><hr>';
	}