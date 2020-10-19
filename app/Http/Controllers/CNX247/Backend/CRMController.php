<?php

namespace App\Http\Controllers\CNX247\Backend;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Carbon\Carbon;
use App\Client;
use App\ClientLog;
use App\ClientMessaging;
use App\Mail\ClientMessaging as ClientMessagingMail;
use App\Mail\SendInvoice;
use App\Mail\SendReceipt;
use App\Ticket;
use App\Lead;
use App\Deal;
use App\Invoice;
use App\InvoiceItem;
use App\Receipt;
use App\ReceiptItem;
use App\Product;
use App\Feedback;
use App\ProductCategory;
use Auth;
use Image;
use DB;
use Schema;


class CRMController extends Controller
{
    public function __construct(){
        $this->middleware('auth');
    }
    //Load CRM dashboard
    public function crmDashboard(){
        $clients = Client::where('tenant_id', Auth::user()->tenant_id)->count();
        $deals = Deal::where('tenant_id', Auth::user()->tenant_id)->count();
        $income = Receipt::where('tenant_id', Auth::user()->tenant_id)->sum('total');
        $invoice = Invoice::where('tenant_id', Auth::user()->tenant_id)->sum('total');
        $client_logs = ClientLog::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->take(5)->get();
        $tickets = Ticket::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->take(10)->get();
        #Duration stats
            #Leads
                $leads = Lead::where('tenant_id', Auth::user()->tenant_id)->count();
                #This months's clients
                $month_clients = Client::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereMonth('created_at', Carbon::now()->isCurrentMonth())
                                    ->count();
                #This months's leads
                $month_leads = Lead::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereMonth('created_at', Carbon::now()->isCurrentMonth())
                                    ->count();
                #Today's clients
                $today_clients = Client::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereDay('created_at', Carbon::today())
                                    ->count();
                #Today's leads
                $today_leads = Lead::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereDay('created_at', Carbon::today())
                                    ->count();
            #Deals
                #This months's deals
                $month_deals = Deal::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereMonth('created_at', Carbon::now()->isCurrentMonth())
                                    ->count();
                #Today's deals
                $today_deals = Deal::where('tenant_id', Auth::user()->tenant_id)
                                    ->whereDate('created_at', Carbon::today())
                                    ->count();

        return view('backend.crm.dashboard',[
            'clients'=>$clients,
            'income'=>$income,
            'invoice'=>$invoice,
            'deals'=>$deals,
            'client_logs'=>$client_logs,
            'leads'=>$leads,
            'month_clients'=>$month_clients,
            'month_leads'=>$month_leads,
            'today_clients'=>$today_clients,
            'today_leads'=>$today_leads,
            'month_deals'=>$month_deals,
            'today_deals'=>$today_deals,
            'tickets'=>$tickets
        ]);
    }

    /*
    * Leads
    */
    public function leads(){
        return view('backend.crm.leads.index');
    }

    #Contacts/clients
    public function clients(){
        return view('backend.crm.clients.index');
    }

    #Contacts/uploadClientAvatar
    public function uploadClientAvatar(Request $request){
        $this->validate($request,[
            'avatar'=>'required'
        ]);
        if($request->avatar){
    	    $file_name = time().'.'.explode('/', explode(':', substr($request->avatar, 0, strpos($request->avatar, ';')))[1])[1];
    	    //avatar image
    	    \Image::make($request->avatar)->resize(300, 300)->save(public_path('assets/images/clients/avatars/medium/').$file_name);
    	    \Image::make($request->avatar)->resize(150, 150)->save(public_path('assets/images/clients/avatars/thumbnails/').$file_name);


    	}
        $client = Client::where('id',$request->client)->where('tenant_id', Auth::user()->tenant_id)->first();
        $client->avatar = $file_name;
        $client->save();
        return response()->json(['message'=>'Success! Client avatar updated.']);

    }

    /*
    * Create new client
    */
    public function createClient(){
        return view('backend.crm.clients.create');
    }

    /*
    * view client
    */
    public function viewClient($slug){
        $client = Client::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        return view('backend.crm.clients.view',['client'=>$client]);
    }
    /*
    * view client
    */
    public function editClient($slug){
        return view('backend.crm.clients.edit');
    }

    /*
    * Convert client to lead
    */
    public function convertClientToLead($slug){
        $client = Client::where('slug', $slug)->first();
        $invoice = Invoice::orderBy('id', 'DESC')->first();
        $products = Product::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $invoiceNo = null;
        if(!empty($invoice) ){
            $invoiceNo = $invoice->invoice_no + rand(11, 99);
        }else{
            $invoiceNo = rand(111, 999);
        }
        return view('backend.crm.clients.convert-to-lead', ['client'=>$client, 'invoice_no'=>$invoiceNo, 'products'=>$products]);
    }

    /*
    * Raise an invoice
    */
    public function raiseAnInvoice(Request $request){
        $this->validate($request,[
            'issue_date'=>'required',
            'due_date'=>'required|after_or_equal:issue_date',
            'description.*'=>'required',
            'quantity.*'=>'required'
        ]);
        //return dd($request->all());
        $totalAmount = 0;
        if(!empty($request->total)){
            for($i = 0; $i<count($request->total); $i++){
                $totalAmount += $request->total[$i];
            }
        }
        $productGlCodes = [];
        if(!empty($request->description)){
            for($d = 0; $d < count($request->description); $d ++){
                $product = Product::where('tenant_id', Auth::user()->tenant_id)
                                    ->where('id',$request->description[$d])->first();
                array_push($productGlCodes, $product->glcode);
            }
        }
        //return $productGlCodes;
        //Check if client already exist
        $clientExist = Lead::where('client_id', $request->clientId)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(empty($clientExist)){
            $lead = new Lead;
            $lead->client_id = $request->clientId;
            $lead->tenant_id = Auth::user()->tenant_id;
            $lead->converted_by = Auth::user()->id;
            //$lead->slug = substr(sha1(time()), 23,40);
            $lead->save();
        }

        #Generate invoice
        $invoice = new Invoice;
        $invoice->invoice_no = $request->invoiceNo;
        $invoice->client_id = $request->clientId;
        $invoice->tenant_id = Auth::user()->tenant_id;
        $invoice->issued_by = Auth::user()->id;
        $invoice->issue_date = $request->issue_date;
        $invoice->due_date = $request->due_date;
        $invoice->total = $request->totalAmount;
        $invoice->sub_total = $request->subTotal;
        $invoice->tax_rate = $request->hiddenTaxRate ?? 0;
        $invoice->discount_rate = $request->hiddenDiscountRate ?? 0;
        $invoice->tax_value = $request->taxValue ?? 0;
        $invoice->discount_value = $request->discountValue ?? 0;
        $invoice->cash = $request->cash_amount ?? 0;
        $invoice->slug = substr(sha1(time()), 23,40);
        $invoice->save();
        #invoiceId
        $invoiceId = $invoice->id;
        #Enter invoice items
        for($i = 0; $i<count($request->description); $i++ ){
            $pro = Product::find($request->description[$i]);
            $item = new InvoiceItem;
            $item->description = $pro->product_name ?? '';
            $item->quantity = $request->quantity[$i];
            $item->unit_cost = $request->unit_cost[$i];
            $item->total = $request->quantity[$i] * $request->unit_cost[$i];
            $item->invoice_id = $invoiceId;
            $item->client_id = $request->clientId;
            $item->tenant_id = Auth::user()->tenant_id;
            $item->save();
        }
        #Check for accounting module
        $trans_ref = strtoupper(substr(sha1(time()), 35,40).$request->invoiceNo);
        if(Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            //$services = InvoiceItem::where('tenant_id', Auth::user()->tenant_id)->whereIn('invoice_id', [$serviceIds])->get();
            $productArray = [];
            for($n = 0; $n<count($request->description); $n++ ){
                $productGl = [
                    'glcode'=>$productGlCodes[$n],
                    'posted_by'=>Auth::user()->id,
                    'narration'=>"Invoice generation for ",
                    'dr_amount'=>0,
                    'cr_amount'=>$request->unit_cost[$n],
                    'ref_no'=>$trans_ref,
                    'bank'=>0,
                    'ob'=>0,
                    'created_at'=>$request->issue_date,
                ];
                array_push($productArray, $productGl);
            }
            #Register service in GL table
            DB::table(Auth::user()->tenant_id.'_gl')->insert($productArray);
        }
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $request->clientId;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' Converted contact to lead.';
        $log->save();
        session()->flash("success", "<strong>Success! </strong> Invoice generated. Proceed to print it or send via mail.");
        return redirect()->route('invoice-list');
    }

    public function sendEmailToClient(Request $request){
        $this->validate($request,[
            'email'=>'required',
            'subject'=>'required',
            'content'=>'required'
        ]);
        $client = Client::where('id', $request->client)->where('tenant_id', Auth::user()->tenant_id)->first();
        $message = new ClientMessaging;
        $message->tenant_id = Auth::user()->tenant_id;
        $message->sent_by = Auth::user()->id;
        $message->client_id = $request->client;
        $message->email = $request->email;
        $message->subject = $request->subject;
        $message->content = $request->content;
        $message->type = 1;//email
        $message->save();
        \Mail::to($client)->send(new ClientMessagingMail($client, $message));
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $request->client;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' Sent an email.';
        $log->save();
        if($message){
            return response()->json(['message'=>'Success! Mail sent.'], 200);
        }else{
            return response()->json(['error'=>'Ooops! Could not send email. Try again'], 400);
        }
    }

    public function sendSmsToClient(Request $request){
        $this->validate($request,[
            'mobile_no'=>'required',
            'sms'=>'required'
        ]);
    }

        /*
    * Convert client to lead
    */
    public function receivePayment($slug){
        $invoice = Invoice::where('tenant_id', Auth::user()->tenant_id)->where('slug', $slug)->first();
        if(!empty($invoice) ){
            $total = 0;
            $charts = DB::table(Auth::user()->tenant_id.'_coa')->orderBy('glcode', 'ASC')->get();
            $pending_invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)
                                        ->where('status', 0)->where('client_id', $invoice->client_id)->get();
            return view('backend.crm.clients.receive-payment', [
                'invoice'=>$invoice,
                'pending_invoices'=>$pending_invoices,
                'total'=>$total,
                'charts'=>$charts
                ]);
        }else{
            session()->flash("error", "<strong>Ooops!</strong> No record found.");
            return redirect()->back();
        }
    }

    public function postPayment(Request $request){
        return dd($request->all());
    }

    /*
    * view lead
    */
    public function viewLead($slug){
        return view('backend.crm.leads.view');
    }

    /*
    * Invoice list [index]
    */
    public function invoiceList(){
        $now = Carbon::now();
        $invoices = Invoice::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $monthly = Invoice::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->sum('total');
        $last_month = Invoice::where('tenant_id', Auth::user()->tenant_id)
                             ->whereMonth('created_at', '=', $now->subMonth()->month)
                            ->sum('total');
        $thisYear = Invoice::where('tenant_id', Auth::user()->tenant_id)
                            ->whereYear('created_at', date('Y'))
                            ->sum('total');
        $this_week = Invoice::where('tenant_id', Auth::user()->tenant_id)
                            ->whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                            ->sum('total');
        return view('backend.crm.invoice.index',
        [
            'invoices'=>$invoices,
            'monthly'=>$monthly,
            'last_month'=>$last_month,
            'this_week'=>$this_week,
            'thisYear'=>$thisYear
        ]);
    }

    /*
    * Print invoice
    */
    public function printInvoice($slug){
        $invoice = Invoice::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($invoice)){

            return view('backend.crm.invoice.print-invoice', ['invoice'=>$invoice]);
        }else{
            return "Invoice not found";
        }
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $invoice->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' printed invoice('.$invoice->invoice_no.")";
        $log->save();
    }

    /*
    * Send invoice via email
    */
    public function sendInvoiceViaEmail(Request $request){
        $invoice = Invoice::where('id', $request->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        //$client = Client::where('client_id', $invoice->client_id)->where('tenant_id', Auth::user()->tenant_id)->first();
        \Mail::to($invoice->client->email)->send(new SendInvoice($invoice));
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $invoice->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' sent invoice('.$invoice->invoice_no.") via mail.";
        $log->save();
        return response()->json(['message'=>'Sent!']);
    }

        /*
    * Convert lead to deal
    */
    public function convertLeadToDeal($slug){
        $client = Client::where('slug', $slug)->first();
        $receipt = Receipt::orderBy('id', 'DESC')->first();
        $receiptNo = null;
        if(!empty($invoice) ){
            $receiptNo = $receipt->receipt_no + rand(11, 99);
        }else{
            $receiptNo = rand(111, 999);
        }
        return view('backend.crm.leads.convert-to-deal', ['client'=>$client, 'receipt_no'=>$receiptNo]);
    }

    /*
    * Convert lead to deal
    */
    public function raiseReceipt(Request $request){
        $this->validate($request,[
            'issue_date'=>'required',
            'due_date'=>'required',
            'description.*'=>'required',
            'quantity.*'=>'required'
        ]);
        $deal = new Deal;
        $deal->client_id = $request->clientId;
        $deal->tenant_id = Auth::user()->tenant_id;
        $deal->converted_by = Auth::user()->id;
        //$lead->slug = substr(sha1(time()), 23,40);
        $deal->save();
        #Generate receipt
        $receipt = new Receipt;
        $receipt->receipt_no = $request->receiptNo;
        $receipt->client_id = $request->clientId;
        $receipt->tenant_id = Auth::user()->tenant_id;
        $receipt->issue_date = $request->issue_date;
        $receipt->issued_by = Auth::user()->id;
        $receipt->due_date = $request->due_date;
        $receipt->total = $request->receiptTotal;
        $receipt->sub_total = $request->receiptSubtotal;
        $receipt->tax_rate = $request->taxRate ?? 0;
        $receipt->discount_rate = $request->discountRate ?? 0;
        $receipt->tax_value = $request->taxValue ?? 0;
        $receipt->discount_value = $request->discountValue ?? 0;
        $receipt->slug = substr(sha1(time()), 23,40);
        $receipt->save();
        #receiptId
        $receiptId = $receipt->id;
        #Enter receipt items
        for($i = 0; $i<count($request->description); $i++ ){
            $item = new ReceiptItem;
            $item->description = $request->description[$i];
            $item->quantity = $request->quantity[$i];
            $item->unit_cost = $request->unit_cost[$i];
            $item->total = $request->total[$i];
            $item->receipt_id = $receiptId;
            $item->client_id = $request->clientId;
            $item->tenant_id = Auth::user()->tenant_id;
            $item->save();
        }
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $request->clientId;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' Converted contact to deal.';
        $log->save();
        session()->flash("success", "<strong>Success! </strong> Invoice generated. Proceed to print it or send via mail.");
        return redirect()->back();
    }


    /*
    * Receipt list [index]
    */
    public function receiptList(){
        $now = Carbon::now();
        $receipts = Receipt::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        $monthly = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->whereMonth('created_at', date('m'))
                            ->whereYear('created_at', date('Y'))
                            ->sum('total');
        $last_month = Receipt::where('tenant_id', Auth::user()->tenant_id)
                             ->whereMonth('created_at', '=', $now->subMonth()->month)
                            ->sum('total');
        $thisYear = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->whereYear('created_at', date('Y'))
                            ->sum('total');
        $this_week = Receipt::where('tenant_id', Auth::user()->tenant_id)
                            ->whereBetween('created_at', [$now->startOfWeek()->format('Y-m-d H:i'), $now->endOfWeek()->format('Y-m-d H:i')])
                            ->sum('total');
        return view('backend.crm.receipt.index',
        ['receipts'=>$receipts,
        'monthly'=>$monthly,
        'last_month'=>$last_month,
        'this_week'=>$this_week,
        'thisYear'=>$thisYear
        ]);
    }

    /*
    * Print invoice
    */
    public function printReceipt($slug){
        $receipt = Receipt::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($receipt)){

            return view('backend.crm.receipt.print-receipt', ['receipt'=>$receipt]);
        }else{
            return "receipts not found";
        }
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $receipt->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' printed receipt('.$receipt->receipt_no.")";
        $log->save();
    }

    /*
    * Send receipt via email
    */
    public function sendReceiptViaEmail(Request $request){
        $receipt = Receipt::where('id', $request->id)->where('tenant_id', Auth::user()->tenant_id)->first();
        \Mail::to($receipt->client->email)->send(new SendReceipt($receipt));
        #Register log
        $log = new ClientLog;
        $log->tenant_id = Auth::user()->tenant_id;
        $log->client_id = $receipt->client_id;
        $log->user_id = Auth::user()->id;
        $log->log = Auth::user()->first_name.' '.Auth::user()->surname.' sent receipt('.$receipt->receipt_no.") via mail.";
        $log->save();
        return response()->json(['message'=>'Sent!']);
    }

    /*
    * Deals
    */
    public function deals(){
        return view('backend.crm.deals.index');
    }

    /*
    * view deal
    */
    public function viewDeal($slug){
        return view('backend.crm.deals.view');
    }

    /*
    * Products [index]
    */
    public function products(){
        $products = Product::where('tenant_id', Auth::user()->tenant_id)->orderBy('id', 'DESC')->get();
        return view('backend.crm.products.index', ['products'=>$products]);
    }

    /*
    * Add new product [add]
    */
    public function addNewProduct(){
        $exist = null;
        $categories = ProductCategory::where('tenant_id', Auth::user()->tenant_id)->orderBy('category', 'ASC')->get();
        if(!Schema::connection('mysql')->hasTable(Auth::user()->tenant_id.'_coa')){
            $exist = 'no';
            return view('backend.crm.products.create', ['categories'=>$categories, 'exist'=>$exist]);
        }else{
            $exist = 'yes';
            $charts = DB::table(Auth::user()->tenant_id.'_coa')->orderBy('glcode', 'ASC')->get();
            return view('backend.crm.products.create', ['categories'=>$categories, 'exist'=>$exist, 'charts'=>$charts]);
        }


    }

    /*
    * Save product
    */
    public function saveProduct(Request $request){
        if($request->exist == 'yes'){
            $this->validate($request,[
                'product_name'=>'required',
                'product_description'=>'required',
                'price'=>'required',
                'product_category'=>'required',
                'featured_image'=>'required',
                'account'=>'required'
            ]);

        }else{
            $this->validate($request,[
                'product_name'=>'required',
                'product_description'=>'required',
                'price'=>'required',
                'product_category'=>'required',
                'featured_image'=>'required'
            ]);
        }
        if(!empty($request->file('featured_image'))){
            $extension = $request->file('featured_image');
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $dir = 'assets/uploads/featuredImage/';
            $featured_image = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('featured_image')->move(public_path($dir), $featured_image);
        }else{
            $featured_image = '';
        }

        $product = new Product;
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->price = $request->price;
        $product->added_by = Auth::user()->id;
        $product->tenant_id = Auth::user()->tenant_id;
        $product->category_id = $request->product_category;
        $product->slug = substr(sha1(time()), 23,40);
        $product->glcode = $request->account;
        $product->featured_image = $featured_image;
        $product->save();
        session()->flash("success", "<strong>Success! </strong> Product saved.");
        return redirect()->route('products');
    }

    /*
    * View product
    */
    public function viewProduct($slug){
        $product = Product::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($product)){
            return view('backend.crm.products.view', ['product'=>$product]);
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Edit product
    */
    public function editProduct($slug){
        $product = Product::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        $categories = ProductCategory::where('tenant_id', Auth::user()->tenant_id)->orderBy('category', 'ASC')->get();
        if(!empty($product)){
            return view('backend.crm.products.edit', ['product'=>$product, 'categories'=>$categories]);
        }else{
            return redirect()->route('404');
        }
    }

    /*
    * Save product changes
    */
    public function saveProductChanges(Request $request){
        $this->validate($request,[
            'product_name'=>'required',
            'product_description'=>'required',
            'price'=>'required',
            'product_category'=>'required',
            'featured_image'=>'required'
        ]);
        //return dd($request->all());
        if(!empty($request->file('featured_image'))){
            $extension = $request->file('featured_image');
            $extension = $request->file('featured_image')->getClientOriginalExtension();
            $dir = 'assets/uploads/featuredImage/';
            $featured_image = uniqid().'_'.time().'_'.date('Ymd').'.'.$extension;
            $request->file('featured_image')->move(public_path($dir), $featured_image);
        }else{
            $featured_image = '';
        }

        $product = Product::find($request->productId);
        $product->product_name = $request->product_name;
        $product->product_description = $request->product_description;
        $product->price = $request->price;
        $product->added_by = Auth::user()->id;
        $product->tenant_id = Auth::user()->tenant_id;
        $product->category_id = $request->product_category;
        $product->slug = substr(sha1(time()), 23,40);
        $product->featured_image = $featured_image;
        $product->save();
        session()->flash("success", "<strong>Success! </strong> Product saved.");
        return redirect()->route('products');
    }

    /*
    * Delete product
    */
    public function deleteProduct($slug){
        $product = Product::where('slug', $slug)->where('tenant_id', Auth::user()->tenant_id)->first();
        if(!empty($product)){
            $product->delete();
            return redirect()->route('products');
        }else{
            return redirect()->route('404');
        }
    }

    public function feedbacks(){
        $feedbacks = Feedback::orderBy('id', 'DESC')->get();
        return view('backend.crm.feedback.index', ['feedbacks'=>$feedbacks]);
    }

    public function feedbackStatus(Request $request){
        $this->validate($request,[
            'id'=>'required',
            'value'=>'required'
        ]);
        $feed = Feedback::find($request->id);
        $feed->favourite = $request->value;
        $feed->save();
        return response()->json(['message'=>'Success! Feedback updated.']);
    }
}
