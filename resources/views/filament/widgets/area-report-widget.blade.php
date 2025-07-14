<x-filament::widget>
    <x-filament::card>
        <h3 class="text-lg font-bold mb-4">Laporan Booking per Area</h3>
        <div class="overflow-x-auto">
            <table class="min-w-full text-sm bg-white text-gray-900 dark:bg-gray-800 dark:text-white">
                <thead>
                    <tr class="bg-gray-100 dark:bg-gray-700">
                        <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Area</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Total</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Success</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Pending</th>
                        <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Cancel</th>
                        @if(isset($areaStats[0]['income']))
                        <th class="px-4 py-2 text-left border-b border-gray-300 dark:border-gray-600">Pendapatan</th>
                        @endif
                    </tr>
                </thead>
                <tbody>
                    @foreach($areaStats as $area)
                        <tr class="even:bg-gray-50 dark:even:bg-gray-900">
                            <td class="px-4 py-2 font-medium border-b border-gray-200 dark:border-gray-700">{{ $area['name'] }}</td>
                            <td class="px-4 py-2 font-medium border-b border-gray-200 dark:border-gray-700">{{ $area['total'] }}</td>
                            <td class="px-4 py-2 font-medium border-b border-gray-200 dark:border-gray-700">{{ $area['success'] }}</td>
                            <td class="px-4 py-2 font-medium border-b border-gray-200 dark:border-gray-700">{{ $area['pending'] }}</td>
                            <td class="px-4 py-2 font-medium border-b border-gray-200 dark:border-gray-700">{{ $area['cancel'] }}</td>
                            @if(isset($area['income']))
                            <td class="px-4 py-2 font-medium border-b border-gray-200 dark:border-gray-700">
                                Rp{{ number_format($area['income'], 0, ',', '.') }}
                            </td>
                            @endif
                        </tr>
                    @endforeach
                </tbody>
            </table>
        </div>
    </x-filament::card>
</x-filament::widget>
