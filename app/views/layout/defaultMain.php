
<h1>main Default</h1>
<?=$view?>
<?php if(isset($_SESSION['error'])) { ?>
<div><?= $_SESSION['error'] ?></div>
<?php } ?>

<?php if(isset($_SESSION['success'])) { ?>
    <div><?= $_SESSION['success'] ?></div>
<?php } ?>