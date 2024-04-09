<?php

namespace App\Http\Controllers\videolinks;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Videolink;
use Illuminate\Http\Request;
use Image;
use File;

class VideolinksController extends Controller
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $videolinks = Videolink::where('title', 'LIKE', "%$keyword%")
                ->orWhere('video_iframe', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $videolinks = Videolink::paginate($perPage);
            }

            return view('videolinks.videolinks.index', compact('videolinks'));
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('videolinks.videolinks.create');
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            

            $videolinks = new Videolink($request->all());

            if ($request->hasFile('image')) {

                $file = $request->file('image');
                
                //make sure yo have image folder inside your public
                $videolinks_path = 'uploads/videolinkss/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($videolinks_path) . DIRECTORY_SEPARATOR. $profileImage);

                $videolinks->image = $videolinks_path.$profileImage;
            }
            
            $videolinks->save();
            return redirect()->back()->with('message', 'Videolink added!');
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $videolink = Videolink::findOrFail($id);
            return view('videolinks.videolinks.show', compact('videolink'));
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $videolink = Videolink::findOrFail($id);
            return view('videolinks.videolinks.edit', compact('videolink'));
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            
            $requestData = $request->all();
            

        if ($request->hasFile('image')) {
            
            $videolinks = Videolink::where('id', $id)->first();
            $image_path = public_path($videolinks->image); 
            
            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/videolinkss/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/videolinkss/'.$fileNameToStore;               
        }


            $videolink = Videolink::findOrFail($id);
            $videolink->update($requestData);
            return redirect()->back()->with('message', 'Videolink updated!');
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
        $model = str_slug('videolinks','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Videolink::destroy($id);
            return redirect()->back()->with('message', 'Videolink deleted!');
        }
        return response(view('403'), 403);

    }
}
