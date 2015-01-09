$('.checkbox input[type=checkbox]').change(function () {

})

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