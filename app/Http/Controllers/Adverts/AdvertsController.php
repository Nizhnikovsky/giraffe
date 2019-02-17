<?php
/**
 * Created by PhpStorm.
 * User: mike
 * Date: 16.02.19
 * Time: 18:57
 */

namespace App\Http\Controllers\Adverts;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use App\Models\Advert;
use App\User;
use Illuminate\Support\Facades\Validator;

class AdvertsController extends Controller
{

    public function __construct()
    {
        $this->middleware('auth')->except('getAllAdverts','showAdvert','pagginateAdverts');
    }

    public function getAllAdverts()
    {
        $user = Auth::user();
        $adverts = Advert::skip(0)->take(5)->get()->load('users')->toArray();
        $pages = Advert::get()->count();
        $pages = (int)round($pages/5);
        $result = [
            'user'=>$user,
            'adverts'=>$adverts,
            'pages'=>$pages
        ];
        return view('adverts.all_adverts',['result'=>$result]);
    }

    public function createAdvert()
    {
        $user = Auth::user();
        $result = ['user'=>$user];
        return view('adverts.create_advert',['result'=>$result]);
    }

    public function showAdvert(Request $request)
    {
        $id = $request->id;
        $advert = Advert::where('id',$id)->get()->load('users')->toArray();
        $user = Auth::user();
        $result = [
            'user'=>$user,
            'advert'=>$advert[0]
        ];
        return view('adverts.show_advert',['result'=>$result]);
    }

    public function saveAdvert(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title'   => 'required',
            'description' => 'required'
        ]);

        if($v->fails()) {
            return response()->json(['message'=>$v->errors()],201);
        }

        $advert = new Advert();
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->user_id = Auth::id();
        $advert->photo = '/img/all_adverts/sm.Xiaomi-Redmi-5-official-renders-1-1.750.jpg';
        $advert->created_at = new \DateTime('now');
        try{
            $advert->save();
            return response()->json(['message'=>'advert saved'],200);
        }catch (\Exception $e)
        {
            return response()->json(['message'=>$e->getMessage()],400);
        }
    }

    public function saveAfterEditAdvert(Request $request)
    {
        $v = Validator::make($request->all(), [
            'title'   => 'required',
            'description' => 'required'
        ]);

        if($v->fails()) {
            return response()->json(['message'=>$v->errors()],201);
        }

        $advert = Advert::where('id',$request->id);
        $advert->title = $request->title;
        $advert->description = $request->description;
        $advert->user_id = $request->user['id'];
        $advert->photo = $request->photo;
        $advert->updated_at = new \DateTime('now');
        try{
            $advert->save();
            return response()->json(['message'=>'advert saved'],200);
        }catch (\Exception $e)
        {
            return response()->json(['message'=>$e->getMessage()],400);
        }
    }

    public function pagginateAdverts(Request $request)
    {
        $offset = $request->offset-1;
        $limit = 5;
        $adverts = Advert::skip($offset*$limit)->take($limit)->get()->load('users')->toArray();
        $pages = Advert::get()->count();
        $pages = (int)round($pages/5);
        return response()->json(['adverts'=>$adverts,'pages'=>$pages],200);
    }

    public function editAdvert(Request $request)
    {
        $id = $request->id;
        $advert = Advert::where('id',$id)->get()->toArray();
        $user = Auth::user();
        $result = [
            'user'=>$user,
            'advert'=>$advert[0]
        ];
        return view('adverts.edit_advert',['result'=>$result]);
    }

    public function deleteAdvert(Request $request)
    {
        $id = $request->id;
        $advert = Advert::find($id);
        try{
            $advert->delete();
            return response()->json(['message'=>'advert deleted'],200);
        }catch (\Exception $e)
        {
            return response()->json(['message'=>$e->getMessage()],400);
        }
    }

}
