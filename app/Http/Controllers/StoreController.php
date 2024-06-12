<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Validator;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use App\Models\Store;

class StoreController extends Controller
{
    //

    /**
     * @var Model
     */
    protected $model;

        /**
     * @param  Model $store
     * @return void
     */
    public function __construct(Store $store)
    {
        $this->model = $store;
    }

    public function index(Request $request)
    {
        $query = $this->model->query();

        if ($search = $request->input('search')) {
            $query->where('name', 'LIKE', "%$search%")
                ->orWhere('email', 'LIKE', "%$search%");
        }
        $perPage = 10;
        $page = $request->input('page', 1);
        $total = $query->count();

        $result = $query->offset(($page - 1) * $perPage)->limit($perPage)->get();

        $items = [
            'data' => $result,
            'total' => $total,
            'page' => $page,
            'last_page' => ceil($total / $perPage)
        ];

        return response(['data' => $items, 'status' => 200]); 
    }

    public function store(Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'exists:users,id',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error'], 400);
        }

        $item = $this->model->create($request->all());
        return response(['data' => $item, 'status' => 201]); 
    }


    public function show($id)
    {
        try {
            $item = $this->model->with('products')->findOrFail($id);
            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }

    public function update($id, Request $request)
    {
        $data = $request->all();

        $validator = Validator::make($data, [
            'user_id' => 'exists:users,id',
            'name' => 'required',
            'phone' => 'required',
            'email' => 'required',
            'address' => 'required',
        ]);

        if ($validator->fails()) {
            return response(['error' => $validator->errors(), 'Validation Error'], 400);
        }
        
        try {
            $item = $this->model->with('products')->findOrFail($id);
            $item->update($data);

            return response(['data' => $item, 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }

        /**
     * @param  mixed $id
     * @return Collection
     */
    public function destroy($id)
    {
        try {
            $item = $this->model->findOrFail($id);
            $item->delete();
            return response(['message' => 'delete success!!!', 'status' => 200]);
        } catch (ModelNotFoundException $e) {
            return response(['message' => 'Item Not Found!', 'status' => 404]);
        }
    }
}
