document.addEventListener('DOMContentLoaded', () => {
    const saveScoreBtn = document.getElementById('save-score');
    const saveScoreModal = document.getElementById('save-score-modal');
    const saveScoreForm = document.getElementById('save-score-form');

    // Show modal when save button is clicked
    if (saveScoreBtn) {
        saveScoreBtn.addEventListener('click', () => {
            saveScoreModal.style.display = 'block';
        });
    }

    // Handle score saving
    if (saveScoreForm) {
        saveScoreForm.addEventListener('submit', (e) => {
            e.preventDefault();
            
            const name = document.getElementById('player-name').value;
            const score = parseInt(document.getElementById('score').value);
            const category = document.getElementById('category').value;
            const time = parseInt(document.getElementById('time').value);

            // Get existing scores or initialize empty array
            let scores = JSON.parse(localStorage.getItem('quizScores')) || [];
            
            // Add new score
            scores.push({
                name,
                category,
                score,
                time,
                timestamp: Date.now()
            });

            // Sort scores by score (descending) and time (ascending)
            scores.sort((a, b) => b.score - a.score || a.time - b.time);

            // Save to localStorage
            localStorage.setItem('quizScores', JSON.stringify(scores));

            // Hide modal and redirect to leaderboard
            saveScoreModal.style.display = 'none';
            window.location.href = 'leaderboard.php';
        });
    }

    // Close modal when clicking outside
    window.addEventListener('click', (e) => {
        if (e.target === saveScoreModal) {
            saveScoreModal.style.display = 'none';
        }
    });
}); 