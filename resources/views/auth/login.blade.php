@extends('app')

@section('page.title', 'Login')

@section('content')
<section id="login">
    <div class="container">
        @php
            $user = Auth::user();
        @endphp
        @if(empty($user))
            <div class="row login-container">
                <div class="login-form">
                    <div class="noti-success">
                        @if (\Session::has('success'))
                            <div class="alert alert-success">
                                <p>{{ \Session::get('success') }}</p>
                            </div>
                        @elseif(\Session::has('error'))
                            <div class="alert alert-danger">
                                <p>{{ \Session::get('error') }}</p>
                            </div>
                        @endif
                    </div>

                    <div class="block">
                        <div class="block-title">
                            <span>đăng nhập</span>
                        </div>
                        <div class="block-content">
                            <form action="" method="post" class="form form-login">
                                <input type="hidden" name="form-key">
                                <fieldset>
                                    <form method="POST" enctype="multipart/form-data" action=" {{ route('login.auth') }}">
                                        @csrf
                                        <div class="field email required">
                                            <div class="control">
                                                <input type="text" name="email" id="email" class="input-text"
                                                       title="Email or phone number" placeholder="ĐỊA CHỈ EMAIL HOẶC SỐ ĐIỆN THOẠI" aria-required="true">
                                                <p class="help is-danger">{{ $errors->first('phone') }}</p>
                                                <p class="help is-danger">{{ $errors->first('email') }}</p>
                                            </div>
                                        </div>
                                        <div class="field password required">
                                            <div class="form-group">
                                                <input type="password" id="inputPassword3" name="password"
                                                       title="text" data-validate="{ required:true }" placeholder="MẬT KHẨU" aria-required="true" data-toggle="password" >
                                                <p class="help is-danger">{{ $errors->first('password') }}</p>
                                            </div>
                                        </div>
                                        <div class="primary">
                                            <button type="submit" class="action btn btn-primary" name="send" id="send2">
                                                <span>Đăng nhập</span>
                                            </button>
                                        </div>
                                        <div class="action-toolbar">

                                            <div class="secondary">
                                                <a href="{{ route('forget-password') }}" class="action remind" href="#">
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
                                    </form>

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
        @else
                <h3>Tài khoản của tôi</h3>
                <div class="row account-user">
                    <div class="col-lg-5">
                        <div class="noti-success">
                            @if (\Session::has('success'))
                                <div class="alert alert-success">
                                    <p>{{ \Session::get('success') }}</p>
                                </div>
                            @elseif(\Session::has('error'))
                                <div class="alert alert-danger">
                                    <p>{{ \Session::get('error') }}</p>
                                </div>
                            @endif
                        </div>
                        <div class="block-title">
                            <h5>Thông tin tài khoản</h5>
                        </div>
                        <div class="block-content">
                            <form class="form-info" method="post" action="{{ route('user.update', $user->id) }}">
                                @csrf
                                <div class="form-group">
                                    <label>Họ và tên</label>
                                    <input type="text" name="name" value="{{ $user->name }}">
                                </div>
                                <div class="form-group">
                                    <label>Email</label>
                                    <input type="email" name="email" value="{{ $user->email }}">
                                </div>
                                <div class="form-group">
                                    <label>Số điện thoại</label>
                                    <input type="number" name="phone" value="{{ $user->phone }}">
                                </div>
                                <button type="submit" name="sbm" class="sbm">Chính sửa thông tin</button>
                            </form>
                        </div>
                        <div class="logout">
                            <a href="{{ route('logout') }}">Đăng xuất</a>
                        </div>
                    </div>
                    <div class="col-lg-4"></div>
                    <div class="col-lg-3"></div>
                </div>
        @endif
    </div>
</section>
    <script type="text/javascript">
    </script>
@endsection
