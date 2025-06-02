<?php
session_start();

$score = isset($_SESSION['score']) ? $_SESSION['score'] : 0;
$category = isset($_SESSION['category']) ? $_SESSION['category'] : 'science';
$start_time = isset($_SESSION['start_time']) ? $_SESSION['start_time'] : time();
$end_time = isset($_SESSION['end_time']) ? $_SESSION['end_time'] : time();

// Check if the game ended due to time up
$time_up = isset($_GET['time_up']) && $_GET['time_up'] === '1';

// If time is up, set time taken to exactly 60 seconds (1 minute)
$time_taken = $time_up ? 60 : ($end_time - $start_time);

// Clear session data
session_destroy();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Challenge - Results</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="results-container">
            <div class="results-card">
                <?php if ($time_up): ?>
                    <div class="results-header time-up">
                        <div class="results-icon">⏰</div>
                        <h2>Time's Up!</h2>
                        <p class="results-message">You ran out of time! The game is over.</p>
                    </div>
                <?php else: ?>
                    <div class="results-header complete">
                        <div class="results-icon">🎉</div>
                        <h2>Quiz Complete!</h2>
                        <p class="results-message">Great job on completing the quiz!</p>
                    </div>
                <?php endif; ?>
                
                <div class="score-section">
                    <div class="score-details">
                        <div class="score-item">
                            <div class="score-label">Final Score</div>
                            <div class="score-value"><?php echo $score; ?></div>
                            <div class="score-unit">points</div>
                        </div>
                        <div class="score-divider"></div>
                        <div class="score-item">
                            <div class="score-label">Time Taken</div>
                            <div class="score-value"><?php echo floor($time_taken / 60); ?>:<?php echo str_pad($time_taken % 60, 2, '0', STR_PAD_LEFT); ?></div>
                            <div class="score-unit">min:sec</div>
                        </div>
                    </div>
                    <div class="category-badge">
                        <span class="category-icon">
                            <?php
                            $icons = [
                                'science' => '🔬',
                                'history' => '📚',
                                'technology' => '💻'
                            ];
                            echo $icons[$category] ?? '📝';
                            ?>
                        </span>
                        <?php echo ucfirst($category); ?>
                    </div>
                </div>

                <div class="action-buttons">
                    <a href="index.php" class="btn btn-primary">Try Another Quiz</a>
                    <a href="leaderboard.php" class="btn btn-secondary">View Leaderboard</a>
                </div>

                <?php if (!$time_up): ?>
                    <button id="save-score" class="btn btn-save">Save Your Score</button>
                <?php endif; ?>
            </div>
        </div>
    </div>

    <!-- Save Score Modal -->
    <div id="save-score-modal" class="modal">
        <div class="modal-content">
            <h3>Save Your Score</h3>
            <form id="save-score-form">
                <div class="form-group">
                    <input type="text" id="player-name" class="form-control" placeholder="Enter your name" required>
                </div>
                <input type="hidden" id="score" value="<?php echo $score; ?>">
                <input type="hidden" id="category" value="<?php echo $category; ?>">
                <input type="hidden" id="time" value="<?php echo $time_taken; ?>">
                <button type="submit" class="btn btn-primary">Save Score</button>
            </form>
        </div>
    </div>

    <style>
        .results-container {
            max-width: 600px;
            margin: 2rem auto;
            animation: slideUp 0.5s ease-out;
        }

        .results-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .results-header {
            text-align: center;
            padding: 2.5rem 2rem;
            background: linear-gradient(135deg, var(--primary-color), var(--secondary-color));
            color: white;
        }

        .results-header.time-up {
            background: linear-gradient(135deg, var(--danger-color), #f43f5e);
        }

        .results-icon {
            font-size: 4rem;
            margin-bottom: 1rem;
            animation: bounceIn 0.6s ease-out;
        }

        .results-header h2 {
            font-size: 2.5rem;
            margin-bottom: 0.5rem;
            font-weight: 700;
        }

        .results-message {
            font-size: 1.125rem;
            opacity: 0.9;
        }

        .score-section {
            padding: 2rem;
            background: white;
        }

        .score-details {
            display: flex;
            justify-content: center;
            align-items: center;
            gap: 2rem;
            margin-bottom: 2rem;
        }

        .score-divider {
            width: 1px;
            height: 80px;
            background: #e5e7eb;
        }

        .score-item {
            text-align: center;
        }

        .score-label {
            font-size: 0.875rem;
            color: var(--text-secondary);
            margin-bottom: 0.5rem;
            text-transform: uppercase;
            letter-spacing: 0.05em;
        }

        .score-value {
            font-size: 3rem;
            font-weight: 700;
            color: var(--primary-color);
            line-height: 1;
            margin-bottom: 0.25rem;
        }

        .score-unit {
            font-size: 0.875rem;
            color: var(--text-secondary);
        }

        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.5rem;
            padding: 0.5rem 1rem;
            background: #f3f4f6;
            border-radius: 999px;
            font-weight: 500;
            color: var(--text-primary);
        }

        .category-icon {
            font-size: 1.25rem;
        }

        .action-buttons {
            display: flex;
            gap: 1rem;
            padding: 2rem;
            border-top: 1px solid #e5e7eb;
        }

        .btn {
            flex: 1;
            display: inline-flex;
            align-items: center;
            justify-content: center;
            padding: 0.875rem 1.5rem;
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-primary {
            background: linear-gradient(135deg, var(--primary-color), #4338ca);
            color: white;
        }

        .btn-secondary {
            background: #f3f4f6;
            color: var(--text-primary);
        }

        .btn:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(0,0,0,0.1);
        }

        .btn-save {
            display: block;
            width: calc(100% - 4rem);
            margin: 0 2rem 2rem;
            padding: 0.875rem;
            background: white;
            border: 2px solid var(--primary-color);
            color: var(--primary-color);
            border-radius: 12px;
            font-weight: 500;
            transition: all 0.3s ease;
        }

        .btn-save:hover {
            background: var(--primary-color);
            color: white;
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
            .score-details {
                flex-direction: column;
                gap: 1.5rem;
            }

            .score-divider {
                width: 80px;
                height: 1px;
            }

            .action-buttons {
                flex-direction: column;
            }
        }
    </style>

    <script src="assets/js/results.js"></script>
</body>
</html> 