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
            alert("Attribute data-url is missing!");
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
        var answer = confirm("Do you really want to update this content?")
        if (answer){
            viewableText.html(html);
            $.ajax({
                type:  'POST',
                url:   CE_editableUrl,
                data:  "editable_content=" + html,
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Content has not been saved due to an error: " + errorThrown);
                }
            });
        } else {
            viewableText.html(CE_editableOriginal);
        }
        CE_active = false;
        $(this).replaceWith(html);
        viewableText.click(tagClicked);
    }
});


