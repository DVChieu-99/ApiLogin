<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Crypt;
use App\Account_table;


class LoginController extends Controller
{
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $list = Account_table::all();
        //printf($list);
        if(count($list) == null){
            $result = [
                'success' => false,
                  'code' => 404,
                  'message'=>'Lấy danh sách thất bại',
                  'data' => null
            ];
        }
        else {
            $result = [
              'success' => true,
              'code' => 200,
              'message'=>'Lấy danh sách thành công',
              'data' => $list
            ];
        }
        return response()->json($result);
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        //
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $img = Hash::make($request->file('url_images'));
        $photo_name = time().'.png';
        $path = $request->file('url_images')->move(public_path('/images'), $photo_name);
        $img_url = asset('/images/'.$photo_name);
        printf($img, $img_url);
        $DanhSach = new Account_table;
        $DanhSach->usernames = $request->input('usernames');
        $DanhSach->phones = $request->input('phones');
        $DanhSach->emails = $request->input('emails'); 
        $DanhSach->url_images = $img_url;
        $DanhSach->passwords = Crypt::encrypt($request->input('passwords'));
        $info = $DanhSach->save();
        printf($info);
        if($info != 1){
            $result = [
                  'success' => false,
                  'code' => 400,
                  'message'=>'Thêm tài khoản không thành công',
                  'data' => null
            ];
        }else{
            $result = [
                  'success' => true,
                  'code' => 200,
                  'message'=>'Thêm tài khoản thành công',
                  'data' => $DanhSach
            ];
        }
        return response()->json($result);
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function show($id)
    {
        //
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        //
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
        //
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        //
    }
}
