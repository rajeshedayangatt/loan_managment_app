<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
                <div class="p-6 bg-white border-b border-gray-200">

                    {{ Form::open(array('route' => 'loan_process')) }}
                    {{Form::token()}}

                        <button  type="submit" class="bg-blue-500 hover:bg-blue-700 text-white font-bold py-2 px-4 rounded">
                            Process Data
                        </button>
                    {{ Form::close() }}
     
                      

                   

                </div>
            </div>

            <hr>

            <x-processed-loan/>
        </div>

        

        

        
    </div>
</x-app-layout>
