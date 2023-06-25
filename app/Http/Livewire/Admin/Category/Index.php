<?php

namespace App\Http\Livewire\Admin\Category;

use Livewire\Component;
use App\Models\Category;
use Livewire\WithPagination;

class Index extends Component
{
    use WithPagination;
    protected $paginationTheme = 'bootstrap';

    public $name, $status, $category_id;
    public function rules()
    {
        return [
            'name' => 'required|string|max:255|unique:categories',
            'status' => 'nullable'
        ];
    }
    public function resetInput()
    {
        $this->name = NULL;
        $this->status = NULL;
        $this->category_id = NULL;
    }
    public function closeModal()
    {
        $this->resetInput();
    }
    public function openModal()
    {
        $this->resetInput();
    }
    public function storeCategory()
    {
        $validatedData = $this->validate();
        Category::create([
            'name' => $this->name,
            'status' => $this->status == true ? '1':'0'
        ]);
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
        $this->dispatchBrowserEvent('success', ['message' => 'Category Created Successfully']);
    }
    public function editCategory(int $category_id)
    {
        $this->category_id = $category_id;
        $category = Category::findOrFail($category_id);
        $this->name = $category->name;
        $this->status = $category->status;
    }
    public function updateCategory()
    {
        $category = Category::findOrFail($this->category_id);
        if ($category) {
            if ($category->name != $this->name || $category->status != $this->status) {
                if ($category->name != $this->name) {
                    $validatedData = $this->validate();
                    $category->update([
                        'name' => $this->name,
                        'status' => $this->status,
                    ]);
                } else {
                    $category->update([
                        'status' => $this->status,
                    ]);
                }
                $this->dispatchBrowserEvent('success', ['message' => 'Category Updated Successfully']);
            } else {
                $this->dispatchBrowserEvent('warning', ['message' => 'Nothing Changed']);
            }
            
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Category does not exist']);
        }
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function deleteCategory($category_id)
    {
        $this->category_id = $category_id;
    }
    public function destroyCategory()
    {
        $category = Category::findOrFail($this->category_id);
        if ($category) {
            $category->delete();
            $this->dispatchBrowserEvent('success', ['message' => 'Category Deleted Successfully']);
        } else {
            $this->dispatchBrowserEvent('error', ['message' => 'Category Already Deleted']);
        }
        $this->dispatchBrowserEvent('close-modal');
        $this->resetInput();
    }
    public function render()
    {
        $categories = Category::orderby('category_id', 'DESC')->paginate(5);
        return view('livewire.admin.category.index', compact('categories'))
                ->extends('layouts.admin')
                ->section('content');
    }
}
