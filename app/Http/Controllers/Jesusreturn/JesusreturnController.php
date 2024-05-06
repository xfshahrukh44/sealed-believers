<?php

namespace App\Http\Controllers\Jesusreturn;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Jesusreturn;
use Illuminate\Http\Request;
use Image;
use File;

class JesusreturnController extends Controller
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $jesusreturn = Jesusreturn::where('title', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $jesusreturn = Jesusreturn::paginate($perPage);
            }

            return view('jesusreturn.jesusreturn.index', compact('jesusreturn'));
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('jesusreturn.jesusreturn.create');
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            

            $jesusreturn = new Jesusreturn($request->all());
            
            
            if ($request->hasFile('video')) {
            
                $file = $request->file('video');

                // Set the destination path
                $destinationPath = public_path('uploads/jesusreturns');

                // Generate a unique filename for the uploaded video
                $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

                // Move the uploaded file to the destination directory
                $file->move($destinationPath, $videoName);

                // Construct the full path to the saved video
                $videoPath = 'uploads/jesusreturns/' . $videoName;

                $jesusreturn->video = $videoPath;
                // $product->save();


            }
            

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $jesusreturn_path = 'uploads/jesusreturns/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($jesusreturn_path) . DIRECTORY_SEPARATOR. $profileImage);

                $jesusreturn->image = $jesusreturn_path.$profileImage;
            }
            
            $jesusreturn->save();
            return redirect()->back()->with('message', 'Jesusreturn added!');
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $jesusreturn = Jesusreturn::findOrFail($id);
            return view('jesusreturn.jesusreturn.show', compact('jesusreturn'));
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $jesusreturn = Jesusreturn::findOrFail($id);
            return view('jesusreturn.jesusreturn.edit', compact('jesusreturn'));
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
        $requestData = $request->all();
            

        if($request->hasFile('video')) {
            
            $file = $request->file('video');

            // Set the destination path
            $destinationPath = public_path('uploads/jesusreturns');

            // Generate a unique filename for the uploaded video
            $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the destination directory
            $file->move($destinationPath, $videoName);

            // Construct the full path to the saved video
            $videoPath = 'uploads/jesusreturns/' . $videoName;

            $requestData['video'] = $videoPath;
            // $product->save();


        }
        
        
        if ($request->hasFile('image')) {
            
            $jesusreturn = Jesusreturn::where('id', $id)->first();
            $image_path = public_path($jesusreturn->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/jesusreturns/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/jesusreturns/'.$fileNameToStore;               
        }


            $jesusreturn = Jesusreturn::findOrFail($id);
            $jesusreturn->update($requestData);
            return redirect()->back()->with('message', 'Jesusreturn updated!');
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
        $model = str_slug('jesusreturn','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Jesusreturn::destroy($id);
            return redirect()->back()->with('message', 'Jesusreturn deleted!');
        }
        return response(view('403'), 403);

    }
}
