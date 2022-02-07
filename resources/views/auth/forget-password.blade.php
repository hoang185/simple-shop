@extends('app')
@section('page.title', 'Phục hồi mật khẩu')
@section('content')
    <div class="container" id="forget-password">
        <div class="row">

            <div class="col-lg-4">
                <div class="title">
                    <h1>Phục hồi mật khẩu</h1>
                </div>
                <div class="form">
                    <form method="post" action="">
                        @csrf
                        <div class="form-group">
                            <input type="email" name="email" placeholder="Địa chỉ email của bạn">
                        </div>
                        <button type="submit" name="sbm">Gửi</button>
                    </form>

                </div>
            </div>
        </div>
    </div>
@endsection



