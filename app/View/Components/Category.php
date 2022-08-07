<?php

namespace App\View\Components;

use App\Repositories\Interfaces\CategoryRepository;
use Illuminate\View\Component;

class Category extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    public $categories;
    public function __construct(CategoryRepository $categorRepo)
    {
        $this->categories = $categorRepo->index();
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.category');
    }
}
