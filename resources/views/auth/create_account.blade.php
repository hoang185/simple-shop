@extends('app')
@section('page.title', 'Đăng ký')
@section('content')
<section id="create-account">
    <div class="container">
        <div class="row justify-content-center">
            <span class="page-header">
                <span>
                    <h3>đăng ký</h3>
                </span>
            </span>
        </div>
        <div class="row justify-content-center">

            <form method="POST" enctype="multipart/form-data" action=" {{ route('user.create') }}" class="info">
                @csrf
                <div class="noti-success">
                    @if (\Session::has('success'))
                        <div class="alert alert-success">
                            <p>{{ \Session::get('success') }}</p>
                        </div>

                    @endif
                </div>
                <div class="field name required">
                    <label for="">Họ và tên</label>
                    <div class="control">
                        <input  id="name-input" class="name" type="text" value="" oninput="myFunction()">
                        <p id="name-error" class="help is-danger name-error"></p>
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    </div>
                </div>
                <div class="field phone required">
                    <label for="">Số điện thoại</label>
                    <div class="control">
                        <input type="number" name="phone">
                        <p id="name-error" class="help is-danger name-error"></p>
                        <p class="help is-danger">{{ $errors->first('phone') }}</p>
                    </div>
                </div>
                <div class="field email required">
                    <label for="">Email</label>
                    <div class="control">
                        <input type="email" name="email" autocomplete="email">
                        <p id="name-error" class="help is-danger name-error"></p>
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    </div>
                </div>
                <div class="field re-password required">
                    <label for="">Mật khẩu</label>
                    <div class="control">
                        <input id="vuhuyhoang" type="password" name="password">
                        <p id="name-error" class="help is-danger name-error"></p>
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    </div>
                </div>
                <div class="field re-password required">
                    <label for="">Nhập lại mật khẩu</label>
                    <div class="control">
                        <input type="password" name="re-password">
                        <p id="name-error" class="help is-danger name-error"></p>
                        <p class="help is-danger">{{ $errors->first('re-password') }}</p>
                    </div>
                </div>
                <div class="choice newsletter">
                    <input type="checkbox" name="mail-check">
                    <label for="is_subscribed" class="label">
                        <span>Tôi muốn nhận bản tin của Simple qua email</span>
                    </label>
                </div>
                <div class="primary">
                    <button type="submit" class=" action btn btn-primary" name="send" id="send2">
                        <span>Đăng ký</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
    <script type="text/javascript">
        let name = document.getElementById("name-input");
        name.addEventListener("focusin", focus);
        name.addEventListener("focusout", blur);
        name.addEventListener("keypress", press);
        // name.addEventListener("keypress", press);
        // console.log(name.value);

        function press() {
            document.getElementById('name-error').innerHTML = "";
        }
        function myFunction() {
            var val = document.getElementById("name-input").value;
        }
        function focus() {
            if( val != "") {
                document.getElementById('name-error').innerHTML = "";
            }
        }
        function blur() {
            if( name.value == "") {
                document.getElementById('name-error').innerHTML = "Day la truong bat buoc";
            }
            else if( name.value !== "" ){
                document.getElementById('name-error').innerHTML = "";
            }
        }
    </script>
@endsection
