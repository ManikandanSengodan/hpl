<?php

namespace App\Http\Controllers\Admin;

use App\Models\CustomerMaster;
use App\Models\Profile;
use App\Models\Invoice;
use App\Models\DesignCard;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use DB;
use PDF;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $invoices = Invoice::orderBy('created_at', 'DESC')->get();

        return view("invoice.index", compact("invoices"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function generateInvoicePDF($id)
    {
        $data = [
            'title' => 'Hilife Invoice',
            'date' => date('m/d/Y')
        ];

        $pdf = PDF::loadView('invoice.pdf', $data);

        return $pdf->stream('invoice.pdf');
        return $pdf->download('invoice.pdf');
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $companyProfile = Profile::whereType('invoice')->first();
        $customerMaster   = CustomerMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $DesignCard = DesignCard::with(['salesRepDetail','customerDetail'])->where('type','woven')->get()->toArray();
        $editInvoice = "";

        return view("invoice.create",compact('editInvoice','customerMaster','DesignCard', 'companyProfile'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validatedFields    = $this->addOrEditRequest($request);
            Invoice::create($validatedFields);

            return redirect()
                ->route("invoice.index")
                ->with("success", "Invoice created successfully.");
        } catch (\Exception $exception) {
            DB::rollBack();
            return redirect()
                ->back()
                ->with(
                    "danger",
                    "Something went wrong" . $exception->getMessage()
                );
        }
    }

    public function show($invoice)
    {
        $companyProfile = Profile::whereType('invoice')->first();
        $customerMaster   = CustomerMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $DesignCard = DesignCard::with(['salesRepDetail','customerDetail'])->where('type','woven')->get()->toArray();
        $editInvoice = Invoice::with('customerDetail')->find($invoice);
        $editInvoice->created_at = date("Y-m-d", strtotime($editInvoice->created_at));
        $editInvoice->items = json_decode($editInvoice->Items);
        $editInvoice->aditional_charge = json_decode($editInvoice->aditional_charge);

        return view("invoice.show", compact('editInvoice','customerMaster','DesignCard', 'companyProfile'));

        $invoice = Invoice::findOrFail($invoice);
        return view("invoice.show", compact("invoice"));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice  $invoice)
    {
        $companyProfile = Profile::whereType('invoice')->first();
        $customerMaster   = CustomerMaster::orderBy('created_at', 'DESC')->get()->toArray();
        $DesignCard = DesignCard::with(['salesRepDetail','customerDetail'])->where('type','woven')->get()->toArray();
        $editInvoice = Invoice::find($invoice->id);
        $editInvoice->created_at = date("Y-m-d", strtotime($editInvoice->created_at));
        $editInvoice->items = json_decode($editInvoice->Items);
        $editInvoice->aditional_charge = json_decode($editInvoice->aditional_charge);

        return view("invoice.create", compact('editInvoice','customerMaster','DesignCard', 'companyProfile'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $validatedFields    = $this->addOrEditRequest($request);
        $invoice = Invoice::find($id)->update($validatedFields);
        // dd($validatedFields);
        return redirect()
        ->route("invoice.index")
        ->with("warning", "Invoice updated successfully.");
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        $invoice->delete();
        return redirect()
            ->route("invoice.index")
            ->with("danger", "Invoice deleted successfully.");
    }

    public function addOrEditRequest($request)
    {
        $validatedFields                        = $request->all();
        $validatedFields['design_card_id']              = json_encode($request->design_card_id);
        $validatedFields['quantity']          = json_encode($request->quantity);
        $validatedFields['price']           = json_encode($request->price);
        $validatedFields['discount']          = json_encode($request->discount);
        $validatedFields['tax']    = json_encode($request->tax);
        $validatedFields['amount']     = json_encode($request->amount);
        $validatedFields['invoice_no']     = $request->invoice_id;
        $validatedFields['aditional_charge']     = json_encode($request->additional_charge);
        $validatedFields['overall_discount']     = $request->overall_discount_percentage;
        $validatedFields['recived_amount']     = $request->received_amount;
        $validatedFields['balance_amount']     = $request->balance;
        $validatedFields['Items']     = json_encode($request->new_row);

        return $validatedFields;
    }
}
