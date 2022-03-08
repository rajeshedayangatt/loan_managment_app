<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Services\LoanService;

class Loan extends Controller
{

    protected $loanservice;

    public function __construct(LoanService $loanservice)
    {
        $this->loanservice = $loanservice;
    }

    /**
     * Get the view loan details.
     *
     * @return \Illuminate\View\View
     */

    public function index() {


        $email_details_content = $this->loanservice->tableContent();

        return view('loan_detail')->with('email_details_content',$email_details_content);

    }


    /**
     * Process Loan Data.
     *
     * @return void
     *
     * 
     */

    public function process() {

        //create emi table
        $this->loanservice->createEmiTable();

        //insert loan emi
        $this->loanservice->insertEmiTable();

        return redirect()->route('loan_details');
    }
}
