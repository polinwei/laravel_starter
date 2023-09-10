<?php

namespace App\Http\Controllers\API;

use App\Http\Controllers\Controller;
use Illuminate\Http\Request;
use App\Http\Controllers\API\JwtBaseController as JwtBaseController;
use App\Models\eStore\Merchandise;
use Illuminate\Support\Facades\Validator;
use App\Http\Resources\eStore\MerchandiseResource;
use Illuminate\Http\JsonResponse;

class JwtMerchandiseController extends JwtBaseController
{    
    
    
    /**
     * index
     * 取得所有的筆數
     * @return JsonResponse
     */
    public function index(): JsonResponse
    {
        $merchandises = Merchandise::all();

        return $this->sendResponse(MerchandiseResource::collection($merchandises), 'Merchandise retrieved successfully.');
    }
    
    /**
     * store
     * 商品資料存檔
     * @param  mixed $request
     * @return JsonResponse
     */
    public function store(Request $request): JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $merchandise = Merchandise::create($input);
   
        return $this->sendResponse(new MerchandiseResource($merchandise), 'Merchandise created successfully.');
    }
    
    /**
     * show
     * 單一商品顯示
     * @param  mixed $id
     * @return JsonResponse
     */
    public function show($id): JsonResponse
    {
        $merchandise = Merchandise::find($id);
  
        if (is_null($merchandise)) {
            return $this->sendError('Merchandise not found.');
        }
   
        return $this->sendResponse(new MerchandiseResource($merchandise), 'Merchandise retrieved successfully.');
    }
    
    /**
     * update
     * 單一商品資料更新
     * @param  mixed $request
     * @param  mixed $merchandise
     * @return JsonResponse
     */
    public function update(Request $request, Merchandise $merchandise): JsonResponse
    {
        $input = $request->all();
   
        $validator = Validator::make($input, [
            'name' => 'required',
            'description' => 'required'
        ]);
   
        if($validator->fails()){
            return $this->sendError('Validation Error.', $validator->errors());       
        }
   
        $merchandise->name = $input['name'];
        $merchandise->description = $input['description'];
        $merchandise->price = $input['price'];
        $merchandise->save();
   
        return $this->sendResponse(new MerchandiseResource($merchandise), 'Merchandise updated successfully.');
    }
    
    /**
     * destroy
     * 單一商品刪除
     * @param  mixed $merchandise
     * @return JsonResponse
     */
    public function destroy(Merchandise $merchandise): JsonResponse
    {
        $merchandise->delete();
   
        return $this->sendResponse([], 'Merchandise deleted successfully.');
    }

}
