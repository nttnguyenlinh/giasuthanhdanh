$(document).ready(function() {

    $('#reset').click(function(e) {
        $('#myform').find('input, textarea').not(':button, :submit').val('');
        if ($(CKEDITOR.instances).length)
            for (var key in CKEDITOR.instances) {
                var instance = CKEDITOR.instances[key];
                if ($(instance.element.$).closest('form').attr('name') == $(e.target).attr('name'))
                    instance.setData(instance.element.$.defaultValue);
            }
    });

    $('#anhbia').click(function() {
        selectFile('anhbia');
    });
    function selectFile(elementId) {
        CKFinder.modal({
            skin: "neko",
            resourceType: 'Storage',
            chooseFiles: true,
            chooseFilesOnDblClick: true,
            width: 800,
            height: 600,
            onInit: function(finder) {
                finder.on('files:choose', function(evt) {
                    var file = evt.data.files.first();
                    var output = document.getElementById(elementId);
                    output.value = file.getUrl();
                    updateFile(file.getUrl(), file.get('name'));
                    $(".dropify-clear").attr('style', 'display:block');
                });

                finder.on('file:choose:resizedImage', function(evt) {
                    var output = document.getElementById(elementId);
                    output.value = evt.data.resizedUrl;
                    updateFile(evt.data.resizedUrl, file.get('name'));
                    $(".dropify-clear").attr('style', 'display:block');
                });
            }
        });
    };
    function updateFile(url, name) {
        $('#thumb').val(url);
        $('#anhbia').attr('data-default-file', url);
        $(".dropify-preview").attr('style', 'display:block');
        $('.dropify-render img').attr('src', url);
        $('.dropify-filename-inner').text(name);
    };

    $('.dropify').dropify({
        messages: {
            'default': '',
            'replace': '',
            'remove': 'Remove',
            'error': ''
        },
    });

    $('.dropify').dropify().on('dropify.afterClear', function(event, element) {
        $('#thumb').val('');
        $('#anhbia').attr('data-default-file', '');
        $('.dropify-render').append('<img src="">');
        $('.dropify-filename-inner').text('');
        $(".dropify-clear").attr('style', 'display:none');
    });

    if ($('#thumb').val().length <= 0) {
        $(".dropify-clear").attr('style', 'display:none');
        $('.dropify-render').append('<img src="">');
    }
});