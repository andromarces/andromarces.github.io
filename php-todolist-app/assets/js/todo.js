// check off specific to dos by clicking

$("ul").on("click", "li", function () {
    $(this).toggleClass("completed");

    $.post('assets/done.php', {
            id: $(this).attr('id')
        },
        function (data, status) {});
});

$('#newTask').keypress(function (event) {
    if (event.which == 13) {
        var todoText = $(this).val();
        // console.log(todoText);

        $.post('assets/create.php', {
            task: todoText
        }, function (data, status) {
            // console.log(data);
            $('ul').append('<li class="list-group-item" id="' + data + '"><span class="mr-1"><i class="fas fa-trash-alt"></i></span>' + todoText + '</li>')
        });
    }
});

$('span.col-1').click(function () {
    var enter = jQuery.Event("keypress");
    enter.which = 13;
    $('#newTask').trigger(enter);
});

// deleting a task
$('ul').on('click', 'span', function () {
    // remove  list item from DOM
    $(this).parent().fadeOut(500, function () {
        $(this).remove();
    });



    //ajax request to update JSON
    $.post('assets/delete.php', {
        id: $(this).parent().attr('id')
    }, function (data, status) {
        // console.log(data);
    });

    event.stopPropagation();

});