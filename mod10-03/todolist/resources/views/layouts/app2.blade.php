<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>

    <link rel="stylesheet" href="{{ asset('css/bootstrap4.0.0.min.css') }}">

    <script defer src="{{ asset('js/fontawesome5.0.6.js') }}"></script>
    <style>
        .taskinput,
        .commentinput {
            display: none;
        }

        .deleteAlert,
        .editAlert {
            left: 50%;
            transform: translateX(-50%);
            z-index: 3;
            display: none;
            top: 100px;
        }
    </style>
</head>

<body>

    @yield("navbar") @if(Session::has('status'))
    <div class="alert alert-danger deleteAlert col-6 position-absolute alert-dismissible" role="alert">
        <strong>{{Session::get('status')}}</strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>
    @endif

    <div class="card col-12 col-md-6 mx-auto mt-5 px-0">
        <div class="card-header">
            Tasks
        </div>
        <div class="card-body">
            <h5 class="card-title">Create a New Task</h5>
            <div class="form-group">
                <form action="/task" method="post">
                    {{ csrf_field() }}
                    <input class="form-control" type="text" name="task" required>
                    <br>
                    <button class="btn btn-success" type="submit" name="submit">
                        <i class="fas fa-plus"></i> Add Task</button>
                </form>
            </div>
        </div>
    </div>

    <div class="card col-12 col-md-6 mx-auto mt-5 px-0">
        <div class="card-header">
            Current Tasks
        </div>
        <div class="card-body currentTasks">
            <table class="table">
                @if (count($tasks) > 0)
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Task Number</th>
                        <th scope="col">User</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr class="task{{$task->id}}">
                        <td class="font-weight-bold" colspan="2">
                            Task {{$loop->iteration}}
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    <tr class="task{{$task->id}}">
                        <td colspan="2">
                            <div class="tasktxt">{{$task->name}}</div>
                            <input type="text" class="form-control taskinput" value="{{$task->name}}">
                        </td>
                        <td>
                            {{$task->user->name}}
                        </td>
                        <td>
                            {{$task->updated_at->diffForHumans()}}
                        </td>
                        @if ($task->user->id == $user_id)
                        <td class="text-center">
                            <button class="btn btn-primary editBtn" data-index="{{$task->id}}">
                                <i class="fas fa-edit"></i> Edit</button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger delBtn" data-index="{{$task->id}}">
                                <i class="fas fa-trash-alt"></i> Delete</button>
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    <tr class="task{{$task->id}}">
                        <td></td>
                        <td class="font-weight-bold">
                            Comments
                        </td>
                        <td class="font-weight-bold">
                            User
                        </td>
                        <td class="font-weight-bold">
                            Time
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if (count($comments) > 0) @foreach($comments as $comment) @if ($comment->task_id == $task->id)
                    <tr id="comment{{$comment->id}}" class="task{{$task->id}}">
                        <td></td>
                        <td>
                            <div class="commenttxt">{{$comment->comments}}</div>
                            <input type="text" class="form-control commentinput" value="{{$comment->comments}}">
                        </td>
                        <td>
                            {{$comment->user->name}}
                        </td>
                        <td>
                            {{$comment->updated_at->diffForHumans()}}
                        </td>
                        @if ($comment->user->id == $user_id)
                        <td class="text-center">
                            <button class="btn btn-primary editCmtBtn" data-edit="0" data-index="{{$comment->id}}">
                                <i class="fas fa-edit"></i> Edit</button>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-danger" data-index="{{$comment->id}}">
                                <i class="fas fa-trash-alt"></i> Delete</button>
                        </td>
                        @else
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    @endif @endforeach @endif
                    <tr class="task{{$task->id}}">
                        <td></td>
                        <td>
                            <input type="text" class="form-control addCmt" required>
                        </td>
                        <td class="text-center">
                            <button class="btn btn-success addCmtBtn" data-index="{{$task->id}}">
                                <i class="fas fa-plus"></i> Add</button>
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endforeach
                </tbody>
                @else
                <span>There are no tasks!</span>
                @endif
            </table>
        </div>
    </div>
    <div class="alert alert-danger editAlert col-5 position-absolute alert-dismissible" role="alert">
        <strong id="alertTxt"></strong>
        <button type="button" class="close" data-dismiss="alert" aria-label="Close">
            <span aria-hidden="true">&times;</span>
        </button>
    </div>

    <script src="{{ asset('js/jquery-3.3.1.min.js') }}"></script>
    <script src="{{ asset('js/popper1.12.9.min.js') }}"></script>
    <script src="{{ asset('js/bootstrap4.0.0.min.js') }}"></script>

    <script>
        $(".currentTasks").on("click", ".editBtn", function () {
            var index = $(this).data("index");
            var element = $(this);
            var task = $(this).closest("tr").find(".taskinput").val();
            var orig = $(this).closest("tr").find(".tasktxt").html();
            if ($(this).html().indexOf("Save") == -1) {
                $(this).closest("tr").find(".tasktxt").fadeOut(350, function () {
                    $(this).closest("tr").find(".editBtn").html("<i class='fas fa-edit'></i> Save Edit");
                    $(this).closest("tr").find(".delBtn").html("<i class='fas fa-ban'></i> Cancel Edit");
                    $(this).closest("tr").find(".taskinput").fadeIn(350);
                });
            } else {
                $.ajax({
                    method: "post",
                    url: "/task/" + index,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        task: task,
                    },
                    success: function (data) {
                        $(element).closest("tr").find(".taskinput").fadeOut(350, function () {
                            $(element).closest("tr").find(".editBtn").html(
                                "<i class='fas fa-edit'></i> Edit");
                            $(element).closest("tr").find(".delBtn").html(
                                "<i class='fas fa-trash-alt'></i> Delete");
                            $(element).closest("tr").find(".tasktxt").html(task);
                            $(element).closest("tr").find(".tasktxt").fadeIn(350, function () {
                                $(".currentTasks").load(" .table");
                            });
                        });
                    },
                    error: function (data) {
                        $(element).closest("tr").find(".taskinput").fadeOut(350, function () {
                            $(element).closest("tr").find(".editBtn").html(
                                "<i class='fas fa-edit'></i> Edit");
                            $(element).closest("tr").find(".delBtn").html(
                                "<i class='fas fa-trash-alt'></i> Delete");
                            $(element).closest("tr").find(".taskinput").val(orig);
                            $(element).closest("tr").find(".tasktxt").fadeIn(350);
                        });
                        var errors = data.responseJSON;
                        var errorHtml = "";
                        $.each(errors["errors"], function (index, value) {
                            errorHtml += value;
                        });
                        errorHtml = errorHtml.split(",");
                        errorHtml = errorHtml.join("<br>");
                        $("#alertTxt").html(errorHtml);
                        $(".editAlert").fadeIn(350);
                        setTimeout(function () {
                            $(".editAlert").fadeOut(350);
                        }, 2000);
                    }
                });
            }
        });

        $(".currentTasks").on("click", ".delBtn", function () {
            var element = $(this);
            var index = $(this).data("index");
            console.log(index);
            if ($(this).html().indexOf("Delete") == -1) {
                var orig = $(this).closest("tr").find(".tasktxt").html();
                $(this).closest("tr").find(".taskinput").fadeOut(350, function () {
                    $(this).closest("tr").find(".editBtn").html(
                        "<i class='fas fa-edit'></i> Edit");
                    $(this).closest("tr").find(".delBtn").html(
                        "<i class='fas fa-trash-alt'></i> Delete");
                    $(this).closest("tr").find(".taskinput").val(orig);
                    $(this).closest("tr").find(".tasktxt").fadeIn(350);
                });
            } else {
                $.ajax({
                    method: "get",
                    url: "/task/" + index,
                    success: function (data) {
                        $(element).closest("table").find(".task" + index).fadeOut(350, function () {
                            $(".currentTasks").load(" .table");
                        });
                    }
                });
            }
        });

        $(".currentTasks").on("click", ".addCmtBtn", function () {
            var element = $(this).closest("tr");
            $(this).prop("disabled", true);
            $(this).closest("tr").find(".addCmt").prop("disabled", true);
            var index = $(this).data("index");
            var comment = $(this).closest("tr").find(".addCmt").val();
            $.ajax({
                method: "post",
                url: "/comment",
                data: {
                    "_token": "{{ csrf_token() }}",
                    task_id: index,
                    comment: comment
                },
                success: function (data) {
                    $(".currentTasks").load(" .table");
                },
                error: function (data) {
                    $(element).closest("tr").find(".taskinput").fadeOut(350, function () {
                        $(element).closest("tr").find(".editBtn").html(
                            "<i class='fas fa-edit'></i> Edit");
                        $(element).closest("tr").find(".taskinput").val(orig);
                        $(element).closest("tr").find(".tasktxt").fadeIn(350);
                    });
                    var errors = data.responseJSON;
                    var errorHtml = "";
                    $.each(errors["errors"], function (index, value) {
                        errorHtml += value;
                    });
                    errorHtml = errorHtml.split(",");
                    errorHtml = errorHtml.join("<br>");
                    $("#alertTxt").html(errorHtml);
                    $(".editAlert").fadeIn(350);
                    setTimeout(function () {
                        $(".editAlert").fadeOut(350);
                    }, 2000);
                }
            });
        });

        $(".currentTasks").on("click", ".editCmtBtn", function () {
            var index = $(this).data("index");
            var element = $(this);
            var comment = $(this).closest("tr").find(".commentinput").val();
            var orig = $(this).closest("tr").find(".commenttxt").html();
            if ($(this).html().indexOf("Save") == -1) {
                $(this).closest("tr").find(".commenttxt").fadeOut(350, function () {
                    $(this).closest("tr").find(".editCmtBtn").html(
                        "<i class='fas fa-edit'></i> Save Edit");
                    $(this).closest("tr").find(".commentinput").fadeIn(350);
                });
            } else {
                $.ajax({
                    method: "post",
                    url: "/comment/" + index,
                    data: {
                        "_token": "{{ csrf_token() }}",
                        comment: comment,
                    },
                    success: function (data) {
                        $(element).closest("tr").find(".commentinput").fadeOut(350,
                            function () {
                                $(element).closest("tr").find(".editCmtBtn").html(
                                    "<i class='fas fa-edit'></i> Edit");
                                $(element).closest("tr").find(".commenttxt").html(
                                    comment);
                                $(element).closest("tr").find(".commenttxt").fadeIn(
                                    350,
                                    function () {
                                        $(".currentTasks").load(" .table");
                                    });
                            });
                    },
                    error: function (data) {
                        $(element).closest("tr").find(".commentinput").fadeOut(350,
                            function () {
                                $(element).closest("tr").find(".editCmtBtn").html(
                                    "<i class='fas fa-edit'></i> Edit");
                                $(element).closest("tr").find(".commentinput").val(
                                    orig);
                                $(element).closest("tr").find(".commenttxt").fadeIn(
                                    350);
                            });
                        var errors = data.responseJSON;
                        var errorHtml = "";
                        $.each(errors["errors"], function (index, value) {
                            errorHtml += value;
                        });
                        errorHtml = errorHtml.split(",");
                        errorHtml = errorHtml.join("<br>");
                        $("#alertTxt").html(errorHtml);
                        $(".editAlert").fadeIn(350);
                        setTimeout(function () {
                            $(".editAlert").fadeOut(350);
                        }, 2000);
                    }
                });
            }
        });

        @if(Session::has('status'))
        $(".deleteAlert").fadeIn(1000);
        setTimeout(function () {
            $(".deleteAlert").fadeOut(350);
        }, 2000);
        @endif
    </script>
</body>

</html>