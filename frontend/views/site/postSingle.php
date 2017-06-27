<?php
use yii\helpers\Html;
/* @var $this yii\web\View */

$this->title = 'Belajar SEO';
?>
<div class="site-index">
<div class="row">
    <div class="col s9">
        <div>
		<?php
		echo $ono;
foreach($posts as $post){
echo '<h2>'.$post->title.'</h2>';
echo '<p><small>Posted by '.$post->user->username.' at '.date('F j, Y, g:i a',$post->create_time).'</small></p>';
echo '<p>'.$post->content.'</p>';
}
echo "<h3>Comment Box</h3>";
foreach($comments as $comment){ 
    echo "<p class='pull-right'><small>
          Comment by ".$comment->author." at ".date("F j, Y, g:i a",$comment->create_time).
          "</small></p>";
    echo $comment->content;
	echo "<br><br>";
}
echo $this->render('formComment', [
    'model' => $model,
]);
?>
         </div>
    </div>
    <div class="col s3">
		<?php
require_once __DIR__ . '/sidebar.php';
?>
    </div>
</div>
</div>