<?php

namespace App\Http\Controllers\User;

use App\Model\EmployeeData;
use App\Model\CompanyData;
use App\Model\SearchSuggestion;
use App\Model\UploadTrack;
use App\Model\UserEmail;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
use DB;
use Redirect;
use Response;
class EmployeeController extends Controller
{
    public function index(Request $request){
        $company = CompanyData::get();
        $sendgrid = UserEmail::get();
        return view('User.dashboard.index',compact('company','sendgrid'));
    }
    public function employeeData($id,Request $request){
        $search_name = $request->input('search');
        $data = EmployeeData::where('unique_code',$id)
                ->whereNotIn('company',['NULL',''])
                ->whereNull('is_updated');
        if($data->count()==0){
            \Session::flash('message', 'No Data Found');
            return redirect('/user/employee-data-import');
        }
        $company_id ='';
        if($search_name){    
            $data = $data->where('company','LIKE','%'.$search_name.'%');  
            $search_id = SearchSuggestion::select('company_id')->where('suggest_text',$search_name)->first();
            if($search_id){
                $company_id = $search_id->company_id;
            }
        }
        $data = $data->orderBy('company', 'asc')->paginate(20);

        $companylist = CompanyData::select('id','pe_name1')
        ->whereNotIn('pe_name1',['NULL',''])
        ->orderBy('pe_name1','asc')
        ->take(10)
        ->get()
        ->unique('pe_name1');
        $unique_code = $id;

        $different_company = DB::table('employee')
        ->select('employee.company','employee.id')
        ->join('company', 'company.pe_name1', '!=', 'employee.company')
        ->where('employee.unique_code',$id)
        ->whereNull('employee.is_updated')
        ->groupBy('employee.company')
        ->orderBy('employee.company','asc')
        ->get();
		return view('User.dashboard.employee',['data'=>$data,
        'unique_code'=>$unique_code,
        'companylist' =>$companylist,
        'company_id' =>$company_id,
        'different_company' =>$different_company,
        'companyslected' =>[],
        ]);
    }
    
    public function updateStatus(Request $request){
     
        // dd($request->all());
        $companyID  =$request->input('company_id');
        $list  =$request->input('list');
        $search  =$request->input('search_text');
        $list1 =explode(',',$list);
        // dd( $companyID)
        $data = CompanyData::where('id',$companyID)->first();

        if($search!=""){

            if($data){
                if($search){
                    SearchSuggestion::updateOrCreate(
                        ['company_id' => $companyID, 'suggest_text' => $search],
                        ['company_id' => $companyID, 'suggest_text' => $search]
                    );  
                }
                $update = [
                    'org_id' => $data->org_id,
                    'pe_id' => $data->pe_id,
                    'company_updated' => $data->pe_name1,
                    'is_updated' => 'updated',
                ];
                EmployeeData::whereIn('id',$list1)->update($update);
                return \Redirect::back()->with('message', 'Successfully Updated');
            }else{
                return \Redirect::back()->with('message', 'Something went wrong');
            }
        }else{
            $company_lists  =$request->input('company_lists');
            $company_lists =explode(',',$company_lists);
            if($data){
                foreach($company_lists as $val){
                    if($val){
                        SearchSuggestion::updateOrCreate(
                                ['company_id' => $companyID, 'suggest_text' => $val],
                                ['company_id' => $companyID, 'suggest_text' => $val]
                            ); 
                    }
 
                }
                $update = [
                    'org_id' => $data->org_id,
                    'pe_id' => $data->pe_id,
                    'company_updated' => $data->pe_name1,
                    'is_updated' => 'updated',
                ];
                EmployeeData::whereIn('id',$list1)->update($update);
                return \Redirect::back()->with('message', 'Successfully Updated');
            }else{
                return \Redirect::back()->with('message', 'Something went wrong');
            }
            
        }

    }
    public function updateList($id=null){
        if($id){
           $data = EmployeeData::where( ['is_updated'=>'updated','unique_code'=>$id])->paginate(25); 
        }else{
            $data = EmployeeData::where('is_updated','updated')->paginate();
        }
        return view('User.dashboard.updated-list',compact('data'));
    }

    public function employeeUpdatedReport($id=null){
        if($id){
           $data = EmployeeData::where( ['is_updated'=>'updated','unique_code'=>$id])->paginate(25); 
        }else{
            $data = EmployeeData::where('is_updated','updated')->paginate();
        }
        return view('User.reports.updated-list',compact('data'));
    }

    public function allemployeeUpdatedReport($id=null){
        $data = EmployeeData::where('unique_code',$id)
        ->whereNotIn('company',['NULL',''])
        ->get();
        return view('User.reports.company_updated_list',compact('data'));
    }



    public function companyData($id,Request $request){
        $search = $request->input('search');
        $data = CompanyData::where('unique_code',$id);
        if($data->count()==0){
            \Session::flash('message', 'No Data Found');
            return redirect('/user/company-data-import'); 
        }
        if($search){
            $data = $data->where('pe_name1','LIKE','%'.$search.'%');  
        }
        $data = $data->orderBy('pe_name1', 'asc')->paginate(25);
        $unique_code = $id;
		return view('User.dashboard.company',compact('data','unique_code'));
    }


    public function employeeDataFilter($id,Request $request){
    
        $companyname = $request->input('companys');
        $data = EmployeeData::where('unique_code',$id)
        ->whereNotIn('company',['NULL',''])
        ->whereNull('is_updated');
      
        if(!empty($companyname)){
            $data = $data->whereIn('company',$companyname);
        }
        if($data->count()==0)
        {
            \Session::flash('message', 'No Data Found');
            return redirect('/user/employee-data-import');
        }
        $company_id ='';

        $data = $data->orderBy('company', 'desc')->paginate(25);

        $companylist = CompanyData::select('id','pe_name1')
        ->whereNotIn('pe_name1',['NULL',''])
        ->orderBy('pe_name1','asc')
        ->take(10)
        ->get()
        ->unique('pe_name1');

        $unique_code = $id;

        $different_company = DB::table('employee')
        ->leftJoin('company', 'employee.id', '=' ,'company.id')
        ->select('employee.company','employee.id','company.pe_name1' )
        ->where('employee.unique_code',$id)
        ->whereNull('employee.is_updated')
        ->whereNull('company.pe_name1')
        ->whereNotIn('employee.company',['NULL',''])
        ->groupBy('employee.company')
        ->orderBy('employee.company', 'asc')
        ->get();
		return view('User.dashboard.employee',['data'=>$data,'unique_code'=>$unique_code,'companylist' =>$companylist, 'companylist' =>$companylist,
                                                'company_id' =>$company_id, 'different_company' =>$different_company, 'companyslected' =>$companyname,
                                                ]);
    }
    
    public function Listofcompany($search){
        $companylist = CompanyData::select('id','pe_name1')
        ->where('pe_name1','LIKE','%'.$search.'%')
        ->orderBy('pe_name1','asc')
        ->get()
        ->unique('pe_name1');
        return response(['success'=>true,'companylist'=>$companylist,'message'=>""], 200);
    }

    public function matchDashboard($id=null){
       
        $previewcomp = DB::table('employee')
        ->join('company', 'employee.company', '=', 'company.pe_name1')
        ->where('employee.unique_code','=',$id)
        ->paginate(20);
       return view('User.dashboard.employee_match_dashboard',[ 'unique_code'=>$id,'previewlist' =>$previewcomp  ]);
    }
    public function empCompMatchUpdate($id=null){
            DB::select("UPDATE employee as e 
            JOIN company as c
            ON   e.`company` = c.`pe_name1`
            AND  e.`unique_code` = '$id'
            SET  e.`org_id` = c.`org_id`,
                 e.`pe_id` = c.`pe_id`,
                 e.`company_updated` = c.`pe_name1`,
                 e.`is_updated` = 'updated'");
            UploadTrack::where('unique_code',$id )->update(['is_updated' => "1"]);

        return \Redirect::back()->with('message', 'Successfully records Updated');
    }
}
