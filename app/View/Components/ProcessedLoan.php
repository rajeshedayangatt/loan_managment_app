<?php

namespace App\View\Components;

use Illuminate\View\Component;
use DB;
use App\Services\LoanService;


class ProcessedLoan extends Component
{
    /**
     * Create a new component instance.
     *
     * @return void
     */
    protected $loanservice;

    public function __construct(LoanService $loanservice)
    {
        $this->loanservice = $loanservice;
    }

    /**
     * Get the view / contents that represent the component.
     *
     * @return \Illuminate\Contracts\View\View|\Closure|string
     */
    public function render()
    {
        $table_content = $this->loanservice->tableContent();
        $table_header = $this->loanservice->tableHeader();
        
        return view('components.processed-loan')->with('table_content',$table_content)->with('table_header',$table_header);
    }
}
