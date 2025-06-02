<?php
session_start();

// Initialize or get the current question
if (!isset($_SESSION['current_question'])) {
    $_SESSION['current_question'] = 0;
    $_SESSION['score'] = 0;
    $_SESSION['start_time'] = time();
    // Get category from URL parameter or default to science
    $_SESSION['category'] = isset($_GET['category']) ? $_GET['category'] : 'science';
} else if (isset($_GET['category'])) {
    // Update category if provided in URL
    $_SESSION['category'] = $_GET['category'];
}

// Ensure we have a valid category
if (empty($_SESSION['category'])) {
    $_SESSION['category'] = 'science';
}

// Load questions based on category
$category = $_SESSION['category'];

// Verify that the category file exists
$category_file = "data/{$category}.php";
if (!file_exists($category_file)) {
    $_SESSION['category'] = 'science';
    $category = 'science';
    $category_file = "data/science.php";
}

require_once $category_file;

// Handle answer submission
if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $current_question = $_SESSION['current_question'];
    
    // Check if time ran out or answer was submitted
    if (isset($_POST['time_up'])) {
        // Time ran out - give 0 points and move to next question
        $_SESSION['current_question']++;
    } else if (isset($_POST['answer'])) {
        $selected_answer = (int)$_POST['answer'];
        $correct_answer = $questions[$current_question]['correct_answer'];
        $difficulty = $questions[$current_question]['difficulty'];
        
        // Calculate points based on difficulty
        $points = 0;
        if ($selected_answer === $correct_answer) {
            switch ($difficulty) {
                case 'easy': $points = 1; break;
                case 'medium': $points = 2; break;
                case 'hard': $points = 3; break;
            }
            $_SESSION['score'] += $points;
        }
        
        $_SESSION['current_question']++;
    }
    
    // Check if quiz is complete
    if ($_SESSION['current_question'] >= count($questions)) {
        $_SESSION['end_time'] = time();
        header('Location: results.php');
        exit;
    }
}

$current_question = $_SESSION['current_question'];
$question = $questions[$current_question];
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz - <?php echo ucfirst($category); ?></title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="quiz-header">
            <h1><?php echo ucfirst($category); ?> Quiz</h1>
            <div class="quiz-info">
                <div class="timer-container">
                    <div class="timer" id="timer" data-time="60">60</div>
                    <div class="timer-label">seconds remaining</div>
                </div>
                <div class="progress-container">
                    <div class="question-counter">
                        Question <?php echo $current_question + 1; ?> of <?php echo count($questions); ?>
                    </div>
                    <div class="progress-bar">
                        <div class="progress" style="width: <?php echo ($current_question / count($questions) * 100); ?>%"></div>
                    </div>
                </div>
            </div>
        </div>
        
        <div class="question-card">
            <div class="difficulty-badge <?php echo $question['difficulty']; ?>">
                <?php echo ucfirst($question['difficulty']); ?> 
                (<?php echo $question['difficulty'] === 'easy' ? '1' : ($question['difficulty'] === 'medium' ? '2' : '3'); ?> pts)
            </div>
            
            <h2 class="question-text"><?php echo htmlspecialchars($question['question']); ?></h2>
            
            <form method="POST" id="quiz-form" class="options-grid">
                <?php foreach ($question['options'] as $index => $option): ?>
                    <div class="option-wrapper">
                        <input type="radio" name="answer" id="option<?php echo $index; ?>" 
                               value="<?php echo $index; ?>" required>
                        <label class="option" for="option<?php echo $index; ?>">
                            <span class="option-letter"><?php echo chr(65 + $index); ?></span>
                            <span class="option-text"><?php echo htmlspecialchars($option); ?></span>
                        </label>
                    </div>
                <?php endforeach; ?>
                
                <button type="submit" class="submit-btn">Submit Answer</button>
            </form>
        </div>
    </div>

    <style>
        .quiz-header {
            text-align: center;
            margin-bottom: 2rem;
            animation: slideDown 0.5s ease-out;
        }

        .quiz-header h1 {
            font-size: 2.5rem;
            color: var(--primary-color);
            margin-bottom: 2rem;
        }

        .quiz-info {
            display: flex;
            justify-content: space-between;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .timer-container {
            text-align: center;
        }

        .timer {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            text-shadow: 0 2px 4px rgba(0,0,0,0.1);
            margin-bottom: 0.5rem;
        }

        .timer.warning {
            color: var(--danger-color);
            animation: shake 0.5s infinite;
        }

        .timer-label {
            color: var(--text-secondary);
            font-size: 0.875rem;
        }

        .progress-container {
            flex: 1;
        }

        .question-counter {
            font-size: 1.125rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
        }

        .progress-bar {
            height: 8px;
            background: #e5e7eb;
            border-radius: 999px;
            overflow: hidden;
        }

        .progress {
            height: 100%;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            transition: width 0.3s ease;
        }

        .question-card {
            background: white;
            border-radius: 20px;
            padding: 2rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1), 0 2px 4px -1px rgba(0,0,0,0.06);
            max-width: 800px;
            margin: 0 auto;
            animation: slideUp 0.5s ease-out;
        }

        .difficulty-badge {
            display: inline-block;
            padding: 0.5rem 1rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 500;
            margin-bottom: 1.5rem;
        }

        .question-text {
            font-size: 1.5rem;
            color: var(--text-primary);
            margin-bottom: 2rem;
            line-height: 1.4;
        }

        .options-grid {
            display: grid;
            gap: 1rem;
            margin-top: 2rem;
        }

        .option-wrapper {
            position: relative;
        }

        .option-wrapper input[type="radio"] {
            position: absolute;
            opacity: 0;
        }

        .option {
            display: flex;
            align-items: center;
            padding: 1rem;
            background: white;
            border: 2px solid #e5e7eb;
            border-radius: 12px;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .option:hover {
            border-color: var(--primary-color);
            background: #f8fafc;
        }

        .option-wrapper input[type="radio"]:checked + .option {
            border-color: var(--primary-color);
            background: #eff6ff;
        }

        .option-letter {
            display: flex;
            align-items: center;
            justify-content: center;
            width: 2rem;
            height: 2rem;
            background: #f3f4f6;
            border-radius: 999px;
            margin-right: 1rem;
            font-weight: 600;
            color: var(--text-primary);
        }

        .option-text {
            flex: 1;
        }

        .submit-btn {
            display: block;
            width: 100%;
            padding: 1rem;
            margin-top: 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
            border: none;
            border-radius: 999px;
            font-size: 1.125rem;
            font-weight: 500;
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .submit-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        @media (max-width: 768px) {
            .quiz-info {
                flex-direction: column;
                gap: 1rem;
            }

            .timer {
                font-size: 2.5rem;
            }

            .question-text {
                font-size: 1.25rem;
            }
        }
    </style>

    <script src="assets/js/quiz.js"></script>
</body>
</html> 