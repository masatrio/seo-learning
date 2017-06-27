<?php

use yii\bootstrap\Nav;
use yii\helpers\Html;
$this->title = 'Sekolah SEO';
?>
<?php
$script = $(document).ready(function() {
     $('#tombol_app').click(function() {
       $('#box').append("<p>jQuery is Amazing...</p>");
     })
     $('#tombol_pre').click(function() {
       $('#box').prepend("<p>Learning jQuery...</p>");
     })
   });
$this->registerJs($script, \yii\web\View::POS_READY);
?>

<?php

$this->registerJs(' 
     $("#tombol_app").click(function() {
       $("#box").append("<p>jQuery is Amazing...</p>");
     })
     $("#tombol_pre").click(function() {
       $("#box").prepend("<p>Learning jQuery...</p>");
     });', \yii\web\View::POS_READY);

?>

<!DOCTYPE html>
<html>
<head>
<meta charset="UTF-8">
<title>Belajar jQuery Duniailkom</title>
</head>
<body>
<div id="box">
   <h2>Sedang belajar jQuery di Duniailkom...</h2>
</div>
<button id="tombol_app">Append</button>
<button id="tombol_pre">Prepend</button>
</body>
</html>
=