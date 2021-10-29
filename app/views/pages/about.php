<!-- Header -->
<?php require APPROOT . "/views/inc/header.php"; ?>
<!-- Main Content -->
<div class="container mt-3">
    <div class="jumbotron jumbotron-fluid">
        <div class="container">
            <h1 class="display-4"><?php echo $data['title']; ?></h1>
            <p class="lead"><?php echo $data['description']; ?></p>
            <p>Version: <strong><?php echo APPVERSION ?></strong></p>
        </div>
    </div>
</div>
<!-- Footer -->
<?php require APPROOT . "/views/inc/footer.php"; ?>