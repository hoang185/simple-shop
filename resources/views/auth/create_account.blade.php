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
            <fieldset class="info" data-hasrequired=" *Bắt buộc">
                <div class="field name required">
                    <label for="">Họ và tên</label>
                    <div class="control">
                        <input type="text" name="name">
                        <div class="message-error">Đây là trường bắt buộc</div>
                    </div>
                </div>
                <div class="field phone required">
                    <label for="">Số điện thoại</label>
                    <div class="control">
                        <input type="number" name="phone">
                        <div class="message-error">Đây là trường bắt buộc</div>
                    </div>
                </div>
                <div class="field email required">
                    <label for="">Email</label>
                    <div class="control">
                        <input type="email" name="email" autocomplete="email">
                        <div class="message-error">Đây là trường bắt buộc</div>
                    </div>
                </div>
                <div class="field password required">
                    <label for="">Mật khẩu</label>
                    <div class="control">
                        <input type="password" name="password">
                        <div class="message-error">Đây là trường bắt buộc</div>
                    </div>
                </div>
                <div class="field re-password required">
                    <label for="">Nhập lại mật khẩu</label>
                    <div class="control">
                        <input type="password" name="password">
                        <div class="message-error">Đây là trường bắt buộc</div>
                    </div>
                </div>
                <div class="choice newsletter">
                    <input type="checkbox">
                    <label for="is_subscribed" class="label">
                        <span>Tôi muốn nhận bản tin của Simple qua email</span>
                    </label>
                </div>
                <div class="primary">
                    <button type="submit" class=" action btn btn-primary" name="send" id="send2">
                        <span>Đăng ký</span>
                    </button>
                </div>
            </fieldset>
        </div>
    </div>
</section>
@endsection
