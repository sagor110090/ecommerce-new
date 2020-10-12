<?php

namespace App\Helper;

use App\Brand;
use App\Category;
use App\CustomerInfo;
use App\Mail\EmailSend;
use App\Order;
use App\Product;
use App\User;
use Carbon\Carbon;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Mail;

class Helper
{
    public function authCheck($permission)
    {
        if (isset(Auth::user()->permission)) {
            $permissions = '';
            if (Auth::user()->permission == 'null') {
                $permissions = ['nothing'];
            } else {
                $permissions = json_decode(Auth::user()->permission);
                foreach ($permissions as $key => $value) {
                    if ($value == $permission) {
                        return true;
                    }
                }
            }
        }
        return false;
    }
    //get all data from table
    public function getAll($tableName)
    {
        return DB::table($tableName)->orderBy('id', 'DESC')->get();
    }
    //find by id
    public function findById($tableName, $id)
    {
        // dd(DB::table($tableName)->find($id));
        return DB::table($tableName)->find($id);
    }
    //text limit
    public function limit_text($text, $limit)
    {
        if (str_word_count($text, 0) > $limit) {
            $words = str_word_count($text, 2);
            $pos = array_keys($words);
            $text = substr($text, 0, $pos[$limit]) . '...';
        }
        return $text;
    }
    // user location
    public function country()
    {
        $query = @unserialize(file_get_contents('http://ip-api.com/php/'));
        if ($query && $query['status'] == 'success') {
            return $query['country'];
        }
    }
    //  activity log
    public function activityStore($activity, $description)
    {
        $data = [
            'activity' => $activity,
            'description' => $description,
            'created_at' => date("Y-m-d H:i:s"),
            'user_id' => Auth::user()->id,
        ];
        DB::table('activitylog')->insert($data);
    }

    public function activityFindName($user_id)
    {
        $name = User::where('id', $user_id)->first();
        return '<b>User id:</b> ' . $name->id . ' <b>Name:</b> ' . $name->fname . ' ' . $name->lname;
    }

    public function globalDateTime($timestamp)
    {
        if (empty($timestamp)) {
            return '<span class="text-danger">No Date Time</span>';
        }
        return date('d-M-y h:i A', strtotime($timestamp));
    }
    public function contact()
    {
        return DB::table('contact_us')->where('id', 1)->first();

    }
    // public function globalDateTime($timestamp)
    // {
    //     if (empty($timestamp)) {
    //         return '';
    //     }
    //     return date('h:i A', strtotime($timestamp));
    // }

    //Setting Panel
    public function layouts()
    {
        $sidebar = DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->first();

        if (DB::table('layouts_setting')->where('user_id', Auth::user()->id)->first() == null) {
            return 'dark dark-sidebar theme-black';
        } elseif ($sidebar != null) {
            return DB::table('sidebars_setting')->where('user_id', Auth::user()->id)->first()->sidebar;
        } else {

            return DB::table('layouts_setting')->where('user_id', Auth::user()->id)->first()->layout;
        }
    }

    public function sidebar()
    {
        $mini = DB::table('minisidebars_setting')->where('user_id', Auth::user()->id)->first();
        if ($mini) {
            return $mini->minisidebar;
        }

    }

    public function sendSingleMail($email, $content)
    {
        return Mail::to($email)->queue(new EmailSend($content));
    }
    public function sendGroupMail($email, $content)
    {

        // if ($email == null) {
        //    return '';
        // }
        foreach ($email as $key => $value) {
            Mail::to($email)->queue(new EmailSend($name));
        }
    }

    public function categories()
    {

        return Category::all();
    }

    public function getProduct($product_id)
    {
        return Product::where('id', $product_id)->first();
    }
    public function brand($id)
    {
        return Brand::find('id', $id)->get();
    }

    public function todayOrder()
    {
        return Order::whereDate('created_at', '=', date('Y-m-d'))->count();
    }
    public function totalCustomer()
    {
        return CustomerInfo::count();
    }
    public function totalProduct()
    {
        return Product::count();
    }
    public function totalSale()
    {
        return Order::whereDate('created_at', '=', date('Y-m-d'))->sum('order_amount');
    }
    public function notificationTime($startTime)
    {
        $finishTime = Carbon::parse($startTime);
        $startTime = Carbon::parse(date("Y-m-d h:i:sa"));
        return $finishTime->diffForHumans($startTime);
    }

//     public function isAdmin()
    //     {
    //         dd(Auth::user());
    //         if(User::user() == 'super-admin'){
    //             return true;
    //         }else{
    //             return false;
    //         }
    //     }
    //     public function isUser()
    //     {
    //         return DB::table('users')->where('email',Auth::User()->email)->where('role','user')->first();

//     }
    //     public function findAll($tableName)
    //     {
    //         return DB::table($tableName)->get();
    //     }
    //     public function twoParameterWhere($tableName,$para1,$search1,$para2,$search2)
    //     {
    //         return  DB::table($tableName)->where($para1,$search1)->where($para1,$search1)->first();
    //     }
    //     public function chackedEmpoloies($date,$id)
    //     {
    //         return Attendance::where('date','like', $date)->where('employee_id',$id)->first();

//     }
    //     public function coutTableRow($tableName)
    //     {
    //         return DB::table($tableName)->count();
    //     }
    //     public function coutTableRowDaly($tableName)
    //     {
    //         return DB::table($tableName)->where('date','like', date('Y-m-d'))->get();
    //     }

//     public function companyHolidays()
    //     {
    //         return json_decode(DB::table('companies')->first()->holidays);

//     }

//     public function companyBreakTime()
    //     {
    //         return DB::table('companies')->first()->break_time;
    //     }
    //     public function companyInfo()
    //     {
    //         return DB::table('companies')->first();
    //     }

//     function cal_days_in_year($year){
    //         $days=0;
    //         for($month=1;$month<=12;$month++){
    //             $days = $days + cal_days_in_month(CAL_GREGORIAN,$month,$year);
    //          }
    //      return $days;
    //     }
    //     function getDays($start, $iDays, $aDays,$format)
    //     {
    //         if ($aDays != null) {

//       $dStart = date('d', strtotime($start));
    //       $YM     = substr($start, 0, 8);

//       $dateCount =[];
    //       for($i=$dStart; $i<=$iDays; $i++)
    //       {
    //         $ok   = strtotime($YM.$i);
    //         if($ok)
    //         {
    //           $date = date('D', $ok);
    //           foreach($aDays as $key=> $day)
    //           {
    //             $date = strtolower($date);
    //             $day  = strtolower($day);
    //             if( $date===$day )
    //             {
    //               $dateCount[$i] = date($format, $ok);
    //             }

//           }
    //         }
    //     }
    //         // dd($dateCount);
    //         return count($dateCount);

//     }
    // }
    //     public function monthlyReport()
    //     {
    //         return DB::table('monthlyReports')->get();
    //     }
    //     public function restDay($employee_id)
    //     {
    //         $restDay = json_decode(DB::table('schedules')->where('employee_id',$employee_id)->first()->restDay);
    //         $dayOfyear = Hr::cal_days_in_year(date('Y'));
    //         return  Hr::getDays(date("Y/m/01"),$dayOfyear,$restDay,'D, M jS Y');
    //     }
    //     public function restDaySchedule($employee_id)
    //     {
    //         $restDay = json_decode(DB::table('schedules')->where('employee_id',$employee_id)->first()->restDay);
    //         $dayOfyear = Hr::cal_days_in_year(date('Y'));
    //         return  Hr::getDays(date("Y-m-01",strtotime("-1 month")),$dayOfyear,$restDay,'D, M jS Y');
    //     }
    //     public function countWorkingDayInMonth($offday)
    //     {
    //         // dd($offday[0]);
    //         $dayOfyear = Hr::cal_days_in_year(date('Y'));
    //         return cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')) - Hr::getDays(date("Y/m/01"),$dayOfyear,$offday[0],'D, M jS Y');

//     }

//     public function countWorkingDayInMonthSchedule($offday)
    //     {
    //         // dd($offday[0]);
    //         $dayOfyear = Hr::cal_days_in_year(date('Y'));
    //         return cal_days_in_month(CAL_GREGORIAN,date('m'),date('Y')) - Hr::getDays(date("Y-m-01",strtotime("-1 month")),$dayOfyear,$offday[0],'D, M jS Y');

//     }

//     public function totalLeave($employee_id)
    //     {
    //         return Leave::where('status','approve')->where('employee_id',$employee_id)->whereRaw('MONTH(date) = ?', date('m'))->count();

//     }

//     public function totalLeaveSchedule($employee_id)
    //     {
    //         return Leave::where('status','approve')->where('employee_id',$employee_id)->whereRaw('MONTH(date) = ?', date("m",strtotime("-1 month")))->count();

//     }
    //     public function totalPresent($employee_id)
    //     {
    //         $attendance = Attendance::where('employee_id',$employee_id)->whereRaw('MONTH(date) = ?', date('m'))->count();
    //         return $attendance;

//     }
    //     public function totalPresentSchedule($employee_id)
    //     {
    //         $attendance = Attendance::where('employee_id',$employee_id)->whereRaw('MONTH(date) = ?', date("m",strtotime("-1 month")))->count();
    //         return $attendance;

//     }
    //     public function totalHoliday()
    //     {
    //         $holiday = Holiday::whereRaw('MONTH(holiday_date) = ?', date('m'))->count();
    //         return $holiday;

//     }
    //     public function totalHolidaySchedule()
    //     {
    //         $holiday = Holiday::whereRaw('MONTH(holiday_date) = ?', date("m",strtotime("-1 month")))->count();
    //         return $holiday;

//     }
    //     public function timeDifference($to_time,$from_time)
    //     {
    //         $to_time = strtotime("2008-12-13 10:42:00");
    //         $from_time = strtotime("2008-12-13 10:21:00");
    //         echo round(abs($to_time - $from_time) / 60,2);
    //     }
    //     function minutes($time){
    //         $time = explode(':', $time);
    //         return ($time[0]*60) + ($time[1]) + ($time[2]/60);
    //         }

//     public function sessionCreate()
    //     {
    //         return Session::get('key');
    //     }
}
