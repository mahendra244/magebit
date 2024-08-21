<?php

namespace App\Http\Controllers\User;
use App\Model\CompanyUploadTrack;
use App\Model\CompanyData;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Validator;
use Illuminate\Support\Str;
use App\Imports\CompanyDataImport;
use Excel;
use Auth;
class CompanyDataImportController extends Controller
{
    public function getImportForm(){

        $uploadtrack = CompanyUploadTrack::orderBy('created_at', 'DESC')->paginate(20);

		return view('User.import.company',compact('uploadtrack'));
	}
    public function postCompanyData(Request $request){ 
        ini_set('max_execution_time',0);
        ini_set("memory_limit", "-1");
		$path = $request->file('excel_input');
    	try {
			$imported_lists =  Excel::toArray(new CompanyDataImport,request()->file('excel_input'));
		} catch (\Exception $e) {
			\Session::flash('message', 'File mismatch.');
			return redirect()->back();
		}
        if(empty($imported_lists)){
        	\Session::flash('message', 'Please check the excel data.');
        	return back()->withInput()->with('errors','Please check the excel data');
        }
        if($request->hasFile('excel_input')){

            $filename = time().'_'.date('d-m-Y').'_'.$path->getClientOriginalName();
            $file_n =preg_replace('/[^A-Za-z0-9\-\_\.]/', '',str_replace(" ","_",$filename));
            $unique_code = Str::random(10);
            $file_tack = new CompanyUploadTrack;
            $file_tack->user_id = Auth()->user()->id;
            $file_tack->file_name = $file_n;
            $file_tack->org_filename = $path->getClientOriginalName();
            $file_tack->unique_code = $unique_code;
            $file_tack->updated_at = date('Y-m-d H:i:s');
            $file_tack->created_at = date('Y-m-d H:i:s');
            $file_tack->save();
            $file = $request->file('excel_input');
            $destinationPath = public_path('/reports/company_reports');
            $file->move($destinationPath, $file_n);
            $i = 0;
            foreach($imported_lists as $key => $imported_list){
                if($key!=0){
                    break;
                }
                foreach($imported_list as $list){
                    $pe_name1 = isset($list['pe_name1']) ? $list['pe_name1'] : '';
                    $data = new CompanyData;
                    $data->pe_name1 = isset($list['pe_name1']) ? $list['pe_name1'] : '';
                    $data->org_id = isset($list['org_id']) ? $list['org_id'] : '';
                    $data->pe_id = isset($list['pe_id']) ? $list['pe_id'] : '';
                    $data->name1 = isset($list['name1']) ? $list['name1'] : '';
                    $data->geo_level1 = isset($list['geo_level1']) ? $list['geo_level1'] : '';
                    $data->country1 = isset($list['country1']) ? $list['country1'] : '';
                    $data->planning_grp_desc = isset($list['planning_grp_desc']) ? $list['planning_grp_desc'] : '';
                    $data->cp_name = isset($list['cp_name']) ? $list['cp_name'] : '';
                    $data->sap_top_view_name1 = isset($list['sap_top_view_name1']) ? $list['sap_top_view_name1'] : '';
                    $data->regional_buying_classification_text = isset($list['regional_buying_classification_text']) ? $list['regional_buying_classification_text'] : '';
                    $data->sap_master_code_text = isset($list['sap_master_code_text']) ? $list['sap_master_code_text'] : '';
                    $data->sales_group_name = isset($list['sales_group_name']) ? $list['sales_group_name'] : '';
                    $data->sales_office_name = isset($list['sales_office_name']) ? $list['sales_office_name'] : '';
                    $data->internal_account_classification = isset($list['internal_account_classification']) ? $list['internal_account_classification'] : '';
                    $data->unique_code = $unique_code;
                    $data->save(); 
                    $i++;
                }
            }

        }
        \Session::flash('message', 'successfully Company details Uploaded');
        return redirect()->back();
    }
    public function postImportExcel(Request $request){
    	try {
			$imported_lists =  Excel::toArray(new CompanyDataImport,request()->file('imported_file'));
        } catch (\Exception $e) {
        	return response(['success'=>false,'data'=>'file_invalid','message'=>"invalid excel"], 215);
		}
		return response(['success'=>true,'data'=>"",'error_data'=>"",'message'=>"valid excel"], 200);
	}
}
