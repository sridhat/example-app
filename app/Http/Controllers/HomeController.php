<?php


namespace App\Http\Controllers;


use Illuminate\Http\Request;
use DB;
use DataTables;
use App\Models\Login_logs;



class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function myCaptcha()
    {
        return view('myCaptcha');
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function myCaptchaPost(Request $request)
    {
        request()->validate([
            'email' => 'required|email',
            'password' => 'required',
            'captcha' => 'required|captcha'
        ],
        ['captcha.captcha'=>'Invalid captcha code.']);
        dd("You are here :) .");
    }


    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function refreshCaptcha()
    {
        return response()->json(['captcha'=> captcha_img()]);
    }

    public function check_in_process(){
        $user_id=(auth()->user()->id);
        $check_in_time=date('y-m-d h:i:s');
        $check_out_time=null;
        $data = array(
            'user_id'=>$user_id,
            'check_in_time'=>$check_in_time,
            'check_out_time'=>$check_out_time,
        );
        $timelog=login_logs::insert($data);
        return $timelog;
    }
    public function check_out_process(){
        $user_id=(auth()->user()->id);
        $check_out_time=date('y-m-d h:i:s');

        $timelog=login_logs::where('user_id',$user_id)->orderBy('id','desc')->limit('1')->update([
            'check_out_time'=>$check_out_time,

        ]);
        return $timelog;
    }
    public function restore_process(){
        $user_id=(auth()->user()->id);
        $release_time=date('y-m-d h:i:s');
        $timelog=login_logs::where('user_id',$user_id)->orderBy('id','desc')->first();
        $datetime_1 = $timelog->check_out_time;
        $datetime_2 = $release_time;
        $from_time = strtotime($datetime_1); 
        $to_time = strtotime($datetime_2); 
        $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
        $timelog=login_logs::where('user_id',$user_id)->orderBy('id','desc')->limit('1')->update([
            'release_time'=>$diff_minutes,
            'check_out_time'=>null,
        ]);
        return $timelog;
    }
    public function attedence_report(){
        $check_in_time=date('y-m-d');
        $user_id=(auth()->user()->id);
        $timelog=login_logs::where('user_id',$user_id)->orderBy('id','desc')->whereDate('check_in_time',$check_in_time)->where('check_out_time',null)->first();
        if($timelog!=null){
            $timelog1=login_logs::where('id',$timelog->id)->orderBy('id','desc')->whereDate('check_in_time',$check_in_time)->where('release_time','!=',null)->first();
            $this->status=$timelog;
            $this->status1=$timelog1;
            return view('attedence_report',['data'=> $this->status,'data1'=> $this->status1]);
        }else{
            $this->status=$timelog;
            return view('attedence_report',['data'=> $this->status]);
        }
       
    }
    public function check_in_check(){
        $user_id=(auth()->user()->id);

        $check_in_time=date('y-m-d');

        $timelog=login_logs::where('user_id',$user_id)->whereDate('check_in_time',$check_in_time)->where('check_out_time',null)->orderBy('id','desc')->limit('1')->get()->toArray();
        return $timelog;

    }
    public function check_out_check(){
        $user_id=(auth()->user()->id);
        $check_in_time=date('y-m-d');
        $timelog=login_logs::where('user_id',$user_id)->where('check_out_time','=',null)->orderBy('id','desc')->limit('1')->get();
        return $timelog;

    }
    public function attedence_report_data(Request $request){
        if ($request->ajax()) {

            $date = (!empty($_POST["date"])) ? ($_POST["date"]) : ('');

        }
        $user_id=(auth()->user()->id);
        if($user_id == 1){
            if($date != ''){
                $timelog=DB::table('login_logs as ll')->join('users as u','ll.user_id','u.id')->whereDate('check_in_time',$date)->get();
            }
            else{
                $timelog=DB::table('login_logs as ll')->join('users as u','ll.user_id','u.id')->get();

            }

        }
        else{
            if($date != ''){
            $timelog=DB::table('login_logs as ll')->join('users as u','ll.user_id','u.id')->whereDate('check_in_time',$date)->where('ll.user_id',$user_id)->get();
            }
            else{
            $timelog=DB::table('login_logs as ll')->join('users as u','ll.user_id','u.id')->where('ll.user_id',$user_id)->get();

            }
        }
        return Datatables::of($timelog)
        ->addIndexColumn()
        
        ->addColumn('logged_time', function($row) {
            $datetime_1 = $row->check_in_time;
            $datetime_2 = $row->check_out_time;
             if($row->check_out_time != null){
                $from_time = strtotime($datetime_1); 
                $to_time = strtotime($datetime_2); 
                $diff_minutes = round(abs($from_time - $to_time) / 60,2). " minutes";
     
                return $diff_minutes;
             }
             else{
                return '-';
             }
          
        })
        ->addColumn('break_time', function($row) {
          
                return $row->release_time;

          
        })
        ->addColumn('date', function($row) {
            $datetime_1 = $row->check_in_time;
            $date =  date("d-m-y", strtotime($datetime_1));  
           
            return $date;
          
        })

        ->rawColumns(['logged_time','break_time','date'])
        ->make(true);

    }
}
