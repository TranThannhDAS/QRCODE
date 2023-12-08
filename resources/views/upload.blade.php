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
        <form action="{{ route('fileUpload') }}" method="post" enctype="multipart/form-data" id="theForm">
            <h3 class="text-center mb-5">Upload File in Laravel</h3>
            @csrf
            @if ($message = Session::get(' success')) <div class="alert alert-success">
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
            <div class="d-flex align-items-center" style='position: relative;'>
                <div class="custom-files" style="width: 100%">
                    <div class="custom-file custom-file0 mt-2" data-index='0' style='position: relative;'>
                        <input type="file" name="files[]" class='onInput' data-index='0' id="chooseFile0" hidden
                            onchange="displayFileName(this)" multiple>
                        <input type="text" name="name" class="form-control replaceName" data-index='0'
                            oninput='handleLoadText(this)' placeholder="Tên dự án"
                            style='position: absolute; width: 84%;'>
                        <label class="custom-file-label" data-index='0' for="chooseFile0">Select file</label>
                    </div>
                </div>
                <button style="height: fit-content; width: fit-content ;position: absolute; right: -96px; top: 8px;"
                    class="addtextbox btn-info border-0 p-2 rounded-1 rounded text-capitalize" type="button"> text
                    input</button>
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
            <button type="button" onclick="formSubmit(this)" name="submit"
                class=" btn btn-primary btn-block mt-4 buttonSubmitUploadFile">
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
            input.multiple = true;
            input.files = dataTransfer.files;
            form.appendChild(input);
            console.log('why');
            HTMLFormElement.prototype.submit.call(form)

        }

        btnAddText.addEventListener("click", function(e) {
            index += 1
            inputReplaceDDD = document.querySelectorAll('.replaceName')
            var customFile = document.querySelector(".custom-files")
            const div = `<div class="custom-file custom-file${index} mt-2" data-index='${index}'>
                                    <input type="file" name="file" class="custom-file-input onInput" data-index='${index}' id="chooseFile${index}"
                                    onchange="displayFileName(this)">
                                    <input type="text" name="name" class="form-control replaceName" data-index='${index}'
                            placeholder="Tên dự án" style='position: absolute; top: 0px; left: 0px; width: 84%;' oninput='handleLoadText(this)'>
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
                        r.setAttribute('style', 'position: absolute; width: 84%; z-index: 5; top: 0px')
                        r.value = input.files[0].name
                    }
                })
                // Lấy tên của file được chọn
                var fileName = input.files[0].name;

                // Lấy label
                var label = input.nextElementSibling;

                // Hiển thị tên file trên label
                label.innerHTML = fileName;
                const divCus = document.querySelectorAll('.custom-file')
                Array.from(divCus).map(e => {
                    console.log(input.closest(
                        `.custom-file${input.dataset.index}`), input.dataset.index);
                    if (e.getAttribute('class') === input.closest(
                            `.custom-file${input.dataset.index}`).getAttribute('class')) {
                        const fileName = input.files[0].name;
                        const isPdf = fileName.toLowerCase().endsWith('.pdf');
                        const isDoc = fileName.toLowerCase().endsWith('.doc');
                        const isDocX = fileName.toLowerCase().endsWith('.docx');
                        const divBut =
                            `<button type='button' onclick="handleDelete(this)" class='buttonReplaceName' data-index='${input.dataset.index}' style="position: absolute; left: -99px; top: 5px; padding: 2px 5px; border-radius: 5px; border: 1px solid #2acb95; font-size: 14px; cursor: pointer;">Delete</button>`
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
        const butReplaceName = document.querySelectorAll('.buttonReplaceName')
        const handleDelete = (e) => {
            const divCus = document.querySelectorAll('.custom-file')

            Array.from(divCus).map(f => {
                console.log('delete', e.dataset.index, f);
                if (e.dataset.index === f.dataset.index) {
                    fileData = fileData.filter(f => f.id !== e.dataset.index)
                    f.remove()
                }

            })
        }

        const handleLoadText = (e) => { // change name and data here
            const inputReplace = document.querySelector('input.replaceName')
            const inputs = document.querySelectorAll('.onInput')
            Array.from(inputs).map(inp => {
                if (inp.dataset.index === e.dataset.index) {
                    console.log('voo 1', inp, 'fuck', inp.files[0].name);
                    const fileName = inp.files[0].name;
                    const isPdf = fileName.toLowerCase().endsWith('.pdf');
                    const isDocX = fileName.toLowerCase().endsWith('.docx');
                    const isDoc = fileName.toLowerCase().endsWith('.doc');
                    if (!isPdf && !isDoc && !isDocX) { // kiểm tra đuôi file
                        console.log('voo 2');

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
                        e.value = fileName
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