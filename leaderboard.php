<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Quiz Challenge - Leaderboard</title>
    <link rel="stylesheet" href="assets/css/styles.css">
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@400;500;600;700&display=swap" rel="stylesheet">
</head>
<body>
    <div class="container">
        <div class="leaderboard-container">
            <div class="leaderboard-header">
                <h1>🏆 Leaderboard</h1>
                <p class="subtitle">Top performers across all categories</p>
            </div>

            <div class="category-filters">
                <button class="filter-btn active" data-category="all">All Categories</button>
                <button class="filter-btn" data-category="science">Science</button>
                <button class="filter-btn" data-category="history">History</button>
                <button class="filter-btn" data-category="technology">Technology</button>
            </div>

            <div class="leaderboard-card">
                <div class="table-container">
                    <table class="leaderboard-table">
                        <thead>
                            <tr>
                                <th>Rank</th>
                                <th>Player</th>
                                <th>Category</th>
                                <th>Score</th>
                                <th>Time</th>
                            </tr>
                        </thead>
                        <tbody id="leaderboard-body">
                            <!-- Leaderboard data will be loaded here via JavaScript -->
                        </tbody>
                    </table>
                </div>
            </div>

            <div class="back-to-home">
                <a href="index.php" class="btn btn-primary">Back to Home</a>
            </div>
        </div>
    </div>

    <footer class="app-footer">
        <p>Created with ❤️ by Hemon</p>
    </footer>

    <style>
        .leaderboard-container {
            max-width: 900px;
            margin: 2rem auto;
            animation: slideUp 0.5s ease-out;
        }

        .leaderboard-header {
            text-align: center;
            margin-bottom: 2rem;
        }

        .leaderboard-header h1 {
            font-size: 3rem;
            color: var(--primary-color);
            margin-bottom: 0.5rem;
            animation: bounceIn 0.6s ease-out;
        }

        .subtitle {
            color: var(--text-secondary);
            font-size: 1.125rem;
        }

        .category-filters {
            display: flex;
            justify-content: center;
            gap: 0.5rem;
            margin-bottom: 2rem;
            flex-wrap: wrap;
        }

        .filter-btn {
            padding: 0.5rem 1rem;
            border: none;
            background: white;
            border-radius: 999px;
            font-weight: 500;
            color: var(--text-secondary);
            cursor: pointer;
            transition: all 0.3s ease;
        }

        .filter-btn:hover {
            background: #f3f4f6;
            color: var(--primary-color);
        }

        .filter-btn.active {
            background: var(--primary-color);
            color: white;
        }

        .leaderboard-card {
            background: white;
            border-radius: 20px;
            box-shadow: 0 20px 25px -5px rgba(0,0,0,0.1), 0 10px 10px -5px rgba(0,0,0,0.04);
            overflow: hidden;
        }

        .table-container {
            overflow-x: auto;
        }

        .leaderboard-table {
            width: 100%;
            border-collapse: collapse;
        }

        .leaderboard-table th,
        .leaderboard-table td {
            padding: 1rem;
            text-align: left;
            border-bottom: 1px solid #e5e7eb;
        }

        .leaderboard-table th {
            background: #f8fafc;
            font-weight: 600;
            color: var(--text-secondary);
            text-transform: uppercase;
            font-size: 0.75rem;
            letter-spacing: 0.05em;
        }

        .leaderboard-table tr:hover {
            background: #f8fafc;
        }

        .leaderboard-table td:first-child {
            font-weight: 600;
            color: var(--primary-color);
        }

        /* Top 3 ranks styling */
        .rank-1 td:first-child { color: gold; }
        .rank-2 td:first-child { color: silver; }
        .rank-3 td:first-child { color: #cd7f32; }

        .category-badge {
            display: inline-flex;
            align-items: center;
            gap: 0.25rem;
            padding: 0.25rem 0.75rem;
            border-radius: 999px;
            font-size: 0.875rem;
            font-weight: 500;
        }

        .category-badge.science {
            background: #dcfce7;
            color: #166534;
        }

        .category-badge.history {
            background: #fef3c7;
            color: #92400e;
        }

        .category-badge.technology {
            background: #dbeafe;
            color: #1e40af;
        }

        .back-to-home {
            text-align: center;
            margin-top: 2rem;
        }

        .btn-primary {
            display: inline-flex;
            align-items: center;
            padding: 0.75rem 1.5rem;
            background: linear-gradient(135deg, var(--primary-color), #4338ca);
            color: white;
            border-radius: 12px;
            font-weight: 500;
            text-decoration: none;
            transition: all 0.3s ease;
        }

        .btn-primary:hover {
            transform: translateY(-2px);
            box-shadow: 0 4px 12px rgba(79, 70, 229, 0.3);
        }

        @media (max-width: 768px) {
            .leaderboard-header h1 {
                font-size: 2rem;
            }

            .category-filters {
                gap: 0.25rem;
            }

            .filter-btn {
                padding: 0.375rem 0.75rem;
                font-size: 0.875rem;
            }

            .leaderboard-table {
                font-size: 0.875rem;
            }

            .leaderboard-table th,
            .leaderboard-table td {
                padding: 0.75rem;
            }
        }

        .app-footer {
            text-align: center;
            padding: 2rem;
            margin-top: 3rem;
            color: var(--text-secondary);
            border-top: 1px solid rgba(0,0,0,0.1);
        }
    </style>

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const filterButtons = document.querySelectorAll('.filter-btn');
            
            filterButtons.forEach(button => {
                button.addEventListener('click', function() {
                    // Remove active class from all buttons
                    filterButtons.forEach(btn => btn.classList.remove('active'));
                    // Add active class to clicked button
                    this.classList.add('active');
                    
                    // Filter logic will be handled by leaderboard.js
                    const category = this.dataset.category;
                    // Trigger filtering event
                    document.dispatchEvent(new CustomEvent('filterLeaderboard', {
                        detail: { category: category }
                    }));
                });
            });
        });
    </script>

    <script src="assets/js/leaderboard.js"></script>
</body>
</html> 