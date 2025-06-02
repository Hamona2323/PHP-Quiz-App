class LeaderboardManager {
    constructor() {
        this.scores = JSON.parse(localStorage.getItem('quizScores')) || [];
        this.currentCategory = 'all';
    }

    addScore(name, category, score, time) {
        const newScore = {
            name,
            category,
            score: parseInt(score),
            time: parseInt(time),
            timestamp: Date.now()
        };
        
        this.scores.push(newScore);
        this.scores.sort((a, b) => b.score - a.score || a.time - b.time);
        this.saveScores();
    }

    getScores(category = 'all') {
        return category === 'all' 
            ? this.scores 
            : this.scores.filter(score => score.category === category);
    }

    saveScores() {
        localStorage.setItem('quizScores', JSON.stringify(this.scores));
    }

    formatTime(seconds) {
        const minutes = Math.floor(seconds / 60);
        const remainingSeconds = seconds % 60;
        return `${minutes}m ${remainingSeconds}s`;
    }

    updateLeaderboard(category = 'all') {
        const scores = this.getScores(category);
        const tbody = document.getElementById('leaderboard-body');
        tbody.innerHTML = '';

        scores.slice(0, 10).forEach((score, index) => {
            const row = document.createElement('tr');
            row.innerHTML = `
                <td>${index + 1}</td>
                <td>${score.name}</td>
                <td>${score.category}</td>
                <td>${score.score}</td>
                <td>${this.formatTime(score.time)}</td>
            `;
            tbody.appendChild(row);
        });
    }
}

// Initialize leaderboard
document.addEventListener('DOMContentLoaded', () => {
    const leaderboard = new LeaderboardManager();
    
    // Handle category filtering
    const filterButtons = document.querySelectorAll('.filter-btn');
    filterButtons.forEach(button => {
        button.addEventListener('click', () => {
            filterButtons.forEach(btn => btn.classList.remove('active'));
            button.classList.add('active');
            leaderboard.updateLeaderboard(button.dataset.category);
        });
    });
    
    // Handle score saving
    const saveScoreForm = document.getElementById('save-score-form');
    if (saveScoreForm) {
        saveScoreForm.addEventListener('submit', (e) => {
            e.preventDefault();
            const name = document.getElementById('player-name').value;
            const score = document.getElementById('score').value;
            const category = document.getElementById('category').value;
            const time = document.getElementById('time').value;
            
            leaderboard.addScore(name, category, score, time);
            
            // Hide modal and redirect to leaderboard
            document.getElementById('save-score-modal').style.display = 'none';
            window.location.href = 'leaderboard.php';
        });
    }
    
    // Show save score modal
    const saveScoreBtn = document.getElementById('save-score');
    if (saveScoreBtn) {
        saveScoreBtn.addEventListener('click', () => {
            document.getElementById('save-score-modal').style.display = 'block';
        });
    }
    
    // Initial leaderboard update
    leaderboard.updateLeaderboard();
}); 