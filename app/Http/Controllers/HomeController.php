<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Support\Facades\Notification;
use App\Notifications\EmailNotification;
use Illuminate\Http\Request;
use App\Models\User;
use App\Models\Log;
use App\Models\TithesOffer;
use App\Models\Delete;
use App\Models\Disbursement;
use App\Models\RevisionHistory;
use App\Models\Notif;
use App\Models\OnlinePayment;

use Pusher\Pusher;
use Image;
use PDF;
use Hash;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */

     public function home(Request $request)
     {
        date_default_timezone_set('Asia/Manila');
        
         $uID =  Auth::user()->uID;
         $Month = Carbon::now()->format('F');  // January
         $month = Carbon::now()->format('m');  // 01
         $Year = Carbon::now()->format('Y');     
    
         if (Auth()->user()->user_type == '2' || Auth()->user()->user_type == '1' && Auth()->user()->user_status == '0')
         {
   
             $officer_access = User::where('user_type', '1')
                     ->orderBy('uID')
                     ->get();
             
            $user =  User::orderby('created_at', 'desc')->get();

            $user_activity =   User::whereNotNull('user_activity')
            ->orderBy('user_activity', 'DESC')
            ->get();

            $users_ =   Log::join('users_tb', 'users_tb.uID', '=', 'log_tb.uID')        
            // ->having(DB::raw('count(log_tb.uID)'), '>', 1)
            ->select('users_tb.lastname', 'users_tb.firstname',  'users_tb.user_image','users_tb.user_type', 'log_tb.*',  DB::raw('MAX(log_tb.created_at) as created_at'))
            ->orderBy('log_tb.created_at', 'ASC')
            ->groupBy('users_tb.uID')
            ->where('user_type', '!=', '0')
            ->get();

            $users_count = $users_->count();



                    
            $first_time =   TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->groupBy('member_ID')
            ->having(DB::raw('count(member_ID)'), '<=', 1)
            ->select('users_tb.lastname', 'users_tb.firstname',  'users_tb.user_image', 'tithes_offer_tb.*',  DB::raw('MAX(tithes_offer_tb.updated_at) as updated_at'))
            ->orderBy('tithes_offer_tb.updated_at', 'DESC')
            ->get();
        
            $first_time_count = $first_time->count();

            
             $recent_contribution =  User::join('tithes_offer_tb', 'tithes_offer_tb.member_ID', '=', 'users_tb.uID')
             ->select('users_tb.*', 'tithes_offer_tb.*')
             ->orderBy('tithes_offer_tb.updated_at', 'DESC')
             ->latest('tithes_offer_tb.updated_at')
             ->take(10)
             ->get();

             $recent_count = $recent_contribution->count();

                     
            $lapsed =  TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->groupBy('member_ID')       
            ->having(DB::raw('count(member_ID)'), '<=', 1)
            ->select('*', 'tithes_offer_tb.updated_at', DB::raw('MAX(tithes_offer_tb.updated_at) as updated_at'))
            ->where('tithes_offer_tb.updated_at', '<=', Carbon::now()->subdays(30))
            ->orderBy('tithes_offer_tb.updated_at', 'DESC')
            ->get();

            $never_contribute =  TithesOffer::rightjoin('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->groupBy('users_tb.uID')   
            ->where('tithes_offer_tb.member_ID', null)
            ->get();

          

            $lapsed_count =  $lapsed->count() + $never_contribute->count();
            
            $frequent =  TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->groupBy('tithes_offer_tb.member_ID')       
            ->having(DB::raw('count(member_ID)'), '>', 1)
            ->select('*', 'tithes_offer_tb.updated_at', DB::raw('MAX(tithes_offer_tb.updated_at) as updated_at'))
            ->where('tithes_offer_tb.updated_at', '>', Carbon::now()->subdays(30))
            ->orderBy('tithes_offer_tb.updated_at', 'DESC')
            ->get();


            $frequent_count = $frequent->count();

      
             $members = TithesOffer::all()->count();

             $user1 = User::where('user_status', '0')
                     ->where('user_type', '0')
                     ->orderBy('uID')
                     ->get();


            // $mark_as_read = TithesOffer::
             
             $delTithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                     ->get('tithes_offer_tb.toID');
             
             $officer = User::get();
 
            //  $offer = TithesOffer::where('tithes_offer_status', '0')->orderBy('toID')->get();
 

             // Disbursement Review
 
                 $disbursement = Disbursement::where('disbursement_delete_status', '=', '0' )
                 ->whereMonth('created_at', '=', $month)
                 ->whereYear('created_at', '=', $Year)
                 ->take(5)
                 ->orderBy('created_at', 'desc')
                 ->latest()
                 ->get();
         
             //Members
                 $members = User::get(); $members = count($members);
                 $new_members = User::whereMonth('created_at', '=', $month)->get();   $new_members = count($new_members);
 
                 $fromDate = Carbon::now()->subMonth()->startOfMonth()->toDateString();
                 $tillDate = Carbon::now()->subMonth()->endOfMonth()->toDateString();

             //Tithes
                 $cur_tithes =  TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')
                 ->whereMonth('created_at', '=', $month)
                 ->whereYear('created_at', '=', $Year)
                 ->sum('tithes_offer_tithe_amount');     

             // previous month
                 $tithes_format = number_format($cur_tithes, 2);
                 $prev_tithes = TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')
                 ->whereBetween('created_at',[$fromDate, $tillDate])
                 ->sum('tithes_offer_tithe_amount');   

                //  x = (y - z) / z * 100 ((This Month – Previous Month) ÷ Previous Month) x100 
              
                if($prev_tithes == '0'){

                    $new  =  0;

                }else{
                    $new   =  (($cur_tithes - $prev_tithes) / $prev_tithes) * 100;
                }


                 $percentage = number_format($new, 2);

 
            // Offerings

                 $cur_offerings = TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')
                 ->whereMonth('created_at', '=', $month)
                 ->whereYear('created_at', '=', $Year)
                 ->sum('tithes_offer_offering_plan_amount');

                 $offerings_format = number_format($cur_offerings, 2);

                 $prev_offerings = TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')
                 ->whereBetween('created_at',[$fromDate,$tillDate])
                 ->sum('tithes_offer_offering_plan_amount'); 
            
                 if($prev_offerings == '0'){

                    $newa  =  0;

                }else{

                    $newa  =   ($cur_offerings  - $prev_offerings) / $prev_offerings * 100;
                }

                 $percentage1 = number_format($newa, 2);

            //Sabbath
                 $cur_sabbath =  TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('member_ID','=', null)
                 ->where('tithes_offer_approval', '=','2')
                 ->whereMonth('created_at', '=', $month)
                 ->whereYear('created_at', '=', $Year)
                 ->sum('tithes_offer_offering_plan_amount');     

             // previous month
                 $sabbath_format = number_format($cur_sabbath, 2);
                 $prev_sabbath = TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')
                 ->where('member_ID','=', null)
                 ->whereBetween('created_at',[$fromDate, $tillDate])
                 ->sum('tithes_offer_offering_plan_amount');   

                //  x = (y - z) / z * 100 ((This Month – Previous Month) ÷ Previous Month) x100 
              
                if($prev_sabbath == '0'){

                    $newSa  =  0;

                }else{
                    $newSa  =  ($cur_sabbath - $prev_sabbath) / $prev_sabbath * 100;
                }


                 $percentage_sabbath = number_format($newSa, 2);


                //  Other gifts
                 $cur_other_gifts = TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')
                 ->whereMonth('created_at', '=', $month)
                 ->whereYear('created_at', '=', $Year)
                 ->sum('tithes_offer_other_gifts_amount');

                 $other_gifts_format = number_format($cur_other_gifts, 2);
         
                 $prev_other_gifts = TithesOffer::where('tithes_offer_status', '=', '0')
                 ->where('tithes_offer_approval', '=','2')->whereBetween('created_at',[$fromDate,$tillDate])->sum('tithes_offer_other_gifts_amount');   
                
               
                 if($prev_other_gifts == '0'){

                    $new_other_gifts =  0;

                }else{
                    $new_other_gifts   =  ($cur_other_gifts - $prev_other_gifts) / $prev_other_gifts * 100;
                }

                 $percentage2 = number_format($new_other_gifts, 2);

                 

                // Total Average

                  $minus = Disbursement::where('disbursement_type_status', '=', 'Approved')
                  ->where('disbursement_delete_status', '=' ,'0')
                  ->whereMonth('created_at', '=', $month)
                  ->whereYear('created_at', '=', $Year)
                  ->sum('disbursement_amount');
                
                 $prev_minus = Disbursement::where('disbursement_type_status', '=', 'Approved')
                 ->where('disbursement_delete_status', '=' ,'0')
                 ->whereBetween('created_at',[$fromDate,$tillDate])
                 ->whereYear('created_at', '=', $Year)
                 ->sum('disbursement_amount');   
                
 

                 $Current_Month_Total = $cur_offerings  + $cur_tithes + $cur_other_gifts  + $cur_sabbath - $minus; //This month
                 $Monthly_Total = number_format($Current_Month_Total, 2);

                 $Prev_Month_Total = $prev_offerings + $prev_tithes + $prev_other_gifts + $prev_sabbath  - $prev_minus; // Last Month
 
                if($Prev_Month_Total == '0'){

                    $Current  =  0;

                }else{
                    $Current   =  ($Current_Month_Total - $Prev_Month_Total) / $Prev_Month_Total * 100;
                }

            
                $Current_Percentage = number_format($Current, 2);
              
 
             // overview

      
 
             $Children =  Disbursement::where('disbursement_purpose', "Childrens department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Women =  Disbursement::where('disbursement_purpose', "Womens department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Personal =  Disbursement::where('disbursement_purpose', "Personal ministry department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Stewardship =  Disbursement::where('disbursement_purpose', "Stewardship department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Prayer =  Disbursement::where('disbursement_purpose', "Prayer department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Youth =  Disbursement::where('disbursement_purpose', "Youth department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $ACS =  Disbursement::where('disbursement_purpose', "ACS department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Communication =  Disbursement::where('disbursement_purpose', "Communication department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Sabbath =  Disbursement::where('disbursement_purpose', "Sabbath School department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Education =  Disbursement::where('disbursement_purpose', "Education department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Health =  Disbursement::where('disbursement_purpose', "Health department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
             $Dorcas =  Disbursement::where('disbursement_purpose', "Dorcas department")->where('disbursement_type_status', 'Approved')->whereMonth('disbursement_date', '=', $month)->whereYear('disbursement_date', '=', $Year)->sum('disbursement_amount');
            
             $get =  Disbursement::get('disbursement_purpose');

           
                
                $Others =  Disbursement::where('disbursement_purpose', '!=', "Childrens department")
                ->where('disbursement_purpose', '!=', "Womens department" )
                ->where('disbursement_purpose', '!=', "Personal ministry department" )
                ->where('disbursement_purpose', '!=', "Stewardship department" )
                ->where('disbursement_purpose', '!=', "Prayer department" )
                ->where('disbursement_purpose', '!=', "Youth department" )
                ->where('disbursement_purpose', '!=', "ACS department" )
                ->where('disbursement_purpose', '!=', "Communication department" )
                ->where('disbursement_purpose', '!=', "Sabbath School department" )
                ->where('disbursement_purpose', '!=', "Education department" )
                ->where('disbursement_purpose', '!=', "Health department" )
                ->where('disbursement_purpose', '!=', "Dorcas department" )
                ->where('disbursement_type_status', 'Approved')
                ->whereMonth('disbursement_date', '=', $month)
                ->whereYear('disbursement_date', '=', $Year)
                ->sum('disbursement_amount');


         //Monthly ave

                $minus = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0'
                )->whereMonth('created_at', '=', $month)->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                
                 $prev_minus = Disbursement::where('disbursement_type_status', '=', 'Approved')
                 ->where('disbursement_delete_status', '=' ,'0')
                 ->whereBetween('created_at',[$fromDate,$tillDate])
                 ->whereYear('created_at', '=', $Year)
                 ->sum('disbursement_amount');   
                

                 $Current_Month_Total = $cur_offerings  + $cur_tithes + $cur_other_gifts  + $cur_sabbath -  $minus; //This month
                 $Prev_Month_Total = $prev_offerings + $prev_tithes + $prev_other_gifts + $prev_sabbath  - $prev_minus; // Last Month
 
                if($Prev_Month_Total == '0'){

                    $Current  =  0;

                }else{
                    $Current   =  ($Current_Month_Total - $Prev_Month_Total) / $Prev_Month_Total * 100;
                }

               
 
                $Current_Percentage = number_format($Current, 2);

                $Monthly_Total = number_format($Current_Month_Total, 2);

                $disbursement_JAN = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');      
                $disbursement_FEB = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_MAR = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_APR = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_MAY = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_JUN = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_JUL = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_AUG = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_SEP = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_OCT = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_NOV = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');
                $disbursement_DEC = Disbursement::where('disbursement_type_status', '=', 'Approved')->where('disbursement_delete_status', '=' ,'0')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)->sum('disbursement_amount');


                 
                    $JAN1_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $JAN2_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $JAN3_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $JAN4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '01')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');    
                $MONTH_JAN  = $JAN1_ + $JAN2_ + $JAN3_ + $JAN4_;

                    $FEB1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $FEB2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)
                        ->sum( 'tithes_offer_offering_plan_amount');
                    $FEB3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)
                         ->sum( 'tithes_offer_tithe_amount');
                    $FEB4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '02')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');    
                $MONTH_FEB  = $FEB1 +  $FEB2 + $FEB3 + $FEB4_ ;


                    $MAR1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $MAR2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $MAR3_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $MAR4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '03')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_MAR  = $MAR1 + $MAR2 + $MAR3_ + $MAR4_;

                    $APR1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $APR2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)
                        ->sum( 'tithes_offer_offering_plan_amount');
                    $APR3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)
                        ->sum( 'tithes_offer_tithe_amount');
                    $APR4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '04')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_APR  = $APR1 + $APR2 + $APR3 + $APR4_;

// 
                    $MAY1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $MAY2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $MAY3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $MAY4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '05')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');    
                $MONTH_MAY  = $MAY1 + $MAY2 + $MAY3 + $MAY4_;

                    $JUN1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $JUN2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $JUN3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $JUN4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '06')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_JUN  = $JUN1 + $JUN2 + $JUN3 + $JUN4_;

                    $JUL1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $JUL2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $JUL3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $JUL4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '07')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_JUL  = $JUL1 + $JUL2 + $JUL3 + $JUL4_;

                    $AUG1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $AUG2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $AUG3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $AUG4_ =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '08')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_AUG  = $AUG1 + $AUG2 + $AUG3 + $AUG4_;

                    $SEP1  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $SEP2  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $SEP3  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $SEP4 =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '09')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_SEP  = $SEP1 + $SEP2 + $SEP3 + $SEP4;

                    $OCT1_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $OCT2_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $OCT3_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $OCT4 =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '10')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_OCT  = $OCT1_ + $OCT2_ + $OCT3_ + $OCT4;

                    $NOV1_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $NOV2_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $NOV3_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $NOV4 =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '11')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_NOV  = $NOV1_ + $NOV2_ + $NOV3_ + $NOV4;

                    $DEC1_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_other_gifts_amount');
                    $DEC2_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_offering_plan_amount');
                    $DEC3_  = TithesOffer::where('tithes_offer_status', '=', '0')->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)
                        ->sum('tithes_offer_tithe_amount');
                    $DEC4 =  TithesOffer::where('tithes_offer_status', '=', '0')->where('member_ID','=', null)->where('tithes_offer_approval', '=','2')->whereMonth('created_at', '=', '12')
                        ->whereYear('created_at', '=', $Year) ->sum('tithes_offer_offering_plan_amount');  
                $MONTH_DEC  = $DEC1_ + $DEC2_ + $DEC3_ + $DEC4;

                //Total Ave

                $JAN_TOTAL_AVE =  $MONTH_JAN - $disbursement_JAN;
                $FEB_TOTAL_AVE =  $MONTH_FEB - $disbursement_FEB;
                $MAR_TOTAL_AVE =  $MONTH_MAR - $disbursement_MAR;
                $APR_TOTAL_AVE =  $MONTH_APR - $disbursement_APR;
                $MAY_TOTAL_AVE =  $MONTH_MAY - $disbursement_MAY;
                $JUN_TOTAL_AVE =  $MONTH_JUN - $disbursement_JUN;
                $JUL_TOTAL_AVE =  $MONTH_JUL - $disbursement_JUL;
                $AUG_TOTAL_AVE =  $MONTH_AUG - $disbursement_AUG;
                $SEP_TOTAL_AVE =  $MONTH_SEP - $disbursement_SEP;
                $OCT_TOTAL_AVE =  $MONTH_OCT - $disbursement_OCT;
                $NOV_TOTAL_AVE =  $MONTH_NOV - $disbursement_NOV;
                $DEC_TOTAL_AVE =  $MONTH_DEC - $disbursement_DEC;
 
             // line chart
                 $JAN =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $FEB =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $MAR =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $APR =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $MAY =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $JUN =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $JUL =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $AUG =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $SEP =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $OCT =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $NOV =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
                 $DEC =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)->sum('tithes_offer_tithe_amount');
 
             // recent contribution
 


             $recent = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
             ->where('tithes_offer_tb.tithes_offer_status',  '=',  '0')
             ->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')
             ->whereMonth('tithes_offer_tb.created_at', '=', $month)
             ->select('tithes_offer_tb.tithes_offer_tithe_amount', 'tithes_offer_tb.tithes_offer_tithe_amount', 'tithes_offer_tb.tithes_offer_other_gifts_amount', 'tithes_offer_tb.created_at', 'users_tb.firstname', 'users_tb.lastname')
             ->take(5)
             ->get();
         
 
 
 
             $JAN1 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $FEB2 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $MAR3 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $APR4 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $MAY5 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $JUN6 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $JUL7 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $AUG8 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $SEP9 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $OCT10 = TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $NOV11 = TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
             $DEC12 = TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_JAN1 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_FEB2 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_MAR3 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_APR4 =  TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_MAY5 =  TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_JUN6 =  TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_JUL7 =  TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_AUG8 =  TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_SEP9 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_OCT10 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');

             $Sabbath_NOV11 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');


             $Sabbath_DEC12 = TithesOffer::where('member_ID','=', null)->where('tithes_offer_status',  '=',  '0')->where('tithes_offer_approval',  '=',  '2')
                            ->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)->sum('tithes_offer_offering_plan_amount');
 
             
             $JAN01 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '01')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $FEB02 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '02')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $MAR03 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '03')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $APR04 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '04')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $MAY05 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '05')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $JUN06 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '06')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $JUL07 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '07')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $AUG08 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '08')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $SEP09 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=',  '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '09')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $OCT010 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=', '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '10')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $NOV011 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=', '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '11')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
             $DEC012 =  TithesOffer::where('tithes_offer_tb.tithes_offer_status',  '=', '0')->where('tithes_offer_tb.tithes_offer_approval',  '=',  '2')->whereMonth('created_at', '=', '12')->whereYear('created_at', '=', $Year)->sum('tithes_offer_other_gifts_amount');
 

             return view('admin.ad_home', compact(
         
                 'officer_access',  'user', 'user1', 'officer', 'delTithe', 'user_activity', 'never_contribute',
                 'cur_sabbath', 'sabbath_format', 'prev_sabbath', 'percentage_sabbath', 'minus',
                 'MONTH_JAN', 'MONTH_FEB', 'MONTH_MAR', 'MONTH_APR', 'MONTH_MAY', 'MONTH_JUN', 'MONTH_JUL', 'MONTH_AUG', 'MONTH_SEP', 'MONTH_OCT', 'MONTH_NOV', 'MONTH_DEC',
                 
                 'disbursement_JAN', 'disbursement_FEB', 'disbursement_MAR', 'disbursement_APR', 'disbursement_MAY', 'disbursement_JUN', 'disbursement_JUL', 'disbursement_AUG', 'disbursement_SEP', 'disbursement_OCT', 'disbursement_NOV', 'disbursement_DEC',

                 'JAN_TOTAL_AVE',  'FEB_TOTAL_AVE', 'MAR_TOTAL_AVE', 'APR_TOTAL_AVE', 'MAY_TOTAL_AVE', 'JUN_TOTAL_AVE', 'JUL_TOTAL_AVE', 'AUG_TOTAL_AVE', 'SEP_TOTAL_AVE', 'OCT_TOTAL_AVE',  'NOV_TOTAL_AVE',  'DEC_TOTAL_AVE',

                 'lapsed', 'recent_contribution', 'first_time', 'frequent', 'users_count', 'lapsed_count', 'recent_count', 'frequent_count', 'first_time_count',
                 'officer', 'members', 'disbursement', 'new_members', 'tithes_format' , 'Month' , 'percentage', 'prev_tithes', 'cur_tithes',
                 'offerings_format', 'cur_offerings', 'prev_offerings', 'percentage1',
                 'percentage2', 'cur_other_gifts', 'prev_other_gifts', 'other_gifts_format',
                 'JAN', 'FEB', 'MAR', 'APR', 'MAY', 'JUN', 'JUL', 'AUG', 'SEP', 'OCT', 'NOV', 'DEC' , 'Current_Month_Total',
                 'recent', 'Monthly_Total', 'Current_Percentage', 'Prev_Month_Total',
                 'Sabbath_JAN1', 'Sabbath_FEB2', 'Sabbath_MAR3', 'Sabbath_APR4', 'Sabbath_MAY5', 'Sabbath_JUN6', 'Sabbath_JUL7', 'Sabbath_AUG8', 'Sabbath_SEP9', 'Sabbath_OCT10', 'Sabbath_NOV11', 'Sabbath_DEC12' ,
                 'JAN1', 'FEB2', 'MAR3', 'APR4', 'MAY5', 'JUN6', 'JUL7', 'AUG8', 'SEP9', 'OCT10', 'NOV11', 'DEC12' ,
                 'JAN01', 'FEB02', 'MAR03', 'APR04', 'MAY05', 'JUN06', 'JUL07', 'AUG08', 'SEP09', 'OCT010', 'NOV011', 'DEC012',

                 'Children', 'Women', 'Personal', 'Stewardship', 'Prayer', 'Youth', 'ACS', 'Communication', 'Sabbath', 'Education', 'Health', 'Dorcas',  'Others',
         
             ));
         }
 
          //  START DITO ===== PAKI COPY NA LANG SIGURO LAHAT
 
        else if (Auth()->user()->user_type == '0' && Auth()->user()->user_status == '0')
        {
            $Month = Carbon::now()->format('F');  // January
            $month = Carbon::now()->format('m');  // 01
            $Year = Carbon::now()->format('Y');

            $user = Auth::user()->uID;

           $get_gcash = OnlinePayment::where('on_type', '=', 'GCash')
                        ->where('on_status', '=', 'Visible')
                        ->where('on_delete_status', '=', 'Active')
                        ->where('on_type', '=', 'GCash')
                        ->get();

            $get_bank = OnlinePayment::where('on_type', '=', 'Bank')
                        ->where('on_status', '=', 'Visible')
                        ->where('on_delete_status', '=', 'Active')
                        ->where('on_type', '=', 'Bank')
                        ->get();

            $method = $request->method();

            if ($request->isMethod('post'))
            {
                $from1 = $request->input('from1');
                $to1 = $request->input('to1');

                if ($request->has('mem_search'))
                {

                    $mem_search1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->whereIn('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                            ->orderBy('tithes_offer_tb.toID', 'DESC')
                            ->get();

                    $history = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            // ->where('users_tb.uID', '!=', Auth()->user()->uID)
                            ->where('tithes_offer_church_member_request', '=', 'Approved')
                            ->where('tithes_offer_tb.member_ID', $user)
                            ->whereIn('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                            ->orderBy('tithes_offer_tb.toID', 'DESC')
                            ->select('tithes_offer_tb.*')
                            ->paginate(10);
                            
                    return view('members.mem_home', compact('user', 'history', 'mem_search1', 'Month', 'month', 'Year', 'get_gcash', 'get_bank'));
                }

            }

            else
            {

                $history = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->where('tithes_offer_tb.member_ID', $user)
                        ->where('tithes_offer_church_member_request', '=', 'Approved')
                        ->orderBy('tithes_offer_tb.toID', 'DESC')
                        ->select('tithes_offer_tb.*')
                        ->get();

                return view('members.mem_home', compact('user', 'history', 'Month', 'month', 'Year', 'get_gcash', 'get_bank'));
            }

        }
     }
 
     // MEMBER'S UPDATE IMAGE
 
     public function update_image(Request $request)
     {
         // Handle the user upload of image
 
         if ($request->hasFile('user_image')){
 
             request()->validate([
                 'user_image' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:255',
             ]);
             
             $uImg = $request->file('user_image');
             $filename = time() . '.' . $uImg->getClientOriginalExtension();
             Image::make($uImg)->resize(300, 300)->save( public_path('users/' . $filename) );
 
             $user = Auth::user();
             $user->user_image = $filename;
             $user->save();
         }
 
         return back();
 
     }

     public function add_new_tithes(Request $request) {

    
        date_default_timezone_set('Asia/Manila');

        $tithe = new TithesOffer();

        $tithe->uID = Auth::user()->uID;
        $tithe->member_ID = Auth::user()->uID;

        

        $tithe->tithes_offer_tithe_amount = request('tithes_offer_tithe_amount');
        $tithe->tithes_offer_offering_plan_amount = request('tithes_offer_offering_plan_amount');
        $tithe->tithes_offer_other_gifts_amount = request('tithes_offer_other_gifts_amount');
        $tithe->tithes_account_number = request('tithes_account_number');
        $tithe->tithes_account_name = request('tithes_account_name');
        $tithe->tithes_reference_number = request('tithes_reference_number');


        if ($request->file('tithes_reciept') == NULL)
        {
            $tithe->tithes_reciept = 'no-image-found.png';
        }
        
        else
        {
            $receipt = $request->file('tithes_reciept');
            $filename = time() . '.' . $receipt->getClientOriginalExtension();
            Image::make($receipt)->resize(300, 300)->save('tithes_offer/' . $filename);

            $tithe->tithes_reciept  = $filename;
        }
        
        $tithe->tithes_offer_type = request('tithes_offer_type');
        $tithe->tithes_offer_date = request('tithes_offer_date');
        $tithe->tithes_offer_approval = 1;
        $tithe->tithes_offer_church_member_request = "Pending";
        $tithe->tithes_offer_admin_action = "Not Yet";
        $tithe->created_at = Carbon::now();

        $tithe->save();

        

        $record = $tithe->toID;

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->member_ID = Auth::user()->uID;
        $Notification->is_read = '0';
        $Notification->record_id = $record;
        
        $id = $Notification->uID;
        $Notification->type =  'Tithes_Offering';
        $Notification->notif_type = 'Added';
        $Notification->save();
    
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
    
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
    
        $data = ['uID' => $id];
        $pusher->trigger('my-channel', 'my-event', $data);

        // EMAIL NOTIFICATION (TITHER)

        $user_officer = User::where('user_type', '=', '0')
            ->where('uID', '=', Auth::user()->uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => 'Your record is on hold, wait for its approval. You will receive another email once it is done. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        
        // EMAIL NOTIFICATION (ADMIN)

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new record and needs an approval. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        return response()->json(['status' => true, 'message' => 'You have added new record request!']);


    }


    /*public function add_member_tithes(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $tithe = new TithesOffer();

        $tithe->uID = Auth::user()->uID;
        $tithe->member_ID = Auth::user()->uID;

        $tithe->tithes_offer_tithe_amount = request('tithes_offer_tithe_amount');
        $tithe->tithes_offer_offering_plan_amount = request('tithes_offer_offering_plan_amount');
        $tithe->tithes_offer_other_gifts_amount = request('tithes_offer_other_gifts_amount');
        $tithe->tithes_offer_other_gifts_desciption =  request('tithes_offer_other_gifts_desciption');


        if (request('tithes_offer_type') === 'pay')
        {
            if (request('type_1') === 'GCash')
            {
                $tithe->tithes_offer_type = request('type_1');
            }
            else if (request('type_1') === 'Bank')
            {
                $tithe->tithes_offer_type = request('type_1');
            }
        }

        else if (request('tithes_offer_type') === 'type')
        {
            $tithe->tithes_offer_type =  request('type-field-3');
        }

        else
        {
            $tithe->tithes_offer_type =  request('tithes_offer_type');
        }
        
        $tithe->tithes_offer_approval = 1;
        $tithe->tithes_offer_church_member_request = "Pending";
        $tithe->tithes_offer_admin_action = "Not Yet";

        $tithe->tithes_offer_date = request('tithes_offer_date');

        $tithe->created_at = Carbon::now();

        $record = $tithe->toID;

        $Notification = new Notif;
        $Notification->member_ID = Auth::user()->uID;
        $Notification->is_read = '0';
        $Notification->record_id = $record;
        
        $id = $Notification->member_ID;
        $Notification->type =  'Tithes_Offering';
        $Notification->notif_type = 'Added';
        $Notification->save();
    
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
    
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
    
        $data = ['member_ID' => $id];
        $pusher->trigger('my-channel', 'my-event', $data);

        // EMAIL NOTIFICATION (TITHER)

        $user_officer = User::where('user_type', '=', '0')
            ->where('uID', '=', Auth::user()->uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => 'Your record is on hold, wait for its approval. You will receive another email once it is done. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        
        // EMAIL NOTIFICATION (ADMIN)

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new record and needs an approval. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        if($tithe->save()) {

            return response()->json(['status' => true, 'message' => 'You have added new record request!']);
        
        }
    
    }*/

/*public function add_member_tithes(Request $request)
    {
        date_default_timezone_set('Asia/Manila');

        $tithe = new TithesOffer();

        $tithe->uID = Auth::user()->uID;
        $tithe->member_ID = Auth::user()->uID;

        $tithe->tithes_account_number  = request('tithes_account_number');
        $tithe->tithes_account_name  = request('tithes_account_name');
        $tithe->tithes_reference_number  = request('tithes_reference_number');
        $tithe->tithes_reciept  = request('tithes_reciept');
        $tithe->tithes_offer_tithe_amount = request('tithes_offer_tithe_amount');
        $tithe->tithes_offer_offering_plan_amount = request('tithes_offer_offering_plan_amount');
        $tithe->tithes_offer_other_gifts_amount = request('tithes_offer_other_gifts_amount');
        $tithe->tithes_offer_other_gifts_desciption =  request('tithes_offer_other_gifts_desciption');
        $tithe->tithes_offer_user_type = request('tithes_offer_user_type');

        if ($request->hasFile('tithes_reciept')){
 
        request()->validate([
            'tithes_reciept' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:255',
        ]);
        
        $uImg = $request->file('tithes_reciept');
        $filename = time() . '.' . $uImg->getClientOriginalExtension();
        $request->tithes_reciept->move(public_path('users/'), $filename);

        }

        
        $tithe->tithes_offer_approval = 1;
        $tithe->tithes_offer_church_member_request = "Pending";
        $tithe->tithes_offer_admin_action = "Not Yet";

        $tithe->tithes_offer_date = request('tithes_offer_date');

        $tithe->created_at = Carbon::now();

        $record = $tithe->toID;

        $Notification = new Notif;
        $Notification->member_ID = Auth::user()->uID;
        $Notification->is_read = '0';
        $Notification->record_id = $record;
        
        $id = $Notification->member_ID;
        $Notification->type =  'Tithes_Offering';
        $Notification->notif_type = 'Added';
        $Notification->save();
    
        $options = array(
            'cluster' => 'ap1',
            'useTLS' => true
        );
    
        $pusher = new Pusher(
            env('PUSHER_APP_KEY'),
            env('PUSHER_APP_SECRET'),
            env('PUSHER_APP_ID'),
            $options
        );
    
        $data = ['member_ID' => $id];
        $pusher->trigger('my-channel', 'my-event', $data);

        // EMAIL NOTIFICATION (TITHER)

        $user_officer = User::where('user_type', '=', '0')
            ->where('uID', '=', Auth::user()->uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => 'Your record is on hold, wait for its approval. You will receive another email once it is done. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        
        // EMAIL NOTIFICATION (ADMIN)

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new record and needs an approval. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        if($tithe->save()) {

            return response()->json(['status' => true, 'message' => 'You have added new record request!']);
        
        }
    
    }*/















    public function pending_member_request()
    {

        $pending = TithesOffer::where('uID', '=', Auth::user()->uID)
                    ->where('member_ID', '=', Auth::user()->uID)
                    ->whereIn('tithes_offer_church_member_request', ['Pending', 'For Approval', 'Declined'])
                    ->orderBy('toID', 'DESC')
                    ->get();
        
        return view('members.mem_request', compact('pending'));
    }

    //  HANGGANG DITO LANG ==^
     

    public function showChangePasswordGet() {
        return view('admin.ad_change_pass');
    }

    public function changePasswordPost(Request $request) {
        if (!(Hash::check($request->get('current-password'), Auth::user()->password))) {
            // The passwords matches
            return redirect()->back()->with("error","Your current password does not matches with the password.");
        }

        if(strcmp($request->get('current-password'), $request->get('new-password')) == 0){
            // Current password and new password same
            return redirect()->back()->with("error","New Password cannot be same as your current password.");
        }

        $validatedData = $request->validate([
            'current-password' => 'required',
            'new-password' => 'required|string|min:8|confirmed',
        ]);

        //Change Password
        $user = Auth::user();
        $user->password = bcrypt($request->get('new-password'));
        $user->save();

        //Automatic Logout
        $uID = Auth::user()->uID;
        Auth::logout();

        $timestamp = Carbon::now()->timezone('Asia/Manila');
        

        $logOUT = new Log();

        $logOUT->uID = $uID;
        $logOUT->logSTAT = '0';
        $logOUT->created_at = $timestamp;
        $logOUT->updated_at = $timestamp;

        $logOUT->save();

        return redirect('/login')->with("info","Password successfully changed! You can now login with your new Password");
    }

    

   

    
    public function __construct()
    {
        $this->middleware('auth');
    } 

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
