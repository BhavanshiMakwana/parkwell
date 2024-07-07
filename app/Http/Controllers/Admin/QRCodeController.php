<?php

namespace App\Http\Controllers\admin;

use App\Http\Controllers\Controller;
use App\Models\QRCodeRecord;
use Illuminate\Http\Request;

use Endroid\QrCode\QrCode;
use Endroid\QrCode\Writer\PngWriter;
use Endroid\QrCode\Encoding\Encoding;
use Endroid\QrCode\ErrorCorrectionLevel\ErrorCorrectionLevelLow;
use Endroid\QrCode\Label\Label;
use Endroid\QrCode\Logo\Logo;
use Endroid\QrCode\RoundBlockSizeMode\RoundBlockSizeModeMargin;
use Endroid\QrCode\Writer\Result\PngResult;
use Carbon\Carbon;

class QRCodeController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['menu'] = 'QR Code';

        $query = QRCodeRecord::where('status','!=','4')->select();
        if(isset($request['search'])){
            $query->where(function ($qu) use($request){
                $qu->orWhere('code','like','%'.$request['search'].'%');
                $qu->orWhere('type','like','%'.$request['search'].'%');
            });
            $data['search'] = $request['search'];
        }
        $data['qr_code'] = $query->Paginate($this->pagination);
        return view('admin.qr_code.index', $data);
    }

    public function create()
    {
        $data['menu']="QR Code";
        return view("admin.qr_code.create",$data);
    }

    public function store(Request $request)
    {
        $this->validate($request, [
            'quantity' => 'required|numeric',
            'type' => 'required',
        ]);
        $input = $request->all();
        if ($request['quantity'] > 0) {
            for ($i = 1; $i <= $request['quantity']; $i++) {
                $input['code'] = $this->generateRandomString();

                if ($request->type === 'big') {
                    $qrCodeSize = 300;
                } else {
                    $qrCodeSize = 150;
                }

                // Generate the URL with the code embedded
                $baseUrl = env('APP_QR_REDIRECT_URL');
                $url = "{$baseUrl}?id={$input['code']}";

                // Get the current date
                $currentDate = Carbon::now()->format('Y-m-d');

                // Create the file name using the structure
                $first4Chars = substr($input['code'], 0, 4);
                $fileNameBase = "{$first4Chars}_{$currentDate}_{$input['code']}";

                // Generate and save QR code
                $qrCode = QrCode::create($url)
                    ->setSize($qrCodeSize)
                    ->setMargin(10)
                    ->setRoundBlockSizeMode(new RoundBlockSizeModeMargin())
                    ->setEncoding(new Encoding('UTF-8'))
                    ->setErrorCorrectionLevel(new ErrorCorrectionLevelLow());

                $writer = new PngWriter();
                $result = $writer->write($qrCode);

                $fileName = $fileNameBase . '.png';
                $filePath = public_path('resource/qrcodes/' . $fileName);

                // Save the QR code to the file path
                $result->saveToFile($filePath);

                // Store the image URL and original code in the database
                $input['qr_code_image'] = url('resource/qrcodes/' . $fileName);
                $input['url'] = $url;

                QRCodeRecord::create($input);
            }
        }
        \Session::flash('success', 'QR code has been inserted successfully!');
        return redirect('admin/qr_code');
    }

    public function show($id)
    {
        //
    }

    public function edit($id)
    {
        $data['menu']="QR Code";
        $data['qr_code'] = QRCodeRecord::where('id',$id)->first();
        return view("admin.qr_code.edit",$data);
    }

    public function update(Request $request, $id)
    {
        $this->validate($request, [
            'code' => 'required',
            'type' => 'required',
        ]);
        $qr_code = QRCodeRecord::where('id',$id)->first();
        $input = $request->all();
        $qr_code->update($input);
        \Session::flash('success', 'QR code has been updated successfully!');
        return redirect('admin/qr_code');
    }

    public function destroy($id)
    {
        $qr_code = QRCodeRecord::findOrFail($id);
        $qr_code->delete();
        \Session::flash('danger','QR code has been deleted successfully!');
        return redirect('admin/qr_code');
    }

    public function assign(Request $request)
    {
        $qr_code = QRCodeRecord::findorFail($request['id']);
        $qr_code['status'] = "active";
        $qr_code->update($request->all());
    }

    public function unassign(Request $request)
    {
        $qr_code = QRCodeRecord::findorFail($request['id']);
        $qr_code['status'] = "inactive";
        $qr_code->update($request->all());
    }

    public function download(Request $request){
        $qrCode = QRCodeRecord::where('id',$request['qrID'])->first();
        if(!empty($qrCode)){
            $input['status'] = 4;
            $qrCode->update($input);
            return 1;
        }
        return 0;
    }

    public function statusWise(Request $request){
        $data['menu'] = 'QR Code';
        $query = QRCodeRecord::select();
        if(isset($request['type'])){
            $query->where('status',$request['type']);
            $data['type'] = $request['type'];
        }else{
            $query->where('status',0);
        }
        $data['qr_code'] = $query->Paginate($this->pagination);
        return view('admin.qr_code.status_index', $data);
    }
}
