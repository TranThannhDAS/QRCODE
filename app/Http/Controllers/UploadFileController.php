<?php

namespace App\Http\Controllers;

use App\Models\Files;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Facades\File;
use App\Http\Controllers\Response;
use App\Models\Anonymous_file;
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
        $randomString = Str::random(12);
        $validatedData = $request->validate([
            'files' => 'required',
            'files.*' => 'mimes:csv,txt,xlx,xls,pdf,doc,docx'
        ]);
        if (!$request->session()->has('id')) {
            $path = 'public/' . 'uploads' . '/' . $randomString;
        } else {
            $path = 'public/' . 'uploads' . '/' . $request->session()->get('id') . '/' . $randomString;
        }
        if (!File::exists(storage_path($path))) {
            File::makeDirectory($path, 0755, true, true);
        }
        $fileBag = $request->file('files');
        if ($fileBag) {
            // Lấy danh sách các file
            $allFilePaths = '';
            // Lặp qua từng file
            foreach ($fileBag as $key => $file) {
                // Lấy tên file
                $fileName = $file->getClientOriginalName();
                $path_pdf = $file->storeAs($path, $fileName);
                $allFilePaths .= $path_pdf . '|';
            }
            if ($request->session()->has('id')) {
                $file_db = new Files();
                $file_db->name = $request->name;
                $file_db->filepath = $allFilePaths;
                $file_db->userid = $request->session()->get('id');
                $file_db->hashcode = $randomString;
                $file_db->save();
                $fileId = $file_db->id;

                // Sử dụng ID để tạo link QRCode
                $file_db->qrcode = url('storagefile/' . $fileId . '/edit');
                $file_db->save();
                $qrCodeData = QrCode::format('png')->size(500)->generate($file_db->qrcode);
            } else {
                $anonymous = new Anonymous_file();
                $anonymous->hashcode = $randomString;
                $anonymous->name = $request->name;
                $anonymous->qrcode = url($randomString);
                $anonymous->save();
                $qrCodeData = QrCode::format('png')->size(500)->generate($anonymous->qrcode);
            }
        }
        return redirect()->route('show-form-uploadFile')->with('success', 'Multiple File has been uploaded Successfully')
            ->with('qrcode', $qrCodeData);;
    }
    public function allfile()
    {
        if (!session('id')) {           
            return redirect()->route('show-form-login');
        }
        $files = DB::table('files')->where('userid', session('id'))->paginate(5);
        return view('show-file.index', compact('files'));
    }
    public function show_edit($id)
    {
        if (!session('id')) {
            return redirect()->route('show-form-login');
        }
        $files = Files::find($id);
        if ($files->userid !== session('id')) {
            abort(404);
        }
        $file = DB::table('files')
            ->where('id', $id)
            ->where('userid', session('id'))
            ->first();
        $files = File::files(storage_path('app/public/uploads/' . session('id') . '/' . $file->hashcode));
        $qrCodeData = QrCode::format('png')->size(1000)->generate($file->qrcode);
        $info = $file->hashcode;
        return view('show-file.edit', compact('file', 'files','qrCodeData','info'));
    }

    public function ondownload(Request $request)
    {
        if (!session('id')) {
        $path2 = storage_path('app\public\uploads/' . session()->get('id') . '/' . $request->code . '/' . $request->path);
        }else{
        $path2 = storage_path('app\public\uploads/' . session()->get('id') . '/' . $request->code . '/' . $request->path);
        }
        
        if (File::exists($path2)) {
            return response()->download($path2);
        } else {
            return "File not found";
        }           
    }
    public function ondelete(Request $request)
    {
        if (!session('id')) {      
            $path2 = storage_path('app\public\uploads/'. '/' . $request->code . '/' . $request->path);
        }else{
            $path2 = storage_path('app\public\uploads/' . session()->get('id') . '/' . $request->code . '/' . $request->path);
        }   
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
            return redirect()->route('show-form-login');
        }
        $exsitsFile = DB::table('files')->where('id', $id)->first();
        if (!$exsitsFile) {
            return null;
        }
        $path = storage_path('app\public\uploads/' . session()->get('id') . '/' . $exsitsFile->hashcode);
        if (File::exists($path)) {
            File::deleteDirectory($path);
        }
        DB::table('files')->where('id', $id)->delete();
        return redirect()->route('storagefile');
    }
    public function doedit(Request $request)
    {
        if (!session('id')) {      
                return redirect()->route('show-form-login');
            }

            $validatedData = $request->validate([
                'files.*' => 'mimes:csv,txt,xlx,xls,pdf,doc,docx'
            ]);

            $files = Files::find($request->id);
            $path = 'public/' . 'uploads' . '/' . $request->session()->get('id') . '/' . $files->hashcode;
        
        if ($files->userid !== session('id')) {
            abort(404);
        }
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
        if (session('id')) {
            DB::table('files')
            ->where('id', $request->id)
            ->update(['name' => $request->nameNew]);
        } 
        return redirect()->route('storagefile');
    }
    public function show_edit_anonymous(Request $request)
    {
        $parts = explode('/', $request->getPathInfo());
        $info = $parts[1];
        if(File::exists(storage_path('app/public/uploads/' . $info))){
            $files = File::files(storage_path('app/public/uploads/' . $info));
        }else{
            abort(404);
        }  
        $file = DB::table('anonymous_files')
            ->where('hashcode', $info)
            ->first();
        $qrCodeData = QrCode::format('png')->size(1000)->generate($file->qrcode);
        return view('show-file.edit', compact('file', 'files','qrCodeData','info'));
    }
    public function find(Request $request)
    {
        if (!session('id')) {          
            return redirect()->route('show-form-login');
        }
        $request->validate([
            'query' => 'required|min:2'
        ]);
        $search_text = $request->input('query');
        $files = DB::table('files')
            ->where('name', 'LIKE', '%' . $search_text . '%')
            ->paginate(5);
        return view('show-file.index', ['files' => $files]);
    }
}
