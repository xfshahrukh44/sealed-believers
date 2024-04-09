<?php

namespace App\Http\Controllers\requestinterview;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Requestinterview;
use Illuminate\Http\Request;
use Image;
use File;
use Mail;
use App\User;

class RequestinterviewController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth');
    }


    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\View\View
     */

    public function index(Request $request)
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $requestinterview = Requestinterview::where('subject', 'LIKE', "%$keyword%")
                ->orWhere('user_id', 'LIKE', "%$keyword%")
                ->orWhere('is_approved', 'LIKE', "%$keyword%")
                ->orWhere('details', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $requestinterview = Requestinterview::paginate($perPage);
            }

            return view('requestinterview.requestinterview.index', compact('requestinterview'));
        }
        return response(view('403'), 403);

    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\View\View
     */
    public function create()
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('requestinterview.requestinterview.create');
        }
        return response(view('403'), 403);

    }

    /**
     * Store a newly created resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function store(Request $request)
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {


            $requestinterview = new Requestinterview($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');

                //make sure yo have image folder inside your public
                $requestinterview_path = 'uploads/requestinterviews/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($requestinterview_path) . DIRECTORY_SEPARATOR. $profileImage);

                $requestinterview->image = $requestinterview_path.$profileImage;
            }

            $requestinterview->save();
            $user = User::find($request->user_id);
            // dd($user);
            $data = [
                'username' => $user->name,
                'user_email' => $user->email,
                'detail' => $request->details,
                'sub' => 'Sealed Believers - Interview Request'

            ];
            $emails = $user->email;
            $subject = 'Sealed Believers - Interview Request';
            Mail::send('mail', $data, function ($message) use ($emails, $subject) {
                $message->from(config('services.mail.username'), 'Sealed Believers - Interview Request');
                $message->to($emails)->subject($subject);
            });
            
            return redirect()->back()->with('message', 'Request Interview added!');
        }
        return response(view('403'), 403);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function show($id)
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $requestinterview = Requestinterview::findOrFail($id);
            return view('requestinterview.requestinterview.show', compact('requestinterview'));
        }
        return response(view('403'), 403);
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     *
     * @return \Illuminate\View\View
     */
    public function edit($id)
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $requestinterview = Requestinterview::findOrFail($id);
            return view('requestinterview.requestinterview.edit', compact('requestinterview'));
        }
        return response(view('403'), 403);
    }

    /**
     * Update the specified resource in storage.
     *
     * @param \Illuminate\Http\Request $request
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function update(Request $request, $id)
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

            $requestData = $request->all();


        if ($request->hasFile('image')) {

            $requestinterview = Requestinterview::where('id', $id)->first();
            $image_path = public_path($requestinterview->image);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/requestinterviews/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/requestinterviews/'.$fileNameToStore;
        }


            $requestinterview = Requestinterview::findOrFail($id);
            $requestinterview->update($requestData);
            // dump($requestinterview->users->email);
            // dd(env('MAIL_PASSWORD'));
            
                $data = [
                    'username' => $requestinterview->users->name,
                    'user_email' => $requestinterview->users->email,
                    'detail' => $request->details,
                    'sub' => 'Sealed Believers - Interview Request'

                ];
                $emails = $requestinterview->users->email;
                $subject = 'Sealed Believers - Interview Request';
                Mail::send('mail', $data, function ($message) use ($emails, $subject) {
                    $message->from(config('services.mail.username'), 'Sealed Believers - Interview Request');
                    $message->to($emails)->subject($subject);
                });
            

            return redirect()->back()->with('message', 'Requestinterview updated!');
        }
        return response(view('403'), 403);

    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     *
     * @return \Illuminate\Http\RedirectResponse|\Illuminate\Routing\Redirector
     */
    public function destroy($id)
    {
        $model = str_slug('requestinterview','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Requestinterview::destroy($id);
            return redirect()->back()->with('message', 'Requestinterview deleted!');
        }
        return response(view('403'), 403);

    }
}
