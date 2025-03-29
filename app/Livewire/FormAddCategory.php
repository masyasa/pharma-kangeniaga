<?php

namespace App\Livewire;

use App\Models\Category;
use Livewire\Component;
use Livewire\Attributes\Validate;

class FormAddCategory extends Component
{
    #[Validate('required|string|min:1', message: 'Please provide a category name')]
    public $name = '';
    #[Validate('required|string|min:1', message: 'Please provide a category slug')]

    public $slug = '';
    #[Validate('required|string|min:1', message: 'Please provide a category icon')]

    public $icon = '';

    public function add()
    {
        $this->validate();
        Category::create(
            $this->only(['name', 'slug', 'icon'])
        );

        session()->flash('status', 'Category successfully added.');

        // return $this->redirect('/admin/categories');
    }


    public function render()
    {
        return view('livewire.form-add-category');
    }
}
