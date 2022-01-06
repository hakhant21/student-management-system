<?php

namespace App\Http\Controllers\Admin;

use App\InvoiceType;
use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use App\Http\Requests\CreateInvoiceType;
use App\Http\Requests\UpdateInvoiceType;

class InvoiceTypeController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index(Request $request)
    {
        $invoice_types = InvoiceType::orderby('created_at', 'DESC');
        
        if(!empty($request->get('keyword'))){
            $invoice_types =$invoice_types->where('name', 'like', '%' . str_replace(' ', '%', $request->keyword) . '%');
        }
        

        $invoice_types = $invoice_types->paginate(10);        
        return view('admin.invoice_types.index', compact('invoice_types'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        return view('admin.invoice_types.add');
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(CreateInvoiceType $request)
    {
        $data = $request->validated();

        try {
            
            InvoiceType::create($data);

            return redirect()->route('admin.invoice_types.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');
        
        } catch (\Exception $e) {

            \Log::error('Admin Invoice Type Create Exception: ' . $e );
            return redirect()->route('admin.invoice_types.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');

        }
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\InvoiceType  $invoice_type
     * @return \Illuminate\Http\Response
     */
    public function show(InvoiceType $invoice_type)
    {
        return view('admin.invoices_types.view', compact('invoice_type'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\InvoiceType  $invoice_type
     * @return \Illuminate\Http\Response
     */
    public function edit(InvoiceType $invoice_type)
    {
        return view('admin.invoice_types.edit', compact('invoice_type'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\InvoiceType  $invoice_type
     * @return \Illuminate\Http\Response
     */
    public function update(UpdateInvoiceType $request, InvoiceType $invoice_type)
    {
        $data = $request->validated();
        
        try {

            $invoice_type->name = $data['name'];
            $invoice_type->save();

            return redirect()->route('admin.invoice_types.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');
       
        } catch (\Exception $e) {
            
            \Log::error('Admin Invoice Type Update Exception: ' . $e );
            return redirect()->route('admin.invoice_types.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\InvoiceType  $invoice_type
     * @return \Illuminate\Http\Response
     */
    public function destroy(InvoiceType $invoice_type)
    {
       
        try {

            $invoice_type->delete();

            return redirect()->route('admin.invoice_types.index')->with('success', 'ဖန်တီးမှု အောင်မြင်ခဲ့သည်။');

       } catch (\Exception $e){

            \Log::error('Admin Invoice Type Delete Exception: ' . $e );
            return redirect()->route('admin.invoices_types.index')->with('error', 'ဖန်တီးမှု မအောင်မြင်ခဲ့ပါ။');
       }
    }
}
