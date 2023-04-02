<?php

namespace App\Http\Livewire;

use App\Models\Item;
use Livewire\Component;

class Items extends Component
{
    public $items, $title, $body, $item_id;
    public $updateMode = false;
    public function render()
    {
        $this->items = Item::all();
        return view('livewire.items');
    }
    private function resetInputFields(){
        $this->title = '';
        $this->body = '';
    }
    public function store()
    {
        $validatedDate = $this->validate([
            'title' => 'required',
            'body' => 'required',
        ]);
  
        Item::create($validatedDate);
  
        session()->flash('message', 'Item Created Successfully.');
  
        $this->resetInputFields();
    }
    public function edit($id)
    {
        $item = Item::findOrFail($id);
        $this->item_id = $id;
        $this->title = $item->title;
        $this->body = $item->body;
  
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
            'title' => 'required',
            'body' => 'required',
        ]);
  
        $item = Item::find($this->item_id);
        $item->update([
            'title' => $this->title,
            'body' => $this->body,
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

