<?php
use yii\bootstrap\Nav;
/* @var $this yii\web\View */

$this->title = 'Belajar SEO';
?>
<div class="row">
    <div class="col s9">
        <div>
            <?php
foreach($posts as $post){
echo '<div>';
echo '<h3>'.$post->title.'</h3>';
echo '<p><small>Posted by '.$post->user->username.' at '.date('F j, Y, g:i a',$post->create_time).'</small></p>';
echo '<p>'.strip_tags(substr($post->content,0,300)).'...</p>';
echo '<p><a href="site/post-single?id='.$post->id.'" class="btn waves-effect waves-light">Read More <i class="material-icons right">send</i></a></p>';
echo '</div>';
}

?>
         </div>
    </div>
    <div class="col s3">
        <?php
require_once __DIR__ . '/sidebar.php';
?>
    </div>
</div>