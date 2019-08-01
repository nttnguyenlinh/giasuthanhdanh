CKEDITOR.editorConfig = function(config) {
    config.defaultLanguage = "vi";
    config.language = "vi";
    config.uiColor = "#E8F3F1";
    config.skin = "office2013";
    config.width = "100%";
    config.height = 450;
    config.resize_dir = "vertical";
    config.toolbarCanCollapse = true;
    config.removePlugins = "easyimage, cloudservices, image";
    config.allowedContent = true;
    config.toolbar = [
        {
            name: "document",
            items: ["Source", "Maximize", "Preview", "Templates", "Find"]
        },
        {
            name: "forms",
            items: ["Form", "Checkbox", "Radio", "TextField", "Textarea", "Select", "Button", "ImageButton", "HiddenField"]
        },
        {
            name: "paragraph",
            items: ["NumberedList", "BulletedList", "Outdent", "Indent", "Blockquote", "CreateDiv", "ShowBlocks", "Table"]
        },
        {
            name: "basicstyles",
            items: ["Bold", "Italic", "Underline", "Strike", "Subscript", "Superscript", "CopyFormatting", "RemoveFormat"]
        },
        {
            name: "styles",
            items: ["Styles", "Format", "Font", "FontSize", "TextColor", "BGColor" ]
        },
        {
            name: "paragraph",
            items: ["JustifyLeft", "JustifyCenter", "JustifyRight", "JustifyBlock"]
        },
        {
            name: "links",
            items: ["Link", "Unlink"]
        },
        {
            name: "insert",
            items: ["Attachments", "Image", "Youtube", "MediaEmbed", "Smiley", "SpecialChar", "HorizontalRule", "PageBreak"]
        }
    ];

    config.filebrowserBrowseUrl = "/admin/media/explorer?type=Storage";
    config.filebrowserImageBrowseUrl = "/admin/media/explorer?type=Storage";
    config.filebrowserFlashBrowseUrl = "/admin/media/explorer?type=Media";
    config.filebrowserUploadUrl = "/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Files";
    config.filebrowserImageUploadUrl = "/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Storage";
    config.filebrowserFlashUploadUrl = "/ckfinder/core/connector/php/connector.php?command=QuickUpload&type=Media";
    config.extraPlugins = "attach,emoji,autocomplete,textwatcher,textmatch,ajax,xml,panelbutton,button,floatpanel,panel,clipboard, dialogui, dialog, notification, youtube, image2, tableresize, wordcount, pastebase64, uploadfile, balloonpanel, balloontoolbar, pastefromexcel, copyformatting, pastecode, mediaembed, googleDocPastePlugin";
    config.youtube_width = "640";
    config.youtube_height = "480";
    config.youtube_responsive = true;
    config.youtube_related = false;
    config.youtube_older = false;
    config.youtube_privacy = true;
    config.youtube_autoplay = false;
    config.youtube_controls = true;
};
