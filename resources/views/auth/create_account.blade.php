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
                        <input  id="input_1" class="create-account__input" name="name" required type="text" value="" >
                        <p id="error_1" class="help is-danger empty-error create-account__inputError"></p>
                        <p class="help is-danger">{{ $errors->first('name') }}</p>
                    </div>
                </div>
                <div class="field phone required">
                    <label for="">Số điện thoại</label>
                    <div class="control">
                        <input id="input_2" class="create-account__input"  type="number" name="phone">
                        <p id="error_2" class="help is-danger empty-error create-account__inputError"></p>
                        <p class="help is-danger">{{ $errors->first('phone') }}</p>
                    </div>
                </div>
                <div class="field email required">
                    <label for="">Email</label>
                    <div class="control">
                        <input id="input_3" class="create-account__input" type="email" name="email" autocomplete="email">
                        <p id="error_3" class="help is-danger empty-error create-account__inputError"></p>
                        <p class="help is-danger">{{ $errors->first('email') }}</p>
                    </div>
                </div>
                <div class="field re-password required">
                    <label for="">Mật khẩu</label>
                    <div class="control">
                        <input id="input_4" class="create-account__input" type="password" name="password" required>
                        <p id="error_4" class="help is-danger empty-error create-account__inputError"></p>
                        <p class="help is-danger">{{ $errors->first('password') }}</p>
                    </div>
                </div>
                <div class="field re-password required">
                    <label for="">Nhập lại mật khẩu</label>
                    <div class="control">
                        <input id="input_5" class="create-account__input" type="password" name="re-password">
                        <p id="error_5" class="help is-danger empty-error create-account__inputError"></p>
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
                    <button type="submit" class=" action btn btn-primary" name="send" id="create-account__submitBtn" style="pointer-events: all; opacity: 0.7">
                        <span>Đăng ký</span>
                    </button>
                </div>
            </form>
        </div>
    </div>
</section>
    <script type="text/javascript">

        const createAccountInputs = document.getElementsByClassName('create-account__input');
        const inputErrorTexts = document.getElementsByClassName(('create-account__inputError'));
        const submitBtn = document.getElementById('create-account__submitBtn');

        const doesErrorExist = () => Array.from(createAccountInputs).some(input => input?.value?.trim()?.length === 0);

        Array.from(createAccountInputs).forEach((input, idx) => {
            input.addEventListener('keyup', function (){
                const inputValue = this.value;
                if(doesErrorExist()){
                    submitBtn.style.pointerEvents = 'none';
                    submitBtn.style.opacity = 0.7;
                } else {
                    submitBtn.style.pointerEvents = 'all';
                    submitBtn.style.opacity = 1;
                }
                inputErrorTexts[idx].textContent = inputValue?.trim()?.length > 0 ? "" : "*Đây là trường bắt buộc";
                // if(inputValue?.trim()?.length  === 0){
                //     inputErrorTexts[idx].textContent = "*Đây là trường bắt buộc";
                // } else {
                //     inputErrorTexts[idx].textContent = "";
                // }
            })
        })

    </script>
@endsection
