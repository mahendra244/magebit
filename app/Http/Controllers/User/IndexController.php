<?php

namespace App\Http\Controllers\User;
use App\Model\EmployeeData;
use App\Model\CompanyData;
use App\Model\UploadTrack;
use App\Model\CompanyUploadTrack;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Auth;
class IndexController extends Controller
{
    public function index(Request $request){
        $company = CompanyData::get();
        return view('User.dashboard.index',compact('company'));
    }
    public function getProduct()
    {
        $companyname = CompanyData::where('name1', 'like', "%" . $_GET['term'] . "%")->get();
        return response($companyname->pluck('name1'), 200);
    }
    public function employeeData($id){
        $data = EmployeeData::where('unique_code',$id)->paginate(25);
        $companyname = CompanyData::groupBy('name1')->pluck('name1')->toArray();
        // dd( $companyname );
        $unique_code=$id;
        // dd($companylist);

        if($data->count()==0){
            \Session::flash('message', 'No Data Found');
            return redirect('/user/employee-data-import');
        }
		return view('User.dashboard.employee',compact('data','unique_code','companyname'));
        return response()->json([
            'statusCode'=>200,
            'status'=>'Success',
            'companyname' => $companyname
          ]);
    }
    public function companyData($id){
        $data = CompanyData::where('unique_code',$id)->paginate(25);
        if($data->count()==0){
            \Session::flash('message', 'No Data Found');
            return redirect('/user/company-data-import'); 
        }
		return view('User.dashboard.company',compact('data'));
    }
    public function employeedelete($id){
        $data = UploadTrack::where('unique_code',$id)->delete();
        return \Redirect::back()->with('message', 'Deleted successfully');
      
    }
   

    public function companyDelete($id){

        $data = CompanyUploadTrack::where('unique_code',$id)->delete();

        return \Redirect::back()->with('message', 'Deleted successfully');
     
    }
}
