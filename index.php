<?php
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Challenge</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="hero">
            <h1>Quiz Challenge</h1>
            <p class="subtitle">Test your knowledge across different categories</p>
            <div class="hero-pattern"></div>
        </div>

        <div class="category-grid">
            <div class="category-card" data-category="science">
                <div class="category-icon">🔬</div>
                <h2>Science</h2>
                <p>Test your knowledge of scientific concepts</p>
                <div class="difficulty-levels">
                    <span class="level easy">Easy</span>
                    <span class="level medium">Medium</span>
                    <span class="level hard">Hard</span>
                </div>
                <a href="quiz.php?category=science" class="start-btn">Start Quiz</a>
            </div>

            <div class="category-card" data-category="history">
                <div class="category-icon">📚</div>
                <h2>History</h2>
                <p>Journey through historical events</p>
                <div class="difficulty-levels">
                    <span class="level easy">Easy</span>
                    <span class="level medium">Medium</span>
                    <span class="level hard">Hard</span>
                </div>
                <a href="quiz.php?category=history" class="start-btn">Start Quiz</a>
            </div>

            <div class="category-card" data-category="technology">
                <div class="category-icon">💻</div>
                <h2>Technology</h2>
                <p>Explore the world of technology</p>
                <div class="difficulty-levels">
                    <span class="level easy">Easy</span>
                    <span class="level medium">Medium</span>
                    <span class="level hard">Hard</span>
                </div>
                <a href="quiz.php?category=technology" class="start-btn">Start Quiz</a>
            </div>
        </div>

        <div class="leaderboard-preview">
            <div class="leaderboard-header">
                <h2>🏆 Top Scores</h2>
                <a href="leaderboard.php" class="view-leaderboard">View Full Leaderboard →</a>
            </div>
            <div class="top-scores">
                <!-- Top scores will be loaded via JavaScript -->
            </div>
        </div>

        <div class="cta-section">
            <div class="cta-content">
                <h2>Ready to Challenge Yourself?</h2>
                <p>Pick your favorite category and begin the quiz adventure!</p>
                <a href="leaderboard.php" class="btn btn-primary">View Leaderboard</a>
            </div>
        </div>
    </div>

    <footer class="app-footer">
        <p>Created by Hemon</p>
    </footer>

    <script src="assets/js/leaderboard.js"></script>

    <style>
        .hero {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            padding: 4rem 2rem;
            text-align: center;
            color: white;
            border-radius: 20px;
            margin-bottom: 3rem;
            position: relative;
            overflow: hidden;
        }

        .hero h1 {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            font-weight: 700;
            text-shadow: 2px 2px 4px rgba(0,0,0,0.1);
            animation: slideDown 0.5s ease-out;
        }

        .subtitle {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
            animation: fadeIn 0.5s ease-out 0.3s both;
        }

        .hero-pattern {
            position: absolute;
            top: 0;
            left: 0;
            right: 0;
            bottom: 0;
            background-image: radial-gradient(circle at 1px 1px, rgba(255,255,255,0.1) 1px, transparent 0);
            background-size: 40px 40px;
            opacity: 0.4;
        }

        .category-card {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            text-align: center;
            transition: all 0.3s ease;
            border: 1px solid rgba(0,0,0,0.1);
            position: relative;
            overflow: hidden;
        }

        .category-card:hover {
            transform: translateY(-5px);
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
        }

        .category-icon {
            font-size: 3.5rem;
            margin-bottom: 1rem;
            animation: bounceIn 0.6s ease-out;
        }

        .difficulty-levels {
            display: flex;
            gap: 0.5rem;
            justify-content: center;
            margin: 1rem 0;
        }

        .level {
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.75rem;
            font-weight: 500;
        }

        .level.easy { background: #dcfce7; color: #166534; }
        .level.medium { background: #fef3c7; color: #92400e; }
        .level.hard { background: #fee2e2; color: #991b1b; }

        .start-btn {
            display: inline-block;
            padding: 0.75rem 2rem;
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            color: white;
            border-radius: 999px;
            text-decoration: none;
            font-weight: 500;
            transition: all 0.3s ease;
            border: none;
            margin-top: 1rem;
        }

        .start-btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        .leaderboard-preview {
            background: white;
            border-radius: 16px;
            padding: 2rem;
            margin-top: 3rem;
            box-shadow: 0 4px 6px -1px rgba(0,0,0,0.1);
        }

        .leaderboard-header {
            display: flex;
            justify-content: space-between;
            align-items: center;
            margin-bottom: 1.5rem;
        }

        .view-leaderboard {
            color: #4f46e5;
            text-decoration: none;
            font-weight: 500;
            display: flex;
            align-items: center;
            gap: 0.5rem;
            transition: all 0.3s ease;
        }

        .view-leaderboard:hover {
            color: #7c3aed;
            transform: translateX(5px);
        }

        .cta-section {
            background: linear-gradient(135deg, #4f46e5 0%, #7c3aed 100%);
            border-radius: 20px;
            padding: 3rem 2rem;
            text-align: center;
            color: white;
            margin-top: 3rem;
            position: relative;
            overflow: hidden;
        }

        .cta-content {
            position: relative;
            z-index: 1;
        }

        .cta-section h2 {
            font-size: 2.5rem;
            font-weight: 700;
            margin-bottom: 1rem;
            animation: slideDown 0.5s ease-out;
        }

        .cta-section p {
            font-size: 1.25rem;
            opacity: 0.9;
            margin-bottom: 2rem;
        }

        .cta-section .btn-primary {
            background: white;
            color: #4f46e5;
            padding: 1rem 2.5rem;
            border-radius: 999px;
            font-weight: 600;
            text-decoration: none;
            display: inline-block;
            transition: all 0.3s ease;
        }

        .cta-section .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(255, 255, 255, 0.3);
        }

        .app-footer {
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            color: #6b7280;
            border-top: 1px solid rgba(0,0,0,0.1);
        }

        @keyframes slideDown {
            from {
                opacity: 0;
                transform: translateY(-20px);
            }
            to {
                opacity: 1;
                transform: translateY(0);
            }
        }

        @keyframes bounceIn {
            0% {
                opacity: 0;
                transform: scale(0.3);
            }
            50% {
                opacity: 0.9;
                transform: scale(1.1);
            }
            80% {
                opacity: 1;
                transform: scale(0.89);
            }
            100% {
                opacity: 1;
                transform: scale(1);
            }
        }

        @media (max-width: 768px) {
            .hero h1 {
                font-size: 2.5rem;
            }
            .subtitle {
                font-size: 1rem;
            }
            .category-grid {
                grid-template-columns: 1fr;
            }
        }
    </style>
</body>
</html> 