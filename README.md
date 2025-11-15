# 📊 Sports Analytics Platform & Football Quiz System

A complete web-based platform for managing football player records, tracking statistics, and conducting interactive quizzes for users.  
Built using **PHP**, **MySQL**, **HTML/CSS**, and **Bootstrap**.

## 🚀 Features

### ⚽ Player Management
- Add, update, edit, and delete football player profiles  
- Store details such as name, age, team, position, nationality, height, weight  
- Upload player images  
- Organized player dashboard  

### 📈 Player Statistics Tracking
- Add and update player performance stats  
- View player stats in detail  
- Relational linking through player IDs  

### 📝 Football Quiz System
- Admin can create, edit, delete quiz questions  
- Support for multiple choice questions  
- User participation and auto-scoring  

### 🔐 Admin Authentication
- Secure login system  
- Admin-only access to management features  

### 🖼 Media Upload
- Upload images for players  
- Validated file types and sizes  

## 🗂 Project Structure

sports_analytics/
│── add_player.php  
│── edit_player.php  
│── delete_player.php  
│── players.php  
│── player_details.php  
│── add_stats.php  
│── edit_stats.php  
│── dashboard.php  
│── add_quiz.php  
│── edit_quiz.php  
│── take_quiz.php  
│── quiz_submission.php  
│── result.php  
│── login.php  
│── logout.php  
│── db_connect.php  
│── style.css  
│── uploads/  
│── database/  
│── logos/  

## 🏗 Tech Stack

| Component | Technology |
|----------|------------|
| Frontend | HTML, CSS, Bootstrap |
| Backend | PHP |
| Database | MySQL |
| Server | XAMPP / WAMP |
| Version Control | Git & GitHub |

## ⚙️ Installation & Setup

### 1️⃣ Clone the Repository
git clone https://github.com/Koushik-Sharma/Sports-Analytics-Platform.git

### 2️⃣ Setup Database
- Import `database.sql`  
- Update database credentials in `db_connect.php`

### 3️⃣ Move Project to Server
Place the folder in:
xampp/htdocs/

### 4️⃣ Run the Project
http://localhost/sports_analytics/

## 🛡 Security Features
- Input sanitization  
- File validation  
- Session-based authentication  

## 🧑‍💻 Future Enhancements
- Analytics dashboards  
- Quiz leaderboard  
- Dark mode  
- REST API support  

## 🤝 Contributions
Pull requests are welcome.

## 📄 License
Open-source and free to use.
