<?php

namespace App\Http\Controllers\Israelppt;

use App\Http\Controllers\Controller;
use App\Http\Requests;

use App\Models\Israelppt;
use Illuminate\Http\Request;
use Image;
use File;

class IsraelpptController extends Controller
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $keyword = $request->get('search');
            $perPage = 25;

            if (!empty($keyword)) {
                $israelppt = Israelppt::where('title', 'LIKE', "%$keyword%")
                ->orWhere('ppt', 'LIKE', "%$keyword%")
                ->paginate($perPage);
            } else {
                $israelppt = Israelppt::paginate($perPage);
            }

            return view('israelppt.israelppt.index', compact('israelppt'));
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {
            return view('israelppt.israelppt.create');
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','add-'.$model)->first()!= null) {


            $israelppt = new Israelppt($request->all());
            $ppt = $request->file('ppt');
            if(! is_null(request('ppt'))) {
            // Make sure you have a folder inside your storage directory
            $destination_path = 'uploads/israelppts/';
            $profile_ppt = date("Ymdhis") . "." . $ppt->getClientOriginalExtension();

            // Store the PDF file in the destination path
            $ppt->move(public_path($destination_path), $profile_ppt);

            $israelppt->ppt = $destination_path . $profile_ppt;
            }
            if ($request->hasFile('image')) {

                $file = $request->file('image');

                //make sure yo have image folder inside your public
                $israelppt_path = 'uploads/israelppts/';
                $fileName = $file->getClientOriginalName();
                $profileImage = date("Ymd").$fileName.".".$file->getClientOriginalExtension();

                Image::make($file)->save(public_path($israelppt_path) . DIRECTORY_SEPARATOR. $profileImage);

                $israelppt->image = $israelppt_path.$profileImage;
            }

            $israelppt->save();
            return redirect()->back()->with('message', 'Israelppt added!');
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','view-'.$model)->first()!= null) {
            $israelppt = Israelppt::findOrFail($id);
            return view('israelppt.israelppt.show', compact('israelppt'));
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {
            $israelppt = Israelppt::findOrFail($id);
            return view('israelppt.israelppt.edit', compact('israelppt'));
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','edit-'.$model)->first()!= null) {

            $requestData = $request->all();
            // Handle the updated PDF file if provided
            $new_ppt= $request->file('ppt');
            if ($new_ppt) {
                // Move the new PDF file to the public directory
                $destination_path = 'uploads/israelppts/';
                $profile_ppt = date("Ymdhis") . "." . $new_ppt->getClientOriginalExtension();
                $new_ppt->move(public_path($destination_path), $profile_ppt);


                $requestData['ppt'] = $destination_path . $profile_ppt;


                if ($existing_ppt) {

                    unlink(public_path($existing_ppt));
                }
            }

        if ($request->hasFile('image')) {

            $israelppt = Israelppt::where('id', $id)->first();
            $image_path = public_path($israelppt->image);

            if(File::exists($image_path)) {
                File::delete($image_path);
            }

            $file = $request->file('image');
            $fileNameExt = $request->file('image')->getClientOriginalName();
            $fileNameForm = str_replace(' ', '_', $fileNameExt);
            $fileName = pathinfo($fileNameForm, PATHINFO_FILENAME);
            $fileExt = $request->file('image')->getClientOriginalExtension();
            $fileNameToStore = $fileName.'_'.time().'.'.$fileExt;
            $pathToStore = public_path('uploads/israelppts/');
            Image::make($file)->save($pathToStore . DIRECTORY_SEPARATOR. $fileNameToStore);

             $requestData['image'] = 'uploads/israelppts/'.$fileNameToStore;
        }


            $israelppt = Israelppt::findOrFail($id);
            $israelppt->update($requestData);
            return redirect()->back()->with('message', 'Israelppt updated!');
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
        $model = str_slug('israelppt','-');
        if(auth()->user()->permissions()->where('name','=','delete-'.$model)->first()!= null) {
            Israelppt::destroy($id);
            return redirect()->back()->with('message', 'Israelppt deleted!');
        }
        return response(view('403'), 403);

    }
}
