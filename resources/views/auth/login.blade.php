@extends('app')

@section('page.title', 'Login')

@section('content')
<section id="login">
    <div class="container">
        <div class="row login-container">
            <div class="login-form">
                <div class="block">
                    <div class="block-title">
                        <span>đăng nhập</span>
                    </div>
                    <div class="block-content">
                        <form action="" method="post" class="form form-login">
                            <input type="hidden" name="form-key">
                            <fieldset>
                                <div class="field email required">
                                    <div class="control">
                                        <input type="text" name="login[user-name]" id="email" class="input-text"
                                        title="Email or phone number" placeholder="ĐỊA CHỈ EMAIL HOẶC SỐ ĐIỆN THOẠI" aria-required="true">
                                    </div>
                                </div>
                                <div class="field password required">
                                    <div class="control">
                                        <input type="password" autocomplete="off" name="login[password]" id="pass" class="input-text"
                                        title="Email or phone number" placeholder="MẬT KHẨU" aria-required="true">
                                    </div>
                                </div>
                                <div class="action-toolbar">
                                    <div class="primary">
                                        <button type="submit" class="action btn btn-primary" name="send" id="send2">
                                            <span>Đăng nhập</span>
                                        </button>
                                    </div>
                                    <div class="secondary">
                                        <a href="#" class="action remind" href="#">
                                            <span>Bạn đã quên mật khẩu ?</span>
                                        </a>
                                        <div class="create-account__link">
                                            <span>Bạn chưa có tài khoản ?</span>
                                            <a href="{{ route('login.create') }}" class="action link-create">
                                                <span>Đăng ký</span>
                                            </a>
                                        </div>
                                    </div>
                                </div>
                            </fieldset>
                        </form>
                    </div>
                </div>
            </div>
            <div class="social-login">
                <div class="btn-network">
                    <div class="title">
                       <span>đăng nhập bằng phương thức khác</span>
                    </div>
                    <div class="modal-socialogin modal-facebook facebook-connect">
                        <span>đăng nhập bằng facebook</span>
                    </div>
                    <div class="modal-socialogin modal-google google-connect">
                        <span>đăng nhập bằng google</span>
                    </div>
                </div>
            </div>
        </div>
    </div>
</section>
@endsection