<h1><?php _e('HTML Extractor &dash; main page', 'html_extractor'); ?></h1>

<div class="form-container">
    <form method="POST" action="<?php echo $_SERVER['PHP_SELF'];?>?page=<?=Plugin::SLUG;?>">
        <div class="input-row">
            <label>Enter ID</label>
            <input type="text" name="post_id" pattern="[0-9]{1,}" />
        </div>
        <input type="hidden" name="page" value="generate" />
        <input type="submit" value="Sent" class="btn-submit" />
    </form>
</div>