<!doctype html>
<html lang="en">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="/public/bootstrap/css/bootstrap.min.css">
    <title>DEFAULT</title>
</head>
<body>
<h1 class="hsuper">Hello, world</h1>


<?=$view?>



<script
    src="https://code.jquery.com/jquery-3.5.1.js"
    integrity="sha256-QWo7LDvxbWT2tbbQ97B53yJnYU3WhH/C8ycbRAkjPDc="
    crossorigin="anonymous"></script>
<script src="/public/bootstrap/js/bootstrap.js" ></script>

<?php foreach($scripts as $value){
    echo $value;
} ?>

</body>
</html>