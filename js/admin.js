(function($){
    $(document).ready(function(){

        $('.customaddmedia').click(function(e){
            var $el = $(this).parent();
            e.preventDefault();
            var uploader = wp.media({
                title : 'Envoyer une image',
                button : {
                    text : 'Choisir ce fichier'
                },
                multiple: true
            })
                .on('select', function(){
                    var selection = uploader.state().get('selection');
                    var attachments = [];
                    selection.map( function(attachment){
                        attachment = attachment.toJSON();
                        attachments.push(attachment.url);
                    })
                    $('input', $el).val(attachments.join(','));
                })
                .open();
        })

    })
})(jQuery);