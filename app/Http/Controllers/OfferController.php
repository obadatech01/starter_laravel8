<?php

namespace App\Http\Controllers;

use App\Http\Requests\OfferRequest;
use App\Models\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;

class OfferController extends Controller
{
    use OfferTrait;

    public function create()
    {
        // view form to add this offer
        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request)
    {
        // save offer into DB using AJAX

        $file_name = $this->saveImage($request->photo, 'images/offers');
        //insert  table offers in database
        $offer = Offer::create([
            'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);

        if($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);

        if($offer)
            return response()->json([
                'status' => false,
                'msg' => 'فشل المحاولة، الرجاء المحاولة مرة أخرى',
            ]);
    }

    public function all(){

        $offers = Offer::select('id', 'price', 'photo', 'name', 'details'
       )->limit(10)->get(); // return collection

       return view('ajaxoffers.all', compact('offers'));
   }

   public function delete(Request $request){

    $offer = Offer::find($request->id);   // Offer::where('id','$offer_id') -> first();

    if (!$offer)
        return redirect()->back()->with(['error' => __('messages.offer not exist')]);

    $offer->delete();

    return response()->json([
        'status' => true,
        'msg' => 'تم الحذف بنجاح',
        'id' =>  $request->id
    ]);

}
}
