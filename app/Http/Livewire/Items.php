<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class Items extends Component
{
    public $items, $name, $body, $item_id, $email, $phone;
    public $updateMode = false;
    public function render()
    {
        $this->items = Item::all();
        return view('livewire.items');
    }
    private function resetInputFields(){
        $this->name = '';
        $this->body = '';
        $this->email = '';
        $this->phone = '';
    }
    public function store()
    {
        $validatedDate = $this->validate([
            'name' => 'required|max:50',
            'body' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
        ]);
  
        Item::create($validatedDate);
  
        session()->flash('message', 'Item Created Successfully.');
  
        $this->resetInputFields();
    }
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->item_id = $id;
        $this->name = $item->name;
        $this->body = $item->body;
        $this->email = $item->email;
        $this->phone = $item->phone;
  
        $this->updateMode = true;
    }
    public function cancel()
    {
        $this->updateMode = false;
        $this->resetInputFields();
    }

    public function update()
    {
        $validatedDate = $this->validate([
            'name' => 'required|max:50',
            'body' => 'required',
            'email' => 'required|email',
            'phone' => 'nullable|numeric',
        ]);
  
        $item = Item::find($this->item_id);
        $item->update([
            'name' => $this->name,
            'body' => $this->body,
            'email' => $this->email,
            'phone' => $this->phone,
        ]);
  
        $this->updateMode = false;
  
        session()->flash('message', 'I Updated Successfully.');
        $this->resetInputFields();
    }
    public function delete($id)
    {
        Item::find($id)->delete();
        session()->flash('message', 'Item Deleted Successfully.');
    }

}

