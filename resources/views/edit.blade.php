@extends('layout')

@section('content')
  <div class="container">
    <div class="card">
        <div class="card-header">
            <div class="row">
                <div class="col-md-6">
                    <h3>Sửa sinh viên</h3>
                </div>
                <div class="col-md-6">
                    <a href="{{ route('sinhvien.index') }}" class="btn btn-primary float-end">Danh sách sinh viên</a>
                </div>
            </div>
        </div>
        <div class="card-body">
            <form action="{{route('sinhvien.update',$sinhvien->id)}}" method="POST">
                 @csrf
                 @method('PUT')
                 <div class="row">
                    <div class="col-md-6">
                        <div class="form-group">
                            <strong>Mã sinh viên</strong>
                            <input type="text" name="MaSV" class="form-control" value="{{ $sinhvien->MaSV }}" placeholder="Nhập mã sinh viên">
                        </div>
                        <div class="form-group">
                            <strong>Họ tên</strong>
                            <input type="text" name="HoTen" class="form-control" value="{{ $sinhvien->HoTen }}" placeholder="Nhập họ tên">
                        </div>
                        <div class="form-group">
                            <strong>Ngày sinh</strong>
                            <input type="date" name="NgaySinh" class="form-control" value="{{ $sinhvien->NgaySinh }}" placeholder="Nhập Ngày sinh">
                        </div>
                        <div class="col-md-6">
                            <div class="form-group">
                                <strong>Giới tính</strong>
                                <select name="GioiTinh" class="form-select" id="">
                                    <option selected>Chọn giới tính</option>
                                    <option value="Nam" {{ $sinhvien->GioiTinh == "Nam"? 'selected' : '' }}>Nam</option>
                                    <option value="Nữ" {{ $sinhvien->GioiTinh == "Nữ"? 'selected' : '' }}>Nữ</option>

                                </select>
                            </div>
                        </div>
                        <div class="form-group">
                            <strong>Địa chỉ</strong>
                            <input type="text" name="DiaChi" value="{{ $sinhvien->DiaChi }}" class="form-control" placeholder="Nhập địa chỉ">
                        </div>
                        <div class="form-group">
                            <strong>Số điện thoại</strong>
                            <input type="text" name="SoDT" value="{{ $sinhvien->SoDT }}" class="form-control" placeholder="Nhập số điện thoại">
                        </div>
                    
                    </div>
                 </div>
                 <button type="submit" class="btn btn-success mt-2">Cập nhật</button>
            </form>
        </div>
    </div>
  </div>