<?php page_header('Error 404'); ?>
<div class="post">
    <h1>404</h1>
    <h3>Oops.! The Page you were looking for, couldn't be
        found.</h3>
    <br>
    <a href="<?php echo $app->BASE_URL('index.php'); ?>"
       class="nice_button"><i
                class="fa fa-arrow-left"></i> Back to Home</a>
</div>
<?php page_footer(); ?>