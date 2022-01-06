<?php

namespace App\Http\Controllers\Admin;

use App\User;
use App\Invoice;
use App\InvoiceDetail;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInvoice;
use App\Http\Requests\UpdateInvoice;

class InvoiceController extends Controller
{
    /**
     * Display a listing of the resource.
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request, Invoice $invoice)
    {
        $invoices = Invoice::has('user');

        $invoices = $invoices->paginate();

        return view('admin.invoices.index', compact('invoices'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $users = User::has('enrollments')->get();
        return view('admin.invoices.add', compact('users'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoice $request, Invoice $invoice)
    {
        $data = $request->validated();

        try {

            DB::beginTransaction();
            $invoice = Invoice::create([
                'user_id' => $data['user_id'],
                'invoiced_at' => date($data['invoice_date']),
                'invoice_type' => $data['invoice_type'],
            ]);

            $invoice->details()->createMany($data['details']);
            DB::commit();

            return redirect()->route('admin.invoices.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin Subject Create Exception: ' . $e);
            return redirect()->route('admin.invoices.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function show(Invoice $invoice)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function edit(Invoice $invoice)
    {
        $users = User::has('enrollments')->get();
        $details = $invoice->details()->get();

        return view('admin.invoices.edit', compact('details', 'invoice', 'users'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoice $request, Invoice $invoice)
    {
        $data = $request->validated();

        try {

            DB::beginTransaction();
            $invoice->user_id = $data['user_id'];
            $invoice->invoiced_at = $data['invoice_date'];
            $invoice->invoice_type = $data['invoice_type'];
            $invoice->save();

            if ($data['details']) {
                foreach ($data['details'] as $key => $value) {
                    InvoiceDetail::updateOrCreate(
                        [
                            'id' => !empty($value['id'])? $value['id'] : null,
                        ],

                        [
                            'item' => $value['item'],
                            'cost' => $value['cost'],
                            'invoice_id' => $invoice->id,
                        ]
                    );
                }
            }
            DB::commit();

            return redirect()->route('admin.invoices.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

        } catch (\Exception $e) {

            DB::rollback();
            \Log::error('Admin Invoice Update Exception: ' . $e);
            return redirect()->route('admin.invoices.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');

        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Invoice  $invoice
     * @return \Illuminate\Http\Response
     */
    public function destroy(Invoice $invoice)
    {
        //
    }
}
