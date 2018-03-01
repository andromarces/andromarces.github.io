@extends('layouts.app') @section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card card-default">
                <div class="card-header">Dashboard</div>

                <div class="card-body">
                    @if (session('status'))
                    <div class="alert alert-success">
                        {{ session('status') }}
                    </div>
                    @endif You are logged in!
                </div>
            </div>
        </div>
    </div>
</div>

{{-- registration modal --}}
<div class="modal fade" id="modalRegisterForm" tabindex="-1" role="dialog" aria-labelledby="myModalLabel" aria-hidden="true">
    <div class="modal-dialog" role="document">
        <div class="modal-content">
            <div class="modal-header text-center">
                <h4 class="modal-title w-100 font-weight-bold">Sign up</h4>
                <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                    <span aria-hidden="true">&times;</span>
                </button>
            </div>
            <form>
                <div class="modal-body mx-3">
                    <div class="md-form mb-4">
                        <i class="fa fa-user prefix grey-text"></i>
                        <input type="text" id="orangeForm-name" class="form-control validate" pattern="^[A-Za-z0-9_]{3,32}$" required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-name">Your name</label>
                        <div class="text-right">
                            <span id="usernameValidation"></span>
                        </div>
                    </div>
                    <div class="md-form mb-4">
                        <i class="fa fa-envelope prefix grey-text"></i>
                        <input type="email" id="orangeForm-email" class="form-control validate" required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-email">Your email</label>
                        <div class="text-right">
                            <span id="emailValidation"></span>
                        </div>
                    </div>

                    <div class="md-form mb-5">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass">Your password</label>
                        <div class="text-right">
                            <span id="passwordValidation"></span>
                        </div>
                    </div>

                    <div class="md-form mt-5 mb-4">
                        <i class="fa fa-lock prefix grey-text"></i>
                        <input type="password" id="orangeForm-pass2" class="form-control validate" pattern="^(?:\S.{4,}\S)?$" required>
                        <label data-error="Wrong. " data-success="Right. " for="orangeForm-pass2">Confirm password</label>
                        <div class="text-right">
                            <span></span>
                        </div>
                    </div>

                </div>
                <div class="modal-footer d-flex justify-content-center">
                    <button class="btn btn-deep-orange" id="registerBtn" type="submit" disabled>Sign up</button>
                </div>
            </form>
        </div>
    </div>
</div>

{{-- hidden div1 --}}
<div id="hiddenDiv1" class="d-none"></div>
@endsection