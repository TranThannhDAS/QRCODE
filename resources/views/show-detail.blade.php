<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css">
    <title>Laravel File Upload</title>
    <style>
    .container {
        max-width: 500px;
    }

    *,
    p {
        margin: 0;
    }

    dl,
    ol,
    ul {
        margin: 0;
        padding: 0;
        list-style: none;
    }

    .buttonReplaceName:hover {
        color: crimson;

    }

    .barOption:hover {
        color: #90c7f7
    }

    .closeFile:hover {
        background-color: #d74d70 !important;
    }

    .eye:hover {
        color:
            #0561CE !important;
    }
    </style>
</head>
<body>
    <body>
    
        <div class=" " style="width: 100%;  background-color: #e0e0e0;">
          
            <div
            style="justify-content: center;margin: auto;/* position: fixed; */display: flex;z-index:999;background: white;align-items: center;width: 100%;/* height: 50px; */top: 303px;left: 485px;display: flex;align-items: center;/* justify-content: space-between; ">              
                    <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data"
                    style="margin: 0 10px" id="theForm">
                    <div style='margin: auto; margin-top: 50px; '>
                        <div
                            style='width: 400px; margin: auto; border: 3px solid #0561CE; background: white; border-radius: 10px; padding: 20px;'>
                            <div style=' width: 100%;  margin-bottom: 16px;width: 100%;
                            word-break: break-all;'>
                                <h3 style='margin-bottom: 6px; color: #0561CE; font-weight: 700;'>Thông tin khởi tạo
                                </h3>
                                <p>Tên cuộc họp: {{ $file->name }}</p>
                            </div>
                            <div style=' width: 100%;  margin-bottom: 16px; width: 100%;
                            word-break: break-all;'>                           
                                <p>Mô tả: {{ $file->description }} </p>
                            </div>
                            <div style='width:100%;     height: 1px; border: 1px dashed #E3E3E3; margin-bottom: 21px;'>
                            </div>
                            <div style='width: 100%; color: black;'>
                                <h2 style="font-size: 17px; margin: 0;">Đường dẫn url: </h2>
                                <div style='    display: flex; align-items: center;'>
                                    <a href="{{ session('url1') }}"
                                        style='font-size: 14px;     text-decoration: none; color: blue;
                                        border-bottom: 1px solid; margin-right: 10px; 
                                        max-width: 76%; overflow: hidden; -webkit-line-clamp: 1; display: -webkit-box; -webkit-box-orient: vertical; /* display: flex; */
                                         height: fit-content;'> {{ $url }}
                                    </a>  
                                    </div>
                            </div>
                            <div style=' margin: 5px 0;  flex-wrap: wrap;   display: flex; justify-content: center;'>
                                <img src='data:image/png;base64,{{ base64_encode($qrCodeData) }}' style="width: 80%;" />
                                <a href='data:image/png;base64,{{ base64_encode($qrCodeData) }}'
                                    style="color: blue; border-bottom: 1px solid;    text-decoration: none; font-size: 15px;" download>Tải
                                    mã
                                    QR-Code</a>
                            </div>
                            <div style="margin-top: 25px">
                                @foreach ($files as $item)
                                <label
                                style=' position:relative; width: 100%; text-align: center; border-radius: 5px; padding: 15px 52px; box-shadow: 0px 1px 5px #00000040;'>
                                <div class="eye"
                                    style="  cursor: pointer;  position: absolute; top: 14px; right: 12px; font-size: 20px; width: 25px; height: 25px; display: flex; align-items: center; justify-content: center; border-radius: 50%; color: #CECECE; ">
                                     <a href="{{ url('storagefile/download?path=' . $item->getFilename() . '&name=' . '&code=' . $info) }}"><i class="fa-solid fa-file-arrow-down"></i></a>
                                </div>
                                <a href="{{ url('show?path=' . $item->getFilename() . '&id=' . $file->id . '&code=' . $info) }}"
                                    style='display: -webkit-box; -webkit-line-clamp: 1; -webkit-box-orient: vertical; overflow: hidden;'>
                                    {{ $item->getFilename()}}</a>
                            </label> 
                                @endforeach
                               
                            </div>
                       
                        </div>
                        <div></div>
                    </div>
                </form>
     
                </div>
    
    
    
            </div>
</body>
</html>