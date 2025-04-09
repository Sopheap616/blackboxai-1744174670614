<?php
require_once '../../config/database.php';
include '../../includes/header.php';

$conn = getDBConnection();
$query = "SELECT t.id, t.amount, t.transaction_date, t.description, 
          c.name AS category, cur.code AS currency
          FROM transactions t
          JOIN categories c ON t.category_id = c.id
          JOIN currencies cur ON t.currency_id = cur.id
          WHERE t.user_id = ?
          ORDER BY t.transaction_date DESC";
$stmt = $conn->prepare($query);
$stmt->bind_param("i", $_SESSION['user_id']);
$stmt->execute();
$result = $stmt->get_result();
?>

<div class="p-6">
    <div class="flex justify-between items-center mb-6">
        <h2 class="text-2xl font-bold">Transaction History</h2>
        <button class="bg-blue-500 text-white px-4 py-2 rounded hover:bg-blue-600">
            <i class="fas fa-plus mr-2"></i>Add Transaction
        </button>
    </div>

    <!-- Search and Filter -->
    <div class="bg-white p-4 rounded-lg shadow mb-6">
        <div class="grid grid-cols-1 md:grid-cols-4 gap-4">
            <div>
                <label class="block text-sm font-medium text-gray-700">Date From</label>
                <input type="date" class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Date To</label>
                <input type="date" class="w-full p-2 border rounded">
            </div>
            <div>
                <label class="block text-sm font-medium text-gray-700">Currency</label>
                <select class="w-full p-2 border rounded">
                    <option value="">All</option>
                    <option value="USD">USD</option>
                    <option value="KHR">KHR</option>
                </select>
            </div>
            <div class="flex items-end">
                <button class="w-full bg-blue-500 text-white p-2 rounded hover:bg-blue-600">
                    Apply Filters
                </button>
            </div>
        </div>
    </div>

    <!-- Transactions Table -->
    <div class="bg-white rounded-lg shadow overflow-hidden">
        <table class="min-w-full divide-y divide-gray-200">
            <thead class="bg-gray-50">
                <tr>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Date</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Description</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Category</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Amount</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Currency</th>
                    <th class="px-6 py-3 text-left text-xs font-medium text-gray-500 uppercase tracking-wider">Actions</th>
                </tr>
            </thead>
            <tbody class="bg-white divide-y divide-gray-200">
                <?php if ($result->num_rows > 0): ?>
                    <?php while ($row = $result->fetch_assoc()): ?>
                        <tr>
                            <td class="px-6 py-4 whitespace-nowrap"><?= date('M d, Y', strtotime($row['transaction_date'])) ?></td>
                            <td class="px-6 py-4"><?= htmlspecialchars($row['description']) ?></td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $row['category'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap <?= $row['amount'] >= 0 ? 'text-green-600' : 'text-red-600' ?>">
                                <?= number_format(abs($row['amount']), 2) ?>
                            </td>
                            <td class="px-6 py-4 whitespace-nowrap"><?= $row['currency'] ?></td>
                            <td class="px-6 py-4 whitespace-nowrap">
                                <button class="text-blue-500 hover:text-blue-700 mr-3 edit-btn" 
                                    data-transaction-id="<?= $row['id'] ?>">
                                    <i class="fas fa-edit"></i>
                                </button>
                                <button class="text-red-500 hover:text-red-700 delete-btn" 
                                    data-transaction-id="<?= $row['id'] ?>">
                                    <i class="fas fa-trash"></i>
                                </button>
                            </td>
                        </tr>
                    <?php endwhile; ?>
                <?php else: ?>
                    <tr>
                        <td colspan="6" class="px-6 py-4 text-center text-gray-500">
                            No transactions found
                        </td>
                    </tr>
                <?php endif; ?>
            </tbody>
        </table>
    </div>
</div>

<?php include '../../includes/footer.php'; ?>
