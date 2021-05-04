<?php

namespace App\Http\Controllers;

use App\Events\VideoViewer;
use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;
use App\Models\Video;
use App\Traits\OfferTrait;

class CrudController extends Controller
{
    use OfferTrait;

    public function getOffers()
    {
        return Offer::select('id', 'name')->get();
    }


    public function create()
    {
        return view('offers.create');
    }

    public function store(OfferRequest $request)
    {
        // validate data before insert to database
        // $rules = $this->getRules();
        // $messages = $this->getMessages();
        // $validator = Validator::make($request->all(), $rules, $messages);
        // if ($validator->fails()) {
        //     return redirect()->back()->withErrors($validator)->withInput($request->all());
        // }

        $file_name = $this->saveImage($request->photo, 'images/offers');

        // insert data
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
            'photo' => $file_name,
        ]);

        return redirect()->route('offers.all')->with(['success' => 'تم إضافة العرض بنجاح']);
    }

    /*
    protected function getMessages()
    {
        return $messages = [
            'name.required' => __('messages.offer name required'),
            'name.unique' => 'اسم العرض موجود',
            'price.required' => 'السعر مطلوب',
            'price.numeric' => 'سعر العرض يجب أن يكون أرقام',
            'details.required' => 'التفاصيل مطلوبة',
        ];
    }

    protected function getRules()
    {
        return $rules = [
            'name' => 'required|max:100|unique:offers,name',
            'price' => 'required|numeric',
            'details' => 'required',
        ];
    }
    */

    public function getAllOffers()
    {
       $offers = Offer::all();
        return view('offers.all', compact('offers'));
    }

    public function editOffer($offer_id)
    {
        // Offer::findOrFail($offer_id);
        $offer = Offer::find($offer_id); //search in given table id only

        if(!$offer)
            return redirect()->back();

        $offer = Offer::select('id', 'name', 'price', 'details')->find($offer_id);

        return view('offers.edit', compact('offer'));
    }

    public function delete($offer_id)
    {
        // check if offer id exists
        $offer = Offer::find($offer_id);

        if(!$offer)
            return redirect()->back()->with(['error' => 'العرض غير موجود']);

        $offer->delete();

        return redirect()->route('offers.all')->with(['success' => 'تم الحذف بنجاح']);
    }

    public function updateOffer(OfferRequest $request, $offer_id)
    {
        // update data
        $offer = Offer::find($offer_id);

        if(!$offer)
            return redirect()->back();

        $offer->update($request->all());
        return redirect()->back()->with(['success' => 'تم التحديث بنجاح']);
    }

    public function getVideo()
    {
        $video = Video::first();

        event(new VideoViewer($video));
        return view('video')->with('video', $video);
    }

}
