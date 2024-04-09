<?php

namespace App\Http\Controllers;
use Illuminate\Http\Request;
use App\inquiry;
use App\schedule;
use App\newsletter;
use App\post;
use App\Banner;
use App\imagetable;
use DB;
use Mail;use View;
use Session;
use App\Http\Helpers\UserSystemInfoHelper;
use App\Http\Traits\HelperTrait;
use Auth;
use App\Profile;
use App\Page;
use Image;
use App\Models\Faith;
use App\Models\Videolink;
use App\Models\Israelppt;
use App\Models\Interviewvideo;

class HomeController extends Controller
{
    use HelperTrait;
    /**
     * Create a new controller instance.
     *
     * @return void
     */
     // use Helper;

    public function __construct()
    {
        //$this->middleware('auth');

        $logo = imagetable::
                     select('img_path')
                     ->where('table_name','=','logo')
                     ->first();

        $favicon = imagetable::
                     select('img_path')
                     ->where('table_name','=','favicon')
                     ->first();

        View()->share('logo',$logo);
        View()->share('favicon',$favicon);

    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
       $page = DB::table('pages')->where('id', 1)->first();
       $section = DB::table('section')->where('page_id', 1)->get();
       $banner = Banner::all();
       $videoLink = Videolink::take(6)->get();

       return view('welcome', compact('page', 'banner', 'section', 'videoLink'));
    }

    public function faith(){
        $page = DB::table('pages')->where('id', 2)->first();
        $faith = Faith::take(4)->orderBy('id', 'desc')->get();
        $faithall = Faith::orderBy('id', 'desc')->skip(4)->take(PHP_INT_MAX)->get();


        return view('faith', compact('page', 'faith', 'faithall'));
    }

    public function faith_detail($id){
        $faith = Faith::find($id);
        return view('faith-detail', compact('faith'));
    }

    public function israel(){
        $page = DB::table('pages')->where('id', 3)->first();
        $section = DB::table('section')->where('page_id', 3)->get();
        $ppt = Israelppt::all();
        return view('israel', compact('page', 'section', 'ppt'));
    }

    public function bible(){
        $page = DB::table('pages')->where('id', 4)->first();

        return view('bible', compact('page'));
    }

    public function about(){
        $page = DB::table('pages')->where('id', 6)->first();

        return view('about', compact('page'));
    }

    public function contact(){
        $page = DB::table('pages')->where('id', 7)->first();

        return view('contact', compact('page'));
    }

    public function join(){
        $page = DB::table('pages')->where('id', 8)->first();

        return view('join', compact('page'));
    }


    public function interviews(){
        $page = DB::table('pages')->where('id', 9)->first();
        $interview = Interviewvideo::all();
        return view('interviews', compact('page', 'interview'));
    }



    public function careerSubmit(Request $request)
    {


        inquiry::create($request->all());
        $data = [
        'username' => $request->fname,
        'user_email' => $request->email,
        'note' => $request->notes

        ];
        // dd($data);
        $emails = config('services.mail.username');
        $subject = 'Sealed Believers - Contact Form Submission';
        Mail::send('inquirymail', $data, function ($message) use ($emails, $subject, $request) {
            $message->from($request->email, 'Sealed Believers - Contact Form Submission');
            $message->to($emails)->subject($subject);
        });

        return response()->json(['message'=>'Thank you for contacting us. We will get back to you asap', 'status' => true]);
        return back();
    }

    public function newsletterSubmit(Request $request){

        $is_email = newsletter::where('newsletter_email',$request->newsletter_email)->count();
        if($is_email == 0) {
            $inquiry = new newsletter;
            $inquiry->newsletter_email = $request->newsletter_email;
            $inquiry->save();
            // dd(config('services.mail.username'));
            $data = [
            'user_email' => $request->newsletter_email,
    
            ];
            $emails = config('services.mail.username');
            $subject = 'Sealed Believers - Newsletter Submission';
            Mail::send('newslettermail', $data, function ($message) use ($emails, $subject, $request) { // Added $request to the use statement
                $message->from($request->newsletter_email, 'Sealed Believers - Newsletter Submission');
                $message->to($emails)->subject($subject);
            });
            
            return response()->json(['message'=>'Thank you for contacting us. We will get back to you asap', 'status' => true]);

        }else{
            return response()->json(['message'=>'Email already exists', 'status' => false]);
        }

    }

    public function updateContent(Request $request){
        $id = $request->input('id');
        $keyword = $request->input('keyword');
        $htmlContent = $request->input('htmlContent');
        if($keyword == 'page'){
            $update = DB::table('pages')
                        ->where('id', $id)
                        ->update(array('content' => $htmlContent));

            if($update){
                return response()->json(['message'=>'Content Updated Successfully', 'status' => true]);
            }else{
                return response()->json(['message'=>'Error Occurred', 'status' => false]);
            }
        }else if($keyword == 'section'){
            $update = DB::table('section')
                        ->where('id', $id)
                        ->update(array('value' => $htmlContent));
            if($update){
                return response()->json(['message'=>'Content Updated Successfully', 'status' => true]);
            }else{
                return response()->json(['message'=>'Error Occurred', 'status' => false]);
            }
        }
    }

}
