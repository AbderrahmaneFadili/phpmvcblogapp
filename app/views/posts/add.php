<!-- Header -->
<?php require APPROOT . "/views/inc/header.php"; ?>
<!-- Main Content -->
<div class="container mt-3">
    <div class="row">
        <div class="col">
            <a href='<?php echo URLROOT; ?>posts/' class='btn btn-light'><i class="fas fa-chevron-left"></i> Back</a>
            <div class="card card-body bg-light mt-5">
                <h2 class="mt-3">Add Post </h2>
                <p>Create a post with this form :</p>
                <form method="POST" action="<?php echo URLROOT; ?>users/register">
                    <!-- Title -->
                    <div class="form-group">
                        <label for="title">Title <sup>*</sup></label>
                        <input type="text" name="title" class="form-control form-control-lg <?php echo !empty($data['title_err']) ? "is-invalid" : "" ?>" value='<?php echo $data['title'] ?>' />
                        <span class='invalid-feedback'><?php echo $data["title_err"] ?></span>
                    </div>

                    <!-- Body -->
                    <div class="form-group">
                        <label for="body">Body <sup>*</sup></label>
                        <textarea name="body" class="form-control form-control-lg <?php echo !empty($data['body_err']) ? "is-invalid" : "" ?>"></textarea>
                        <span class='invalid-feedback'><?php echo $data["body_err"] ?></span>
                    </div>

                    <!-- Add post submit -->
                    <button type="submit" class='btn btn-success btn-block'>Add post</button>

                </form>
            </div>
        </div>
    </div>

</div>
<!-- Footer -->
<?php require APPROOT . "/views/inc/footer.php"; ?>