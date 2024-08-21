<?php

namespace App\Http\Controllers\User;
use App\Model\UploadTrack;
use App\Model\EmployeeData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Imports\EmployeedataImport;
use Excel;
use Auth;
class EmployeeDataImportController extends Controller
{
    public function getImportForm(){
        $uploadtrack = UploadTrack::orderBy('created_at', 'DESC')->paginate(20);
		return view('User.import.employee',compact('uploadtrack'));
	}
    public function uploadEmployeeData(Request $request){ 

        ini_set('max_execution_time',0);
        ini_set("memory_limit", "-1");

		$file_path = $request->file('excel_input');

    	try {
			$imported_lists =  Excel::toArray(new EmployeedataImport,request()->file('excel_input'));
		} catch (\Exception $e) {
			\Session::flash('message', 'File mismatch.');
			return redirect()->back();
		}

        if(empty($imported_lists)){
        	\Session::flash('message', 'Please check the excel data.');
        	return back()->withInput()->with('errors','Please check the excel data');
        }

        if($request->hasFile('excel_input')){
            $filename = time().'_'.date('d-m-Y').'_'.$file_path->getClientOriginalName();
            $file_n =str_replace(" ","_",$filename);
            $file = $request->file('excel_input');
            $destinationPath = public_path('/reports');
            $file->move($destinationPath, $file_n);
            // dd($file_n);

            $unique_code = Str::random(10);
            $file_tack = new UploadTrack;
            $file_tack->user_id = Auth()->user()->id;
            $file_tack->file_name = $file_n;
            $file_tack->org_filename = $file_path->getClientOriginalName();
            $file_tack->unique_code = $unique_code;
            $file_tack->updated_at = date('Y-m-d H:i:s');
            $file_tack->created_at = date('Y-m-d H:i:s');
            $file_tack->save();

          
            foreach($imported_lists as $key => $imported_list){
                if($key!=0){
                    break;
                }
                foreach($imported_list as $list){
                    $data = new EmployeeData;
                    $data->name = isset($list['name']) ? $list['name'] : '';
                    $data->email = isset($list['email']) ? $list['email'] : '';
                    $data->phone = isset($list['phone']) ? $list['phone'] : '';
                    $data->company = isset($list['company']) ? $list['company'] : '';
                    $data->designation = isset($list['designation']) ? $list['designation'] : '';
                    $data->city_name = isset($list['city_name']) ? $list['city_name'] : '';
                    $data->event_type = isset($list['event_type']) ? $list['event_type'] : '';
                    $data->event_name = isset($list['event_name']) ? $list['event_name'] : '';
                    $data->event_date = isset($list['event_date']) ? $list['event_date'] : '';
                    $data->is_unique = isset($list['unique']) ? $list['unique'] : '';
                    $data->is_unique_num = isset($list['unique_no']) ? $list['unique_no'] : '';
                    $data->utm_source = isset($list['utm_source']) ? $list['utm_source'] : '';
                    $data->utm_medium = isset($list['utm_medium']) ? $list['utm_medium'] : '';
                    $data->utm_campaign = isset($list['utm_campaign']) ? $list['utm_campaign'] : '';
                    $data->status = isset($list['status']) ? $list['status'] : '';
                    $data->register_date = isset($list['register_date']) ? $list['register_date'] : '';
                    $data->is_attended = isset($list['attended']) ? $list['attended'] : '';
                    $data->unique_code = $unique_code;
                    $data->save(); 
                }
            }
        }

        $search = $file_tack->file_name;
        \Session::flash('message', 'successfully Uploaded');
        return redirect()->back();
        
    }
    public function postImportExcel(Request $request){
    	try {
			$imported_lists =  Excel::toArray(new EmployeedataImport,request()->file('imported_file'));
        } catch (\Exception $e) {
        	return response(['success'=>false,'data'=>'file_invalid','message'=>"invalid excel"], 215);
		}
		return response(['success'=>true,'data'=>"",'error_data'=>"",'message'=>"valid excel"], 200);
	}
}
