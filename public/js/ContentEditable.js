$(document).ready(function() {
    
    $(".editable").click(divClicked);

    var attrs      = [];
    var attributes = [];
    
    var attrsHtml        = "";
    var editableUrl      = "";
    var editableTag      = "";
    var editableOriginal = "";
     
    function divClicked() {
        var divHtml = $(this).html();
        var height = $(this).height();
        
        editableTag = this.nodeName.toLowerCase();
        attributes = $(this).prop("attributes");
        
        $.each(attributes, function() {
            if (this.name == 'data-url') {
                editableUrl = this.value;
            }
            attrs.push(this.name + '="' + this.value +'"');
        });
        
        if (!editableUrl) {
            alert("Attribute data-url is missing!");
            return;
        }
        
        attrsHtml = attrs.join(' ');

        var editableText = $("<textarea class=\"editabler\" style=\"height: " + height + "px\"/>");
        editableText.val(divHtml);
        editableOriginal = divHtml;
        
        $(this).replaceWith(editableText);
        editableText.focus();
        editableText.blur(editableTextBlurred);
    }

    function editableTextBlurred() {
        var html = $(this).val();
        var viewableText = $("<" + editableTag + " " + attrsHtml + ">");

        var answer = confirm("Do you really want to update this content?")
        if (answer){
            viewableText.html(html);
            $.ajax({
                type: 'POST',
                url: editableUrl,
                data: "editable_content=" + html,
                error: function(XMLHttpRequest, textStatus, errorThrown) {
                    alert("Content has not been saved due to an error: " + errorThrown);
                }
            });
        } else {
            viewableText.html(editableOriginal);
        }

        $(this).replaceWith(viewableText);
        viewableText.click(divClicked);
    }

});


