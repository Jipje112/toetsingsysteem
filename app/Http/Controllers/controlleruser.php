<?php
namespace App\View\Components;

use Illuminate\View\Component;

class controlleruser extends Component
{
    public $users;

    public function __construct($users)
    {
        $this->users = $users;
    }

    public function render()
    {
        return view('components.user');
    }
}
