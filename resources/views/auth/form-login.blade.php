<!-- resources/views/auth/login.blade.php -->

@extends('../layout')

@section('content')
<div class="container mt-5">
    <div class="row justify-content-center">
        <div class="col-md-8">
            <div class="card" style="box-shadow: 0 0 5px #76cff2;">
                <div class="card-header">{{ __('Login') }}</div>

                <div class="card-body">
                    <form method="POST" action="{{ route('login') }}">
                        @csrf

                        <div class="form-group row">
                            <label for="email" class="col-md-3 col-form-label text-md-right">Email</label>

                            <div class="col-md-6">
                                <input id="email" style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;' type="email" class="form-control" name="email" required>
                            </div>
                        </div>

                        <div class="form-group row">
                            <label for="password" class="col-md-3 col-form-label text-md-right">Mật khẩu</label>

                            <div class="col-md-6">
                                <input id="password" style=' border-radius: 5px; border: 2px solid #46b4f7; padding: 4px;' type="password" class="form-controlr" name="pass" required>
                            </div>
                        </div>
                        <div class="form-group row mb-0" style="padding-right: 180px;">
                            <div class="col-md-8 offset-md-4">
                                <button type="submit" class="btn btn-primary">
                                    Login
                                </button>
                                <a href="register">register</a>
                            </div>
                        </div>
                    </form>
                    @if (Session::has('error'))
                    <div class="alert alert-danger">
                        {{ Session::get('error') }}
                    </div>
                    @endif
                </div>
            </div>
        </div>
    </div>
</div>
@endsection