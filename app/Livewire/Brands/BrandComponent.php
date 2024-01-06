<?php

namespace App\Livewire\Brands;

use App\Models\Brand;
use Livewire\Attributes\Validate;
use Livewire\Component;
use Illuminate\Support\Str;

class BrandComponent extends Component
{
    public $isModalOpen = false;
    public $brandID;

    #[Validate('required')]
    public $name;

    #[Validate('required')]
    public $description;

    public function render()
    {
        return view('livewire.brands.brand-component', [
            'brands' => Brand::all(),
        ]);
    }

    public function create()
    {
        $this->openModal();
    }

    public function store()
    {
        $this->validate();

        Brand::create([
            'name' => $this->name,
            'description' => $this->description,
            'slug' => Str::slug($this->name),
        ]);

        session()->flash('success', 'Brand created successfully');

        $this->reset();
        $this->closeModal();
    }

    public function edit($id)
    {
        $brand = Brand::findOrFail($id);

        $this->brandID = $brand->id;
        $this->name = $brand->name;
        $this->description = $brand->description;

        $this->openModal();
    }

    public function update()
    {
        $this->validate();
        if ($this->brandID) {
            $brand = Brand::findOrFail($this->brandID);

            $brand->update([
                'name' => $this->name,
                'description' => $this->description,
            ]);

            session()->flash('success', 'Brand updated successfully');

            $this->reset();
            $this->closeModal();
        }
    }

    public function delete($id)
    {
        Brand::findOrFail($id)->delete();
        
        session()->flash('success', 'Brand deleted successfully');

        $this->reset();
        $this->closeModal();
    }

    public function openModal()
    {
        $this->isModalOpen = true;
    }

    public function closeModal()
    {
        $this->isModalOpen = false;
    }
}
