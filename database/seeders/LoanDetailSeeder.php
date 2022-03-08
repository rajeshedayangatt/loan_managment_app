<?php

namespace Database\Seeders;

use Illuminate\Database\Seeder;
use DB,File;
use App\Models\LoanDetail;


class LoanDetailSeeder extends Seeder
{
    /**
     * Run the database seeds.
     *
     * @return void
     */
    public function run()
    {

        DB::table('loan_details')->delete();
        $sample_data_json = File::get('database/data/sample_loan_details_data.json');
        $sample_data_array  = json_decode($sample_data_json);

        foreach( $sample_data_array as $data) {

            LoanDetail::create(
                array(
                    "client_id" => $data->client_id,                    
                    "num_of_payment" => $data->num_of_payment,
                    "first_payment_date" => $data->first_payment_date,
                    "last_payment_date" => $data->last_payment_date,
                    "loan_amount" => $data->loan_amount
                )
            );
        }

    }


}
