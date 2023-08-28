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
use App\Models\OnlinePayment;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;
use Illuminate\Auth\Events\Registered;
use Illuminate\Support\Collection;

use App\Notifications\EmailNotification;
use Illuminate\Support\Facades\Notification;

use Pusher\Pusher;

use Image;
use PDF;
use Auth;
use Session;
use DB;
use Carbon\Carbon;

class AdminController extends Controller
{

    use RegistersUsers;

    // ADD NEW ADMIN, OFFICER, MEMBER

    public function add_new(Request $request)
    {
        date_default_timezone_set('Asia/Manila');


        $validator = Validator::make($request->all(), [
            'firstname' => 'required',
            'lastname' => 'required',
            'birthday' => 'required',
            'user_mobile_number' => 'required',
            'user_street' => 'required',
            'user_barangay' => 'required',
            'user_city' => 'required',
            'user_zip' => 'required',
            'username' => 'required|unique:users_tb',
            'email' => 'required|email|unique:users_tb',
            'password' => 'required|confirmed|min:8|',
            'user_type' => 'required',
        ]);

        if (!$validator->passes())
        {
            return response()->json(['status' => false, 'error' => $validator->errors()->toArray()]);
        }

        else
        {
            $new_user = new User();
            $new_user->firstname = request('firstname');
            $new_user->middlename = request('middlename');
            $new_user->lastname = request('lastname');
            $new_user->birthday = request('birthday');
            $new_user->user_mobile_number = request('user_mobile_number');
            $new_user->user_street = request('user_street');
            $new_user->user_barangay = request('user_barangay');
            $new_user->user_city = request('user_city');
            $new_user->user_zip = request('user_zip');
            $new_user->username = request('username');
            $new_user->email = request('email');
            $new_user->password = Hash::make(request('password'));
            $new_user->user_type = request('user_type');
            $new_user->save();

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'User';
            $Notification->notif_type = 'Added';
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

            $uID = Auth::user()->uID;

            $user_notif = User::whereIn('user_type', [1,2])
                        ->where('uID', '!=', $uID)
                        ->where('user_email_status', '=', 'On')
                        ->get();

            $notify = [
                'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added new member. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));


            return response()->json(['status' => true, 'message' => 'You added new member!']);

            
        }
        
    }

    // EDIT OFFICER ACCESS

    public function edit_officer(User $officer, $uID)
    {
        $officer = User::find($uID);

        return view('admin.edit_officer', compact('officer'));
    }


    // UPDATE ADMIN'S PROFILE PIC

    public function update_image(Request $request)
    {
    	// Handle the user upload of image
        date_default_timezone_set('Asia/Manila');


    	if ($request->hasFile('user_image')){

            request()->validate([
                'user_image' => 'required', 'image', 'mimes:jpeg,png,jpg,gif,svg', 'max:255',
            ]);
            
    		$uImg = $request->file('user_image');
    		$filename = time() . '.' . $uImg->getClientOriginalExtension();
    		Image::make($uImg)->resize(300, 300)->save('users/' . $filename);

    		$user = Auth::user();
    		$user->user_image = $filename;
    		$user->save();
    	}

    	return back();

    }


    // EDIT ADMIN'S INFO PAGE

    public function ad_edit(Request $request)
    {
        $method = $request->method();
        $uID = Auth::user()->uID;
        $log_history = Log::join('users_tb', 'users_tb.uID', '=', 'log_tb.uID')
        ->where('log_tb.uID', $uID)
        ->where('log_tb.logSTAT', '0')
        ->select('log_tb.*')
        ->orderby('log_tb.created_at', 'DESC')
        ->get();

        $active_now = User::whereNotNull('user_activity')->get();

        if ($request->isMethod('post'))
        {
            $from1 = $request->input('from1');
            $to1 = $request->input('to1');

            $users = User::where('uID', '=', $uID)
                    ->find($uID);


            if ($request->has('mem_search'))
            {

                $mem_search1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                        ->orderBy('tithes_offer_tb.toID')
                        ->get();

                $history = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        // ->where('users_tb.uID', '!=', Auth()->user()->uID)
                        ->where('tithes_offer_tb.member_ID', $uID)
                        ->where('tithes_offer_tb.tithes_offer_approval', '=', '2')
                        ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                        ->orderBy('tithes_offer_tb.toID')
                        ->select('tithes_offer_tb.*')
                        ->get();
                        
                return view('admin.ad_edit', compact('users', 'history',  'mem_search1', 'log_history'));
            }

            elseif ($request->has('export_member_tithesPDF'))
            {

                $memPDF = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->where('tithes_offer_tb.member_ID', $uID)
                            ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                            ->orderBy('tithes_offer_tb.toID')
                            ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                            ->get();
                
                $pdf = PDF::loadView('admin.mem_layoutPDF', compact('memPDF', 'users', 'log_history'))
                ->setOptions(['defaultFont' => 'Arial']);
                
                //download PDF file with download method
                return $pdf->stream('report.pdf');
            }

        }

        else
        {
            $users = User::where('uID', '=', $uID)
                ->find($uID);

            $history = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    ->where('tithes_offer_tb.member_ID', $uID)
                    ->where('tithes_offer_tb.tithes_offer_approval', '=', '2')
                    ->orderBy('tithes_offer_tb.toID')
                    ->select('tithes_offer_tb.*')
                    ->get();

            return view('admin.ad_edit', compact('users', 'history', 'log_history', 'active_now'));


        }
    }

    // UPDATE ADMIN'S INFO

    public function edit_profile($uID)
    {
        date_default_timezone_set('Asia/Manila');

        $users = User::find($uID)
                ->update([
                    'firstname' => request('firstname'),
                    'middlename' => request('middlename'),
                    'lastname' => request('lastname'),
                    'birthday' => request('birthday'),
                    'email' => request('email'),
                    'user_mobile_number' => request('user_mobile_number'),
                    'user_street' => request('user_street'),
                    'user_barangay' => request('user_barangay'),
                    'user_city' => request('user_city'),
                    'user_zip' => request('user_zip'),
                ]);



        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'User Info';
        $Notification->notif_type = 'Modified';
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

        return back();
        
    }

    // ADD TITHES 

    public function add_tithes(Request $request)
    {

        date_default_timezone_set('Asia/Manila');

            $tithe = new TithesOffer();

            $tithe->uID = Auth::user()->uID;
            $tithe->member_ID = request('uID');

            $tithe->tithes_offer_tithe_amount = request('tithes_offer_tithe_amount');
            $tithe->tithes_offer_offering_plan_amount = request('tithes_offer_offering_plan_amount');
            $tithe->tithes_offer_other_gifts_amount = request('tithes_offer_other_gifts_amount');
                      
            if(  request('tithes_offer_other_gifts_desciption') === 'Specify'){
                $tithe->tithes_offer_other_gifts_desciption =  request('other-field');
            }else{
                $tithe->tithes_offer_other_gifts_desciption =  request('tithes_offer_other_gifts_desciption');
            }

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

            if (Auth::user()->user_type == '2')
            {
                $tithe->tithes_offer_approval = 2;
            }

            else if (Auth::user()->user_type == '1')
            {
                $tithe->tithes_offer_approval = 1;
            }
            
            $tithe->tithes_offer_date = request('tithes_offer_date');
            
            $tithe->created_at = Carbon::now();
            $tithe->save();


            $record  = $tithe->toID;

        // NOTIFICATION
            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Tithes_Offering';
            $Notification->notif_type = 'Added';
            $Notification->record_id = $record;

            $Notification->created_at = Carbon::now(); 
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
                    ->where('user_email_status', '=', 'On')
                    ->get();

            $notify = [
                'body' => 'Your new record has been recorded. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

            
        // // EMAIL NOTIFICATION (ADMIN)

            $uID = Auth::user()->uID;

            $user_officer = User::whereIn('user_type', [1,2])
                ->where('uID', '!=', $uID)
                ->where('user_email_status', '=', 'On')
                ->get();

            $notify = [
                'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new record. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_officer, new EmailNotification($notify));

        // // SAVING
            
            return response()->json(['status' => true, 'message' => 'You have added new record!']);

    }
    
    // TITHE EDIT

    public function tithe_edit(Request $request, $toID)
    {   
        
        $user = User::all();

        $tithe_edit = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.member_ID')
                    ->find($toID);

        $officer_incharge = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.toID', '=', $toID)
                    ->select('users_tb.lastname', 'users_tb.firstname')
                    ->find($toID);

        return view('admin.tithe_edit', compact('tithe_edit','officer_incharge', 'user' ));
    }

       
    public function tithe_view(Request $request, $toID)
    {
        $tithe_view = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.member_ID')
                    ->find($toID);

        $officer_incharge = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.toID', '=', $toID)
                    ->select('users_tb.lastname', 'users_tb.firstname')
                    ->find($toID);


        return view('admin.tithe_view', compact('tithe_view','officer_incharge' ));
    }


       
    public function view_notification(Request $request, $nID)
    {


            $tithe_view = Notif::join('users_tb', 'users_tb.uID', '=', 'notifs.uID')
            ->select('users_tb.lastname', 'users_tb.firstname', 'notifs.*')
            ->find($nID);
            
     
        $tithe_info = Notif::join('tithes_offer_tb', 'tithes_offer_tb.toID', '=', 'notifs.record_id')
                ->leftjoin('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID'  )
                ->select('users_tb.lastname', 'users_tb.firstname', 'notifs.*', 'tithes_offer_tb.*')
                ->find($nID);

        $disbursement_info = Notif::join('disbursement_tb', 'disbursement_tb.dsID', '=', 'notifs.record_id') 
                ->select('disbursement_tb.*', 'notifs.created_at')
                ->find($nID);


        $tithe = Notif::where('nID', $nID)
                ->update([
                    'is_read' =>  '1',
                ]);


        return view('admin.view_notification', compact('tithe_view', 'tithe_info', 'disbursement_info'));
    }

    // MEMBER'S SIDE

    public function member_view_notification(Request $request, $nID)
    {
        $tithe_view = Notif::join('users_tb', 'users_tb.uID', '=', 'notifs.uID')
                ->select('users_tb.lastname', 'users_tb.firstname', 'notifs.*')
                ->find($nID);

        $tithe_info = Notif::join('tithes_offer_tb', 'tithes_offer_tb.toID', '=', 'notifs.record_id')
                ->leftjoin('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID'  )
                ->select('users_tb.lastname', 'users_tb.firstname', 'notifs.*', 'tithes_offer_tb.*')
                ->find($nID);

        $disbursement_info = Notif::join('disbursement_tb', 'disbursement_tb.dsID', '=', 'notifs.record_id') 
                ->select('disbursement_tb.*', 'notifs.created_at')
                ->find($nID);


        $tithe = Notif::where('nID', $nID)
                ->update([
                    'is_read' =>  '1',
                ]);


        return view('members.member_view_notification', compact('tithe_view', 'tithe_info', 'disbursement_info'));
    }
   

    // LIST OF DELETED TITHES AND OFFERINGS

    public function deleted_tithes_offerings()
    {
        $deleted_tithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    ->where('tithes_offer_tb.tithes_offer_status', '=', '1')
                    ->orderBy('tithes_offer_tb.toID')
                    ->get(['tithes_offer_tb.*', 'users_tb.firstname', 'users_tb.lastname']);

        $deleted_sabbath = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                    ->orderBy('tithes_offer_tb.toID')
                    ->where('tithes_offer_status' , '2')
                    ->get();

        $move_disbursement = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
                    ->where('disbursement_tb.disbursement_delete_status','=' , '1')
                    ->orderBy('disbursement_tb.uID')
                    ->get();

        $declined_member_request = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.member_ID', '!=', null)
                    ->where('tithes_offer_tb.tithes_offer_church_member_request', '=', 'Declined')
                    ->where('tithes_offer_tb.tithes_offer_approval', 0)
                    ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                    ->orderBy('tithes_offer_tb.toID')
                    ->get();

        $declined_sabbath_offering_request = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.member_ID', '=', null)
                    ->where('tithes_offer_tb.tithes_offer_approval', 0)
                    ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                    ->orderBy('tithes_offer_tb.toID')
                    ->get();
        
        
        return view('admin.deleted_tithes_offer', compact('deleted_tithe', 'deleted_sabbath', 'move_disbursement', 'declined_member_request', 'declined_sabbath_offering_request'));
   
    }


    // DELETE TITHES

    public function delete_tithe(Request $request, $toID)
    {
        date_default_timezone_set('Asia/Manila');

        $tithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_status' =>  '1',
            ]);

            $trash = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->where('tithes_offer_tb.toID', $toID)
            ->select( 'tithes_offer_tb.tithes_offer_status')
            ->get();

                $success = true;
                $message = "You can still retrive the record in the Trash!";

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Tithes_Offering';
            $Notification->notif_type = 'Move To Trash';
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

               // EMAIL NOTIFICATION (ADMIN)
    
               $uID = Auth::user()->uID;
    
               $user_officer = User::whereIn('user_type', [1,2])
                   ->where('uID', '!=', $uID)
                   ->where('user_email_status', '=', 'On')
                   ->get();
       
               $notify = [
                   'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'modified a new record from tithes and offerings. To see the changes, click the button below.',
                   'thanks' => 'Thank you!',
                   'actionText' => 'Go to Website',
                   'actionURL' => url('/'),
               ];
       
               Notification::sendNow($user_officer, new EmailNotification($notify));
       
            
            //  return response
           return response()->json([
            'success' => $success,
            'message' => $message,
        ]);
    

    }

    // RETRIEVE TITHES
    
    public function retrieve_tithe(Request $request, $toID)
    {
        $retrieve = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_status' => '0',
            ]);
       
            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Tithes_Offering';
            $Notification->notif_type = 'Retrieved';
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
       
               // EMAIL NOTIFICATION (ADMIN)
    
               $uID = Auth::user()->uID;
    
               $user_officer = User::whereIn('user_type', [1,2])
                   ->where('uID', '!=', $uID)
                   ->where('user_email_status', '=', 'On')
                   ->get();
       
               $notify = [
                   'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'retrieved a new record from tithes and offerings. To see the changes, click the button below.',
                   'thanks' => 'Thank you!',
                   'actionText' => 'Go to Website',
                   'actionURL' => url('/'),
               ];
       
               Notification::sendNow($user_officer, new EmailNotification($notify));
       
        
        return response()->json([
            'status' => true, 
            'message' => 'Your record have been successfully retrieved from the Trash!'
        ]);
    }

 
    public function retrieve_disbursement(Request $request, $dsID)
    {
        $retrieve = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
            ->where('disbursement_tb.dsID', $dsID)
            ->update([
                'disbursement_tb.disbursement_delete_status' => '0',
            ]);

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Disbursement';
            $Notification->notif_type = 'Retrieved';
            $Notification->record_id = $dsID;
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

               // EMAIL NOTIFICATION (ADMIN)
    
               $uID = Auth::user()->uID;
    
               $user_officer = User::whereIn('user_type', [1,2])
                   ->where('uID', '!=', $uID)
                   ->where('user_email_status', '=', 'On')
                   ->get();
       
               $notify = [
                   'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'retrieved a new record from disbursement. To see the changes, click the button below.',
                   'thanks' => 'Thank you!',
                   'actionText' => 'Go to Website',
                   'actionURL' => url('/'),
               ];
       
               Notification::sendNow($user_officer, new EmailNotification($notify));
       
       
        
        return response()->json(['status' => true, 'message' => 'You have retrieved the record successfully!']);
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

    public function remove_notification(Request $request, $nID)
    {
        $remove_notification = Notif::where('nID' , $nID)
            ->update([
                'is_read' => '2',  //Remove
            ]);

        return response()->json(['status' => true, 'message' => '']);
    }

    public function mark_as_read(Request $request, $nID)
    {
        $check = Notif::where('nID', $nID)->get('uID');

      
            $mark_as_read = Notif::where('nID' , $nID)
            ->update([
                'is_read' => '1', 
            ]);

        return response()->json(['status' => true, 'message' => '']);
    }


    // UPDATE TITHES

    public function update_tithes(Request $request, $toID)
    {
        
        date_default_timezone_set('Asia/Manila');
        $date = Carbon::now();
        $upTithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_tithe_amount' => request('tithes_offer_tithe_amount'),
                'tithes_offer_tb.tithes_offer_offering_plan_amount' => request('tithes_offer_offering_plan_amount'),
                'tithes_offer_tb.tithes_offer_other_gifts_amount' => request('tithes_offer_other_gifts_amount'),
                'tithes_offer_tb.tithes_offer_other_gifts_desciption' => request('tithes_offer_other_gifts_desciption'),
                'tithes_offer_tb.tithes_offer_type' => request('tithes_offer_type'),
                'tithes_offer_tb.updated_at' =>  $date,
            ]);

            $insertRevision = new RevisionHistory();
            $insertRevision->uID = Auth::user()->uID;
            $insertRevision->toID = $toID;
            $insertRevision->rev_tithe_amount = request('tithes_offer_tithe_amount');
            $insertRevision->rev_offer_amount = request('tithes_offer_offering_plan_amount');
            $insertRevision->rev_gifts_amount = request('tithes_offer_other_gifts_amount');
            $insertRevision->rev_description = request('tithes_offer_other_gifts_desciption');
            $insertRevision->rev_type = request('tithes_offer_type');
            $insertRevision->rev_date = Carbon::now();
            $insertRevision->save();


            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Tithes_Offering';
            $Notification->notif_type = 'Modified';
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

            // EMAIL NOTIFICATION (TITHER)

            $user_notif = User::whereIn('user_type', [0,1,2])
            ->where('uID', request('uID'))
            ->where('user_email_status', '=', 'On')
            ->get();

                $notify = [
                    'body' => 'Your Tithe and offering record has been modified. To see the changes, click the button below.',
                    'thanks' => 'Thank you!',
                    'actionText' => 'Go to Website',
                    'actionURL' => url('/'),
                ];
    
                Notification::sendNow($user_notif, new EmailNotification($notify));
        
            // EMAIL NOTIFICATION (ADMIN)
    
            $uID = Auth::user()->uID;
    
            $user_officer = User::whereIn('user_type', [1,2])
                ->where('uID', '!=', $uID)
                ->where('user_email_status', '=', 'On')
                ->get();
    
            $notify = [
                'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'modified a new record from tithes and offering. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];
    
            Notification::sendNow($user_officer, new EmailNotification($notify));
    

            return response()->json(['status' => true, 'message' => 'You have updated the record successfully!']);

        
        
    }

    // ALL CHURCH MEMBERS RECORDS OF TITHES
    // PWEDE MA-SEARCH DITO USING DATE RANGE THEN LALABAS LAHAT NANG AMBAG NILA AND PWEDE DEN MA-EXPORT TO PDF

    public function member_tithes(Request $request, $uID)
    {
        $method = $request->method();

        $log_history = Log::join('users_tb', 'users_tb.uID', '=', 'log_tb.uID')
                    ->where('log_tb.uID', $uID)
                    ->where('log_tb.logSTAT', '0')
                    ->select('log_tb.*')
                    ->orderby('log_tb.created_at', 'DESC')
                    ->get();

        $active_now = User::whereNotNull('user_activity')->get();

        if ($request->isMethod('post'))
        {
            $from1 = $request->input('from1');
            $to1 = $request->input('to1');

            $users = User::where('uID', '=', $uID)
                    ->find($uID);


            if ($request->has('mem_search'))
            {

                $mem_search1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                        ->orderBy('tithes_offer_tb.toID')
                        ->get();

                $history = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        // ->where('users_tb.uID', '!=', Auth()->user()->uID)
                        ->where('tithes_offer_tb.member_ID', $uID)
                        ->where('tithes_offer_tb.tithes_offer_approval', '=', '2')
                        ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                        ->orderBy('tithes_offer_tb.toID')
                        ->select('tithes_offer_tb.*')
                        ->get();
                        
                return view('admin.member_tithes', compact('users', 'history',  'mem_search1', 'log_history'));
            }

            elseif ($request->has('export_member_tithesPDF'))
            {

                $memPDF = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->where('tithes_offer_tb.member_ID', $uID)
                            ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from1, $to1])
                            ->orderBy('tithes_offer_tb.toID')
                            ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                            ->get();
                
                $pdf = PDF::loadView('admin.mem_layoutPDF', compact('memPDF', 'users', 'log_history'))
                ->setOptions(['defaultFont' => 'Arial']);
                
                //download PDF file with download method
                return $pdf->stream('report.pdf');
            }

        }

        else
        {
            $users = User::where('uID', '=', $uID)
                ->find($uID);

            $history = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    ->where('tithes_offer_tb.member_ID', $uID)
                    ->where('tithes_offer_tb.tithes_offer_approval', '=', '2')
                    ->orderBy('tithes_offer_tb.toID')
                    ->select('tithes_offer_tb.*')
                    ->get();

            return view('admin.member_tithes', compact('users', 'history', 'log_history', 'active_now'));
        }
        
    }

    // UPDATE OFFERINGS

    // public function update_offer(Request $request, $toID)
    // {

    //     if ($request->isMethod('post'))
    //     {
    //         $upOffer = TithesOffer::where('toID', $toID)
    //             ->update([
    //                 'tithes_offer_file' => null,
    //                 'tithes_offer_amount' => request('tithes_offer_amount'),
    //                 'tithes_offer_type' => request('tithes_offer_type'),
    //                 'offering_name' => request('offering_name'),
    //             ]);

    //         $insertRevision = new RevisionHistory();
    //         $insertRevision->uID = Auth::user()->uID;
    //         $insertRevision->toID = $toID;
    //         $insertRevision->revision_amount = request('tithes_offer_amount');
    //         $insertRevision->revision_offering_name = request('offering_name');
    //         $insertRevision->revision_type = request('tithes_offer_type');
    //         $insertRevision->revision_date = Carbon::now();
    //         $insertRevision->save();

    //         return redirect('/home');

    //     }
    // }
    

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

    // ADMIN AND OFFICER REGISTRATION PAGE

    public function ad_register(Request $request)
    {
        $officer = User::get();
        $member = User::orderBy('uID')->get();
        $method = $request->method();

        if ($request->isMethod('post'))
        {

            // MEMBERS

            $from1 = $request->input('from1');
            $to1 = $request->input('to1');


            // ---- MEMBERS ---- //

                if ($request->has('search_1'))
                {
                    // select search

                    $search1 = User::whereBetween('created_at', [$from1, $to1])
                            ->orderBy('uID')
                            ->get();

                    $member = User::whereBetween('created_at', [$from1, $to1])
                            ->orderBy('uID')
                            ->get();

                    
                    return view('admin.ad_register', compact('officer', 'search1', 'member'));
                }

                else if ($request->has('exportPDF_1'))
                {
                    // select PDF

                    if ($from1 == '' && $to1 == '') {

                        $exportMEM = User::get();


                        $pdf = PDF::loadView('admin.ad_layout_memPDF', compact('exportMEM'))
                        ->setOptions(['defaultFont' => 'Arial']);
                        
                        //download PDF file with stream method
                        return $pdf->stream('users_report.pdf');

                    } else {

                        $exportMEM = User::whereBetween('created_at', [$from1, $to1])
                        ->orderBy('uID')
                        ->select('users_tb.*')
                        ->get();


                        $pdf = PDF::loadView('admin.ad_layout_memPDF', compact('exportMEM'))
                        ->setOptions(['defaultFont' => 'Arial']);
                        
                        //download PDF file with stream method
                        return $pdf->stream('users_report.pdf');

                    }

                } 

            // ---- END - MEMBERS ---- //
        }

        else
        {
            //select all
            $member = User::all();

            $Users_log = Log::join('users_tb', 'users_tb.uID', '=', 'log_tb.uID')       
            // ->having(DB::raw('count(log_tb.uID)'), '<=', 1)
            ->select('users_tb.lastname', 'users_tb.firstname',  'users_tb.user_image','users_tb.user_type', 'log_tb.*',  DB::raw('MAX(log_tb.created_at) as created_at'))
            //->orderBy('tithes_offer_tb.created_at', 'ASC')
            ->groupBy('log_tb.uID')
            ->get();

            
            return view('admin.ad_register', compact('officer', 'member'));
        }

    }

    public function refresh_1(Request $request) 
    {
        return view('admin.ad_register');
    }


    // TITHES AND OFFERINGS REQUEST FOR APPROVAL

    public function ad_requests()
    {
        $reqTithes = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->where('tithes_offer_tb.tithes_offer_approval', '1')
                ->where('tithes_offer_tb.member_ID', '!=', null)
                ->where('users_tb.user_type', '!=', '0')
                ->orderBy('tithes_offer_tb.toID', 'DESC')
                ->get(['users_tb.*', 'tithes_offer_tb.*']);

        return view('admin.ad_requests', compact('reqTithes'));

    }

    // REQUEST APPROVAL

    public function approve_requests(Request $request, $toID)
    {
        $req = TithesOffer::find($toID);

        $req->tithes_offer_approval = 2;
    
        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Tithes_Offering';
        $Notification->notif_type = 'Approved';
        $Notification->record_id = $toID;
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
                ->where('uID', request('memberID'))
                ->where('user_email_status', '=', 'On')
                ->get();

        $notify = [
            'body' => 'Your new record has been recorded. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_notif, new EmailNotification($notify));
        

        // EMAIL NOTIFICATION (CO-ADMIN/ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', request('uID'))
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => 'Your new record has been approved. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));
    
    
        if($req->save()) {
            return back();
        }

    }

    // GENERATED REPORT (ADMIN)

    public function ad_reports(Request $request)
    {
        $method = $request->method();

        $user = User::all();

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


        // ---- TITHES ---- //

            if ($request->has('search_3'))
            {
                // select search
                
                $user = User::all();

                $search3 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                        ->orderBy('tithes_offer_tb.toID')
                        ->get();

                $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                        ->where('tithes_offer_tb.tithes_offer_status', '0')
                        ->where('tithes_offer_tb.tithes_offer_approval', '2')
                        ->orderBy('tithes_offer_tb.toID')
                        ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*' )
                        ->get();

                $tithesRep2 = TithesOffer::where('member_ID', null)
                        ->where('tithes_offer_approval', '2')
                        ->orderBy('toID')
                        ->select('tithes_offer_tb.*')
                        ->get();

                $member = User::orderBy('uID')
                        ->get();

                
                return view('admin.ad_report', compact('search3', 'user',  'tithesRep1', 'tithesRep2', 'member'));
            }

            else if ($request->has('exportPDF_3'))
            {
                // select PDF
                
                $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                            ->where('tithes_offer_tb.tithes_offer_status', '0')
                            ->where('tithes_offer_tb.tithes_offer_approval', '2')
                            ->orderBy('tithes_offer_tb.toID')
                            ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                            ->get();

                // $amount = TithesOffer::whereBetween('created_at','tithes_offer_tithe_amount', 'tithes_offer_offering_plan_amount', 'tithes_offer_other_gifts_amount' [$from3, $to3])
                //             ->sum(['tithes_offer_tithe_amount', 'tithes_offer_offering_plan_amount', 'tithes_offer_other_gifts_amount');

                $tithesRep2 = TithesOffer::where('member_ID', null)
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID');

                $pdf = PDF::loadView('admin.ad_layout_toPDF', compact('tithesRep1', 'tithesRep2', 'tithe1', 'offer2'))
                ->setOptions(['defaultFont' => 'Arial']);
                
                //download PDF file with stream method
                return $pdf->stream('tithes_report.pdf');
            }

        // ---- END - TITHES ---- //


        // ---- OFFERINGS ---- //

            else if ($request->has('search_4'))
            {
                // select search

                $user = User::all();

                $search4 = TithesOffer::where('member_ID', null)
                        ->where('tithes_offer_approval', '2')
                        ->whereBetween('tithes_offer_date', [$from4, $to4])
                        ->orderBy('toID')
                        ->get();

                $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                        ->where('tithes_offer_tb.tithes_offer_approval', '2')
                        ->orderBy('tithes_offer_tb.toID')
                        ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.tithes_offer_amount', 'tithes_offer_tb.tithes_offer_type', 'tithes_offer_tb.tithes_offer_purpose', 'tithes_offer_tb.created_at')
                        ->get();

                $tithesRep2 = TithesOffer::where('member_ID', null)
                        ->whereBetween('tithes_offer_date', [$from4, $to4])
                        ->where('tithes_offer_approval', '2')
                        ->orderBy('toID')
                        ->select('tithes_offer_tb.*')
                        ->get();

                $member = User::orderBy('uID')
                        ->get();
                
                return view('admin.ad_report', compact('search4', 'user', 'tithesRep1', 'tithesRep1', 'tithesRep2', 'member'));
            }

            else if ($request->has('exportPDF_4'))
            {
                // select PDF

                $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->orderBy('tithes_offer_tb.toID');
                
            
                $tithesRep2 = TithesOffer::where('member_ID', null)
                            ->whereBetween('tithes_offer_date', [$from4, $to4])
                            ->where('tithes_offer_group_type', '2')
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID')
                            ->select('tithes_offer_tb.*')
                            ->get();

                $amount = TithesOffer::whereBetween('tithes_offer_date', [$from4, $to4])
                            ->sum('tithes_offer_amount');

                $pdf = PDF::loadView('admin.ad_layout_toPDF', compact('tithesRep1',  'tithesRep2', 'tithe1', 'offer2', 'amount'))
                ->setOptions(['defaultFont' => 'Arial']);
                
                //download PDF file with download method
                return $pdf->stream('offerings_report.pdf');
            }

        // ---- END - OFFERINGS ---- //

        }

        else
        {
            //select all
            $uID = Auth::user()->uID;

            $user = User::where('user_type', '=', '0')->orderBy('firstname')->get();

            $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    ->where('tithes_offer_tb.tithes_offer_approval', '2')
                    ->where('tithes_offer_tb.tithes_offer_status', '0')
                    ->where('user_type', '=', '0')
                    ->orderBy('tithes_offer_tb.toID','DESC')
                    ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                    ->get();


            $tithesRep2 = TithesOffer::where('member_ID', null)
                    ->where('tithes_offer_approval', '2')
                    ->orderBy('toID','DESC')
                    ->get();

            
            $member = User::orderBy('uID','DESC')
                    ->get();

            return view('admin.ad_report', compact('member', 'user', 'tithesRep1', 'tithesRep2'));
        }
        

    }


    // ACTIVATE OFFICER'S ACCOUNT

    public function activate_officer(User $officer, $uID)
    {

        $officer = User::find($uID);
        $officer->user_status = 0;
        $officer->save();

        return back();

    }

    // DEACTIVATE OFFICER'S ACCOUNT
    
    public function deactivate_officer(User $officer, $uID)
    {

        $officer = User::find($uID);
        $officer->user_status = 1;
        $officer->save();

        return back();

    }

    // SETTINGS

    public function ad_setting() {

        return view('admin.ad_setting');

    }

    public function ad_change_pass()
    {
        return view('admin.ad_change_pass');
    }


    public function create(Request $request)
    {
        $method = $request->method();

        if($request->isMethod('post'))
        {
            // $search = strtoupper($request->input('search'));
            $search = $request->input('search');

            if (!empty($search) ) {

                $search2 = strtolower($search);

                if (($search2 == 'home') || ($search2 == 'homepage')  || ($search2 == 'home page') || ($search2 == 'dashboard')) {

                    return redirect('/home#Dashboard');

                } else if (($search2 == 'contributor') || ($search2 == 'contributors') || ($search2 == 'recent contributor') || ($search2 == 'recent contributors')  
                || ($search2 == 'frequent contributor') || ($search2 == 'frequent contributors')  || ($search2 == 'lapsed contributor') || ($search2 == 'lapsed contributors')
                || ($search2 == 'frequnt') || ($search2 == 'lapsed')  || ($search2 == 'first time') || ($search2 == 'first-time') || ($search2 == '1st time') || ($search2 == '1st-time')) {

                    return redirect('/home#Contributors');

                } else if ($search2 == 'trash' || ($search2 == 'retrieve')|| ($search2 == 'retrieve trash') || ($search2 == 'retrieve record') || ($search2 == 'retrieve records')
                || ($search2 == 'restore')|| ($search2 == 'restore trash') || ($search2 == 'restore record') || ($search2 == 'restore records')) {

                    return redirect('/deleted_tithes_offerings#Trash');

                } elseif ($search2 == 'tithe' || ($search2 == 'tithes') || ($search2 == 'offerings') || ($search2 == 'tithes & offerings') || ($search2 == 'tithes and offerings') ) {

                    return redirect('/ad_reports#Tithes');

                } elseif ($search2 == 'sabath' || ($search2 == 'sabbath') || ($search2 == 'sabbath offering') || ($search2 == 'sabbath offerings') 
                || ($search2 == 'sabbathoffering') || ($search2 == 'sabbathofferings') ) {

                    return redirect('/sabbath_offering#Sabbath');

                } elseif (($search2 == 'disburse') || ($search2 == 'disbursement') || ($search2 == 'disbursement record') || ($search2 == 'disbursement report') 
                || ($search2 == 'disbursementrecord') || ($search2 == 'disbursementreport') ) {
                    
                    return redirect('/disbursement_report#Disburse');
                
                } elseif (($search2 == 'profile') || ($search2 == 'myprofile') || ($search2 == 'my profile') || ($search2 == 'photo') || ($search2 == 'editprofile') || ($search2 == 'edit profile')) {
                    
                    return redirect('/edit_profile#Profile');

                } elseif (($search2 == 'member') || ($search2 == 'members') || ($search2 == 'churchmember') || ($search2 == 'churchmembers') || ($search2 == 'church member') || ($search2 == 'church members') 
                || ($search2 == 'member list') || ($search2 == 'member lists') || ($search2 == 'memberlist') || ($search2 == 'memberlists') ) {
                    
                    return redirect('/church_members');

                } elseif (($search2 == 'setting') || ($search2 == 'info') || ($search2 == 'personalinfo') || ($search2 == 'personal info') || ($search2 == 'password') 
                || ($search2 == 'changepassword')  || ($search2 == 'change password') || ($search2 == 'editpassword')  || ($search2 == 'edit password') || ($search2 == 'edit password') ) {
                    
                    return redirect('/ad_setting#Settings');
                
                } elseif (($search2 == 'offering') || ($search2 == 'offerings') || ($search2 == 'memberoffering') || ($search2 == 'member offering') || ($search2 == 'membersoffering') || ($search2 == 'members offering')) {
                    
                    return redirect('/ad_reports#Tithes');
                
                } elseif (($search2 == 'online') || ($search2 == 'payment') || ($search2 == 'onlinepayment') || ($search2 == 'online payment')
                || ($search2 == 'addpayment') || ($search2 == 'add payment') || ($search2 == 'gcash') || ($search2 == 'bank') ) {
                    
                    return redirect('/online_payment_details');
                
                } else {  
                    
                    return view('admin.search')->with('search', $search2);
                }
            
            } else {

                $search = 'No Input';

                return view('admin.search')->with('search', $search);
            }
        }
        
    }

    // CO-ADMIN SIDE = CHURCH MEMBER'S TITHES/OFFERINGS REQUEST

    public function tithes_offerings_requests()
    {

        $member_request = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->where('tithes_offer_tb.tithes_offer_church_member_request', '=', 'Pending')
                ->where('tithes_offer_tb.tithes_offer_approval', 1)
                ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*')
                ->orderBy('tithes_offer_tb.toID', 'DESC')
                ->get();

        return view('admin.co_admin_member_request', compact('member_request'));

    }

    public function approve_member_request(Request $request, $toID)
    {
        $req = TithesOffer::find($toID);

        if (Auth::user()->user_type == '2')
        {
            $req->tithes_offer_approval = 2;
            $req->tithes_offer_church_member_request = "Approved";
            $req->tithes_offer_admin_action = "Reviewed";
        }

        if (Auth::user()->user_type == '1')
        {
            $req->tithes_offer_church_member_request = "For Approval";
        }

        $req->tithes_offer_approved_by = Auth::user()->uID;
        $req->tithes_offer_user_type = Auth::user()->user_type;


        $record  = $req->toID;

        $member = $req->member_ID;

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->member_ID = $member;
        $Notification->is_read = '0';
        $Notification->record_id = $record;
        
        $id = $Notification->uID;
        $Notification->type =  "Tithes_Offering";

        if (Auth::user()->user_type == '1')
        {
            $Notification->notif_type = 'For Approval';
        }

        else if (Auth::user()->user_type == '2')
        {
            $Notification->notif_type = 'Approved';
        }


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


        $memberID = request('memberID');

       
        // EMAIL NOTIFICATION (ADMIN)

        if (Auth::user()->user_type == '1')
        {
            // TITHER

            $user_notif = User::where('user_type', '0')
                ->where('uID', '=', $memberID)
                ->where('user_email_status', '=', 'On')
                ->get();

            $notify = [
                'body' => 'Your request has been checked but needs an approval. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

            // ADMIN

            $user_officer = User::where('user_type', '2')
                        ->where('user_email_status', '=', 'On')
                        ->get();

            $notify = [
                'body' => Auth::user()->firstname." ".Auth::user()->lastname." "."sent a request for approval. To see the changes, click the button below.",
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_officer, new EmailNotification($notify));

        }

        else if (Auth::user()->user_type == '2')
        {
            // TITHER

            $user_notif = User::where('user_type', '0')
                ->where('uID', '=', $memberID)
                ->where('user_email_status', '=', 'On')
                ->get();

            $notify = [
                'body' => 'Your request has been approved. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

            // CO-ADMIN

            $user_officer = User::where('user_type', '1')
                        ->where('user_email_status', '=', 'On')
                        ->get();

            $notify = [
                'body' => Auth::user()->firstname." ".Auth::user()->lastname." "."approved new church member's request. To see the changes, click the button below.",
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_officer, new EmailNotification($notify));

        }

        if($req->save()) {

            return back();
        }

    }

    public function decline_member_request(Request $request, $toID)
    {
        $req = TithesOffer::find($toID);

        if (Auth::user()->user_type == '2' || Auth::user()->user_type == '1')
        {
            $req->tithes_offer_approval = 0;
            $req->tithes_offer_church_member_request = "Declined";
            $req->tithes_offer_user_type = Auth::user()->user_type;
        }

        $record  = $req->toID;

        $member = $req->member_ID;

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->member_ID = $member;
        $Notification->is_read = '0';
        $Notification->record_id = $record;
        
        $id = $Notification->uID;
        $Notification->type =  "Tithes_Offering";

        $Notification->notif_type = 'Declined';

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


        $memberID = request('memberID');

       
        // EMAIL NOTIFICATION (ADMIN)

        if (Auth::user()->user_type == '1')
        {
            // TITHER

            $user_notif = User::where('user_type', '0')
                ->where('uID', '=', $memberID)
                ->where('user_email_status', '=', 'On')
                ->get();

            $notify = [
                'body' => 'Your request has been declined. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

            // ADMIN

            $user_officer = User::where('user_type', '2')
                        ->where('user_email_status', '=', 'On')
                        ->get();

            $notify = [
                'body' => Auth::user()->firstname." ".Auth::user()->lastname." "."declined church member's request. To see the changes, click the button below.",
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_officer, new EmailNotification($notify));

        }

        else if (Auth::user()->user_type == '2')
        {
            // TITHER

            $user_notif = User::where('user_type', '0')
                ->where('uID', '=', $memberID)
                ->where('user_email_status', '=', 'On')
                ->get();

            $notify = [
                'body' => 'Your request has been declined. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

            // CO-ADMIN

            $user_officer = User::where('user_type', '1')
                        ->where('user_email_status', '=', 'On')
                        ->get();

            $notify = [
                'body' => Auth::user()->firstname." ".Auth::user()->lastname." "."declined church member's request. To see the changes, click the button below.",
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_officer, new EmailNotification($notify));

        }

        if($req->save()) {

            return back();
        }

    }

    public function retrieve_member_request(Request $request, $toID) 
    {

        $req = TithesOffer::find($toID);

        $req->tithes_offer_approval = '1';
        $req->tithes_offer_church_member_request = 'Pending';
    

        $record  = $req->toID;       

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
         $Notification->record_id = $record;
        
        $id = $Notification->uID;
        $Notification->type =  "Tithes_Offering";
        $Notification->notif_type = 'Retrieved';
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
    
    
        if($req->save()) {
             return response()->json(['status' => true, 'message' => 'You have updated the record successfully!']);
        }

    }

    public function update_member_info(Request $request, $uID)
    {

        $users = User::find($uID)
                ->update([
                    'firstname' => request('firstname'),
                    'middlename' => request('middlename'),
                    'lastname' => request('lastname'),
                    'birthday' => request('birthday'),
                    'email' => request('email'),
                    'user_mobile_number' => request('user_mobile_number'),
                    'user_street' => request('user_street'),
                    'user_barangay' => request('user_barangay'),
                    'user_city' => request('user_city'),
                    'user_zip' => request('user_zip'),
                ]);


        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'User Info';
        $Notification->notif_type = 'Modified';
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

        // EMAIL NOTIFICATION (OWNER)

        $user_notif = User::whereIn('user_type', [0,1,2])
        ->where('uID', '=', $uID)
        ->where('user_email_status', '=', 'On')
        ->get();

            $notify = [
                'body' => 'Your personal information has been modified. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

        
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname." ".Auth::user()->lastname." "."modified a member's information. To see the changes, click the button below.",
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        return response()->json(['status' => true, 'message' => 'You have updated the record successfully!']);

    }

    public function online_payment_details()
    {
        $gcash_records = OnlinePayment::where('on_type', '=', 'GCash')
                        ->where('on_delete_status', '=', 'Active')
                        ->get();

        $bank_records = OnlinePayment::where('on_type', '=', 'Bank')
                        ->where('on_delete_status', '=', 'Active')
                        ->get();
        
        return view('admin.ad_online_payment', compact('gcash_records', 'bank_records'));
    }

    public function upload_online_payment_details(Request $request) 
    {
        $new_pay = new OnlinePayment();
        $new_pay->uID = Auth::user()->uID;
        $new_pay->on_type = request('on_type');

        if ($request->file('on_gcash_image') == NULL)
        {
            $new_pay->on_gcash_image = 'no-image-found.png';
        }
        
        else
        {
            $on_gcash_image = $request->file('on_gcash_image');
            $filename = time() . '.' . $on_gcash_image->getClientOriginalExtension();
            Image::make($on_gcash_image)->resize(300, 300)->save( public_path('payments/' . $filename) );

            $new_pay->on_gcash_image = $filename;
        }
        
        $new_pay->on_account_name = request('on_account_name');
        $new_pay->on_contact_number = request('on_contact_number');
        $new_pay->on_bank_name = request('on_bank_name');
        $new_pay->on_bank_account_number = request('on_bank_account_number');

        $new_pay->save();
    
        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->notif_type = 'Online Payment Added';
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

        return response()->json(["status" => true, "message" => "Thank you! You have added new online payment details!"]);
    }

    public function visible_online_payment(Request $request, $oID)
    {
        $pay = OnlinePayment::find($oID)
            ->update([
                "on_status" => "Visible",
            ]);

        return back();

    }

    public function hide_online_payment(Request $request, $oID)
    {
        $pay = OnlinePayment::find($oID)
            ->update([
                "on_status" => "Hidden",
            ]);

        return back();

    }

    public function co_admin_request()
    {
       


        $co_admin_req = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.tithes_offer_approved_by')
                ->where('tithes_offer_tb.tithes_offer_approval', '1')
                ->where('tithes_offer_tb.tithes_offer_church_member_request', '=', 'For Approval')
                ->where('users_tb.user_type', '!=', '0')
                ->orderBy('tithes_offer_tb.toID', 'DESC')
                ->get(['users_tb.*', 'tithes_offer_tb.*']);

        $giver = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                ->where('tithes_offer_tb.tithes_offer_approval', '1')
                ->orderBy('tithes_offer_tb.toID', 'DESC')
                ->get(['users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*']);

        return view('admin.co_admin_requests', compact('co_admin_req', 'giver'));
    }

    public function co_admin_for_approval_page()
    {
        $co_admin_req = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    ->where('tithes_offer_tb.tithes_offer_approved_by', '=', Auth::user()->uID)
                    ->where('tithes_offer_tb.tithes_offer_church_member_request', '=', 'For Approval')
                    ->select('users_tb.*', 'tithes_offer_tb.*')
                    ->get();
    

        return view('admin.co_admin_for_approval', compact('co_admin_req'));
    }

    public function approve_co_admin_request(Request $request, $toID)
    {

        $req = TithesOffer::find($toID);

        $req->tithes_offer_approval = "2";
        $req->tithes_offer_church_member_request = "Approved";
        $req->tithes_offer_admin_action = "Reviewed";
    
        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        

        $record = $req->toID;
        
        $id = $Notification->uID;
        $Notification->type =  "Tithes_Offering";
        $Notification->notif_type = 'Approved';
        $Notification->record_id = $record;
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

        // EMAIL NOTIFICATION (OWNER)

        $user_notif = User::where('user_type', 0)
        ->where('uID', request('member_ID'))
        ->where('user_email_status', '=', 'On')
        ->get();

            $notify = [
                'body' => 'Your tithe has been approved and recorded. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

        
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::where('user_type', 1)
            ->where('uID', request('co_admin_uID'))
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => "Your request has been approved. To see the changes, click the button below.",
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));
    
    
        if($req->save()) {
            return back();
        }

    }

    public function email_status(Request $request, $uID)
    {
        $user_email_status = User::find($request->uID);
        $user_email_status->user_email_status = $request->user_email_status;
        $user_email_status->save();
                        

       return response()->json(['success'=>'User email status change successfully.']);
    }

    public function delete_online_payment(Request $request, $oID)
    {

        $delete = OnlinePayment::find($oID)
            ->update([
                "on_delete_status" => request('on_delete_status'),
            ]);

        return back();

    }




public function sabbath_offering(Request $request)
    {
        $method = $request->method();

        if ($request->isMethod('post'))
        {

            $from3 = $request->input('from3');
            $to3 = $request->input('to3');


            if ($request->has('search_3'))
            {
                    // select search
                  

                    $search3 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                            ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                            ->orderBy('tithes_offer_tb.toID')
                            ->get();
                    
                    // $tithesRep1 = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.member_ID')
                    //         ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                    //         ->where('tithes_offer_tb.tithes_offer_status', '0')
                    //         ->where('tithes_offer_tb.tithes_offer_approval', '2')
                    //         ->orderBy('tithes_offer_tb.toID')
                    //         ->select('users_tb.firstname', 'users_tb.lastname', 'tithes_offer_tb.*' )
                    //         ->get();

                    $sabbath = TithesOffer::where('member_ID', null)
                            ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID')
                            ->select('tithes_offer_tb.*')
                            ->get();
                    
                    return view('admin.sabbath_offering', compact('search3', 'sabbath'));
            }

                else if ($request->has('exportPDF_3'))
            {
                // select PDF
                

                // $amount = TithesOffer::whereBetween('created_at','tithes_offer_tithe_amount', 'tithes_offer_offering_plan_amount', 'tithes_offer_other_gifts_amount' [$from3, $to3])
                //             ->sum(['tithes_offer_tithe_amount', 'tithes_offer_offering_plan_amount', 'tithes_offer_other_gifts_amount');

                $sabbath = TithesOffer::where('member_ID', null)
                            ->whereBetween('tithes_offer_tb.tithes_offer_date', [$from3, $to3])
                            ->where('tithes_offer_approval', '2')
                            ->orderBy('toID')
                            ->select('tithes_offer_tb.*')
                            ->get();

                $pdf = PDF::loadView('admin.ad_layout_sabbathPDF', compact('sabbath'))
                ->setOptions(['defaultFont' => 'Arial']);
                
                //download PDF file with stream method
                return $pdf->stream('sabbath_offerings_report.pdf');
            }

            

        }
        else
            {
                //select all
    
                $sabbath = TithesOffer::where('member_ID', null)
                            ->where('tithes_offer_approval', '2')
                            ->where('tithes_offer_status', '0')
                            ->orderBy('toID', 'DESC')
                            ->select('tithes_offer_tb.*')
                            ->get();
                
                $member = User::orderBy('uID')
                        ->get();
    
                return view('admin.sabbath_offering', compact('member', 'sabbath'));
            }
    }


public function sabbath_edit(Request $request, $toID)
{   
    $user = User::all();

    $sabbath_edit = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                ->find($toID);

    $officer_incharge = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                ->where('tithes_offer_tb.toID', '=', $toID)
                ->find($toID);

    return view('admin.sabbath_edit', compact('sabbath_edit','officer_incharge', 'user' ));
}

   
public function sabbath_view(Request $request, $toID)
{
    $sabbath_view = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                ->find($toID);

    $officer_incharge = TithesOffer::join('users_tb', 'users_tb.uID',  '=', 'tithes_offer_tb.uID')
                ->where('tithes_offer_tb.toID', '=', $toID)
                ->find($toID);


    return view('admin.sabbath_view', compact('sabbath_view','officer_incharge' ));
}

public function sabbath_update(Request $request, $toID)
{
    
    date_default_timezone_set('Asia/Manila');
    $date = Carbon::now();
    $upTithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
        ->where('tithes_offer_tb.toID', $toID)
        ->update([
            'tithes_offer_tb.tithes_offer_offering_plan_amount' => request('tithes_offer_offering_plan_amount'),
            'tithes_offer_tb.tithes_offer_other_gifts_desciption' => request('tithes_offer_other_gifts_desciption'),
            'tithes_offer_tb.tithes_offer_type' => request('tithes_offer_type'),
            'tithes_offer_tb.updated_at' =>  $date,
        ]);

        $insertRevision = new RevisionHistory();
        $insertRevision->uID = Auth::user()->uID;
        $insertRevision->toID = $toID;
        $insertRevision->rev_offer_amount = request('tithes_offer_offering_plan_amount');
        $insertRevision->rev_description = request('tithes_offer_other_gifts_desciption');
        $insertRevision->rev_type = request('tithes_offer_type');
        $insertRevision->rev_date = Carbon::now();
        $insertRevision->save();


        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Sabbath Offering';
        $Notification->notif_type = 'Modified';
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

        // EMAIL NOTIFICATION (TITHER)


        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')

            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'modified a new record from sabbath offering. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify)); 

        
        return response()->json(['status' => true, 'message' => 'You have updated the record successfully!']);
    
}

public function sabbath_revision_history(Request $request, $toID)
{

    $revHistory = RevisionHistory::join('users_tb', 'users_tb.uID', '=', 'revision_tb.uID')
                ->join('tithes_offer_tb', 'tithes_offer_tb.toID', '=', 'revision_tb.toID')
                ->where('tithes_offer_tb.toID', $toID )
                ->orderBy('revision_tb.revID', 'DESC')
                ->get(['users_tb.*', 'tithes_offer_tb.*', 'revision_tb.*']);
    
    return view('admin.sabbath_revision_history', compact('revHistory'));
}

public function delete_sabbath(Request $request, $toID)
    {
        $tithe = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_status' =>  '2',
            ]);

            $trash = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
            ->where('tithes_offer_tb.toID', $toID)
            ->select( 'tithes_offer_tb.tithes_offer_status')
            ->get();

                $success = true;
                $message = "You can still retrive the record in the Trash!";

            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Sabbath Offering';
            $Notification->notif_type = 'Move To Trash';
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

            return response()->json([ 'success' => $success,   'message' => $message,]);

               // EMAIL NOTIFICATION (ADMIN)
    
               $uID = Auth::user()->uID;
    
               $user_officer = User::where('user_type', [1,2])
                   // ->whereIn('user_access', [3,6,8])
                   ->where('uID', '!=', $uID)
                   ->get();
       
               $notify = [
                   'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'move a new record from sabbath offering to trash. To see the changes, click the button below.',
                   'thanks' => 'Thank you!',
                   'actionText' => 'Go to Website',
                   'actionURL' => url('/'),
               ];
       
               Notification::sendNow($user_officer, new EmailNotification($notify));
       
            
            //  return response
         
    }

     public function retrieve_sabbath(Request $request, $toID)
    {
        $retrieve = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
            ->where('tithes_offer_tb.toID', $toID)
            ->update([
                'tithes_offer_tb.tithes_offer_status' => '0',
            ]);
       
            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Sabbath Offering';
            $Notification->notif_type = 'Retrieved';
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
       
        return response()->json([
                'status' => true, 
                'message' => 'Your record have been successfully retrieved from the Trash!'
            ]);
                // EMAIL NOTIFICATION (ADMIN)
    
               $uID = Auth::user()->uID;
    
               $user_officer = User::whereIn('user_type', [1,2])
                   ->where('uID', '!=', $uID)
                   ->where('user_email_status', '=', 'On')
                   ->get();
       
               $notify = [
                   'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'retrieved a new record from tithes and offerings. To see the changes, click the button below.',
                   'thanks' => 'Thank you!',
                   'actionText' => 'Go to Website',
                   'actionURL' => url('/'),
               ];
       
               Notification::sendNow($user_officer, new EmailNotification($notify));
       
        
        
    }


    public function disbursement_report(Request $request)
    {

        // DISBURSEMENT

        $method = $request->method();
        $user = User::all();

        $from2 = $request->input('from2');
        $to2 = $request->input('to2');

        if ($request->has('search_2'))
        {
            // select search

            $search2 = Disbursement::whereBetween('disbursement_date', [$from2, $to2])
                    ->orderBy('dsID')
                    ->get();

            $dsment = Disbursement::whereBetween('disbursement_date', [$from2, $to2])
                    ->where('disbursement_delete_status', '0')
                    ->orderBy('dsID')
                    ->get();

            $member = User::orderBy('uID')
                    ->get();
            
            return view('admin.disbursement_report', compact('search2', 'dsment', 'member'));
        }

        else if ($request->has('exportPDF_2'))
        {
            // select PDF

            $exportDSMENT = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
                            ->whereBetween('disbursement_tb.disbursement_date', [$from2, $to2])
                            ->orderBy('disbursement_tb.dsID')
                            ->select('disbursement_tb.*', 'users_tb.firstname', 'users_tb.lastname')
                            ->get();

            $pdf = PDF::loadView('admin.ad_layout_disbursePDF', compact('exportDSMENT'))
            ->setOptions(['defaultFont' => 'Arial']);
            
            //download PDF file with stream method
            return $pdf->stream('disbursement_report.pdf');
        }

        else
        {
            //select all

            $user = User::all();


            $dsment = Disbursement::where('disbursement_delete_status', '0')
                    ->orderBy('dsID', 'DESC')
                    ->select('disbursement_tb.*')
                    ->get();


            $member = User::orderBy('uID')
                    ->get();

        }
      
        return view('admin.disbursement_report', compact('member', 'user', 'dsment'));
    }

    public function ch_disbursement()
    {
      
        $disbursement = Disbursement::where('disbursement_delete_status', '0')->get();

        return view('admin.disbursement_report',  compact('disbursement'));

    }

    public function ch_add_disbursement()
    {
        $uAccess = Auth::user()->user_access;

        return view('admin.ch_add_disbursement', compact('uAccess'));
    }

    // Add Record

    public function store_new(Request $request)
    {
        
        $disbursement = new Disbursement();
        $disbursement->uID = request('uID');
        $disbursement->disbursement_purpose = request('disbursement_purpose');
        $disbursement->disbursement_amount = request('disbursement_amount');
        $disbursement->disbursement_description = request('disbursement_description');
        $disbursement->disbursement_type_status = request('disbursement_type_status');
        $disbursement->disbursement_delete_status = 0;
        $disbursement->disbursement_date = request('disbursement_date');
    
        if(  request('disbursement_purpose') === 'type'){
            $disbursement->disbursement_purpose =  request('purpose-field');
        }else{
            $disbursement->disbursement_purpose =  request('disbursement_purpose');
        }

        if(  request('disbursement_type_status') === 'others'){
            $disbursement->disbursement_type_status =  request('status-field');
        }else{
            $disbursement->disbursement_type_status =  request('disbursement_type_status');
        }
        $disbursement->save();

        $disbursement_id = $disbursement->dsID;
        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Disbursement';
        $Notification->notif_type = 'Added';
        $Notification->record_id = $disbursement_id;
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
                ->where('user_email_status', '=', 'On')
                ->get();

        $notify = [
            'body' => 'Your disbursement has been recorded. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_notif, new EmailNotification($notify));

        
        
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'added a new disbursement record. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

       

            return response()->json(['status' => true, 'message' => 'You have added new disbursement record!']);
        

    }

    public function disbursement_view(Disbursement $disbursement, $dsID)
    {
        $disbursement = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
                    ->find($dsID);

        return view('admin.disbursement_view', compact('disbursement'));
    }

    public function disbursement_edit(Disbursement $disbursement, $dsID)
    {
        $disbursement = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
                    ->find($dsID);

        return view('admin.disbursement_edit', compact('disbursement'));
        
    }

    // Approved Disbursements 

    public function update_disbursement($dsID)
    {

        date_default_timezone_set('Asia/Manila');

        $disbursement = Disbursement::find($dsID);
      
        $disbursement->disbursement_type_status = request('disbursement_type_status');
        $disbursement->updated_at = request('updated_at');

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Disbursement Record';
        $Notification->notif_type = 'Approved';
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

        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'approved pending disbursement request. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));


        if ($disbursement->save()) {

            return response()->json(['status' => true, 'message' => 'Thank you! You have approved pending disbursement request!']);
        
        }

    }

    // Editing / Updating Record 

    public function ch_updating_image(Request $request, $dsID)
    {

        date_default_timezone_set('Asia/Manila');
        $disbursement = Disbursement::find($dsID);

        if (request('disbursement_hide')) {
            $disbursement_add = request('disbursement_hide');
        } else if (request('disbursement_purpose')) {
            $disbursement_add = request('disbursement_purpose');
        }

        $disbursement->disbursement_purpose =  $disbursement_add;
        $disbursement->disbursement_amount = request('disbursement_amount');
        $disbursement->disbursement_type_status = request('disbursement_type_status');     
        $disbursement->disbursement_description = request('disbursement_description');
        $disbursement->updated_at = request('updated_at');

        $insertRevision = new RevisionHistory();
        $insertRevision->uID = Auth::user()->uID;
        $insertRevision->toID = $dsID;
        $insertRevision->disbursement_department = $disbursement_add;
        $insertRevision->disbursement_amount = request('disbursement_amount');
        $insertRevision->disbursement_description = request('disbursement_description');
        // $insertRevision->rev_type =  $disbursement_add;
        $insertRevision->rev_date = Carbon::now();
        $insertRevision->save();

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Disbursement Record';
        $Notification->notif_type = 'Modified';
        $Notification->record_id = $dsID;
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

        
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'modified a record from disbursement. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        if ($disbursement->save()) {

            return response()->json(['status' => true, 'message' => 'You have modified a disbursement record successfully']);
        
        }

    }
    

    // Remove Record

    public function remove_disbursement(Request $request, $dsID)
    {
        $tithe = Disbursement::find($dsID);
        $tithe->disbursement_delete_status = 1;

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Disbursement Record';
        $Notification->notif_type = 'Move To Trash';
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

        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'moved disbursement record to trash. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));


        if ($tithe->save()) {

            return response()->json(['status' => true, 'message' => '']);
        
        }

    }

    public function get_member_details() {

        return view('members.mem_setting');

    }

    public function update_member_details(Request $request, $uID)
    {

        $users = User::find($uID)
                ->update([
                    'firstname' => request('firstname'),
                    'middlename' => request('middlename'),
                    'lastname' => request('lastname'),
                    'birthday' => request('birthday'),
                    'email' => request('email'),
                    'user_mobile_number' => request('user_mobile_number'),
                    'user_street' => request('user_street'),
                    'user_barangay' => request('user_barangay'),
                    'user_city' => request('user_city'),
                    'user_zip' => request('user_zip'),
                ]);


        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'User Info';
        $Notification->notif_type = 'Modified';
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

        // EMAIL NOTIFICATION (OWNER)

        $user_notif = User::whereIn('user_type', [0,1,2])
        ->where('uID', '=', $uID)
        ->where('user_email_status', '=', 'On')
        ->get();

            $notify = [
                'body' => 'Your personal information has been modified. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

        
        // EMAIL NOTIFICATION (ADMIN)

        $uID = Auth::user()->uID;

        $user_officer = User::whereIn('user_type', [1,2])
            ->where('uID', '!=', $uID)
            ->where('user_email_status', '=', 'On')
            ->get();

        $notify = [
            'body' => Auth::user()->firstname." ".Auth::user()->lastname." "."modified a member's information. To see the changes, click the button below.",
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_officer, new EmailNotification($notify));

        return response()->json(['status' => true, 'message' => 'You have updated the record successfully!']);

    }


    public function add_offering(Request $request)
    {

        date_default_timezone_set('Asia/Manila');

            $tithe = new TithesOffer();

            $tithe->uID = Auth::user()->uID;

            $tithe->tithes_offer_offering_plan_amount = request('tithes_offer_offering_plan_amount');
            $tithe->tithes_offer_other_gifts_amount = request('tithes_offer_other_gifts_amount');
                      
            if(  request('tithes_offer_other_gifts_desciption') === 'Specify'){
                $tithe->tithes_offer_other_gifts_desciption =  request('other-field');
            }else{
                $tithe->tithes_offer_other_gifts_desciption =  request('tithes_offer_other_gifts_desciption');
            }

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

            if (Auth::user()->user_type == '2')
            {
                $tithe->tithes_offer_approval = 2;
            }

            else if (Auth::user()->user_type == '1')
            {
                $tithe->tithes_offer_approval = 1;
            }
            
            $tithe->tithes_offer_date = request('tithes_offer_date');
            
            $tithe->save();


            $record  = $tithe->toID;

        // NOTIFICATION
            $Notification = new Notif;
            $Notification->uID = Auth::user()->uID;
            $Notification->is_read = '0';
            
            $id = $Notification->uID;
            $Notification->type =  'Sabbath Offering';

            if (Auth::user()->user_type == '2')
            {
                $Notification->notif_type = 'Added';
            }

            else if (Auth::user()->user_type == '1')
            {
                $Notification->notif_type = 'For Approval';
            }

            $Notification->record_id = $record;

            $Notification->created_at = Carbon::now(); 
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


            // EMAIL NOTIFICATION (CO-ADMIN)

            $user_notif = User::where('user_type', '1')
                    ->where('uID', request('uID'))
                    ->where('user_email_status', '=', 'On')
                    ->get();

            $notify = [
                'body' => 'Your new added record is on hold, wait for approval. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_notif, new EmailNotification($notify));

            
        // // EMAIL NOTIFICATION (ADMIN)

            $uID = Auth::user()->uID;

            $user_officer = User::where('user_type', '2')
                ->where('uID', '!=', $uID)
                ->where('user_email_status', '=', 'On')
                ->get();

            $notify = [
                'body' => Auth::user()->firstname.' '.Auth::user()->lastname.' '.'requested a new record and needs approval. To see the changes, click the button below.',
                'thanks' => 'Thank you!',
                'actionText' => 'Go to Website',
                'actionURL' => url('/'),
            ];

            Notification::sendNow($user_officer, new EmailNotification($notify));

        // // SAVING
            
        return response()->json(['status' => true, 'message' => 'You have added new record!']);

    }


    public function sabbath_offering_pending()
    {
        $penOffer = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->where('tithes_offer_tb.tithes_offer_approval', '1')
                ->where('users_tb.user_type', '!=', '0')
                ->where('tithes_offer_tb.member_ID', '=', null)
                ->orderBy('tithes_offer_tb.toID', 'DESC')
                ->get(['users_tb.*', 'tithes_offer_tb.*']);


        return view('admin.sabbath_offering_pending', compact('penOffer'));
    }


    public function approve_sabbath_offer(Request $request, $toID)
    {
        $req = TithesOffer::find($toID);

        $req->tithes_offer_approval = 2;

        $req->save();
    
        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Sabbath Offering';
        $Notification->notif_type = 'Approved';
        $Notification->record_id = $toID;
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


        // EMAIL NOTIFICATION (CO-ADMIN)

        $user_notif = User::where('user_type', '1')
                ->where('uID', request('uID'))
                ->where('user_email_status', '=', 'On')
                ->get();

        $notify = [
            'body' => 'Your new record has been approved. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_notif, new EmailNotification($notify));
    
        return back();

    }


    public function sabbath_offering_for_approval()
    {
        $co_admin_req = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                    ->where('tithes_offer_tb.uID', '=', Auth::user()->uID)
                    ->where('tithes_offer_tb.member_ID', '=', null)
                    ->where('tithes_offer_tb.tithes_offer_approval', '1')
                    ->select('users_tb.*', 'tithes_offer_tb.*')
                    ->get();
    

        return view('admin.sabbath_offering_for_approval', compact('co_admin_req'));
    }


    public function decline_sabbath_offer(Request $request, $toID)
    {
        $req = TithesOffer::find($toID);

        $req->tithes_offer_approval = 0;

        $req->save();
    
        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
        
        $id = $Notification->uID;
        $Notification->type =  'Sabbath Offering';
        $Notification->notif_type = 'Declined';
        $Notification->record_id = $toID;
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


        // EMAIL NOTIFICATION (CO-ADMIN)

        $user_notif = User::where('user_type', '1')
                ->where('uID', request('uID'))
                ->where('user_email_status', '=', 'On')
                ->get();

        $notify = [
            'body' => 'Your new record has been declined. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_notif, new EmailNotification($notify));
    
        return back();

    }


    public function retrieve_sabbath_offering_request(Request $request, $toID) 
    {

        $req = TithesOffer::find($toID);

        $req->tithes_offer_approval = '1';
    
        $record  = $req->toID;       

        $Notification = new Notif;
        $Notification->uID = Auth::user()->uID;
        $Notification->is_read = '0';
         $Notification->record_id = $record;
        
        $id = $Notification->uID;
        $Notification->type =  "Sabbath Offering";
        $Notification->notif_type = 'Retrieved';
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

        
        // EMAIL NOTIFICATION (CO-ADMIN)

        $user_notif = User::where('user_type', '1')
                ->where('uID', request('uID'))
                ->where('user_email_status', '=', 'On')
                ->get();

        $notify = [
            'body' => 'Your new record has been retrieved. To see the changes, click the button below.',
            'thanks' => 'Thank you!',
            'actionText' => 'Go to Website',
            'actionURL' => url('/'),
        ];

        Notification::sendNow($user_notif, new EmailNotification($notify));
    
    
        if($req->save()) {
            return back();
        }

    }


    public function disbursement_pending_list()
    {
        $penDisburse = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
                ->whereIn('disbursement_tb.disbursement_type_status', ['Pending', 'Needs Review'])
                ->orderBy('disbursement_tb.dsID', 'DESC')
                ->get(['users_tb.*', 'disbursement_tb.*']);


        return view('admin.disbursement_pending_list', compact('penDisburse'));
    }



    public function tithes_offerings_dashboard(){

    $Month = Carbon::now()->format('F');  // January
    $month = Carbon::now()->format('m');  // 01
    $Year = Carbon::now()->format('Y');     
   
     $user = User::all();
       
            $sort_by_year = TithesOffer::groupBy(DB::raw("DATE_FORMAT(tithes_offer_date,' %Y')"))
            ->where('member_ID',  '!=', null)
            ->select(
                DB::raw('sum(tithes_offer_tithe_amount) as annually_tithe_amount'),
                DB::raw('sum(tithes_offer_offering_plan_amount) as annually_offering_amount'),
                DB::raw('sum(tithes_offer_other_gifts_amount) as annually_other_gifts_amount'),
                DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y') as year")
            )
            ->orderBy('tithes_offer_date','DESC')
            ->get();


            $sort_by_month = TithesOffer::groupBy(DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y')"))
            ->where('member_ID',  '!=', null)
            ->select(
                DB::raw('sum(tithes_offer_tithe_amount) as tithe_amount'),
                DB::raw('sum(tithes_offer_offering_plan_amount) as offering_amount'),
                DB::raw('sum(tithes_offer_other_gifts_amount) as other_gifts_amount'),
                DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y') as months")
                )
            ->orderBy('tithes_offer_date','DESC')
            ->get();

            $sort_by_submonth = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
            ->where('member_ID',  '!=', null)
            ->orderBy('tithes_offer_date','DESC')
            ->get();

                $current_tithers =   TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->groupBy("tithes_offer_tb.uID")
                ->whereMonth('tithes_offer_date', '=', $month)
                ->whereYear('tithes_offer_date', '=', $Year)
                ->count('tithes_offer_tb.uID');

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
    
              
    
                $current_lapsed_tithers = $lapsed->count() + $never_contribute->count();


                $current_monthly_tithes = TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->groupBy("tithes_offer_tb.uID")
                ->whereMonth('tithes_offer_date', '=', $month)
                ->whereYear('tithes_offer_date', '=', $Year)
                ->sum('tithes_offer_tithe_amount');

                $current_offerings =   TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->groupBy("tithes_offer_tb.uID")
                ->whereMonth('tithes_offer_date', '=', $month)
                ->whereYear('tithes_offer_date', '=', $Year)
                ->where('member_ID',  '!=', null)
                ->sum('tithes_offer_offering_plan_amount');

                

                $current_gifts =TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                ->groupBy("tithes_offer_tb.uID")
                ->whereMonth('tithes_offer_date', '=', $month)
                ->whereYear('tithes_offer_date', '=', $Year)
                ->sum('tithes_offer_other_gifts_amount');


            return view('admin.Summary.tithes&offering_dashboard', 
            compact(
         'sort_by_month', 'sort_by_submonth',  'sort_by_year', 'current_tithers', 'current_lapsed_tithers',
          'current_monthly_tithes','current_offerings', 'current_gifts',
        ));
    }

    public function sabbath_offering_dashboard(){

        $Month = Carbon::now()->format('F');  // January
        $month = Carbon::now()->format('m');  // 01
        $Year = Carbon::now()->format('Y');     
       
         $user = User::all();
           
                $sort_by_year = TithesOffer::groupBy(DB::raw("DATE_FORMAT(tithes_offer_date,' %Y')"))
                ->where('member_ID',  '=', null)
                ->select(
                    DB::raw('sum(tithes_offer_offering_plan_amount) as annually_offering_amount'),
                    DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y') as year")
                )
              
                ->orderBy('tithes_offer_date','DESC')
                ->get();
    
    
                    $sort_by_month = TithesOffer::groupBy(DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y')"))
                    ->where('member_ID',  '=', null)
                    ->select(
                        DB::raw('sum(tithes_offer_offering_plan_amount) as offering_amount'),
                        DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y') as months")
                        )
                   
                    ->orderBy('tithes_offer_date','DESC')
    
                    ->get();
    
                    $current_tithers =   TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                    ->groupBy("tithes_offer_tb.uID")
                    ->whereMonth('tithes_offer_date', '=', $month)
                    ->whereYear('tithes_offer_date', '=', $Year)
                    ->where('member_ID',  '=', null)
                    ->count('tithes_offer_tb.tithes_offer_offering_plan_amount');
    
                    $current_offerings =  TithesOffer::join('users_tb', 'users_tb.uID', '=', 'tithes_offer_tb.uID')
                    ->groupBy("tithes_offer_tb.uID")
                    ->whereMonth('tithes_offer_date', '=', $month)
                    ->whereYear('tithes_offer_date', '=', $Year)
                    ->where('member_ID',  '=', null)
                    ->sum('tithes_offer_offering_plan_amount');
    
                return view('admin.Summary.sabbath_offering_dashboard', 
                compact(
             'sort_by_month',   'sort_by_year', 'current_tithers',
             'current_offerings', 
            ));
        }



    public function disbursement_dashboard(){
        $Month = Carbon::now()->format('F');  // January
        $month = Carbon::now()->format('m');  // 01
        $Year = Carbon::now()->format('Y');     
        $date = Carbon::now();    

       
         $user = User::all();
           
                    // $sort_by_year = TithesOffer::groupBy(DB::raw("DATE_FORMAT(tithes_offer_date,' %Y')"))
                    // ->where('member_ID',  '!=', null)
                    // ->select(
                    //     DB::raw('sum(tithes_offer_tithe_amount) as annually_tithe_amount'),
                    //     DB::raw('sum(tithes_offer_offering_plan_amount) as annually_offering_amount'),
                    //     DB::raw('sum(tithes_offer_other_gifts_amount) as annually_other_gifts_amount'),
                    //     DB::raw("DATE_FORMAT(tithes_offer_date,'%M %Y') as year")
                    // )
                    // ->orderBy('tithes_offer_date','DESC')
                    // ->get();

                    $sort_by_year = Disbursement::groupBy(DB::raw("DATE_FORMAT(disbursement_date,' %Y')"))
                    ->where('disbursement_type_status', '=', 'Approved')
                    ->select(
                        DB::raw('sum(disbursement_amount) as annually_disbursement_amount'),
                        DB::raw("DATE_FORMAT(disbursement_date,'%M %Y') as year")
                    )
                    ->orderBy('disbursement_date','DESC')
                    ->get();
        
        
                    $sort_by_month = Disbursement::groupBy(DB::raw("DATE_FORMAT(disbursement_date,'%M %Y')"))
                    ->where('disbursement_type_status', '=', 'Approved')
                    ->select(
                        DB::raw('sum(disbursement_amount) as annually_disbursement_amount'),
                        DB::raw("DATE_FORMAT(disbursement_date,'%M %Y') as months")
                        )
                    ->orderBy('disbursement_date','DESC')
                    ->get();
        
                    $sort_by_submonth = Disbursement::join('users_tb', 'users_tb.uID', '=', 'disbursement_tb.uID')
                    ->where('disbursement_type_status', '=', 'Approved')
                    ->orderBy('disbursement_date','DESC')
                    ->get();
    
                    $current_tithers =  Disbursement::where('disbursement_type_status', '!=', 'Approved')
                    ->whereMonth('disbursement_date',   $month  )
                    ->where('disbursement_delete_status', '=', '0' )
                    ->count('disbursement_type_status');

                    $current_lapsed_tithers =  Disbursement::where('disbursement_type_status', '=', 'Approved')
                    ->whereMonth('disbursement_date',   $month  )
                    ->whereYear('disbursement_date', '=', $Year)
                    ->where('disbursement_type_status', '=', 'Approved')
                    ->count('disbursement_type_status');

                
    
                    $current_disbursement_total = Disbursement::where('disbursement_type_status', '=', 'Approved')
                    ->whereMonth('disbursement_date',   $month  )
                    ->whereYear('disbursement_date', '=', $Year)
                    ->where('disbursement_type_status', '=', 'Approved')
                    ->sum('disbursement_amount');


    
                    $previous_amount =  Disbursement::where('disbursement_type_status', '=', 'Approved')
                    ->whereMonth('disbursement_date',   $date->subMonth()->format('m') )
                    ->whereYear('disbursement_date', '=', $Year)
                    ->where('disbursement_type_status', '=', 'Approved')
                    ->sum('disbursement_amount');
    

                    $last_month_excess =TithesOffer::whereMonth('tithes_offer_date',   $date->subMonth()->format('m') )
                    ->whereYear('tithes_offer_date', '=', $Year)
                    ->sum('tithes_offer_other_gifts_amount', 'tithes_offer_tithe_amount', 'tithes_offer_offering_plan_amount' );
                    
                    $total_excess = $last_month_excess - $previous_amount;


                    $current_fund = TithesOffer::whereMonth('tithes_offer_date',   $month )
                    ->whereYear('tithes_offer_date', '=', $Year)
                    ->where('tithes_offer_approval', '=', '2')
                    ->sum('tithes_offer_other_gifts_amount', 'tithes_offer_tithe_amount', 'tithes_offer_offering_plan_amount' );
                    
    
    
                    return view('admin.Summary.disbursement_dashboard', 
                compact(
             'sort_by_month', 'sort_by_submonth',  'sort_by_year', 'current_tithers', 'current_lapsed_tithers',
              'current_disbursement_total','total_excess', 'current_fund',
            ));
        }


    
};
