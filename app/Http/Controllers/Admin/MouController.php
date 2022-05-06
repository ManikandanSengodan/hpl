<?php

namespace App\Http\Controllers\Admin;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

use App\Http\Requests\Admin\MouRequest;
use App\Http\Requests\Auth\ChangePasswordRequest;
use App\Models\Staf_master;
use App\Models\Role_master;
use App\Models\Staf_address;
use App\Models\Mou;
use App\Models\Incentive;
use App\Models\CustomerMaster;

use Illuminate\Support\Facades\Auth;
use DB;

class MouController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $mou = Mou::where('status',1);

        $mous = $mou->with('mouDetails')->orderBy('created_at', 'DESC')->paginate(config("motorTraders.paginate.perPage"));
       // echo "<pre>"; print_r($mous);exit;
        return view("mou.index", compact("mous"));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   $customers = CustomerMaster::get();
         //echo "<pre>"; print_r($customers);exit;
        return view("mou.create",compact("customers"));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(MouRequest $request)
    {   $latestOrder = Mou::orderBy('created_at','DESC')->first();
        $moucode = '#MOU'.str_pad($latestOrder->id + 1, 6, "0", STR_PAD_LEFT);
        
       $request['mou_code'] = $moucode;
        
       // echo "<pre>"; print_r($request->all());exit;
        $mous = Mou::create($request->all());
        
       
        return redirect()
            ->route("mous.index")
            ->with("success", "Mou created successfully.");
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($mou)
    {
        $mou = Mou::with('mouDetails')->withTrashed()->findOrFail($mou);
      // echo"<pre>";print_r($mou);exit;
        return view("mou.show", compact("mou"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Mou $mou)
    { 
        $customers = CustomerMaster::get();
        return view("mou.edit", compact("mou","customers"));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(MouRequest $request, Mou $mou)
    {
        $mou->update($request->all());
    
        return redirect()
            ->route("mous.index")
            ->with("warning", "mous updated successfully");
    
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Mou $mou)
    {
        $mou->delete(); 
        return redirect()
            ->route("mous.index")
            ->with("danger", "mous deleted successfully");
    }
   
    public function incentive($mou_id)
    {
        $mou = Mou::with('mouDetails')->withTrashed()->findOrFail($mou_id);

        $incentives = Incentive::where('mou_id',$mou->id)->first();
       
        return view("incentive.show", compact("mou","incentives"));
    }

    public function calculate(Request $request)
    {   
        $deviation = 0;
        $default = 0;
        $mou = Mou::findOrFail($request->mou_id);
         $achivement = $request->customer_order/$mou->monthly_target *100;
        if($achivement>50 && $achivement<80){
           $deviation = 1;
        }

        if($achivement<50){
            $default = 1;
         }
        if($deviation == 1 && $default == 0){
             
             $comment = "Deviation Month, incentive ON hold- To be paid at FI Year end";
        }elseif($default == 1){
            $comment = "Default Month, incentive ON hold- To be paid at FI Year end";
        }else{
            $comment = "To be Paid in Next Month";
        }
        if($achivement > 100){
            $ccs_eligibility = 1.25*$mou->monthly_target;
            $ccs_calculation = min($ccs_eligibility,$request->domestic_lifting);
        }else{
            $ccs_eligibility = $request->customer_order;
            $ccs_calculation = $request->domestic_lifting;
        }
        $monthly_incentive = $ccs_calculation*$mou->monthly_rate;
        $deviation = $deviation+$default;
        $incentive['period_month'] = $request->period_month;
        $incentive['mou'] = $mou->monthly_target;
        $incentive['customer_order'] = $request->customer_order;
        $incentive['unserviced_quantity'] = $unserviced_quantity = $request->unserviced_quantity;
        $incentive['domestic_lifting'] =  $request->domestic_lifting;
        $incentive['export_lifting'] =  $request->export_lifting;
        $incentive['achivement'] = round($achivement, 2);
        $incentive['ccs_eligibility'] =  $ccs_eligibility;
        $incentive['ccs_calculation'] =  $ccs_calculation;
        $incentive['monthly_rate'] = $mou->monthly_rate;
        $incentive['monthly_incentive'] = $monthly_incentive;
        $incentive['deviation'] = $deviation;
        $incentive['comment'] = $comment;
        

        if($request->status ==1){
            $Incentive = Incentive::where('customer_id',$mou->customer_id)->where('mou_id',$mou->id)->first();
            $incentive_data = json_encode($incentive);
            if(!$Incentive){
             
              $save_data['customer_id'] = $mou->customer_id;
              $save_data['mou_id'] = $mou->id;
              switch ($request->period_month) {
                    case 'jul':
                        $save_data['jul'] = $incentive_data;
                        break;
                    case 'aug':
                        $save_data['aug'] = $incentive_data;
                        break;
                    case 'sep':
                        $save_data['sep'] = $incentive_data;
                        break;
                    case 'oct':
                        $save_data['oct'] = $incentive_data;
                        break;
                    case 'nov':
                        $save_data['nov'] = $incentive_data;
                        break;
                    case 'dec':
                        $save_data['dec'] = $incentive_data;
                        break;
                    case 'jan':
                        $save_data['jan'] = $incentive_data;
                        break;  
                    case 'feb':
                        $save_data['feb'] = $incentive_data;
                        break;
                    case 'mar':
                        $save_data['mar'] = $incentive_data;
                        break;       
                }
            
                $result = Incentive::create($save_data);
            }else{
                $save_data[$request->period_month] = $incentive_data;
                $save_data['updated_at'] = date('Y-m-d H:i:s');
                $result = Incentive::where('customer_id', $mou->customer_id)->where('mou_id', $mou->id)->update($save_data);

                if($request->period_month == "sep"){
                    $Incentive_q2 = Incentive::where('customer_id',$mou->customer_id)->where('mou_id',$mou->id)->first();
                  
                    $incentive_1 = json_decode($Incentive_q2->jul);
                    $incentive_2 = json_decode($Incentive_q2->aug);
                    $incentive_3 = json_decode($Incentive_q2->sep);
                    
                    $q_customer_order = $incentive_1->customer_order+$incentive_2->customer_order+$incentive_3->customer_order;
                    
                    $q_unserviced_quantity = $incentive_1->unserviced_quantity+$incentive_2->unserviced_quantity+$incentive_3->unserviced_quantity;

                    $q_domestic_lifting = $incentive_1->domestic_lifting+$incentive_2->domestic_lifting+$incentive_3->domestic_lifting;

                    $q_export_lifting = $incentive_1->export_lifting+$incentive_2->export_lifting+$incentive_3->export_lifting;

                    $q_achivement = $q_customer_order/$mou->quarterly_target*100;

                    $q_ccs_eligibility = $incentive_1->ccs_eligibility+$incentive_2->ccs_eligibility+$incentive_3->ccs_eligibility;

                    $q_ccs_calculation = $incentive_1->ccs_calculation+$incentive_2->ccs_calculation+$incentive_3->ccs_calculation;

                    $q_incentive = $q_ccs_calculation*$mou->quarterly_rate;
                    $q_deviation = 0;
                    if($q_achivement<80){
                        $q_deviation = 1;
                     }
                     if($q_deviation == 0){
                          $q_comment = "To be Paid in Next Month";
                     }else{
                          $q_comment = "Deviation Month, incentive ON hold- To be paid at FI Year end";
                     }
                        $quater_incentive['period_month'] = "q2";
                        $quater_incentive['mou'] = $mou->quarterly_target;
                        $quater_incentive['customer_order'] = $q_customer_order;
                        $quater_incentive['unserviced_quantity'] = $q_unserviced_quantity;
                        $quater_incentive['domestic_lifting'] =  $q_domestic_lifting;
                        $quater_incentive['export_lifting'] =  $q_export_lifting;
                        $quater_incentive['achivement'] = round($q_achivement, 2);
                        $quater_incentive['ccs_eligibility'] =  $q_ccs_eligibility;
                        $quater_incentive['ccs_calculation'] =  $q_ccs_calculation;
                        $quater_incentive['q_rate'] = $mou->quarterly_rate;
                        $quater_incentive['q_incentive'] = $q_incentive;
                        $quater_incentive['deviation'] = $q_deviation;
                        $quater_incentive['comment'] = $q_comment;
                        $quater_data = json_encode($quater_incentive);
                        $save_data["q2"] = $quater_data;
                        $save_data['updated_at'] = date('Y-m-d H:i:s');
                        $result = Incentive::where('customer_id', $mou->customer_id)->where('mou_id', $mou->id)->update($save_data);
                }elseif($request->period_month == "dec"){
                    $Incentive_q2 = Incentive::where('customer_id',$mou->customer_id)->where('mou_id',$mou->id)->first();
                  
                    $incentive_1 = json_decode($Incentive_q2->oct);
                    $incentive_2 = json_decode($Incentive_q2->nov);
                    $incentive_3 = json_decode($Incentive_q2->dec);
                    
                    $q_customer_order = $incentive_1->customer_order+$incentive_2->customer_order+$incentive_3->customer_order;
                    
                    $q_unserviced_quantity = $incentive_1->unserviced_quantity+$incentive_2->unserviced_quantity+$incentive_3->unserviced_quantity;
                    
                    $q_export_lifting = $incentive_1->export_lifting+$incentive_2->export_lifting+$incentive_3->export_lifting;

                    $q_domestic_lifting = $incentive_1->domestic_lifting+$incentive_2->domestic_lifting+$incentive_3->domestic_lifting;

                    $q_achivement = $q_customer_order/$mou->quarterly_target*100;

                    $q_ccs_eligibility = $incentive_1->ccs_eligibility+$incentive_2->ccs_eligibility+$incentive_3->ccs_eligibility;

                    $q_ccs_calculation = $incentive_1->ccs_calculation+$incentive_2->ccs_calculation+$incentive_3->ccs_calculation;

                    $q_incentive = $q_ccs_calculation*$mou->quarterly_rate;
                    $q_deviation = 0;
                    if($q_achivement<80){
                        $q_deviation = 1;
                     }
                     if($q_deviation == 0){
                          $q_comment = "To be Paid in Next Month";
                     }else{
                          $q_comment = "Deviation Month, incentive ON hold- To be paid at FI Year end";
                     }

                     $quater_incentive['period_month'] = "q3";
                        $quater_incentive['mou'] = $mou->quarterly_target;
                        $quater_incentive['customer_order'] = $q_customer_order;
                        $quater_incentive['unserviced_quantity'] = $q_unserviced_quantity;
                        $quater_incentive['domestic_lifting'] =  $q_domestic_lifting;
                        $quater_incentive['export_lifting'] =  $q_export_lifting;
                        $quater_incentive['achivement'] = round($q_achivement, 2);
                        $quater_incentive['ccs_eligibility'] =  $q_ccs_eligibility;
                        $quater_incentive['ccs_calculation'] =  $q_ccs_calculation;
                        $quater_incentive['q_rate'] = $mou->quarterly_rate;
                        $quater_incentive['q_incentive'] = $q_incentive;
                        $quater_incentive['deviation'] = $q_deviation;
                        $quater_incentive['comment'] = $q_comment;
                        $quater_data = json_encode($quater_incentive);
                        $save_data["q3"] = $quater_data;
                        $save_data['updated_at'] = date('Y-m-d H:i:s');
                        $result = Incentive::where('customer_id', $mou->customer_id)->where('mou_id', $mou->id)->update($save_data);

                }elseif($request->period_month == "mar"){
                    $Incentive_q2 = Incentive::where('customer_id',$mou->customer_id)->where('mou_id',$mou->id)->first();
                  
                    $incentive_1 = json_decode($Incentive_q2->jan);
                    $incentive_2 = json_decode($Incentive_q2->feb);
                    $incentive_3 = json_decode($Incentive_q2->mar);
                    
                    $q_customer_order = $incentive_1->customer_order+$incentive_2->customer_order+$incentive_3->customer_order;
                    
                    $q_unserviced_quantity = $incentive_1->unserviced_quantity+$incentive_2->unserviced_quantity+$incentive_3->unserviced_quantity;
                    
                    $q_export_lifting = $incentive_1->export_lifting+$incentive_2->export_lifting+$incentive_3->export_lifting;

                    $q_domestic_lifting = $incentive_1->domestic_lifting+$incentive_2->domestic_lifting+$incentive_3->domestic_lifting;

                    $q_achivement = $q_customer_order/$mou->quarterly_target*100;

                    $q_ccs_eligibility = $incentive_1->ccs_eligibility+$incentive_2->ccs_eligibility+$incentive_3->ccs_eligibility;

                    $q_ccs_calculation = $incentive_1->ccs_calculation+$incentive_2->ccs_calculation+$incentive_3->ccs_calculation;

                    $q_incentive = $q_ccs_calculation*$mou->quarterly_rate;
                    $q_deviation = 0;
                    if($q_achivement<80){
                        $q_deviation = 1;
                     }
                     if($q_deviation == 0){
                          $q_comment = "To be Paid in Next Month";
                     }else{
                          $q_comment = "Deviation Month, incentive ON hold- To be paid at FI Year end";
                     }

                        $quater_incentive['period_month'] = "q4";
                        $quater_incentive['mou'] = $mou->quarterly_target;
                        $quater_incentive['customer_order'] = $q_customer_order;
                        $quater_incentive['unserviced_quantity'] = $q_unserviced_quantity;
                        $quater_incentive['domestic_lifting'] =  $q_domestic_lifting;
                        $quater_incentive['export_lifting'] =  $q_export_lifting;
                        $quater_incentive['achivement'] = round($q_achivement, 2);
                        $quater_incentive['ccs_eligibility'] =  $q_ccs_eligibility;
                        $quater_incentive['ccs_calculation'] =  $q_ccs_calculation;
                        $quater_incentive['q_rate'] = $mou->quarterly_rate;
                        $quater_incentive['q_incentive'] = $q_incentive;
                        $quater_incentive['deviation'] = $q_deviation;
                        $quater_incentive['comment'] = $q_comment;
                        $quater_data = json_encode($quater_incentive);
                        $save_data["q4"] = $quater_data;
                        $save_data['updated_at'] = date('Y-m-d H:i:s');
                        $result = Incentive::where('customer_id', $mou->customer_id)->where('mou_id', $mou->id)->update($save_data);

                    

                    $incentive_1 = json_decode($Incentive_q2->q2);
                    $incentive_2 = json_decode($Incentive_q2->q3);
                    $incentive_3 = json_decode($Incentive_q2->q4);
                    
                    $incentive_jul = json_decode($Incentive_q2->jul);
                    $incentive_aug = json_decode($Incentive_q2->aug);
                    $incentive_sep = json_decode($Incentive_q2->sep);
                    $incentive_oct = json_decode($Incentive_q2->oct);
                    $incentive_nov = json_decode($Incentive_q2->nov);
                    $incentive_dec = json_decode($Incentive_q2->dec);
                    $incentive_jan = json_decode($Incentive_q2->jan);
                    $incentive_feb = json_decode($Incentive_q2->feb);
                    $incentive_mar = json_decode($Incentive_q2->mar);
                    $pending_due = 0;
                   
                    if($incentive_jul->deviation ==1){
                        $pending_due = $pending_due + $incentive_jul->monthly_incentive; 
                    }
                    if($incentive_aug->deviation ==1){
                        $pending_due = $pending_due + $incentive_aug->monthly_incentive; 
                    }
                    if($incentive_sep->deviation ==1){
                        $pending_due = $pending_due + $incentive_sep->monthly_incentive; 
                    }
                    if($incentive_oct->deviation ==1){
                        $pending_due = $pending_due + $incentive_oct->monthly_incentive; 
                    }
                    if($incentive_nov->deviation ==1){
                        $pending_due = $pending_due + $incentive_nov->monthly_incentive; 
                    }
                    if($incentive_dec->deviation ==1){
                        $pending_due = $pending_due + $incentive_dec->monthly_incentive; 
                    }
                    if($incentive_jan->deviation ==1){
                        $pending_due = $pending_due + $incentive_jan->monthly_incentive; 
                    }
                    if($incentive_feb->deviation ==1){
                        $pending_due = $pending_due + $incentive_feb->monthly_incentive; 
                    }

                    if($incentive_mar->deviation ==1){
                        $pending_due = $pending_due + $incentive_mar->monthly_incentive; 
                    }
                    $q_pending_due = 0;
                   
                    if($incentive_1->deviation ==1){
                        $q_pending_due = $q_pending_due + $incentive_1->q_incentive; 
                    }
                    if($incentive_2->deviation ==1){
                        $q_pending_due = $q_pending_due + $incentive_2->q_incentive; 
                    }
                    if($incentive_3->deviation ==1){
                        $q_pending_due = $q_pending_due + $incentive_3->q_incentive; 
                    }

                    $hold_monthly_incentive = $pending_due;
                    $hold_q_incentive = $q_pending_due;

                    $annual_customer_order = $incentive_1->customer_order+$incentive_2->customer_order+$incentive_3->customer_order;
                    
                    $annual_unserviced_quantity = $incentive_1->unserviced_quantity+$incentive_2->unserviced_quantity+$incentive_3->unserviced_quantity;
                    
                    $annual_export_lifting = $incentive_1->export_lifting+$incentive_2->export_lifting+$incentive_3->export_lifting;

                    $annual_domestic_lifting = $incentive_1->domestic_lifting+$incentive_2->domestic_lifting+$incentive_3->domestic_lifting;

                    $annual_achivement = $q_customer_order/$mou->annual_target;

                    $annual_ccs_eligibility = $incentive_1->ccs_eligibility+$incentive_2->ccs_eligibility+$incentive_3->ccs_eligibility;

                    $annual_ccs_calculation = $incentive_1->ccs_calculation+$incentive_2->ccs_calculation+$incentive_3->ccs_calculation;

                    $annual_incentive = $annual_achivement*$annual_customer_order*$mou->annual_rate;

                    $total_annual_incentive = $annual_incentive+$hold_q_incentive+$hold_monthly_incentive;
                    $annual_deviation = 0;
                    $annual_comment = "To be Paid in This Month";
                     
                        $annaul_incentive_data['period_month'] = "annual";
                        $annaul_incentive_data['mou'] = $mou->annual_target;
                        $annaul_incentive_data['customer_order'] = $annual_customer_order;
                        $annaul_incentive_data['unserviced_quantity'] = $annual_unserviced_quantity;
                        $annaul_incentive_data['domestic_lifting'] =  $annual_domestic_lifting;
                        $annaul_incentive_data['export_lifting'] =  $annual_export_lifting;
                        $annaul_incentive_data['achivement'] = round($annual_achivement, 2);
                        $annaul_incentive_data['ccs_eligibility'] =  $annual_ccs_eligibility;
                        $annaul_incentive_data['ccs_calculation'] =  $annual_ccs_calculation;
                        $annaul_incentive_data['annual_rate'] = $mou->annual_rate;
                        $annaul_incentive_data['annual_incentive'] = round($annual_incentive, 2);
                        $annaul_incentive_data['deviation'] = $annual_deviation;
                        $annaul_incentive_data['comment'] = $annual_comment;
                        $annaul_incentive_data['hold_monthly_incentive'] = $hold_monthly_incentive;
                        $annaul_incentive_data['hold_quater_incentive'] = $hold_q_incentive;
                        $annaul_incentive_data['total_annual_incentive'] = round($total_annual_incentive, 2);
                        
                       

                        //echo "<pre>";print_r( $annaul_incentive_data);exit;
                        $annual_data = json_encode($annaul_incentive_data);
                        $save_data["annual"] = $annual_data;
                        $save_data['updated_at'] = date('Y-m-d H:i:s');
                        $result = Incentive::where('customer_id', $mou->customer_id)->where('mou_id', $mou->id)->update($save_data);

                }
            }

            return response()->json( array('success' => true) );
         
    }else{
        $incentive ="<tr>
                    <td>".$request->period_month."</td>
                    <td>".$mou->monthly_target."</td> 
                    <td>".$request->customer_order."</td>
                    <td>".$request->unserviced_quantity."</td>
                    <td>".$request->domestic_lifting."</td>
                    <td>".$request->export_lifting."</td>
                    <td>".round($achivement, 2)."</td>
                    <td>".$ccs_eligibility."</td>
                    <td>".$ccs_calculation."</td>
                    <td>".$mou->monthly_rate."</td>
                    <td>".$monthly_incentive."</td>
                    <td>".$deviation."</td>
                    <td>".$comment."</td>
                    <td></td>
                    </tr>";
                    return response()->json( array('success' => true, 'html'=>$incentive) );
        }

    }
    
   
}
