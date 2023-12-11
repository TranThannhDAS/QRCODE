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
    </style>
</head>

<body>
    <div class="mt-5 " style="width: 979px; box-shadow: 0 0 5px #ffbdbd; background-color: #e0e0e0;
 position: relative; margin: auto; padding: 7px;  border: 1px solid; border-radius: 5px;">
        <div style="position: absolute; top: 5px; left: 4px;">
            <div style='display: flex; align-items: center;'>
                <div style="width: 50px; height: 50px; margin-right: 5px;">
                    <img style='width: 100%;height: 100%; object-fit: cover;' src="https://gaixinhbikini.com/wp-content/uploads/2023/02/anh-gai-dep-2k-005.jpg" alt='' />
                </div>
                <div style="    width: 147px; height: 50px; border: 1px solid; display: flex; align-items: center; justify-content: center; border-radius: 5px; box-shadow: 0 0 2px wheat; background-color: #b5d0f3;">
                    QR code</div>
            </div>
            <div style='border: 1px solid #333333; margin-top: 10px; border-radius: 5px; box-shadow: 0 0 2px #d2ba8d; background-color: cornsilk; color: white;'>
                <div style='cursor: pointer; padding: 10px; text-align: center;' class='barOption'>
                    <a href="#">Tạo mới</a> 
                </div>
                <div style='cursor: pointer; padding: 10px; text-align: center;' class='barOption'>
                   <a href="{{ route('storagefile') }}">Mã của tôi</a> 
                </div>
                <div style='cursor: pointer; padding: 10px; text-align: center;' class='barOption'>
                    <a href="#" >Lấy link</a> 
                </div>
            </div>
        </div>
        @if (session()->has('id'))
        <a href="{{ url('logout') }}" style=" outline: none;   position: absolute; top: 5px; right: 9px; padding: 3px 40px; border-radius: 5px; background-color: #ea645d; border-color: #f57373; color: white;">Đăng xuất</a>
        @else
        <a href="{{ url('login') }}" style=" outline: none;   position: absolute; top: 5px; right: 9px; padding: 3px 40px; border-radius: 5px; background-color: #3692ca; border-color: #277fc8; color: white; ">Đăng nhập</a>
        @endif
        <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data" id="theForm" style='width: 450px; margin: auto;'>
            <h3 class="text-center mb-5">Tạo mã QR</h3>
            @csrf
            @if ($message = Session::get('success')) <div class="alert alert-success">
                <strong>{{ $message }}</strong>
            </div>
            @endif
            <div style='width: auto; background-color: white; width: auto; padding: 21px 15px; box-shadow: 0 0 6px; border-radius: 5px;'>
                @if (count($errors) > 0)
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
                @endif
                <div style="width: 100%;">
                    <input type="text" class="form-control " placeholder="Tên dự án" style=' width: 84%;' name="name" required>
                </div>
                <div class="d-flex align-items-center" style='position: relative;'>
                    <div class="custom-files" style="width: 84%">
                        <div class="custom-file custom-file0 mt-3" data-index='0' style='position: relative;'>
                            <input type="file" name="files[]" class='onInput' data-index='0' id="chooseFile0" hidden onchange="displayFileName(this)" multiple>
                            <input type="text" name="name" class="form-control replaceName" data-index='0' oninput='handleLoadText(this)' placeholder="Tên dự án" style='position: absolute; width:79%;'>
                            <label class="custom-file-label" data-index='0' for="chooseFile0">Select file</label>
                        </div>
                    </div>
                    <button style="height: fit-content; width: fit-content ;position: absolute; right: -9px; top: 16px; font-size: 25px; padding: 0px 27px; display: flex; align-items: center;" class="addtextbox btn-info border-0 rounded-1 rounded text-capitalize" type="button">+</button>
                </div>
                <button type="button" onclick="formSubmit(this)" name="submit" class=" btn btn-primary btn-block mt-4 buttonSubmitUploadFile">
                    Tải files & tạo mã QR
                </button>
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

            <div style="width: 10px; height: 265px; "></div>
            <div id="downloadQR" style=" width: 250px; position: absolute; right: 4px; height: 250px; top: 203px;">
                @if ($image = Session::get('qrcode'))
                <div style="width: 100%; height: 100%;">
                    <img style="width: 100%; height: 100%;" src="data:image/png;base64,{{ base64_encode($image) }}" alt="QR Code">
                </div>
                <div style=" width: 100%; text-align: center; padding: 2px 4px; border: 1px solid;     margin-top: 5px; border-radius: 5px; background-color: #007bff;">
                    <a type="button" style="color: white" href="data:image/png;base64,{{ base64_encode($image) }} " download>Downloads</a>
                </div>
                @endif
            </div>
        </form>
        <script>
            let index = 0;
            let fileData = []
            const btnAddText = document.querySelector(".addtextbox")
            const butt = document.querySelector(".buttonSubmitUploadFile")
            let inputReplaceDDD = document.querySelectorAll('.replaceName')
            const formSubmit = (e) => {
                const form = document.getElementById('theForm')

                const dataTransfer = new DataTransfer();

                // Add files to the DataTransfer object
                fileData.forEach((file) => {
                    dataTransfer.items.add(file.file);
                });

                //  Remove the old file inputs (assuming you have existing file inputs with class "custom-file")
                const divCus = document.querySelectorAll('.custom-file');
                divCus.forEach((f) => {
                    if (f) f.remove();
                });

                // Append the FormData to the form
                const input = document.createElement('input');
                input.type = 'file';
                input.name = 'files[]';
                input.setAttribute('style', 'display: hidden')
                input.multiple = true;
                input.files = dataTransfer.files;
                form.appendChild(input);
                console.log('why');
                const downloadQR = document.getElementById('downloadQR')
                HTMLFormElement.prototype.submit.call(form)

            }

            btnAddText.addEventListener("click", function(e) {
                index += 1
                inputReplaceDDD = document.querySelectorAll('.replaceName')
                var customFile = document.querySelector(".custom-files")
                const div = `<div class="custom-file custom-file${index} mt-3" data-index='${index}'>
                                    <input type="file" name="file" class="custom-file-input onInput" data-index='${index}' id="chooseFile${index}"
                                    onchange="displayFileName(this)">
                                    <input type="text" name="name" class="form-control replaceName" data-index='${index}'
                            placeholder="Tên dự án" style='position: absolute; top: 0px; left: 0px; width: 79%;' oninput='handleLoadText(this)'>
                                    <label class="custom-file-label" data-index='${index}' for="chooseFile${index}">Select file</label>
                            </div>`

                console.log(customFile);
                customFile.insertAdjacentHTML('beforeend', div)
            })

            function additem(e) {
                e.preventDefault();

            }

            function displayFileName(input) {
                // Kiểm tra xem có file nào được chọn không
                if (input.files.length > 0) {
                    const rr = document.querySelectorAll('.replaceName')

                    if (fileData.some(f => f.id === input.dataset.index)) {
                        fileData = fileData.map(f => {
                            if (f.id === input.dataset.index) f.file = input.files[0]
                            return f
                        })
                    } else {
                        fileData.push({
                            id: input.dataset.index,
                            file: input.files[0]
                        });
                    }
                    Array.from(rr).map(r => {
                        if (r.dataset.index === input.dataset.index) {
                            r.setAttribute('style',
                                'position: absolute; padding-right: 40px; width: 79%; z-index: 5; top: 0px')
                            r.value = input.files[0].name
                        }
                    })
                    // Lấy tên của file được chọn
                    var fileName = input.files[0].name;

                    // Lấy label
                    var label = input.nextElementSibling;

                    // Hiển thị tên file trên label
                    // label.innerHTML = fileName;
                    const divCus = document.querySelectorAll('.custom-file')
                    Array.from(divCus).map(e => {
                        console.log(input.closest(
                            `.custom-file${input.dataset.index}`), input.dataset.index);
                        if (e.getAttribute('class') === input.closest(
                                `.custom-file${input.dataset.index}`).getAttribute('class')) {
                            const fileName = input.files[0].name;
                            const divBut =
                                `<div  onclick="handleDelete(this)" class='buttonReplaceName' 
                                data-index='${input.dataset.index}' 
                                style="position: absolute;right: 79px;top: 6px;padding: 2px 7px; border-radius: 5px; border: 1px solid #2acb95; font-size: 14px; cursor: pointer; z-index: 5; background-color: #c67878;  border: 0;color: white;">Xóa</div>`
                            e.insertAdjacentHTML('beforeend', divBut)

                        }
                        console.log(e.getAttribute('class'), 'e.getAttribute');
                        // const div = `<button>replace name</button>`
                    })
                } else {
                    // Nếu không có file nào được chọn, thì hiển thị lại nội dung ban đầu của label
                    input.value = '';
                    label.innerHTML = 'Select file';
                }
            }
            const handleDelete = (e) => {
                const butReplaceName = document.querySelectorAll('.buttonReplaceName')
                const divCus = document.querySelectorAll('.custom-file')
                const form = document.getElementById('theForm')
                const rr = document.querySelectorAll('.replaceName')

                Array.from(divCus).map((f, index, arr) => {
                    console.log('delete', f, arr, rr);

                    if (arr.length === 1) {
                        HTMLFormElement.prototype.reset.call(form)
                        Array.from(rr).map(r => {
                            r.setAttribute('style', 'z-index: 0;position: absolute; width: 84%; top: 0')
                            r.value = ''
                        })
                        Array.from(butReplaceName).map(b => b.remove())
                    } else {
                        if (e.dataset.index === f.dataset.index) {
                            fileData = fileData.filter(f => f.id !== e.dataset.index)
                            f.remove()
                        }
                    }


                })
            }
            let text = ''

            const handleLoadText = (e) => { // change name and data here
                const inputReplace = document.querySelector('input.replaceName')
                const inputs = document.querySelectorAll('.onInput')
                Array.from(inputs).map(inp => {
                    if (inp.dataset.index === e.dataset.index) {
                        console.log('voo 1', inp, 'fuck', inp.files[0].name);
                        const fileName = inp.files[0].name;
                        const pdfRegex = /\.pdf$/i; // Case-insensitive match for .pdf
                        const docxRegex = /\.docx$/i; // Case-insensitive match for .docx
                        const xlxsRegex = /\.xlxs$/i; // Case-insensitive match for .xlxs
                        const docRegex = /\.doc$/i; // Case-insensitive match for .docx

                        // Test the filename against each regex
                        const isPdf = pdfRegex.test(e.value);
                        const isDoc = docRegex.test(e.value);
                        const isDocX = docxRegex.test(e.value);
                        const isXlxs = xlxsRegex.test(e.value);
                        console.log(isPdf, isDoc, isDocX);
                        if (isPdf || isDocX || isXlxs) { // kiểm tra đuôi file
                            console.log('voo 2');
                            text = e.value
                            const fd = fileData.filter(f => f.id === e.dataset
                                .index)[0]
                            const myRenamedFile = new File([fd.file], e.value, {
                                lastModifiedDate: fd.file.lastModifiedDate,
                                type: fd.file.type,
                                size: fd.file.size,
                                webkitRelativePath: fd.file.webkitRelativePath

                            });
                            console.log(fd, 'fd.lastModifiedDate', fileData);
                            fileData = fileData.map(f => {
                                if (f.id === e.dataset.index) f.file = myRenamedFile
                                return f
                            })
                        } else {
                            e.value = text ? text : fileName
                            console.log('voo 3');
                        }

                        // inputReplace.value = ''
                        // inputReplace.setAttribute('data-index', '0');

                    }
                })
            }
        </script>

</body>

</html>