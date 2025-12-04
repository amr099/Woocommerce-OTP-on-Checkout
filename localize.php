add_action('wp_head', function() {
    ?>
    <script>
        var wp_vars = {
            ajax: "<?php echo admin_url('admin-ajax.php'); ?>"
        }
    </script>
    <?php
});
