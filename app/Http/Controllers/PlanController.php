<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\TrsPlan;
use App\Models\TrsPlanImages;
use App\Models\TrsPlanRr;
use DataTables;
use App\Models\MstPair;
use Carbon\Carbon;
use DB;

class PlanController extends Controller
{

    function __construct()
    {
         $this->middleware('permission:plan-list|plan-create|plan-edit|plan-delete', ['only' => ['index','getData']]);
         $this->middleware('permission:plan-create', ['only' => ['create','store']]);
         $this->middleware('permission:plan-edit', ['only' => ['edit','update']]);
         $this->middleware('permission:plan-delete', ['only' => ['destroy']]);
    }

    public function index(){
        return view("plans.index");
    }

    public function getData(Request $req){

        $query = TrsPlan::with("pair")->get();

        return DataTables::of($query)
            ->editColumn('status_pl', function ($query) {
                    
                    $status ="";
                    switch ($query->status_pl) {
                        case 0:
                            $status = ' <span class="badge badge-warning">Need Approval</span>';
                        break;
                        case 1:
                            $status = ' <span class="badge badge-success">Approved</span>';
                        break;
                        case 2:
                            $status = ' <span class="badge badge-danger">Cancel</span>';
                        break;
                        
                      
                    }

                    return $status;
                   
                })
                ->addColumn("day", function ($query) {
                    

                    return Carbon::parse($query->entry_date)->locale("id")->dayName;
                   
                })
                ->editColumn("entry_date", function ($query) {
                    

                    return Carbon::parse($query->entry_date)->locale("id")->format("d-M-Y");
                   
                })
                ->addColumn('action',function($query){
                    $approve ="";
                    $cancel  ="";
                    $detail = "";
                    $close = "";


                    if($query->status_pl == 0){
                        $approve = "<a class='btn-approve text-success' onclick='approvePlan($query->id)' href='#' role='button' style='font-size:20px'><i class='mdi mdi-check-circle-outline'></i></a>";

                    }
                    $cancel = "<a class='btn-approve text-danger' data-toggle='tooltip' title='Cancel' onclick='cancelPlan($query->id)' href='#' role='button' style='font-size:20px'><i class='mdi mdi-close-circle-outline'></i></a>";
                    $detail = "<a class='btn-approve text-primary' data-toggle='tooltip' title='Detail' href='".url('plans/detail/'.$query->id)."' role='button' style='font-size:20px'><i class='mdi mdi-launch'></i></a>";
                    $close = "<a class='btn-approve text-primary' data-toggle='tooltip' title='Close'  href='".url('plans/close/'.$query->id)."' role='button' style='font-size:20px'><i class='mdi mdi-power'></i></a>";
                    
                   
                    return $approve.$cancel.$detail.$close;
                })
                ->rawColumns(['status_pl', 'action'])
                ->addIndexColumn()
                ->toJson();
    }

    public function create(){
        $pairs = MstPair::all();
        return view("plans.create",compact("pairs"));
    }

    public function store(Request $req){
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";
        $ret->data = array();

        $detail = json_decode($req->detail, true);
        
        
        // dd($detail);

		$pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
		try{

            $prefix_no = "FX".date("Ym");
            $last_no = TrsPlan::select(DB::Raw("cast(RIGHT(plan_no, 4) AS UNSIGNED) last_no"))
                ->where(DB::Raw("left(plan_no, 9)"), $prefix_no)
                ->orderBy("plan_no", "desc")
                ->first();
            if( $last_no ){
                $last_no = intval($last_no->last_no)+1;
            }else{
                $last_no = 1;
            }
            $planNo = $prefix_no.str_repeat("0", 4-strlen($last_no)).$last_no;

            $plan = New TrsPlan;
            $plan->plan_no = $planNo;
            $plan->entry_date = Carbon::createFromFormat('m-d-Y', $req->entry_date)->format('Y-m-d');
            $plan->pair_id = $req->pair_id;
            $plan->trading_rule = $req->trading_rule;
            $plan->status_order = 0;
            $plan->status_pl = 0;
            $plan->save();

            $image = [];
		for($i=0; $i<=6; $i++){
		

			if ($req->hasFile('img'.($i+1))) {
				$file = $req->file('img'.($i+1));
				$ext = $file->getClientOriginalExtension();
				if(in_array(strtolower($ext), ['jpg', 'jpeg', 'bmp', 'png'])) {
					$size = ceil($file->getSize()/1024); //KB
					if($size > (1024*10)) {
						$ret->result = false;
						$ret->msg = "File Image upload ".($i+1)." with size ".$size." is not allowed, the image upload only allowed for maximum 10 MB";
					
                        DB::rollback();

						return response()->json($ret, 200);
					}else{
						$file_name = str_replace(" ", "_", trim(strtolower($file->getClientOriginalName())));
						$file_name = date("Ymd_His")."_img".($i+1)."_".$file_name;
						$destinationPath = storage_path("app/public/plan/");
						$moved_file = $file->move($destinationPath, $file_name);

						$image[$i]["file_name"] = "plan/".$file_name;
                        $image[$i]["type"] = 1;
                        $image[$i]['plan_id']=$plan->id;
					}
				}else{
					$ret->result = false;
					$ret->msg = "File Image upload ".($i+1)." with extension ".$ext." is not allowed, the image upload only allowed for extension jpg, jpeg, bmp, and png";

				
                    DB::rollback();
					return response()->json($ret, 200);
				}
			}
			unset($file);
        }

            foreach ($detail as $item){
                $rr = new TrsPlanRr;
                $rr->plan_id = $plan->id;
                $rr->risk_to_reward_ratio=$item["risk_to_reward_ratio"];
                $rr->risk_percentase=$item["risk_percentase"];
                $rr->entry_price=$item["entry_price"];
                $rr->stop_loss = $item["stop_loss"];
                $rr->take_profit = $item["take_profit"];
                $rr->lot = $item["lot"];
                $rr->position = $item["position"];
                $rr->status = 0;
                $rr->save();
            }

            // dd($image);

            TrsPlanImages::insert($image);
            DB::commit();
		}catch(\QueryException $e){
			DB::rollback();
			$ret->result = false;
			$ret->msg = $e->getMessage();
		}
		
		return \Response::json($ret, 200);
    }

    public function approve($id){
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";
        $ret->data = array();


		$pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
		try{
            $data = TrsPlan::find($id);
            $data->status_pl = 1;
            $data->save();

            DB::commit();
		}catch(\QueryException $e){
			DB::rollback();
			$ret->result = false;
			$ret->msg = $e->getMessage();
		}
		
		return \Response::json($ret, 200);
    }

    public function detail($id){
        $plan = TrsPlan::with(["pair",'riskRiward','images'])->find($id);

        // dd($plan);

        return view("plans.detail",compact("plan"));
    }

    public function saveDetail(Request $req){
        $ret = (object) [];
		$ret->result = true;
		$ret->msg = "";
        $ret->data = array();


		$pdo = DB::connection()->getPdo();
		$pdo->exec("SET TRANSACTION ISOLATION LEVEL SERIALIZABLE");
		DB::beginTransaction();
		try{
            $plan = TrsPlanRr::find($req->id);
            $plan->status = $req->status;
            $plan->exit_price = $req->exit_price;
            $plan->profit_loss = $req->profit_loss;

            $plan->save();

            DB::commit();
		}catch(\QueryException $e){
			DB::rollback();
			$ret->result = false;
			$ret->msg = $e->getMessage();
		}
		
		return \Response::json($ret, 200);
    }
}
