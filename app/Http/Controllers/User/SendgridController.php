<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Model\UserEmail;
use App\Model\UserEmailMessageID;
use App\Model\UserSendgridUploadTrack;
use DB;
class SendgridController extends Controller
{
    public function getSendgridData($id,Request $request){
    $sendgrid_data = UserEmail::where('unique_code',$id)->paginate(50);
    return view('User.dashboard.sendgrid_dashboard',['sendgrid_data'=> $sendgrid_data,'uniqueid'=>$id]);
	}
    public function getSendgridDelete($id,Request $request){
        $sendgrid_data = UserSendgridUploadTrack::where('unique_code',$id)->delete();
        return \Redirect::back()->with('message', 'Deleted successfully');;
    }

    public function getEmailFilter($id,Request $request){
    $email=$request->get('email_id');
    $sendgrid_data = UserEmail::where('unique_code',$id)->where('email_id',$email)->paginate(50);
    return view('User.dashboard.sendgrid_dashboard',['sendgrid_data'=> $sendgrid_data,'uniqueid'=>$id]);
	}

    public function getMailDetails( $user_id)
    {
    $details_list = DB::table('user_email_id')
    ->leftJoin('user_message_id','user_email_id.id','=','user_message_id.email_user_id')
    ->leftJoin('user_subject','user_message_id.id','=','user_subject.euser_id')
    ->leftJoin('user_template','user_message_id.id','=','user_template.user_id')
    ->select('user_email_id.email_id as email','user_message_id.click_status as clk_status','user_message_id.message_id as msg_id','user_message_id.message_status as msg_status','user_message_id.process_date as proc_date','user_subject.email_subject as subject','user_template.template_id as temp_id' )
    ->where('user_message_id.email_user_id', $user_id)
    ->paginate(40);
    return view('User.dashboard.sendgrid_more_details',['details_list'=>$details_list,'userid'=>$user_id ]);
    }
   
    public function getSendgridAllReports($uniqueid)
    {
    $details = UserEmail::where('unique_code', $uniqueid)->with('messageid.emailSubject','messageid.emailTemplate')->get()->keyBy('email_id');
    return view('User.reports.sendgrid_complete_report',compact('details'));
    }

    public function getMailDetailsReports($user_id)
    {
    $details_list_report = DB::table('user_email_id')
    ->leftJoin('user_message_id','user_email_id.id','=','user_message_id.email_user_id')
    ->leftJoin('user_subject','user_message_id.id','=','user_subject.euser_id')
    ->leftJoin('user_template','user_message_id.id','=','user_template.user_id')
    ->select('user_email_id.email_id as email','user_message_id.click_status as clk_status','user_message_id.message_id as msg_id','user_message_id.message_status as msg_status','user_message_id.process_date as proc_date','user_subject.email_subject as subject','user_template.template_id as temp_id' )
    ->where('user_message_id.email_user_id', $user_id)
    ->get();
    return view('User.reports.sendgrid_more_details_report',compact('details_list_report'));
    }
}
