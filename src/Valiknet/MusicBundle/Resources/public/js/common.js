$('.checkbox input[type=checkbox]').change(function () {

})


$(".checkbox").on('change', 'input[type=checkbox]', function(){
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

$(document).on('click', '.delete-track', function(e){
    e.preventDefault();

    var id = $(this).data('id');

    var thisIs = $(this);

    $.ajax({
        url: Routing.generate('valiknet_track_remove', {"id" : id}),
        type: "DELETE",
        success: function (data, opt, opt2) {
            console.log(opt2);

            switch (opt2.status) {
                case 200:
                    thisIs.parent().parent().remove();
                    break;
            }
        }
    });
});

$(document).on('click', 'a.parent-div', function (e) {
    e.preventDefault();

    $(this).parent().next().next().css({
        "display": "block"
    })


    $(this).attr("class", "parent-div-active");
});

$(document).on('click', 'a.parent-div-active', function (e) {
    e.preventDefault();

    $(this).parent().next().next().css({
        "display": "none"
    })


    $(this).attr("class", "parent-div");
});