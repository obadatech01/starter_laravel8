<?php

namespace App\Http\Controllers;

use App\Models\Offer;
use Illuminate\Support\Facades\Validator;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;

class CrudController extends Controller
{
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

        // insert data
        Offer::create([
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,
        ]);

        return redirect()->back()->with(['success' => 'تم إضافة العرض بنجاح']);
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


       ##################### paginate result ####################
       $offers = Offer::all();



        return view('offers.all', compact('offers'));
    }

}
