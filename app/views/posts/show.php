<!-- Header -->
<?php require APPROOT . "/views/inc/header.php"; ?>

<!-- Main Content -->
<div class="container mt-3">
    <a href='<?php echo URLROOT; ?>posts/' class='btn btn-light'><i class="fas fa-chevron-left"></i> Back</a>
    <h1 class='h1 mt-4'><?php echo $data['post']->title ?></h1>

    <div class="bg-secondary text-white p-2 mb-3">
        Written by <?php echo $data['user']->name; ?> on <?php echo $data['post']->created_at; ?>
    </div>

    <p><?php echo $data['post']->body; ?></p>

    <!-- check if the user_id in the session -->
    <?php if ($data['post']->user_id === $_SESSION['user_id']) : ?>
        <hr />
        <div class="row">
            <a href="<?php echo URLROOT; ?>posts/edit/<?php echo $data['post']->id; ?>" class='btn btn-dark'>Edit</a>

            <form class='ml-auto' action="<?php echo URLROOT; ?>posts/delete/<?php echo $data['post']->id; ?>" method="POST">
                <input type="submit" value="Delete" class='btn btn-danger' />
            </form>
        </div>

    <?php endif; ?>
</div>
<!-- Footer -->
<?php require APPROOT . "/views/inc/footer.php"; ?>