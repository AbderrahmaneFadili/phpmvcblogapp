<!-- Header -->
<?php require APPROOT . "/views/inc/header.php"; ?>
<!-- Main Content -->
<?php echo '<h1>' . $data['title'] . '</h1>'; ?>
<?php
echo '<ul>';
foreach ($data['posts'] as $post) {
    echo "<li>" . $post->title . "</li>";
}
echo '</ul>';
?>
<!-- Footer -->
<?php require APPROOT . "/views/inc/footer.php"; ?>