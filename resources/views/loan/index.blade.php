<x-app-layout>
    <x-slot name="header">
        <h2 class="font-semibold text-xl text-gray-800 leading-tight">
            {{ __('Loan Details') }}
        </h2>
    </x-slot>

    <div class="py-12 bg-gray-50">
        <div class="w-full px-4">
            <div class="bg-white shadow-md rounded-lg overflow-x-auto">
                <div class="p-4">
                    <!-- EMI Button -->
                    <div class="flex justify-end mb-4">
                        <a href="{{ route('emi.index') }}"
                           class="inline-flex items-center px-4 py-2 bg-gray-800 border border-transparent rounded-md font-semibold text-xs text-white uppercase tracking-widest hover:bg-gray-700 focus:bg-gray-700 active:bg-gray-900 focus:outline-none focus:ring-2 focus:ring-indigo-500 focus:ring-offset-2 transition ease-in-out duration-150">
                            ➤ Go to EMI Processing
                        </a>
                    </div>
    
                    <!-- Table -->
                    <table class="w-full min-w-[1000px] table-auto border border-gray-300 text-sm text-left text-gray-800">
                        <thead class="bg-gray-100">
                            <tr>
                                <th class="px-4 py-2 border-b" style="text-align: left !important;">ID</th>
                                <th class="px-4 py-2 border-b" style="text-align: left !important;">Client ID</th>
                                <th class="px-4 py-2 border-b" style="text-align: left !important;">Payments</th>
                                <th class="px-4 py-2 border-b" style="text-align: left !important;">First Payment</th>
                                <th class="px-4 py-2 border-b" style="text-align: left !important;">Last Payment</th>
                                <th class="px-4 py-2 border-b" style="text-align: left !important;">Loan Amount</th>
                            </tr>
                        </thead>
                        <tbody>
                            @forelse($loans as $loan)
                                <tr class="hover:bg-gray-50">
                                    <td class="px-4 py-2 border-b text-left">{{ $loan->id }}</td>
                                    <td class="px-4 py-2 border-b text-left">{{ $loan->clientid }}</td>
                                    <td class="px-4 py-2 border-b text-left">{{ $loan->num_of_payment }}</td>
                                    <td class="px-4 py-2 border-b text-left">{{ \Carbon\Carbon::parse($loan->first_payment_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 border-b text-left">{{ \Carbon\Carbon::parse($loan->last_payment_date)->format('d M Y') }}</td>
                                    <td class="px-4 py-2 border-b text-left">₹{{ number_format($loan->loan_amount, 2) }}</td>
                                </tr>
                            @empty
                                <tr>
                                    <td colspan="6" class="px-4 py-2 text-center text-gray-500">No loans found.</td>
                                </tr>
                            @endforelse
                        </tbody>
                    </table>
                </div>
            </div>
        </div>
    </div>
    
    
    
</x-app-layout>
