<?php

namespace App\Http\Controllers\User;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Imports\SendgridDataImport;
use Excel;
use Illuminate\Support\Str;
use App\Model\UserSendgridUploadTrack;
use App\Model\UserEmail;
use App\Model\UserEmailMessageID;
use App\Model\UserEmailTemplate;
use App\Model\UserEmailSubject;
use DB;
use Arr;
class SendgridDataImportController extends Controller
{
    public function getSendgridImportForm(){
        $sendgridtrack = UserSendgridUploadTrack::orderBy('created_at', 'DESC')->paginate(20);
		return view('User.import.sendgrid',compact('sendgridtrack'));
	}
    public function uploadsendgridData(Request $request) 
    {
        ini_set('max_execution_time',0);
        ini_set("memory_limit", "-1");
		$excelpath = $request->file('excel_input');
    	try {
			$sendgrid_imported_lists =  Excel::toArray(new SendgridDataImport,request()->file('excel_input'));
		} catch (\Exception $e) {
			\Session::flash('message','File mismatch.');
			return redirect()->back();
		}
        if(empty($sendgrid_imported_lists)){
        	\Session::flash('message', 'Please check the excel data.');
        	return back()->withInput()->with('errors','Please check the excel data');
        }
        if($request->hasFile('excel_input')){
           
            $sendgridfilename = time().'_'.date('d-m-Y').'_'.$excelpath->getClientOriginalName();
            $file_n =str_replace(" ","_",$sendgridfilename);
            $file = $request->file('excel_input');
            $destinationPath = public_path('/sendgrid_reports');
            $file->move($destinationPath, $file_n);
            $unique_code = Str::random(10);
            $email= array();    
            if (  $email == null) {
            $upload_track = new UserSendgridUploadTrack;
            $upload_track->user_id = Auth()->user()->id;
            $upload_track->file_name = $file_n;
            $upload_track->org_filename = $excelpath->getClientOriginalName();
            $upload_track->unique_code = $unique_code;
            $upload_track->updated_at = date('Y-m-d H:i:s');
            $upload_track->created_at = date('Y-m-d H:i:s');
            $upload_track->save(); 
            }  
                
            foreach($sendgrid_imported_lists as $key => $sendgrid_imported_lists){
                if($key!=0){
                    break;
                }
                $i=0;
                foreach($sendgrid_imported_lists as $list)
                {  

                        $i=0;
                        $unique_email = array_unique(array_column($sendgrid_imported_lists, 'email'));
                        foreach($unique_email as $value)
                        {
                            $email = UserEmail::where('email_id', '=', $value)->first();
                            if ($email != null) {
                                \Session::flash('message', 'This Email already uploaded.');
                                return redirect()->back(); 
                            }
                            

                            $sendgrid_emial =UserEmail::updateOrCreate(['email_id' => $value,'unique_code' =>  $unique_code]);
                            $email_keys = array_keys(array_column($sendgrid_imported_lists, 'email'), $value);
                            $email_data = array_intersect_key($sendgrid_imported_lists, array_flip($email_keys));
                            foreach ($email_data as $data)
                            {
                                $user_id=$sendgrid_emial->id;
                                $message=UserEmailMessageID::firstOrCreate(['email_user_id' => $user_id,'message_id' => $data['recv_message_id'],'message_status' => $data['event'],'process_date' => $data['processed'],'click_status' => $data['type'] ]); 
                                $message_id=$message->id;
                                $user_template=array('template_id' => $data['template_id'],'user_id' => $message_id);
                                $template_insert= DB::table('user_template')->insertGetId( $user_template);     
                                $user_subject=array('email_subject' => $data['subject'],'euser_id' => $message_id);
                                $subject_insert= DB::table('user_subject')->insert( $user_subject);     
                            }      
                        }
                         $i++;
                         if($i==1) break;        
                }
                $i++;
                if($i==1) break;    
            } 
            \Session::flash('message', 'successfully Uploaded');
            return redirect()->back(); 
        }
       
    }
}
