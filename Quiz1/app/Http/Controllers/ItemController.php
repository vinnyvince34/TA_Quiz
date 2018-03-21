<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\ItemModel;
use Exception;

class ItemController extends Controller
{
    protected $item;

    public function __construct(ItemModel $item)
    {
      $this->item =$item;
    }
    public function register(Request $request)
    {
      $item = [
        "id" => $request->id,
        "user_id" => $request->user_id,
        "name" => $request->name,
        "price" => $request->price,
        "stock" => $request->stock
      ];

      try
      {
        $item = $this->item->create($item);
        return response('Created', 201);
      }
      catch(Exception $ex)
      {
        return reponse('Failed', 400);
      }
    }

    public function all()
    {
      $item = $this->item->all();
      return view("all")->with('item',$item);
    }

    public function update(Request $request, $id)
    {
        try
        {
            $query = $this->item->find($id);

            $id = $request->id;
            $user_id = $request->user_id;
            $name = $request->name;
            $price =  $request->price;
            $stock = $request->stock;

            $update = $query->save();

            return response('Updated', 201);
        }
        catch(Exception $ex)
        {
            return $ex;
            return response('Failed', 400);
        }
    }

    public function delete($id)
    {
        try
        {
            $deletedItem = $this->item->where('id',$id)->delete();
            return response('Deleted', 201);
        }
        catch(Exception $ex)
        {
            return response('Failed', 400);
        }
    }

    public function find($id)
    {
      $item = $this->item->find($id);

      return $item;
    }
}
