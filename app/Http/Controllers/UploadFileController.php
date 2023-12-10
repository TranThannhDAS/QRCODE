<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Response;
use Illuminate\Support\Str;
use Illuminate\Support\Facades\Hash;
use SimpleSoftwareIO\QrCode\Facades\QrCode;
use Barryvdh\DomPDF\Facade as PDF;

class UploadFileController extends Controller
{
    public function createForm()
    {
        return view('upload');
    }
    public function fileUpload(Request $request)
    {
        // $randomString = Str::random(7);
        // $path = 'app/'.'public/' . 'uploads' . '/' . $randomString;
        // $qrCodeData = base64_encode(QrCode::format('png')->size(300)->generate('abc'));
        // if (!File::exists(storage_path($path))) {
        //     File::makeDirectory($path, 0755, true, true);
        // }
        // file_put_contents(storage_path($path), $qrCodeData);        
        //  return redirect()->route('show-form-uploadFile')->with('success', 'Multiple File has been uploaded Successfully')
        // ->with('image', $qrCodeData);

        $validatedData = $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:csv,txt,xlx,xls,pdf,doc,docx'
        ]);
        if (!$request->session()->has('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            $randomString = Str::random(7);
            $path = 'public/' . 'uploads' . '/' . $randomString.'/'.$request->name;
            if (!File::exists(storage_path($path))) {
                File::makeDirectory($path, 0755, true, true);
            }
            $qrCodeData = QrCode::format('png')->size(300)->generate(url($randomString));
        }else{
            $path = 'public/' . 'uploads' . '/' . $request->session()->get('id') . '/' . $request->name;
            if (!File::exists(storage_path($path))) {
                File::makeDirectory($path, 0755, true, true);
            }  
        }              
        $fileBag = $request->file('files');
        if ($fileBag) {
            // Lấy danh sách các file
            $allFilePaths = '';
            // Lặp qua từng file
            foreach ($fileBag as $key => $file) {
                // Lấy tên file
                $fileName = $file->getClientOriginalName();
                print_r($fileName . "<br>");
                $path_pdf = $file->storeAs($path, $fileName);
                print_r($path_pdf);
                $allFilePaths .= $path_pdf . '|';
            }
            if($request->session()->has('id')){
                $file_db = new Files();
                $file_db->name = $request->name;
                $file_db->filepath = $allFilePaths;
                $file_db->userid = $request->session()->get('id');
                $file_db->save();
                $fileId = $file_db->id;
    
                // Sử dụng ID để tạo link QRCode
                $file_db->qrcode = url('storagefile/' . $fileId . '/edit');
                $file_db->save();
                $qrCodeData = QrCode::format('png')->size(50)->generate(url($file_db->qrcode));
            }                
        }
        return redirect()->route('show-form-uploadFile')->with('success', 'Multiple File has been uploaded Successfully')
        ->with('qrcode', $qrCodeData);;
    }
    public function allfile()
    {
        if (!session('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            return redirect()->route('show-form-login');
        }
        $file = DB::table('files')->where('userid', session('id'))->get();

        return view('show-file.index', compact('file'));
    }
    public function show_edit($id)
    {
        $files = Files::find($id);
        if($files->userid !== session('id')){
            abort(404);
        }
        if (!session('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            return redirect()->route('show-form-login');
        }
        $file = DB::table('files')
            ->where('id', '$id')
            ->where('userid', session('id'))
            ->get();
        $files = File::files(storage_path('app/public/uploads/' . session('id') . '/' . $file->name));
        return view('show-file.edit', compact('file', 'files'));
    }
    public function edit(Files $file)
    {
    }

    public function ondownload(Request $request)
    {
        if (!session('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            return redirect()->route('show-form-login');
        }
        $path2 = storage_path('app\public\uploads/' . session()->get('id') . '/' . $request->name . '/' . $request->path);
        if (File::exists($path2)) {
            return response()->download($path2);
        } else {
            return "File not found";
        }
    }
    public function ondelete(Request $request)
    {
        if (!session('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            return redirect()->route('show-form-login');
        }
        $path2 = storage_path('app\public\uploads/' . session()->get('id') . '/' . $request->name . '/' . $request->path);
        if (File::exists($path2)) {
            File::delete($path2);
            return redirect()->route('show_edit', ['id' => $request->id]);
        } else {
            return "File not found";
        }
    }
    public function deleteall(Request $request, $id)
    {
        if (!session('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            return redirect()->route('show-form-login');
        }
        $exsitsFile = DB::table('files')->where('id', $id)->first();
        if (!$exsitsFile) {
            return null;
        }
        $path = storage_path('app\public\uploads/' . session()->get('id') . '/' . $exsitsFile->name);
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        DB::table('files')->where('id', $id)->delete();
        return redirect()->route('storagefile');
    }
    public function doedit(Request $request)
    {
        $files = Files::find($request->id);
        if($files->userid !== session('id')){
            abort(404);
        }
        if (!session('id')) {
            //     //tạo ra QR code rồi lưu vào dự án thông qua httplocalhost
            //     //địa chỉ storage
            return redirect()->route('show-form-login');
        }
       
        $nameOld = $request->get('nameOld');
        $nameNew = $request->get('nameNew');
        $Oldpath = storage_path('app\public\uploads/' . session()->get('id') . '/' . $nameOld);
        $Newpath = storage_path('app\public\uploads/' . session()->get('id') . '/' . $nameNew);
        if ($nameOld !== $nameNew) {
            if (File::exists($Oldpath)) {
                File::move($Oldpath, $Newpath);
            } else {
                echo "Thư mục cần đổi tên không tồn tại.";
            }
            $user = Files::find($request->id);
            $user->update([
                'name' => $nameNew
            ]);
        }
        $path = 'public/' . 'uploads' . '/' . $request->session()->get('id') . '/' . $nameNew;
        $fileBag = $request->file('files');
        if ($fileBag) {
            // Lấy danh sách các file
            $allFilePaths = '';
            // Lặp qua từng file
            foreach ($fileBag as $key => $file) {
                // Lấy tên file
                $fileName = $file->getClientOriginalName();
                $path_pdf = $file->storeAs($path, $fileName);
            }
        }
        return redirect()->route('storagefile');
    }
    public function show_edit_anonymous(Request $request){       
        $parts = explode('/', $request->getPathInfo());
        $info = $parts[1];
        $files = File::files(storage_path('app/public/uploads/' . $info));
        $path = storage_path('app/public/uploads/' . $info);
//kphwWsS
    }
}
