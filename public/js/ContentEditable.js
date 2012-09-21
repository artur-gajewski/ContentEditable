$(document).ready(function() {
    
    $(".editable").click(tagClicked);

    var CE_attrs      = [];
    var CE_attributes = [];
    
    var CE_attrsHtml        = "";
    var CE_editableUrl      = "";
    var CE_editableTag      = "";
    var CE_editableOriginal = "";
    var CE_active           = false; 
     
    function tagClicked() {
        
        // Init variables on each click
        CE_attrsHtml        = "";
        CE_editableUrl      = "";
        CE_editableTag      = "";
        CE_editableOriginal = "";
        
        var tagHtml = $(this).html();
        var height = $(this).height();
        
        CE_editableTag = this.nodeName.toLowerCase();
        CE_attributes = $(this).prop("attributes");
        
        $.each(CE_attributes, function() {
            if (this.name == 'data-url') {
                CE_editableUrl = this.value;
            }
            CE_attrs.push(this.name + '="' + this.value +'"');
        });
        
        if (!CE_editableUrl) {
            $('#notification').find('p').html("Attribute data-url is missing!");
            $("#notification").dialog();
            return;
        }
        
        CE_attrsHtml = CE_attrs.join(' ');

        var editableText = $("<textarea class=\"editabler\" style=\"height: " + height + "px\"/>");
        editableText.val(tagHtml);
        
        CE_editableOriginal = tagHtml;
        
        if (CE_active == false) {
            $(this).html(editableText);
            CE_active = true;
        }
        editableText.focus();
        editableText.blur(editableTextBlurred);
    }

    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<" + CE_editableTag + " " + CE_attrsHtml + ">");
        var error = false;
        
        $('#notification').find('p').html("Please select action:");
        $( "#notification" ).dialog({
            resizable: false,
            height:140,
            modal: true,
            buttons: {
                "Save": function(fn) {
                    viewableText.html(html);
                    $.ajax({
                        type:  'POST',
                        url:   CE_editableUrl,
                        data:  "editable_content=" + html,
                        success: function() {
                            $('#notification').dialog('close');
                        },
                        error: function(XMLHttpRequest, textStatus, errorThrown) {
                            $('#notification').find('p').html("There was an error: " + errorThrown);
                        }
                    });
                },
                "Preview": function() {
                    viewableText.html(html);
                    $(this).dialog( "close" );
                },
                Cancel: function() {
                    viewableText.html(CE_editableOriginal);
                    $(this).dialog( "close" );
                }
            }
        });
        
        CE_active = false;
        $(this).replaceWith(html);
        viewableText.click(tagClicked);
    }
});


