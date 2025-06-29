<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('EMI Details') }}
        </h2>
    </x-slot>

    <div class="py-12">
        <div class="max-w-7xl mx-auto sm:px-6 lg:px-8">
            <div class="bg-white shadow-sm sm:rounded-lg" style="overflow: scroll !important;">
                <div class="p-6 text-gray-900">
                    
                    {{-- Process Button --}}
                    <form method="POST" action="{{ route('process-emi') }}" class="mb-6">
                        @csrf
                        <button type="submit"
                            class="inline-flex items-center px-4 py-2 border border-gray-800 rounded-md font-semibold text-xs text-gray-800 uppercase tracking-widest bg-transparent hover:bg-gray-800 hover:text-white focus:outline-none focus:ring-2 focus:ring-gray-800 focus:ring-offset-2 transition ease-in-out duration-150">
                            ➤ Process Data
                        </button>
                    </form>
    
                    {{-- EMI Table --}}
                    @if(count($data))
                    <div class="w-full overflow-x-auto">
                        <table class="min-w-max table-auto bg-white border border-gray-200 text-sm text-gray-700">
                            <thead class="bg-gray-100 sticky top-0 z-10">
                                <tr>
                                    <th class="px-4 py-2 border-b border-gray-200 text-left whitespace-nowrap">Client ID</th>
                                    @foreach($columns as $col)
                                        <th class="px-4 py-2 border-b border-gray-200 text-left whitespace-nowrap">{{ $col }}</th>
                                    @endforeach
                                </tr>
                            </thead>
                            <tbody>
                                @foreach($data as $row)
                                    <tr class="hover:bg-gray-50">
                                        <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">{{ $row->clientid }}</td>
                                        @foreach($columns as $col)
                                            <td class="px-4 py-2 border-b border-gray-200 whitespace-nowrap">
                                                {{ number_format($row->$col ?? 0, 2) }}
                                            </td>
                                        @endforeach
                                    </tr>
                                @endforeach
                            </tbody>
                        </table>
                    </div>
                    
                    @else
                        <p class="text-gray-500 italic">No EMI data found. Click “Process Data” to generate it.</p>
                    @endif
    
                </div>
            </div>
        </div>
    </div>
    
</x-app-layout>
