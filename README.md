# Parking System API

This is a REST API project for managing vehicle entries, exits, and payments in a parking system. It was developed in PHP with a focus on simplicity and functionality.

---

## 🚀 Features

- **Register Entry**: Allows the registration of vehicle entries into the parking system.
- **Register Exit**: Records vehicle exits.
- **Payment**: Handles payments for parking stays.
- **Exit Validation**: Checks if a vehicle is allowed to leave, ensuring all payments are settled.

---

## 🛠️ Technologies Used

- **Language**: PHP
- **Database**: MySQL (or any PDO-compatible database)
- **Tools**: Postman for API testing

---

## 📷 Screenshots

### Example database System Screen
<img width="935" alt="database" src="https://github.com/user-attachments/assets/8bd0fa0a-b8bf-41d5-839f-f5edbeee77fd">


### Example API Response
<img width="629" alt="response" src="https://github.com/user-attachments/assets/3a71462d-6197-4b75-b7c3-d117f92e91a0">


---

## 📂 Project Structure

```plaintext
.
├── index.php           # Main API endpoint
├── database.php        # Database connection setup
├── vehicle.php         # Class managing vehicle-related functionalities
├── README.md           # Project documentation

⚙️ Setup and Usage

1-Clone the repository:
    git clone https://github.com/your-username/your-repository.git
    cd your-repository

2-Set up the database:
    - Create a database in your system (e.g., MySQL).
    - Edit the database.php file to configure the connection details:
        private $host = "localhost";
        private $db_name = "parking_system";
        private $username = "your_username";
        private $password = "your_password";

3- Run the local server:
    - Use an environment like XAMPP, WAMP, or PHP's built-in server:
        php -S localhost:8000

4- Access the project:
    - Open your browser and go to: http://localhost:8000/index.php.




🧪 Testing with Postman

1- Initial Setup:
    - Download and install Postman.
    - Open Postman and create a new collection to organize your requests.

2- Request to Register Entry:
    - URL: http://localhost:8000/index.php?action=entry
    - Method: POST
    - Body (form-data):
        license_plate: ABC1234
    - Example Response:
        {
          "message": "Vehicle entry registered."
        }

3- Request to Register Exit:
  - URL: http://localhost:8000/index.php?action=exit
    - Method: POST
    - Body (form-data):
        license_plate: ABC1234
    - Example Response:
        {
          "message": "Vehicle exit registered."
        }

4- Request for Payment:
  - URL: http://localhost:8000/index.php?action=payment
      - Method: POST
      - Body (form-data):
          license_plate: ABC1234
      - Example Response:
        {
          "message": "Payment successful."
        }

5- Request to Validate Exit:
  - URL: http://localhost:8000/index.php?action=can_exit
    - Method: POST
    - Body (form-data):
    license_plate: ABC1234
    - Example Response:
      {
        "message": "Vehicle can exit."
      }



📝 Notes

- Make sure the local server is running before making any requests.
- Ensure the database tables are properly configured to store the necessary data.

