<?php

namespace App\Http\Controllers\Salvation;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Salvation;
use Illuminate\Http\Request;
use Image;
use File;

class SalvationController extends Controller
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $salvation = Salvation::where('title', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $salvation = Salvation::paginate($perPage);
            }

            return view('salvation.salvation.index', compact('salvation'));
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('salvation.salvation.create');
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            

            $salvation = new Salvation($request->all());
            
            if ($request->hasFile('video')) {
            
                $file = $request->file('video');

                // Set the destination path
                $destinationPath = public_path('uploads/salvations');

                // Generate a unique filename for the uploaded video
                $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

                // Move the uploaded file to the destination directory
                $file->move($destinationPath, $videoName);

                // Construct the full path to the saved video
                $videoPath = 'uploads/salvations/' . $videoName;

                $salvation->video = $videoPath;
                // $product->save();


            }
            

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $salvation_path = 'uploads/salvations/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($salvation_path) . DIRECTORY_SEPARATOR. $profileImage);

                $salvation->image = $salvation_path.$profileImage;
            }
            
            $salvation->save();
            return redirect()->back()->with('message', 'Salvation added!');
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $salvation = Salvation::findOrFail($id);
            return view('salvation.salvation.show', compact('salvation'));
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $salvation = Salvation::findOrFail($id);
            return view('salvation.salvation.edit', compact('salvation'));
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
        $requestData = $request->all();
        
        
        if($request->hasFile('video')) {
            $file = $request->file('video');

            // Set the destination path
            $destinationPath = public_path('uploads/salvations');

            // Generate a unique filename for the uploaded video
            $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the destination directory
            $file->move($destinationPath, $videoName);

            // Construct the full path to the saved video
            $videoPath = 'uploads/salvations/' . $videoName;

            $requestData['video'] = $videoPath;
            // $product->save();


        }
        
            
        if ($request->hasFile('image')) {
            
            $salvation = Salvation::where('id', $id)->first();
            $image_path = public_path($salvation->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/salvations/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/salvations/'.$fileNameToStore;               
        }


            $salvation = Salvation::findOrFail($id);
            $salvation->update($requestData);
            return redirect()->back()->with('message', 'Salvation updated!');
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
        $model = str_slug('salvation','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Salvation::destroy($id);
            return redirect()->back()->with('message', 'Salvation deleted!');
        }
        return response(view('403'), 403);

    }
}
