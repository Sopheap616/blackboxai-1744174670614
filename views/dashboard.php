<?php include '../includes/header.php'; ?>

<div class="p-6">
    <h2 class="text-2xl font-bold mb-6">Dashboard Overview</h2>
    
    <!-- Summary Cards -->
    <div class="grid grid-cols-1 md:grid-cols-3 gap-6 mb-8">
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Income</h3>
            <p class="text-2xl font-bold text-green-600">$0.00</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Total Expenses</h3>
            <p class="text-2xl font-bold text-red-600">$0.00</p>
        </div>
        <div class="bg-white p-6 rounded-lg shadow">
            <h3 class="text-lg font-semibold mb-2">Net Balance</h3>
            <p class="text-2xl font-bold text-blue-600">$0.00</p>
        </div>
    </div>

    <!-- Recent Transactions -->
    <div class="bg-white p-6 rounded-lg shadow">
        <div class="flex justify-between items-center mb-4">
            <h3 class="text-lg font-semibold">Recent Transactions</h3>
            <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
                Add Transaction
            </button>
        </div>
        <div class="overflow-x-auto">
            <table class="min-w-full bg-white">
                <thead>
                    <tr class="bg-gray-100">
                        <th class="py-2 px-4 text-left">Date</th>
                        <th class="py-2 px-4 text-left">Description</th>
                        <th class="py-2 px-4 text-left">Category</th>
                        <th class="py-2 px-4 text-left">Amount</th>
                        <th class="py-2 px-4 text-left">Currency</th>
                    </tr>
                </thead>
                <tbody>
                    <tr class="border-b">
                        <td colspan="5" class="py-4 text-center text-gray-500">
                            No transactions found
                        </td>
                    </tr>
                </tbody>
            </table>
        </div>
    </div>
</div>

<?php include '../includes/footer.php'; ?>
