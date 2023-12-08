<!doctype html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.5.0/css/bootstrap.min.css">
    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <title>Laravel File Upload</title>
    <style>
        .container {
            max-width: 500px;
        }

        dl,
        ol,
        ul {
            margin: 0;
            padding: 0;
            list-style: none;
        }
    </style>
</head>

<body>
    <div class="container mt-5">
        <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data">
            <h3 class="text-center mb-5">Upload File in Laravel</h3>
            @csrf
            <div class="">
                <input type="text" name="name" class="form-control">            
            </div>
            @if ($message = Session::get('success'))
                <div class="alert alert-success">
                    <strong>{{ $message }}</strong>
                </div>
            @endif
            @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <div class="d-flex">
                <div class="custom-files" style="flex: 1">
                    <div class="custom-file">
                        <input type="text" name="files[]" class="form-control" id="ádas">
                        <input type="file" name="files[]" id="chooseFile"
                            onchange="displayFileName(this)" multiple>
                        <label class="custom-file-label" for="chooseFile2">Select file</label>
                    </div>
                </div>
                <button style="height: fit-content" class="addtextbox btn-info border-0 p-2 rounded-1 rounded text-capitalize" type="button"> text input</button>
            </div>


            <script>
                function displayFileName() {
                    var input = document.querySelectorAll(".custom-file-input")
                    var fileName = input.files.map(file => {
                        return file.name
                    })
                    input.nextElementSibling.innerHTML = fileName; // Set tên file vào label
                    input.value = fileName; // Set tên file vào giá trị (value) của input
                }
            </script>
            <button type="submit" name="submit" class="btn btn-primary btn-block mt-4">
                Upload Files
            </button>
        </form>
            <a href=""></a>
               <div class="card">
            <div class="card-header">
                <h2>Color QR Code</h2>
            </div>                 
    </div>
     <script>
        // var btnAddText = document.querySelector(".addtextbox")
        // btnAddText.addEventListener("click", function(e) {
        //     var customFile = document.querySelector(".custom-files")

        //     customFile.innerHTML += `<div class="custom-file mt-2">
        //         <input type="file" name="file" class="custom-file-input" id="chooseFile"
        //                 onchange="displayFileName()">
        //             <label class="custom-file-label" for="chooseFile">Select file</label>
        //         </div>`
        // })
        // //   function additem(e){
        // //       e.preventDefault();
        // //     console.log(e);

        // //   }

        function displayFileName(input) {
    // Kiểm tra xem có file nào được chọn không
    if (input.files.length > 0) {
        // Lấy tên của file được chọn
        var fileName = input.files[0].name;
        
        // Lấy label
        var label = input.nextElementSibling;
        
        // Hiển thị tên file trên label
        label.innerHTML = fileName;
    } else {
        // Nếu không có file nào được chọn, thì hiển thị lại nội dung ban đầu của label
        input.value = '';
        label.innerHTML = 'Select file';
    }
}

    </script>

</body>

</html>
