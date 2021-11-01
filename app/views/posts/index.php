<!-- Header -->
<?php require APPROOT . "/views/inc/header.php"; ?>
<!-- Main Content -->
<div class="container mt-3">
    <?php flash('post_message'); ?>
    <div class="row">
        <div class="col-md-6">
            <h1>Posts</h1>
        </div>
        <div class="col-md-6">
            <div class="d-flex">
                <a href="<?php echo URLROOT; ?>posts/add" class='btn btn-primary ml-auto'>
                    <i class='fa fa-pencil'></i> Add Post
                </a>
            </div>
        </div>
    </div>
    <?php foreach ($data['posts'] as $post) : ?>
        <div class="card card-body mb-3">
            <h4 class="card-title"><?php echo $post->title; ?></h4>
            <div class="bg-light p-2 mb-3">
                Written by <?php echo $post->name; ?>
                on <?php echo $post->postCreated; ?>
            </div>
            <p class="card-text">
                <?php echo $post->body ?>
            </p>
            <a href="<?php echo URLROOT; ?>posts/show/<?php echo $post->postId; ?>" class='btn btn-dark'>More</a>
        </div>
    <?php endforeach; ?>

</div>
<!-- Footer -->
<?php require APPROOT . "/views/inc/footer.php"; ?>