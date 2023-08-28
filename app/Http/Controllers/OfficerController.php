<?php

namespace App\Http\Controllers;

use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\RegistersUsers;

use App\Models\User;
use App\Models\Log;
use App\Models\TithesOffer;
use App\Models\Delete;
use App\Models\Disbursement;
use App\Models\RevisionHistory;
use App\Models\Notif;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;

use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

use Pusher\Pusher;

use Image;
use PDF;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class OfficerController extends Controller
{

    public function notifs()
    {
        $notifications = Notif::join('users_tb', 'users_tb.uID', '=' , 'notifs.nID')
        ->where('notifs.uID', '!=', Auth()->user()->uID)
        ->count('is_read');     
        
        $notif_list =  Notif::join('users_tb', 'users_tb.uID', '=' , 'notifs.uID')
        ->where('notifs.uID', '!=', Auth()->user()->uID)
        ->get();     


         return view('dashboard', compact('notifications', $notifications));

    }

    public function add_church_member(Request $request)
    {
        $users = new User();    
        $users->firstname = request('firstname'); 
        $users->middlename = request('middlename');     
        $users->lastname = request('lastname');
        $users->birthday = request('birthday');
        $users->user_mobile_number = " ";
        $users->user_street = request('user_street');
        $users->user_barangay = request('user_barangay');
        $users->user_city = request('user_city');
        $users->user_zip = request('user_zip');

        $permitted_chars = '0123456789abcdefghijklmnopqrstuvwxyzABCDEFGHIJKLMNOPQRSTUVWXYZ';
        $username = substr(str_shuffle($permitted_chars), 0, 10);

        $users->username = $username;
        $users->email = request('email');
        $users->password = " ";
        $users->user_status = 0;
        $users->user_access = 0;
        $users->user_type = 0;

        $users->save();

        $uID = Auth::user()->uID;

        $user_notif = User::whereIn('user_type', [1,2])
                    ->whereIn('user_access', [2,5,8])
                    ->where('uID', '!=', $uID)
                    ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added new member. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::send($user_notif, new EmailNotification($notify));

        return redirect('/home');

    }


    // ADD TITHES

    public function add_tithes(Request $request)
    {
        if ($request->hasFile('tithes_offer_file')) {

            request()->validate([
                'tithes_offer_file' => 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:255',
            ]);

            
            $tFILE = $request->file('tithes_offer_file');
            $filename = time() . '.' . $tFILE->getClientOriginalExtension();
            Image::make($tFILE)->resize(300, 300)->save( public_path('tithes-offer/' . $filename) );


            $tithe = new TithesOffer();

            $tithe->uID = Auth::user()->uID;
            $tithe->member_ID = request('uID');
            $tithe->tithes_offer_group_type = '1';
            $tithe->tithes_offer_amount = request('tithes_offer_amount');
            $tithe->tithes_offer_type = request('tithes_offer_type');
            $tithe->tithes_offer_purpose = request('tithes_offer_purpose');

            $tithe->tithes_offer_file = $filename;
                
            $tithe->offering_name = " ";
            $tithe->tithes_offer_read = 0;
            $tithe->tithes_offer_approval = 1;

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Tithes';
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

            $user_notif = User::whereIn('user_type', [0,1,2])
                    ->where('uID', request('uID'))
                    ->get();

            $notify = [
                'body' => 'Your tithe has been recorded. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

        }
        
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::where('user_type', [1,2])
            ->whereIn('user_access', [3,6,8])
            ->where('uID', '!=', $uID)
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new tithe. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        
        if($tithe->save()) {

            return response()->json(['status' => true, 'message' => 'You have added new tithe request!']);
        
        }

    }

    // ADD OFFERINGS

    public function add_offer(Request $request)
    {

        if ($request->hasFile('tithes_offer_file')) {

            request()->validate([
                'tithes_offer_file' => 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:255',
            ]);
            
            $tFILE = $request->file('tithes_offer_file');
            $filename = time() . '.' . $tFILE->getClientOriginalExtension();
            Image::make($tFILE)->resize(300, 300)->save( public_path('tithes-offer/' . $filename) );

            $offer = new TithesOffer();

            $offer->uID = Auth::user()->uID;
            $offer->tithes_offer_group_type = request('tithes_offer_group_type');
            $offer->tithes_offer_amount = request('tithes_offer_amount');
            $offer->tithes_offer_type = request('tithes_offer_type');
            $offer->tithes_offer_purpose = " ";

            $offer->tithes_offer_file = $filename;
        
            $offer->offering_name = request('offering_name');
            $offer->tithes_offer_read = 0;
            $offer->tithes_offer_approval = 2;

            $offer->save();

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Offerings';
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

        }
      
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::where('user_type', [1,2])
            ->whereIn('user_access', [3,6,8])
            ->where('uID', '!=', $uID)
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new offering. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

    
        return response()->json(['status' => true, 'message' => 'You have add new offering request!']);
        
    }

    // CHURCH OFFICER PROFILE

    public function ch_profile()
    {
        $uAccess = Auth()->user()->uAccess;

        return view('officers.ch_profile', compact('uAccess'));

    }

    // CHURCH OFFICER EDIT INFO

    public function ch_edit_profile($uID)
    {
        $users = User::find($uID);

        $users->lastname = request('lastname'); 
        $users->firstname = request('firstname');     
        $users->middlename = request('middlename');
        $users->birthday = request('birthday');
        $users->uMob = request('user_mobile_number');
        $users->uStrt = request('user_street');
        $users->uBrgy = request('user_barangay');
        $users->uCity = request('user_city');
        $users->uZip = request('user_zip');
        
        $users->save();
    

        return back();
    }

    // CHURCH OFFICER UPDATE DP

    public function ch_update_image(Request $request)
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


    // public function edit_tithes_offer(Request $request, $toID)
    // {
    //     $titheO = TithesOffer::join('users_tb', 'users_tb.uID', '=', 't&o_tb.memID')
    //             ->find($toID);

    //     return view('officers.edit_tithes_offer', compact('titheO'));

    // }


    // UPDATE TITHES

    public function update_tithes(Request $request, $toID)
    {

        if ($request->isMethod('post'))
        {

            $upTithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                ->where('tithes_offer_tb.toID', $toID)
                ->update([
                    'tithes_offer_tb.tithes_offer_file' => request('tithes_offer_file'),
                    'tithes_offer_tb.tithes_offer_amount' => request('tithes_offer_amount'),
                    'tithes_offer_tb.tithes_offer_type' => request('tithes_offer_type'),
                    'tithes_offer_tb.tithes_offer_purpose' => request('tithes_offer_purpose'),
                ]);

        
                $Notification = new Notif;
                $Notification->uID = Auth::user()->uID;
                $Notification->is_read = '0';
                
                $id = $Notification->uID;
                $Notification->type =  request('tithes_offer_type');
                $Notification->notif_type = 'Updated';
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
            
            
                
                return response()->json(['status' => true, 'message' => 'You have successfully updated the information!']);
                


        }
        
    }

    // UPDATE OFFERINGS

    public function update_offer(Request $request, $toID)
    {
        if ($request->isMethod('post'))
        {
            $upOffer = TithesOffer::where('toID', $toID)
                ->update([
                    'tithes_offer_file' => null,
                    'tithes_offer_amount' => request('tithes_offer_amount'),
                    'tithes_offer_type' => request('tithes_offer_type'),
                    'offering_name' => request('offering_name'),
                ]);


            return redirect('/home');

        }
    }

    // LIST OF DELETED TITHES AND OFFERINGS

    public function deleted_tithes_offerings()
    {
        
        $deleted_tithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->where('tithes_offer_tb.tithes_offer_group_type', '1')
                        ->where('tithes_offer_tb.tithes_offer_status', '1')
                        ->orderBy('tithes_offer_tb.toID')
                        ->get();

        $deleted_offer = TithesOffer::where('tithes_offer_group_type', '2')
                    ->where('tithes_offer_status', '1')
                    ->orderBy('toID')->get();

        $uAccess = Auth::user()->user_access;

        return view('officers.deleted_tithes_offer', compact('deleted_tithe', 'deleted_offer', 'uAccess'));
    }

    // DELETE TITHES

    public function delete_tithe(Request $request, $toID)
    {
        $tithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_status' => 1,
            ]);

        // $delTithe = new Delete();
        // $delTithe->uID = Auth::user()->uID;
        // $delTithe->toID = request('toID');
        // $delTithe->dDATA = Carbon::now();
        // $delTithe->save();
        
        return back();
    }

    // RETRIEVE TITHES
    
    public function retrieve_tithe(Request $request, $toID)
    {
        $retrieve = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->where('tithes_offer_tb.tithes_offer_group_type', '1')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_status' => 0,
            ]);

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Tithes_Offering';
            $Notification->notif_type = 'Retrieve';
            $Notification->record_id = $toID;
            $Notification->created_at = Carbon::now();
            $Notification->updated_at = Carbon::now();
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
       
        
        return response()->json(['status' => true, 'message' => 'You have retrieve the record successfully!']);
    }

    // DELETE OFFERINGS

    public function delete_offer(Request $request, $toID)
    {
        $offer = TithesOffer::find($toID);
        $offer->tithes_offer_status = 1;
        $offer->save();
        
        return redirect('/home');
    }

    // RETRIEVE OFFERINGS
    
    public function retrieve_offer(Request $request, $toID)
    {
        $retrieve = TithesOffer::find($toID)
                    ->where('tithes_offer_tb.tithes_offer_group_type', '2')
                    // ->where('toID', $toID)
                    ->update([
                        'tithes_offer_tb.tithes_offer_status' => 0,
                    ]);
        
        return back();
    }


    // ITO, APPLICABLE LANG FOR CHURCH OFFICER NA MAY ACCESS SA PAG EEDIT NANG MEMBER'S INFO WHICH IS ACCESS 5.
    // ANG HINDI LANG NYA PWEDENG MA-EDIT NA INFO IS YUNG SA MGA KAPWA CHURCH OFFICERS NIYA AND ADMIN
    // KASI MAY KANIYA KANIYA SILANG ACCESS PARA SA PAG EEDIT NG INFO NILA

    public function mem_edit(Request $request, $uID)
    {
        $users = User::find($uID);

        $users->lastname = request('lastname'); 
        $users->firstname = request('firstname');     
        $users->middlename = request('middlename');
        $users->birthday = request('birthday');
        $users->user_mobile_number = request('user_mobile_number');
        $users->user_street = request('user_street');
        $users->user_barangay = request('user_barangay');
        $users->user_city = request('user_city');
        $users->user_zip = request('user_zip');

        $users->save();
        
        return back();

    }

    // ETO YUNG PAGE FOR REPORT NG TITHES AT OFFERINGS
    // MAY DATE RANGE AND EXPORT TO PDF DEN

    public function ch_reports(Request $request)
    {
        $method = $request->method();

        $uAccess = Auth()->user()->user_access;

        if (Auth::user()->user_type == '1') {

            // ACCESS 1 - VIEW/MONITOR ONLY OR ACCESS 2 - VIEW/MONITOR MEMBERS ONLY OR ACCESS 5 - EDITORS ACCESS TO MEMBERS OR ACCESS 8 - ALL ACCESS

            if ($uAccess == '1' || $uAccess == '2' || $uAccess == '5' || $uAccess == '8') {

                if ($request->isMethod('post'))
                {

                    $from1 = $request->input('from1');
                    $to1 = $request->input('to1');

                    if ($request->has('search_1'))
                    {
                        // select search

                        $search1 = User::whereBetween('created_at', [$from1, $to1])
                                ->orderBy('uID')
                                ->get();

                        $member = User::whereBetween('created_at', [$from1, $to1])
                                ->orderBy('uID')
                                ->get();

                        $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                ->where('tithes_offer_tb.tithes_offer_approval', '2')
                                ->orderBy('tithes_offer_tb.toID')
                                ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                                ->get();
                    

                        $tithesRep2 = TithesOffer::where('member_ID', null)
                                ->where('tithes_offer_approval', '2')
                                ->orderBy('toID')->get();
                        
                        $dsment = Disbursement::where('disbursement_status', '2')
                                ->orderBy('dsID')
                                ->get();
                        
                        return view('officers.ch_report', compact('search1', 'member', 'uAccess', 'tithesRep1', 'tithesRep2', 'dsment'));
                    }

                    elseif ($request->has('exportPDF_1'))
                    {
                        // select PDF

                        $exportMEM = User::whereBetween('created_at', [$from1, $to1])
                                    ->orderBy('uID')
                                    ->select('users_tb.*')
                                    ->get();


                        $pdf = PDF::loadView('officers.ch_layout_memPDF', compact('exportMEM', 'uAccess'))
                        ->setOptions(['defaultFont' => 'Arial']);
                        
                        //download PDF file with stream method
                        return $pdf->stream('users_report.pdf');
                    } 

                }

                else
                {
                    //select all
                    $dsment = Disbursement::where('disbursement_status', '2')
                            ->orderBy('dsID')
                            ->select('disbursement_tb.*')
                            ->get();

                    $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->where('tithes_offer_tb.tithes_offer_approval', '2')
                            ->orderBy('tithes_offer_tb.toID')
                            ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                            ->get();
                

                    $tithesRep2 = TithesOffer::where('member_ID', null)
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID')->get();
                    
                    $member = User::orderBy('uID')
                            ->get();

                    return view('officers.ch_report', compact('member', 'uAccess', 'tithesRep1', 'tithesRep2', 'dsment'));
                }
            }

            // ACCESS 1 - VIEW/MONITOR ONLY OR ACCESS 4 - VIEW/MONITOR DISBURSEMENT OR ACCESS 7 - EDITORS ACCESS TO DISBURSEMENT OR ACCESS 8 - ALL ACCESS

            if ($uAccess == '1' || $uAccess == '4' || $uAccess == '7' || $uAccess == '8') {

                if ($request->isMethod('post'))
                {

                    $from2 = $request->input('from2');
                    $to2 = $request->input('to2');

                    if ($request->has('search_2'))
                    {
                        // select search

                        $search2 = Disbursement::whereBetween('created_at', [$from2, $to2])
                                ->orderBy('dsID')
                                ->get();

                        $dsment = Disbursement::whereBetween('created_at', [$from2, $to2])
                                ->where('disbursement_status', '2')
                                ->orderBy('dsID')
                                ->get();

                        $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                ->where('tithes_offer_tb.tithes_offer_approval', '2')
                                ->orderBy('tithes_offer_tb.toID')
                                ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                                ->get();
                    

                        $tithesRep2 = TithesOffer::where('member_ID', null)
                                ->where('tithes_offer_approval', '2')
                                ->orderBy('toID')
                                ->get();

                        $member = User::orderBy('uID')
                                ->get();
                        
                        return view('officers.ch_report', compact('search2', 'dsment', 'uAccess', 'tithesRep1', 'tithesRep2', 'member'));
                    }

                    elseif ($request->has('exportPDF_2'))
                    {
                        // select PDF

                        $exportDSMENT = Disbursement::whereBetween('created_at', [$from1, $to1])
                                    ->orderBy('dsID')
                                    ->select('disbursement_tb.*')
                                    ->get();

                        $pdf = PDF::loadView('officers.ch_layout_disbursePDF', compact('exportDSMENT', 'uAccess'))
                        ->setOptions(['defaultFont' => 'Arial']);
                        
                        //download PDF file with stream method
                        return $pdf->stream('disbursement_report.pdf');
                    } 

                }

                else
                {
                    //select all
                    $dsment = Disbursement::where('disbursement_status', '2')
                            ->orderBy('dsID')
                            ->select('disbursement_tb.*')
                            ->get();

                    $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->where('tithes_offer_tb.tithes_offer_approval', '2')
                            ->orderBy('tithes_offer_tb.toID')
                            ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                            ->get();
                

                    $tithesRep2 = TithesOffer::where('member_ID', null)
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID')->get();
                    
                    $member = User::orderBy('uID')
                            ->get();

                    return view('officers.ch_report', compact('dsment', 'uAccess', 'tithesRep1', 'tithesRep2', 'member'));
                }



            }


            // ACCESS 1 - VIEW/MONITOR ONLY OR ACCESS 3 - VIEW/MONITOR TITHES AND OFFERINGS OR ACCESS 6 - EDITORS ACCESS TO TITHES AND OFFERINGS OR ACCESS 8 - ALL ACCESS

            if ($uAccess == '1' || $uAccess == '3' || $uAccess == '6' || $uAccess == '8') {

                if ($request->isMethod('post'))
                {
                    // TITHES

                    $from3 = $request->input('from3');
                    $to3 = $request->input('to3');

                    // OFFERINGS

                    $from4 = $request->input('from4');
                    $to4 = $request->input('to4');

                    $tithe1 = $request->input('tithes');
                    $offer2 = $request->input('offer');

                        // TITHES

                        if ($request->has('search_3'))
                        {
                            // select search

                            $search3 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                    ->whereBetween('tithes_offer_tb.created_at', [$from3, $to3])
                                    ->orderBy('tithes_offer_tb.toID')
                                    ->get();

                            $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                    ->whereBetween('tithes_offer_tb.created_at', [$from3, $to3])
                                    ->where('tithes_offer_tb.tithes_offer_approval', '2')
                                    ->orderBy('tithes_offer_tb.toID')
                                    ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.tithes_offer_amount', 'tithes_offer_tb.tithes_offer_type', 'tithes_offer_tb.tithes_offer_purpose', 'tithes_offer_tb.created_at')
                                    ->get();

                            $tithesRep2 = TithesOffer::where('member_ID', null)
                                    ->orderBy('toID')
                                    ->select('tithes_offer_tb.*')
                                    ->get();

                            $member = User::orderBy('uID')
                                    ->get();

                            $dsment = Disbursement::where('disbursement_status', '2')
                                    ->orderBy('dsID')
                                    ->get();
                            

                            
                            return view('officers.ch_report', compact('search3', 'tithesRep1', 'tithesRep2', 'uAccess', 'member', 'dsment'));
                        }

                        elseif ($request->has('exportPDF_3'))
                        {
                            // select PDF

                            $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                        ->whereBetween('tithes_offer_tb.created_at', [$from3, $to3])
                                        ->where('tithes_offer_tb.tithes_offer_approval', '2')
                                        ->orderBy('tithes_offer_tb.toID')
                                        ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                                        ->get();

                            $amount = TithesOffer::whereBetween('created_at', [$from3, $to3])
                                        ->sum('tithes_offer_amount');

                            $tithesRep2 = TithesOffer::where('member_ID', null)
                                        ->where('tithes_offer_approval', '2')
                                        ->orderBy('toID');

                            $pdf = PDF::loadView('officers.ch_layout_toPDF', compact('tithesRep1', 'tithesRep2', 'tithe1', 'offer2', 'uAccess', 'amount'))
                            ->setOptions(['defaultFont' => 'Arial']);
                            
                            //download PDF file with stream method
                            return $pdf->stream('tithes_report.pdf');
                        }

                        // OFFERINGS
                        
                        elseif ($request->has('search_4'))
                        {
                            // select search
                            
                            $search4 = TithesOffer::where('member_ID', null)
                                    ->where('tithes_offer_approval', '2')
                                    ->whereBetween('created_at', [$from4, $to4])
                                    ->orderBy('toID')
                                    ->get();

                            $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                    ->where('tithes_offer_tb.tithes_offer_approval', '2')
                                    ->orderBy('tithes_offer_tb.toID')
                                    ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.tithes_offer_amount', 'tithes_offer_tb.tithes_offer_type', 'tithes_offer_tb.tithes_offer_purpose', 'tithes_offer_tb.created_at')
                                    ->get();

                            $tithesRep2 = TithesOffer::where('member_ID', null)
                                    ->whereBetween('created_at', [$from4, $to4])
                                    ->orderBy('toID')
                                    ->select('tithes_offer_tb.*')
                                    ->get();

                            $member = User::orderBy('uID')
                                    ->get();

                            $dsment = Disbursement::where('disbursement_status', '2')
                                    ->orderBy('dsID')
                                    ->get();
                            
                            return view('officers.ch_report',compact('search4', 'tithesRep1', 'tithesRep2', 'uAccess', 'member', 'dsment'));
                        }

                        elseif ($request->has('exportPDF_4'))
                        {
                            // select PDF

                            $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                        ->orderBy('tithes_offer_tb.toID');
                            
                            $tithesRep2 = TithesOffer::where('member_ID', null)
                                        ->whereBetween('created_at', [$from4, $to4])
                                        ->where('tithes_offer_group_type', '2')
                                        ->where('tithes_offer_approval', '2')
                                        ->orderBy('toID')
                                        ->select('tithes_offer_tb.*')
                                        ->get();

                            $amount = TithesOffer::whereBetween('created_at', [$from4, $to4])
                                        ->sum('tithes_offer_amount');

                            $pdf = PDF::loadView('officers.ch_layout_toPDF', compact('tithesRep1', 'tithesRep2', 'tithe1', 'offer2', 'uAccess', 'amount'))
                            ->setOptions(['defaultFont' => 'Arial']);
                            
                            //download PDF file with download method
                            return $pdf->stream('offerings_report.pdf');
                        }
                    

                }

                else
                {
                    //select all
                    $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                                ->where('tithes_offer_tb.tithes_offer_approval', '2')
                                ->orderBy('tithes_offer_tb.toID')
                                ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                                ->get();
                    

                    $tithesRep2 = TithesOffer::where('member_ID', null)
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID')->get();

                    $member = User::orderBy('uID')
                            ->get();

                    $dsment = Disbursement::where('disbursement_status', '2')
                            ->orderBy('dsID')
                            ->get();

                    return view('admin.ad_reports', compact('tithesRep1', 'tithesRep2', 'uAccess', 'member', 'dsment'));
                }
            }
        }
    }

    // ETO YUNG LAYOUT PARA SA AMBAG NG KA-MEMBER
    // INDIVIDUAL MEMBERS LANG HINDI YUNG PANG LAHATAN
    // ANG PANG LAHATAN YUNG 'ch_reports' NA METHOD

    public function mem_layoutPDF(Request $request, $uID)
    {
        // select PDF

        $memPDF = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    ->where('tithes_offer_tb.member_ID', $uID)
                    ->orderBy('tithes_offer_tb.toID')
                    ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                    ->get();
        
        $pdf = PDF::loadView('officers.mem_layoutPDF', compact('memPDF'))
        ->setOptions(['defaultFont' => 'Arial']);
        
        //download PDF file with download method
        return $pdf->stream('member_tithes_report.pdf');

    }

    
     

    public function offering_edit(Request $request, $toID)
    {   
        $user = User::all();

        $offering_edit = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                    ->find($toID);

        $officer_incharge = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.toID', '=', $toID)
                    ->select('users_tb.lastname', 'users_tb.firstname')
                    ->find($toID);

        return view('admin.offering_edit', compact('offering_edit','officer_incharge', 'user' ));
    }

    public function offering_view(Request $request, $toID)
    {
        $offering_view = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                    ->find($toID);

        $officer_incharge = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.toID', '=', $toID)
                    ->select('users_tb.lastname', 'users_tb.firstname')
                    ->find($toID);

        return view('admin.offering_view', compact('offering_view','officer_incharge' ));
    }

    public function ad_register()
    {

        return view ('admin.ad_register');

    }

    

    
    // REVISION HISTORY

    public function revision_history(Request $request, $toID)
    {
        $revHistory = RevisionHistory::join('users_tb', 'users_tb.uID', '=', 'revision_tb.uID')
                    ->join('tithes_offer_tb', 'tithes_offer_tb.toID', '=', 'revision_tb.toID')
                    ->where('tithes_offer_tb.toID', $toID )
                    ->orderBy('revision_tb.revID', 'DESC')
                    ->get(['users_tb.*', 'tithes_offer_tb.*', 'revision_tb.*']);
        
        return view('admin.ad_rev_history', compact('revHistory'));
    }

        public function revision_history_disbursement(Request $request, $toID)
    {
        $revHistory = RevisionHistory::join('users_tb', 'users_tb.uID', '=', 'revision_tb.uID')
                    ->join('disbursement_tb', 'disbursement_tb.dsID', '=', 'revision_tb.toID')
                    ->where('disbursement_tb.dsID', $toID )
                    ->orderBy('revision_tb.revID', 'DESC')
                    ->get(['users_tb.*', 'disbursement_tb.*', 'revision_tb.*']);
        
        return view('admin.disbursement_revision_history', compact('revHistory'));
    }

}