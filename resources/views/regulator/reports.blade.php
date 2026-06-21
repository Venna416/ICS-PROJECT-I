<x-app-layout>

    <div class="max-w-7xl mx-auto py-10">

        <h1 class="text-2xl font-bold mb-6">
            Fraud Reports
        </h1>

        <table class="w-full border">

            <thead class="bg-gray-200">
                <tr>
                    <th class="p-2">Seller</th>
                    <th class="p-2">Description</th>
                    <th class="p-2">Status</th>
                    <th class="p-2">Actions</th>
                </tr>
            </thead>

            <tbody>

                @foreach ($reports as $report)
                    <tr class="border">

                        <td class="p-2">
                            {{ $report->seller_name }}
                        </td>

                        <td class="p-2">
                            {{ $report->description }}
                        </td>

                        <td class="p-2">
                            {{ ucfirst($report->status) }}
                        </td>

                        <td class="p-2">

                            <form action="{{ route('regulator.reports.resolve', $report->id) }}" method="POST"
                                class="inline">

                                @csrf
                                @method('PATCH')

                                <button class="bg-green-500 text-white px-3 py-1 rounded">
                                    Resolve
                                </button>

                            </form>

                            <form action="{{ route('regulator.reports.delete', $report->id) }}" method="POST"
                                class="inline">

                                @csrf
                                @method('DELETE')

                                <button class="bg-red-500 text-white px-3 py-1 rounded">
                                    Delete
                                </button>

                            </form>

                        </td>

                    </tr>
                @endforeach

            </tbody>
        </table>

    </div>

</x-app-layout>

</x-app-layout>