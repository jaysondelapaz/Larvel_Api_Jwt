<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\item;
class ItemController extends Controller
{
    protected $data = array();
    public function index()
    {
    	$this->data['items'] = item::orderBy('updated_at','desc')->get();

    	return view('welcome',$this->data);
    }

    public function store(Request $request)
    {
    	$item = new item;
    	$item->fill($request->all());
    	$item->save();

    	session()->flash('msg_success',"New record has been added.");
    	return redirect()->route('Backend.index');
    }

    public function edit($id)
    {
    	$item = item::find($id);
    	if($item)
    	{
    		$this->data['item'] = $item;
    		return view('edit',$this->data);
    	}
    	else
    	{
    		return "record not found";
    	}
    }

    public function update(Request $request,$id=0)
    {
    	$item = item::find($id);
    	if($item)
    	{
    		$item->fill($request->all());
    		$item->save();
    		session()->flash('msg_success',"Record successfully updated!.");
    		return redirect()->route('Backend.index');
    	}
    	else
    	{
    		return "Failed to update";
    	}
    }

    public function confirmdelete($id)
    {
    	$item = item::find($id);

    	if($item)
    	{
    		$this->data['item'] = $item;
    	return view('deleteconfirm',$this->data);
    	}
    	else
    	{
    		return "Record not found";
    	}
    }

    public function destroy($id = 0)
    {
    	$item = item::find($id);
    	$item->delete();
    	session()->flash('msg_success',"Record Successfully deleted!");
    	return redirect()->route('Backend.index');
    }
}
