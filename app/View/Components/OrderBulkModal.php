<?php

namespace App\View\Components;

use Illuminate\View\Component;

class OrderBulkModal extends Component
{
    public $modalId;
    public $modalTitle;
    public $status;
    public $formId;
    public $message;
    public $formAction;

    /**
     * Create a new component instance.
     *
     * @return void
     */
    public function __construct($modalId,$modalTitle,$status,$formId,$message,$formAction)
    {
        $this->modalId = $modalId;
        $this->modalTitle = $modalTitle;
        $this->status = $status;
        $this->formId = $formId;
        $this->message = $message;
        $this->formAction = $formAction;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        return view('components.order-bulk-modal');
    }
}
