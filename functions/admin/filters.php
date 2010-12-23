<?php
/**
 * Media uploader for option panels
 */
// Ajax call for image selection
add_action('wp_ajax_theme-uploader-get-image', 'image_select_callback');
function image_select_callback() {
	$original = wp_get_attachment_image_src($_POST['id'],'full');
	if (! empty($original)) {
		echo $original[0];
	} else {
		die(0);
	}
	die();
}

if(isset($_GET['option_upload']) || isset($_POST['option_upload'])) {
    add_filter('attachment_fields_to_edit', 'filter_attachment_fields_to_edit', 10, 2);
    add_filter('media_upload_tabs', 'disable_medias_tabs');
    add_filter('media_upload_form_url', 'upload_form_url', 10, 2);
    add_filter('flash_uploader', 'disable_flash_upload');
}
function filter_attachment_fields_to_edit($form_fields, $post){
    unset($form_fields);
    $delete = '';
    $filename = basename( $post->guid );
    $media_id = $post->ID;
    if ( current_user_can( 'delete_post', $media_id ) ) {
        if ( !EMPTY_TRASH_DAYS ) {
                $delete = "<a href='".wp_nonce_url( "post.php?action=delete&amp;post=$media_id", 'delete-attachment_' . $media_id ) . "' id='del[$media_id]' class='delete'>" . __( 'Delete') . '</a>';
        } elseif ( !MEDIA_TRASH ) {
                $delete = "
                <a href='#' class='del-link' onclick=\"document.getElementById('del_attachment_$media_id').style.display='block';return false;\">".__('Delete')."</a>
                <div id='del_attachment_$media_id' class='del-attachment' style='display:none;'>"
                    .sprintf( __( 'You are about to delete <strong>%s</strong>.'), $filename )."
                    <a href='" . wp_nonce_url( "post.php?action=delete&amp;post=$media_id", 'delete-attachment_' . $media_id ) . "' id='del[$media_id]' class='button'>".__( 'Continue')."</a>
                    <a href='#' class='button' onclick=\"this.parentNode.style.display='none';return false;\">" . __( 'Cancel') . "</a>
                 </div>";
        } else {
                $delete = "<a href='" . wp_nonce_url( "post.php?action=trash&amp;post=$media_id", 'trash-attachment_' . $media_id ) . "' id='del[$media_id]' class='delete'>" . __( 'Move to Trash') . "</a>
                <a href='" . wp_nonce_url( "post.php?action=untrash&amp;post=$media_id", 'untrash-attachment_' . $media_id ) . "' id='undo[$media_id]' class='undo hidden'>" . __( 'Undo') . "</a>";
        }
    }
    $form_fields['buttons'] = array(
        'tr' => "\t\t<tr><td></td><td><input type='button' class='button-primary' onclick='window.parent.themeadmin.insertMedia(".$post->ID.",\"". $_GET['target']."\"); return false;' value='" . __( 'Select') . "' />$delete</td></tr>\n"
    );
    return $form_fields;
}
function disable_flash_upload(){
    return false;
}
function upload_form_url($form_action_url, $type){
    return $form_action_url.'&option_upload=1&target='.$_GET['target'];
}
function disable_medias_tabs($tabs) {
    unset($tabs['type_url'], $tabs['gallery']);
    return $tabs;
}
?>
