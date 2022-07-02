<?php

namespace App\Http\Controllers\Admin;

use App\Models\Admin\SettingsStorage;
use App\Http\Controllers\Controller;
use Illuminate\Http\Request;

/**
 * Repositories used in this controller
 */
use App\Repositories\Admin\SettingsStorageEloquentRepository;
use Illuminate\Support\Facades\Log;
use Illuminate\Support\Facades\Validator;

class SettingsStorageController extends Controller
{

    protected $phone_storages;

    public function __construct(SettingsStorageEloquentRepository $phone_storages)
    {
        $this->phone_storages = $phone_storages;
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $data['phone_storages'] = $this->phone_storages->all('label','asc',array('id','capacity','label'));
        $data['module'] = "phone-storages";
        $data['tvsettings'] = true;

        return view('admin.settings.storages.index',$data);
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        try {
            $validator = Validator::make($request->all(),[
                "capacity" => "required|integer",
                "label" => "required",
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "status" => false,
                    "error" => $validator->errors()->first(),
                ]);
            };
    
            $this->phone_storages->create([
                "capacity" => $request->capacity,
                "label" => $request->label,
            ]);
    
            return response()->json([
                "status" => true,
                "requests" => $request->all(),
            ]);
        } catch (\Exception $e){
            Log::error($e->getMessage());

            return response()->json([
                "status" => false,
                "message" => "something went wrong",
            ]);
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Models\SettingsStorage  $settingsStorage
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request,$id)
    {
        try {
            $validator = Validator::make($request->all(),[
                "capacity" => "required|integer",
                "label" => "required",
            ]);
    
            if($validator->fails()){
                return response()->json([
                    "status" => false,
                    "error" => $validator->errors()->first(),
                ]);
            };
    
            $this->phone_storages->update([
                "capacity" => $request->capacity,
                "label" => $request->label,
            ],$id);
    
            return response()->json([
                "status" => true,
                "message" => "successfully updated",
            ]);
        } catch (\Exception $e){
            Log::error($e->getMessage());

            return response()->json([
                "status" => false,
                "message" => "something went wrong",
            ]);
        }
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Models\SettingsStorage  $settingsStorage
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        try {
            $this->phone_storages->delete($id);
            
            return response()->json([
                "status" => true,
                "message" => "successfully deleted",
            ]);
        } catch (\Exception $e){
            Log::error($e->getMessage());

            return response()->json([
                "status" => false,
                "message" => "something went wrong",
            ]);
        }
    }
}
