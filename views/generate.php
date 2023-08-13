<h1><?php _e('HTML Extractor &dash; respond page', 'html_extractor'); ?></h1>

<div class="respond-container">
    <h2><?php echo Plugin::instance()->html_header; ?></h2>
    <pre>
        <xmp>
            <?php echo Plugin::instance()->html; ?>
        </xmp>
    </pre>

</div>