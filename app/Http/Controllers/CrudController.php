<?php

namespace App\Http\Controllers;
use App\Http\Requests\OfferRequest;
use App\Models\Offer;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use LaravelLocalization;
class CrudController extends Controller
{
    public function __construct()
    {


    }
    public function getOffers()
    {
        return Offer::select('id', 'name')->get();
    }
    /*public function store(){
        Offer::create([
            'name'=>'offer',
            'price'=>'900',
            'details'=>'offer details',
        ]);
    }*/
    public function create(){
        return view('offers.create');
    }
    public  function store(OfferRequest $request){
       /*$rulese= ['name'=>'required|max:100|unique:offers,name',
            'price'=>'required|numeric',
            'details'=>'required',
        ];
        $messages=$this->getMessages();
        $validator=Validator::make($request->all(),$rulese,$messages);


            if ($validator->fails()){
                return redirect()->back()->withErrors($validator)->withInputs($request->all());
            }*/
        Offer::create([
            'name_ar' => $request->name_ar,
            'name_en' => $request->name_en,
            'price' => $request->price,
            'details_ar' => $request->details_ar,
            'details_en' => $request->details_en,

        ]);
        return redirect()->back()->with(['success'=>'تم اضافة العرض بنجاح']);
    }
   /* protected function getMessages(){
        return $message=[
            'name.required'=>__('messages.offer name required'),
            'name.unique'=>__('messages.offer name required'),
            'price.numeric'=>__('messages.offer price required'),
            'price.required'=>__('messages.offer price required'),
        ];

    }*/
    public function getAllindex(){
        $offers=Offer::select('id',
            'price',
            'name_'. LaravelLocalization::getCurrentLocale().' as name',
            'details_'.LaravelLocalization::getCurrentLocale().' as details')->get();
        return view('offers.all',compact('offers'));
    }

}




