<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Models\NotifyReason;
use Carbon\Carbon;

class NotifyReasonController extends Controller
{
    public function __construct(Request $request){
        $this->middleware('auth');
    }

    public function index(Request $request)
    {
        $data['menu'] = 'Notify Reason';

        $query = NotifyReason::select();

        if ($request->has('language') && !empty($request['language'])) {
            $query->where('language', $request['language']);
            $data['selected_language'] = $request['language'];
        }
        // else{
        //     $query->where('language', 'en');
        //     $data['selected_language'] = 'en';
        // }

        if(isset($request['search'])){
            $query->where(function ($qu) use($request){
                $qu->orWhere('language','like','%'.$request['search'].'%');
                $qu->orWhere('reasons','like','%'.$request['search'].'%');
            });
            $data['search'] = $request['search'];
        }
        $data['notify_reason'] = $query->Paginate($this->pagination);
        return view('admin.notify_reason.index', $data);
    }

    public function create()
    {
        $data['menu']="Notify Reason";
        return view("admin.notify_reason.create",$data);
    }

    // public function store(Request $request)
    // {
    //     $this->validate($request, [
    //         'language' => 'required',
    //         'reasons' => 'required',
    //     ]);

    //     $input = $request->all();
    //     NotifyReason::create($input);
    //     \Session::flash('success', 'Notify Reason has been inserted successfully!');
    //     return redirect('admin/notify_reason');
    // }

    public function store(Request $request)
    {
        // Validate the request
        $this->validate($request, [
            'language' => 'required',
            'reasons' => 'required',
            'image' => 'required|image|mimes:jpeg,png,jpg,gif', // Adjust max file size as needed
        ]);

        // Handle image upload
        if ($request->hasFile('image')) {
            $currentDate = Carbon::now()->format('Y-m-d-H-i-s');

            $fileNameBase = "{$currentDate}";
            $imagePath = $request->file('image')->store('images'); // 'images' is the storage folder name
            $fileName = $fileNameBase . '.png';
            $filePath = public_path('resource/reasonIcon/' . $fileName);

            // Save the QR code image to the file path
            $request->file('image')->move('resource/reasonIcon', $fileName);
        } else {
            $fileName = null; // Default to null if no image is uploaded
        }

        // Create NotifyReason instance with input data
        $input = $request->all();
        $input['image'] = $fileName; // Add image path to input data
        NotifyReason::create($input);

        \Session::flash('success', 'Notify Reason has been inserted successfully!');
        return redirect('admin/notify_reason');
    }

    public function edit($id)
    {
        $data['menu']="Notify Reason";
        $data['notify_reason'] = NotifyReason::where('id',$id)->first();
        return view("admin.notify_reason.edit",$data);
    }

    // public function update(Request $request, $id)
    // {
    //     $this->validate($request, [
    //         'language' => 'required',
    //         'reasons' => 'required',
    //     ]);
    //     $notify_reason = NotifyReason::where('id',$id)->first();
    //     $input = $request->all();
    //     $notify_reason->update($input);
    //     \Session::flash('success', 'Notify Reason has been updated successfully!');
    //     return redirect('admin/notify_reason');
    // }

    public function update(Request $request, $id)
{
    // Validate the request
    $this->validate($request, [
        'language' => 'required',
        'reasons' => 'required',
        'image' => 'nullable|image|mimes:jpeg,png,jpg,gif|max:2048', // Adjust max file size as needed
    ]);

    // Find the NotifyReason instance by ID
    $notify_reason = NotifyReason::findOrFail($id);

    // Handle image upload if a new image is provided
    if ($request->hasFile('image')) {
        // Get the current date for generating the file name
        $currentDate = Carbon::now()->format('Y-m-d-H-i-s');
        $fileName = "{$currentDate}.png";
        $filePath = public_path('resource/reasonIcon/' . $fileName);

        // Save the uploaded image to the file path
        $request->file('image')->move('resource/reasonIcon', $fileName);

        // Update the image file name in the database
        $notify_reason->image = $fileName;
    }

    // Update other fields if provided in the request
    $notify_reason->language = $request->input('language');
    $notify_reason->reasons = $request->input('reasons');
    $notify_reason->save();

    \Session::flash('success', 'Notify Reason has been updated successfully!');
    return redirect('admin/notify_reason');
}


    public function destroy($id)
    {
        $notify_reason = NotifyReason::findOrFail($id);
        $notify_reason->delete();
        \Session::flash('danger','Notify Reason has been deleted successfully!');
        return redirect('admin/notify_reason');
    }

}

