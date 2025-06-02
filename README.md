# Quiz Challenge Application

## Student Information
- **Name:** Hemon Gebremariam
- **Institution:** WSB Merito University
- **Project:** Quiz Application
- **Repository:** [GitHub - Quiz Challenge Application](https://github.com/Hamona2323/PHP-Quiz-App.git)

## Project Overview
Quiz Challenge is an interactive web-based quiz application developed using PHP, JavaScript, and modern web technologies. The application offers an engaging platform for users to test their knowledge across multiple categories including Science, History, and Technology.

### Key Features
- 🎯 Multiple quiz categories (Science, History, Technology)
- ⏱️ 60-second time limit per quiz
- 📊 Real-time score tracking
- 🏆 Global leaderboard system
- 🎨 Modern, responsive design
- 📱 Mobile-friendly interface
- 🔄 Category-based filtering
- 🌈 Beautiful UI with animations

## Technologies Used
- PHP (59.4%)
- JavaScript (13.5%)
- CSS (12.7%)
- MySQL

## Deployment Instructions

### Step 1: Environment Setup
1. Ensure XAMPP is installed on the evaluation computer
2. Start XAMPP Control Panel
3. Start both Apache and MySQL services
4. Verify services are running (green indicators in XAMPP Control Panel)

### Step 2: Project Deployment
1. Clone the repository or download ZIP:
   ```
   git clone https://github.com/Hamona2323/PHP-Quiz-App.git
   ```
   Or extract the ZIP file to:
   ```
   C:\xampp\htdocs\
   ```

2. Verify folder structure matches:
   ```
   PHP-Quiz-App/
   ├── assets/
   │   ├── css/
   │   │   └── styles.css
   │   └── js/
   │       ├── leaderboard.js
   │       └── quiz.js
   ├── database/
   │   └── quiz_db.sql
   ├── index.php
   ├── quiz.php
   ├── results.php
   ├── leaderboard.php
   └── README.md
   ```

### Step 3: Database Setup
1. Open web browser
2. Navigate to: http://localhost/phpmyadmin
3. Create new database:
   - Click "New" in left sidebar
   - Database name: `quiz_db`
   - Click "Create"
4. Import database:
   - Select `quiz_db`
   - Click "Import" tab
   - Choose file: `C:\xampp\htdocs\PHP-Quiz-App\database\quiz_db.sql`
   - Click "Go" to import

### Step 4: Application Access
1. Open web browser
2. Navigate to: http://localhost/PHP-Quiz-App
3. The Quiz Challenge application should now be running

## Verification Steps

### 1. Homepage
- Verify all category cards are visible
- Check if animations work
- Confirm responsive design

### 2. Quiz Functionality
- Test each category (Science, History, Technology)
- Verify 60-second timer works
- Check score calculation
- Confirm question navigation

### 3. Results Page
- Verify score display
- Check time tracking
- Test "Try Again" functionality

### 4. Leaderboard
- Verify sorting works
- Test category filters
- Check top 3 highlighting

## Technical Implementation

### Frontend
- HTML5 for structure
- CSS3 for styling (including animations and transitions)
- JavaScript for interactivity
- Responsive design using modern CSS features

### Backend
- PHP for server-side logic
- MySQL for database management
- Session management for user progress
- Secure data handling

## Troubleshooting Common Issues
1. If page shows blank:
   - Check Apache service is running
   - Verify file permissions
   - Check PHP error logs in XAMPP

2. If database connection fails:
   - Verify MySQL service is running
   - Check database name is 'quiz_db'
   - Confirm import was successful

3. If styles don't load:
   - Clear browser cache
   - Check file paths in assets folder
   - Verify CSS file permissions

## Credits
Created by Hemon Gebremariam
WSB Merito University

## License
This project is created for educational purposes.

