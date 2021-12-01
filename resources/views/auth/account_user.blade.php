@extends('app')
@section('page.title', 'Tài khoản của tôi')
@section('content')
    <section id="account-user">
        <div class="container">
            <h3>Tài khoản của tôi</h3>
            <div class="row">
                <div class="col-lg-5">
                    <div class="block-title">
                        <h5>Thông tin tài khoản</h5>
                        <a href="#">Chỉnh sửa thông tin</a>
                    </div>
                    <div class="block-content">
                        <table>
                            <tbody>
                            <tr>
                                <th>Họ và tên</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Email</th>
                                <td></td>
                            </tr>
                            <tr>
                                <th>Số điện thoại</th>
                                <td></td>
                            </tr>
                            </tbody>
                        </table>
                    </div>
                    <div class="logout">
                        <a href="#">Đăng xuất</a>
                    </div>
                </div>
                <div class="col-lg-4"></div>
                <div class="col-lg-3"></div>
            </div>
        </div>
    </section>
@endsection



