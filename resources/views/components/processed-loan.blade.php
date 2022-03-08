<div class="bg-white overflow-hidden shadow-sm sm:rounded-lg">
    <div class="p-6 bg-white border-b border-gray-200">

        <div class="flex flex-col">
            <div class="overflow-x-auto sm:-mx-6 lg:-mx-8">
                <div class="inline-block py-2 min-w-full sm:px-6 lg:px-8">
                    <div class="overflow-hidden shadow-md sm:rounded-lg">
                        <table class="min-w-full">
                            <thead class="bg-gray-50 dark:bg-gray-700">
                                <tr>
                                    
                                    <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                        Client Id
                                    </th>

                                    @foreach($table_header as $index => $val)


                                        <th scope="col" class="py-3 px-6 text-xs font-medium tracking-wider text-left text-gray-700 uppercase dark:text-gray-400">
                                            {{date('Y M',strtotime($val))}}
                                        </th>

                                    @endforeach
                                    
                                </tr>
                            </thead>
                            <tbody>

                                @foreach($table_content as $index => $val)
                                <!-- Product 1 -->
                                    <tr class="bg-white border-b dark:bg-gray-800 dark:border-gray-700">

                                        <td class="py-4 px-6 text-sm font-medium text-gray-900 whitespace-nowrap dark:text-white">
                                           {{$val[0]}}
                                        </td>

                                        @foreach($val as $i => $v)

                                            @if($i != 0)
                                                <td class="py-4 px-6 text-sm text-gray-500 whitespace-nowrap dark:text-gray-400">
                                                 {{$v}}
                                                </td>
                                            @endif
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                </div>
            </div>
        </div>
        

    
    </div>
</div>

