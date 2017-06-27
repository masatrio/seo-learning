<?php use yii\bootstrap\Nav; ?>
<h2>Category</h2>
		<?php
$items=[];
foreach($categories as $category){
$items[]=['label' => $category->name , 'url' => 'http://sekolahseo.com/site/post-category?id='.$category->id.''];
}
echo Nav::widget([
'items' => $items,
]);
?>