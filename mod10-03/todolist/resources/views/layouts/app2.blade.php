<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <title>Tasks</title>

    <link rel="stylesheet" href="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/css/bootstrap.min.css" integrity="sha384-Gn5384xqQ1aoWXA+058RXPxPg6fy4IWvTNh0E263XmFcJlSAwiGgFAW/dAiS6JXm"
        crossorigin="anonymous">

    <script defer src="https://use.fontawesome.com/releases/v5.0.6/js/all.js"></script>
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

    @yield("navbar")
    @if(Session::has('status'))
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
        <div class="card-body">
            <table class="table">
                @if (count($tasks) > 0)
                <thead>
                    <tr>
                        <th scope="col" colspan="2">Task 1</th>
                        <th scope="col">User</th>
                        <th scope="col">Time</th>
                        <th scope="col"></th>
                        <th scope="col"></th>
                    </tr>
                </thead>
                <tbody>
                    @foreach($tasks as $task)
                    <tr>
                        <td colspan="2">
                            <div class="tasktxt">{{$task->name}}</div>
                            <input type="text" class="taskinput" value="{{$task->name}}">
                        </td>
                        <td>
                            {{$task->user->name}}
                        </td>
                        <td>
                            {{$task->created_at->diffForHumans()}}
                        </td>
                        @if ($task->user->id == $user_id)
                        <td class="text-center">
                            <button class="btn btn-primary editBtn" data-edit="0" data-index="{{$task->id}}" data-content="{{$task->name}}">
                                <i class="fas fa-edit"></i> Edit</button>
                        </td>
                        <td class="text-center">
                            <a href='{{url("/task/$task->id")}}'>
                                <button class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete</button>
                            </a>
                        </td>
                        <td></td>
                        @else
                        <td></td>
                        <td></td>
                        <td></td>
                        @endif
                    </tr>
                    <tr>
                        <td></td>
                        <td class="font-weight-bold">
                            Comments
                        </td>
                        <td class="font-weight-bold">
                            User
                        </td>
                        <td></td>
                        <td></td>
                    </tr>
                    @if (count($comments) > 0)
                    @foreach($comments as $comment)
                    @if ($comment->task_id == $task->id)
                    <tr>
                        <td></td>
                        <td>
                                <div class="commenttxt">{{$comment->comments}}</div>
                                <input type="text" class="commentinput" value="{{$comment->comments}}">
                        </td>
                        <td>
                               {{$comment->user->name}}
                        </td>
                        <td>
                                {{$comment->created_at->diffForHumans()}}
                        </td>
                        <td class="text-center">
                            <button class="btn btn-primary editCmtBtn" data-edit="0" data-index="{{$comment->id}}" data-content="{{$comment->comments}}">
                                <i class="fas fa-edit"></i> Edit</button>
                        </td>
                        <td class="text-center">
                            <a href='{{url("/comment/$comment->id")}}'>
                                <button class="btn btn-danger">
                                    <i class="fas fa-trash-alt"></i> Delete</button>
                            </a>
                        </td>
                    </tr>
                    @endif
                    @endforeach
                    @endif
                    <tr>
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
                    </tr>
                    @if ($loop->last)
                    @else
                    <tr>
                        <td class="font-weight-bold" colspan="2">
                            Task {{$loop->iteration + 1}}
                        </td>
                        <td class="font-weight-bold">
                            User
                        </td>
                        <td></td>
                        <td></td>
                        <td></td>
                    </tr>
                    @endif
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

    <script src="https://code.jquery.com/jquery-3.3.1.min.js" integrity="sha256-FgpCb/KJQlLNfOu91ta32o/NMZxltwRo8QtmkMRdAu8="
        crossorigin="anonymous"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/popper.js/1.12.9/umd/popper.min.js" integrity="sha384-ApNbgh9B+Y1QKtv3Rn7W3mgPxhU9K/ScQsAP7hUibX39j7fakFPskvXusvfa0b4Q"
        crossorigin="anonymous"></script>
    <script src="https://maxcdn.bootstrapcdn.com/bootstrap/4.0.0/js/bootstrap.min.js" integrity="sha384-JZR6Spejh4U02d8jOt6vLEHfe/JQGiRRSQQxSfFWpi1MquVdAyjUar5+76PVCmYl"
        crossorigin="anonymous"></script>

    <script>
        $(".editBtn").click(function () {
            var index = $(this).data("index");
            var element = $(this);
            var task = $(this).closest("tr").find(".taskinput").val();
            var orig = $(this).closest("tr").find(".tasktxt").html();
            if ($(this).html().indexOf("Save") == -1) {
                $(this).closest("tr").find(".tasktxt").fadeOut(350, function () {
                    $(this).closest("tr").find(".editBtn").html("<i class='fas fa-edit'></i> Save Edit");
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
                            $(element).closest("tr").find(".tasktxt").html(task);
                            $(element).closest("tr").find(".tasktxt").fadeIn(350);
                        });
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
            }
        });

        $(".addCmtBtn").click(function() {
            var element = $(this);
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
                    console.log(data);
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

        @if(Session::has('status'))
        $(".deleteAlert").fadeIn(1000);
        setTimeout(function () {
            $(".deleteAlert").fadeOut(350);
        }, 2000);
        @endif
    </script>
</body>

</html>