<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-T3c6CoIi6uLrA9TneNEoa7RxnatzjcDSCmG1MXxSR1GAsXEV/Dwwykc2MPK8M2HN" crossorigin="anonymous">
    <title>Thêm sửa xóa sinh viên trong Laravel 8</title>
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

</head>
<body>
     @yield('content')
     <div
     style='position: fixed;display: flex; z-index:999; background: white; align-items: center; width: 100%; height: 50px; top: 0; left: 0; display: flex; align-items: center; justify-content: space-between '>
     <div
         style="color: #0561CE;display: flex; align-items: center; width: 100px; padding: 0 13px; margin-left: 50px; justify-content: space-between">
         <div><i class="fa-solid fa-expand"></i></div>
         <p style='font-weight:600;'>QRHOP</p>
     </div>
     <div style='display: flex; align-items: center; padding: 0 50px;'>
         <div style='display: flex; margin-right: 10px; align-items: center; color: #0561CE;'>
             <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>TRANG CHỦ</a>
             <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>GIỚI THIỆU</a>
             <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>ĐÁNH GIÁ</a>
             <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>LỘ TRÌNH</a>
             <a style='margin: 0 8px; cursor: pointer; font-weight:600;'>LIÊN HỆ</a>
             <a href="{{ route('storagefile') }}" style='margin: 0 8px; cursor: pointer; font-weight:600; text-decoration: none;'>Danh sách mã QR</a>
         </div>
         <div style='width: 1px; height: 30px; background: #CECECE'></div>
         @if (!session('id'))
             <div style='display: flex;padding: 0 18px; align-items: center; '><a 
                 href="{{ url('register') }}"
                 style=' color: black; cursor: pointer; text-decoration: none;'>Đăng
                 ký</a>
                 <a
                   href="{{ url('login') }}"
                 style='padding: 4px 20px; margin-left: 10px;border-radius: 5px; cursor: pointer; color: white;background: #0561CE; text-decoration: none;'>Đăng
                 nhập</a>
             </div>
         @else
         <a href="{{ url('logout') }}" style="padding: 4px 20px; margin-left: 10px;border-radius: 5px; cursor: pointer; background-color: #ea645d; border-color: #f57373; color: white; text-decoration: none;">Đăng xuất</a>
     
         
             
         @endif
         
     </div>
     </div>
     <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/js/bootstrap.bundle.min.js" integrity="sha384-C6RzsynM9kWDrMNeT87bh95OGNyZPhcTNXj1NW7RuBCsyN/o0jlpcV8Qyq46cDfL" crossorigin="anonymous"></script>

</body>
</html>