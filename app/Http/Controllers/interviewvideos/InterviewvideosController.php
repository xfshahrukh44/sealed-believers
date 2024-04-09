<?php

namespace App\Http\Controllers\interviewvideos;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Interviewvideo;
use Illuminate\Http\Request;
use Image;
use File;

class InterviewvideosController extends Controller
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $interviewvideos = Interviewvideo::where('title', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $interviewvideos = Interviewvideo::paginate($perPage);
            }

            return view('interviewvideos.interviewvideos.index', compact('interviewvideos'));
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('interviewvideos.interviewvideos.create');
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {


            $interviewvideos = new Interviewvideo;
                // Check if a file is present in the request
            $interviewvideos->title = $request->title;
            if ($request->hasFile('video')) {
                $file = $request->file('video');

                // Set the destination path
                $destinationPath = public_path('uploads/interviewvideoss');

                // Generate a unique filename for the uploaded video
                $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

                // Move the uploaded file to the destination directory
                $file->move($destinationPath, $videoName);

                // Construct the full path to the saved video
                $videoPath = 'uploads/interviewvideoss/' . $videoName;

                $interviewvideos->video = $videoPath;
                // $product->save();


            }
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                //make sure yo have image folder inside your public
                $interviewvideos_path = 'uploads/interviewvideoss/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($interviewvideos_path) . DIRECTORY_SEPARATOR. $profileImage);

                $interviewvideos->image = $interviewvideos_path.$profileImage;
            }

            $interviewvideos->save();
            return redirect()->back()->with('message', 'Interviewvideo added!');
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $interviewvideo = Interviewvideo::findOrFail($id);
            return view('interviewvideos.interviewvideos.show', compact('interviewvideo'));
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $interviewvideo = Interviewvideo::findOrFail($id);
            return view('interviewvideos.interviewvideos.edit', compact('interviewvideo'));
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

            $requestData = $request->all();
            if ($request->hasFile('video')) {
                $file = $request->file('video');

                // Set the destination path
                $destinationPath = public_path('uploads/interviewvideoss');

                // Generate a unique filename for the uploaded video
                $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

                // Move the uploaded file to the destination directory
                $file->move($destinationPath, $videoName);

                // Construct the full path to the saved video
                $videoPath = 'uploads/interviewvideoss/' . $videoName;

                $requestData['video'] = $videoPath;
                // $product->save();


            }

        if ($request->hasFile('image')) {

            $interviewvideos = Interviewvideo::where('id', $id)->first();
            $image_path = public_path($interviewvideos->image);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/interviewvideoss/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/interviewvideoss/'.$fileNameToStore;
        }


            $interviewvideo = Interviewvideo::findOrFail($id);
            $interviewvideo->update($requestData);
            return redirect()->back()->with('message', 'Interviewvideo updated!');
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
        $model = str_slug('interviewvideos','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Interviewvideo::destroy($id);
            return redirect()->back()->with('message', 'Interviewvideo deleted!');
        }
        return response(view('403'), 403);

    }
}
