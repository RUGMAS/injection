<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Admin Dashboard</title>
    <style>
    body { 
        font-family: Arial, sans-serif; 
        margin: 0; 
        padding: 0; 
        background-color: #f4f4f4; /* Light grey background */
    }
    .sidebar { 
        height: 100vh; 
        width: 250px; 
        position: fixed; 
        top: 0; 
        left: 0; 
        background-color: #333; /* Dark grey sidebar */
        color: white; 
    }
    .sidebar a { 
        padding: 16px; 
        display: block; 
        color: white; 
        text-decoration: none; 
    }
    .sidebar a:hover { 
        background-color: #555; /* Lighter grey for hover */
    }
    .top-bar { 
        background-color: #222; /* Very dark grey top bar */
        color: white; 
        padding: 10px 1px; 
        text-align: right; 
        position: fixed; 
        width: calc(100% - 250px); 
        top: 0; 
        right: 0; 
    }
    .main-content { 
        margin-left: 250px; 
        padding: 60px 20px; 
        background-color: #fff; /* White main content area */
    }
    table { 
        width: 100%; 
        border-collapse: collapse; 
    }
    th, td { 
        border: 1px solid #ddd; /* Light grey border for tables */
        padding: 8px; 
        text-align: left; 
    }
    th { 
        background-color: #0000ff; /* Blue header background */
        color: white; 
    }
    tr:nth-child(even) { 
        background-color: #f2f2f2; /* Zebra striping for table rows */
    }
	.edit-btn {
        background-color: #4CAF50; /* Green background */
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .edit-btn:hover {
        background-color: #45a049; /* Darker green on hover */
    }

    .delete-btn {
        background-color: #f44336; /* Red background */
        color: white;
        border: none;
        padding: 8px 16px;
        cursor: pointer;
        border-radius: 5px;
    }

    .delete-btn:hover {
        background-color: #da190b; /* Darker red on hover */
    }
</style>
</head>
<body>

    <div class="sidebar">
        <h2>Dashboard</h2>
        <a href="#home">Home</a>
        <a href="#customers">Customers</a>
        <a href="#settings">Settings</a>
        <a href="logout.php">Logout</a>
    </div>

    <div class="top-bar">
    </div>
    <div class="main-content"><br><br>
    <?php
session_start();

// Check if the username is stored in the session
if(isset($_SESSION['username'])) {
    $username = $_SESSION['username'];
    echo "Welcome, $username!";
} else {
    echo "User not logged in.";
}
?>
        <h2>Customer Data</h2>
        <table id="customerTable">
            <tr>
                <th>ID</th>
                <th>Name</th>
                <th>Email</th>
                <th>Phone</th>
                <th>Actions</th>
                </tr>
        <!-- Customer rows will be added here by JavaScript -->
    </table>
    <!-- Add more content as needed -->
</div>

<script>
// Placeholder for customer data with additional fields
const customers = [
    { id: 1, name: "John Doe", email: "john.doe@example.com", phone: "123-456-7890", orderId: "ORD001", status: "Shipped", place: "New York" },
    { id: 2, name: "Jane Smith", email: "jane.smith@example.com", phone: "234-567-8901", orderId: "ORD002", status: "Processing", place: "Los Angeles" },
    { id: 3, name: "Alice Brown", email: "alice.brown@example.com", phone: "345-678-9012", orderId: "ORD003", status: "Delivered", place: "Chicago" },
    { id: 4, name: "Bob Johnson", email: "bob.johnson@example.com", phone: "456-789-0123", orderId: "ORD004", status: "Cancelled", place: "Miami" },
    { id: 5, name: "Charlie Lee", email: "charlie.lee@example.com", phone: "567-890-1234", orderId: "ORD005", status: "Returned", place: "Seattle" },
    { id: 6, name: "Diana King", email: "diana.king@example.com", phone: "678-901-2345", orderId: "ORD006", status: "In Transit", place: "Portland" },
    { id: 7, name: "Evan Long", email: "evan.long@example.com", phone: "789-012-3456", orderId: "ORD007", status: "Awaiting Pickup", place: "San Francisco" },
    { id: 8, name: "Fiona Graham", email: "fiona.graham@example.com", phone: "890-123-4567", orderId: "ORD008", status: "Ready to Ship", place: "Denver" },
    { id: 9, name: "George Hall", email: "george.hall@example.com", phone: "901-234-5678", orderId: "ORD009", status: "Shipped", place: "Boston" },
    { id: 10, name: "Hannah Scott", email: "hannah.scott@example.com", phone: "012-345-6789", orderId: "ORD010", status: "Processing", place: "Dallas" }
];

// Function to render customers to the table
function renderCustomers() {
    const table = document.getElementById('customerTable');
    // Clear existing table rows
    table.innerHTML = `
        <tr>
            <th>ID</th>
            <th>Name</th>
            <th>Email</th>
            <th>Phone</th>
            <th>Order ID</th>
            <th>Status</th>
            <th>Place</th>
            <th>Actions</th>
        </tr>
    `;
    // Add new rows from the customers array
    customers.forEach(customer => {
        const row = table.insertRow(-1);
        row.innerHTML = `
            <td>${customer.id}</td>
            <td>${customer.name}</td>
            <td>${customer.email}</td>
            <td>${customer.phone}</td>
            <td>${customer.orderId}</td>
            <td>${customer.status}</td>
            <td>${customer.place}</td>
            <td>
                <button class="edit-btn" onclick="editCustomer(${customer.id})">Edit</button>
                <button class="delete-btn" onclick="deleteCustomer(${customer.id})">Delete</button>
            </td>
        `;
    });
}
document.addEventListener('DOMContentLoaded', renderCustomers);
function deleteCustomer(customerId) {
    // For demonstration, we simply filter out the customer
    const index = customers.findIndex(customer => customer.id === customerId);
    if (index !== -1) {
        customers.splice(index, 1);
        renderCustomers(); // Re-render the table
    }
}
function editCustomer(customerId) {
    // This function would typically populate a form with customer details for editing
    console.log('Edit customer with ID:', customerId);
    // For demonstration, we just log to the console
}
renderCustomers();
</script>

</body>
</html>
