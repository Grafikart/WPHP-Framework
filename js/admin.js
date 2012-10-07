themeadmin = {
    insertMedia : function(media_id,target){

        jQuery.post(ajaxurl, {
                action:'theme-uploader-get-image',
                id: media_id,
                cookie: encodeURIComponent(document.cookie)
        }, function(src){
                if ( src == '0' ) {
                        alert( 'Could not find this image' );
                } else {
                        jQuery("#"+target).val(src);
                        jQuery("#"+target+"_preview").html('<a class="thickbox" href="'+src+'?"><img src="'+src+'"/></a>');
                }
                jQuery('#TB_overlay,#TB_window').remove();
        });

    }

}