<?php

namespace App\Http\Controllers\Prophecy;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Prophecy;
use Illuminate\Http\Request;
use Image;
use File;

class ProphecyController extends Controller
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $prophecy = Prophecy::where('title', 'LIKE', "%$keyword%")
                ->orWhere('video', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $prophecy = Prophecy::paginate($perPage);
            }

            return view('prophecy.prophecy.index', compact('prophecy'));
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('prophecy.prophecy.create');
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            

            $prophecy = new Prophecy($request->all());


            if ($request->hasFile('video')) {
                $file = $request->file('video');

                // Set the destination path
                $destinationPath = public_path('uploads/prophecys');

                // Generate a unique filename for the uploaded video
                $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

                // Move the uploaded file to the destination directory
                $file->move($destinationPath, $videoName);

                // Construct the full path to the saved video
                $videoPath = 'uploads/prophecys/' . $videoName;

                $prophecy->video = $videoPath;
                // $product->save();


            }
            
            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $prophecy_path = 'uploads/prophecys/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($prophecy_path) . DIRECTORY_SEPARATOR. $profileImage);

                $prophecy->image = $prophecy_path.$profileImage;
            }
            
            // dd($request->all());
            
            $prophecy->save();
            
            return redirect()->back()->with('message', 'Prophecy added!');
            
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $prophecy = Prophecy::findOrFail($id);
            return view('prophecy.prophecy.show', compact('prophecy'));
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $prophecy = Prophecy::findOrFail($id);
            return view('prophecy.prophecy.edit', compact('prophecy'));
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
        $requestData = $request->all();
            
        
       
        if ($request->hasFile('video')) {
            $file = $request->file('video');

            // Set the destination path
            $destinationPath = public_path('uploads/prophecys');

            // Generate a unique filename for the uploaded video
            $videoName = date("Ymdhis") . '.' . $file->getClientOriginalExtension();

            // Move the uploaded file to the destination directory
            $file->move($destinationPath, $videoName);

            // Construct the full path to the saved video
            $videoPath = 'uploads/prophecys/' . $videoName;

            $requestData['video'] = $videoPath;
            // $product->save();


        }
        
        if ($request->hasFile('image')) {
            
            $prophecy = Prophecy::where('id', $id)->first();
            $image_path = public_path($prophecy->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/prophecys/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/prophecys/'.$fileNameToStore;               
        }


            $prophecy = Prophecy::findOrFail($id);
            $prophecy->update($requestData);
            return redirect()->back()->with('message', 'Prophecy updated!');
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
        $model = str_slug('prophecy','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Prophecy::destroy($id);
            return redirect()->back()->with('message', 'Prophecy deleted!');
        }
        return response(view('403'), 403);

    }
}
