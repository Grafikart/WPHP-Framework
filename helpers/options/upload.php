<tr>
    <th scope="row">
        <label for="<?php echo $id; ?>"><?php echo $name; ?></label>
    </th>
    <td>
        <input type="text" id="<?php echo $id; ?>" name="<?php echo $id; ?>" value="<?php echo $value; ?>" size="75"/>
        <a class="thickbox button theme-upload-button"
           id="<?php echo $id; ?>"
           href="media-upload.php?&post_id=-500&target=<?php echo $id; ?>&option_upload=1&type=image&TB_iframe=1&width=640&height=644">
            Upload
        </a>
        <?php if(!empty($value)): ?>
        <a href="<?php echo $value; ?>" class="thickbox preview">
            <img src="<?php echo $value; ?>"/>
        </a>
        <?php endif; ?>
    </td>
</tr>