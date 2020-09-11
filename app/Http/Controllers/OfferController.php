<?php

namespace App\Http\Controllers;

use App\Model\Offer;
use App\Traits\OfferTrait;
use Illuminate\Http\Request;
use App\Http\Requests\OfferRequest;

class OfferController extends Controller
{
    use OfferTrait;


    public function all(){

        $offers = Offer::select('id',
           'price',
           'photo',
           'name',
           'details' 
       )->limit(10)->get(); // return collection

       return view('ajaxoffers.all', compact('offers'));
   }


    public function create()
    {
        //view form to add this offer

        return view('ajaxoffers.create');
    }

    public function store(OfferRequest $request)
    {
        //save offer into DB using AJAX

        $file_name = $this->saveImages($request->photo, 'images/offers');
        //insert  table offers in database
        $offer = Offer::create([
            'photo' => $file_name,
            'name' => $request->name,
            'price' => $request->price,
            'details' => $request->details,

        ]);

        if ($offer)
            return response()->json([
                'status' => true,
                'msg' => 'تم الحفظ بنجاح',
            ]);

        else
            return response()->json([
                'status' => false,
                'msg' => 'فشل الحفظ برجاء المحاوله مجددا',
            ]);
    }




    public function edit(Request  $request)
    {
         $offer = Offer::find($request -> offer_id);  // search in given table id only
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذ العرض غير موجود',
            ]);

        $offer = Offer::select('id', 'name',  'details', 'price')->find($request -> offer_id);

        return view('ajaxoffers.edit', compact('offer'));

    }

    public  function update(Request $request){
        $offer = Offer::find($request -> offer_id);
        if (!$offer)
            return response()->json([
                'status' => false,
                'msg' => 'هذ العرض غير موجود',
            ]);

        //update data
        $offer->update($request->all());

        return response()->json([
            'status' => true,
            'msg' => 'تم  التحديث بنجاح',
        ]);
    }

    public function delete(Request $request){

        $offer = Offer::find($request -> id);   // Offer::where('id','$offer_id') -> first();

        if (!$offer)
            return redirect()->back()->with(['error' => 'messages.offer not exist']);

        $offer->delete();

        return response()->json([
            'status' => true,
            'msg' => 'تم الحذف بنجاح',
            'id' =>  $request -> id
        ]);

    }
}
