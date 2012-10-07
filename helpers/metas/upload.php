<?php global $post; ?>
<div class="meta-box-item-title">
    <?php if(!empty($value)): ?>
    <a href="<?php echo $value; ?>" class="thickbox">
        <img src="<?php echo $value; ?>" style="max-height:100px"/>
    </a>
    <?php endif; ?>
    <h4><?php echo $name; ?></h4>
</div>
<div class="meta-box-item-content">
    <input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" size="75"/>
    <a class="thickbox button theme-upload-button"
       id="<?php echo $id; ?>"
       href="media-upload.php?&post_id=<?php echo $post->ID; ?>&target=<?php echo $id; ?>&option_upload=1&type=image&TB_iframe=1&width=640&height=644">
        Upload
    </a>
</div>