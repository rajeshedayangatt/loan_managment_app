<?php 


namespace App\Services;

use DB;
use App\Models\LoanDetail;
use DateTime;


class LoanService {

    public function tableHeader() {

    
        $first_payment_date = LoanDetail::OrderBy('first_payment_date','ASC')->limit(1)->first()->first_payment_date;
        $last_payment_date = LoanDetail::OrderBy('last_payment_date','DESC')->limit(1)->first()->last_payment_date;
        $table_column = $this->dynamicColumnCreate($first_payment_date,$last_payment_date);

        return $table_column;


    }

    public function tableContent() {
        
        $emi = DB::table('emi_details')->get();

        $content = [];
        
        foreach($emi as $index => $val) {

            $column_header = $this->tableHeader();

            $data = [$val->client_id];
            foreach($column_header as $header) {

                $column_name = date('Y_M',strtotime($header));
                $data[] = $val->$column_name;

            }

     
            $content[] = $data;
        }

        return $content;
    
    }
    public function createEmiTable() {


        $first_payment_date = LoanDetail::OrderBy('first_payment_date','ASC')->limit(1)->first()->first_payment_date;
        $last_payment_date = LoanDetail::OrderBy('last_payment_date','DESC')->limit(1)->first()->last_payment_date;


        $table_column = $this->dynamicColumnCreate($first_payment_date,$last_payment_date);


        if(!empty($table_column)) {

            //Delete existing table exist
            DB::statement("DROP TABLE  IF EXISTS  emi_details");


            $query = "create table emi_details(
            id INT NOT NULL AUTO_INCREMENT PRIMARY KEY,
            client_id VARCHAR(200) NOT NULL
            ";

            foreach($table_column as $column) {

                $column_name = date('Y_M',strtotime($column));
                $query .= ",".$column_name." DOUBLE(8,2) NULL DEFAULT 0";
            }

            $query .= ")";

            DB::statement($query);

        }


    }


    public function insertEmiTable() {

        $total_loans = LoanDetail::get();

        if(!empty($total_loans)) {

            foreach($total_loans as $loans) {


                $loan_emi = $this->calculateLoanEmi($loans);
                $total_loan_amount = $loans->loan_amount;
                $monthly_emis_date = $this->dynamicColumnCreate($loans->first_payment_date,$loans->last_payment_date);

                if(!empty($monthly_emis_date)) {


                    $column_query = "(client_id";
                    $value_query = " VALUES (".$loans->client_id;

                    foreach($monthly_emis_date as $emi_date) {


                        $monthly_amount_to_insert = ($loan_emi < $total_loan_amount) ? $loan_emi : $total_loan_amount;

                        $column_query .= ",".date('Y_M',strtotime($emi_date));
                        $value_query .= ",".$monthly_amount_to_insert;
                        $total_loan_amount -=  $loan_emi;

                    }



                    $column_query .= ")";
                    $value_query .= ")";

                    $query = "INSERT INTO emi_details ".$column_query.$value_query;

                    DB::statement($query);

                }

        
               
            }
        }
    }

    private function calculateLoanEmi($loan) {

        $monthly_emi = $loan->loan_amount / $loan->num_of_payment;
        $monthly_emi = number_format((float)$monthly_emi, 2, '.', '');
        return $monthly_emi;
    }


    private  function dynamicColumnCreate($first_payment_date,$last_payment_date){


        $table_column = [];

        if($first_payment_date != "" && $last_payment_date != "") {

            $begin = new DateTime( $first_payment_date );
            $end   = new DateTime( $last_payment_date );

            for($i = $begin; $i <= $end; $i->modify('+30 days')){
                array_push( $table_column , $i->format("Y-m-d"));
            }
        }

        return $table_column;

    }

}