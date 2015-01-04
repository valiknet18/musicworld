$('.checkbox input[type=checkbox]').change(function () {

})


$('.checkout').on('click', 'input[type=checkout]', function(){
    var targetCheckbox =  $(this);
    if ($(this).is(':checked')) {
        $.ajax({
            url: Routing.generate('valiknet_style_children_list_ajax', {"id" : targetCheckbox.val()}),
            type: "POST",
            success: function (data) {
                data = $.parseJSON(data.data);;
                console.log(data);

                var html = "<div class='children checkbox'>";
                html += "<ul>";
                for (var i = 0; i < data.children.length; i++) {
                    html += "<li><label>";
                    html += "<input type='checkbox' id='group_styles_" + data.children[i].id + "' name='group[styles][]' value='" + data.children[i].id + "'/>";
                    html += data.children[i].name + "</label></li>";
                }
                html += "</ul>";
                html += "</div>";

                targetCheckbox.parent().parent().append(html);
            }
        })
    } else {
        $(this).parent().parent().find('.children').remove();
    }
});