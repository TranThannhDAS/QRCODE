<!-- resources/views/auth/register.blade.php -->

@extends('../layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: 0 0 5px #76cff2;">
                <div class="card-header">Đăng ký</div>

                <div class="card-body">
                    @if (Session::has('success'))
                    <div class="alert alert-success">
                        {{ Session::get('success') }}
                    </div>
                    @endif
                    <form method="POST" action="{{ route('register') }}">
                        @csrf

                        <div class="form-group row" style='margin-bottom: 6px;'>
                            <label for="email" class="col-md-4 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" type="email"
                                    style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;'
                                    class="form-control" name="email" required>
                                @if (Session::has('errors.email'))
                                <span class="text-danger small">
                                    <strong>{{ Session::get('errors.email') }}</strong>
                                </span>
                                @endif
                            </div>

                        </div>
                        <div class="form-group row" style='margin-bottom: 6px;'>
                            <label for="name" class="col-md-4 col-form-label text-md-right">Họ và tên</label>

                            <div class="col-md-6">
                                <input id="name" type="text"
                                    style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;'
                                    class="form-control" name="username" required>
                            </div>
                        </div>



                        <div class="form-group row" style='margin-bottom: 6px;'>
                            <label for="email" class="col-md-4 col-form-label text-md-right">Số điện thoại</label>

                            <div class="col-md-6">
                                <input id="phone" type="text"
                                    style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;'
                                    class="form-control" name="phone" required>
                            </div>
                        </div>

                        <div class="form-group row" style='margin-bottom: 6px;'>
                            <label for="password" class="col-md-4 col-form-label text-md-right">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" type="password"
                                    style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;'
                                    class="form-control" name="pass" required>

                            </div>
                        </div>

                        <div class="form-group row" style='margin-bottom: 6px;'>
                            <label for="password-confirm" class="col-md-4 col-form-label text-md-right">Xác nhận mật
                                khẩu</label>

                            <div class="col-md-6">
                                <input id="password-confirm" type="password"
                                    style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;'
                                    class="form-control" name="cfm_pass" required>
                                @if (Session::has('errors.pass'))
                                <span class="text-danger small">
                                    <strong>{{ Session::get('errors.pass') }}</strong>
                                </span>
                                @endif
                            </div>
                        </div>

                        <div class="form-group row mb-0">
                            <div class="col-md-6 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Đăng ký
                                </button>
                                <a href="{{ url('login') }}">Login</a>
                            </div>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection