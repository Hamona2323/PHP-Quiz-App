document.addEventListener('DOMContentLoaded', function() {
    const timerElement = document.getElementById('timer');
    const quizForm = document.getElementById('quiz-form');
    let timeLeft = parseInt(timerElement.dataset.time);
    
    // Timer countdown
    const timer = setInterval(() => {
        timeLeft--;
        timerElement.textContent = timeLeft;
        
        if (timeLeft <= 10) {
            timerElement.classList.add('warning');
        }
        
        if (timeLeft <= 0) {
            clearInterval(timer);
            // Create a hidden input to indicate game over due to time up
            const timeUpInput = document.createElement('input');
            timeUpInput.type = 'hidden';
            timeUpInput.name = 'time_up';
            timeUpInput.value = '1';
            quizForm.appendChild(timeUpInput);
            // Redirect directly to results page with time_up parameter
            window.location.href = 'results.php?time_up=1';
        }
    }, 1000);
    
    // Disable form submission if no answer is selected
    quizForm.addEventListener('submit', function(e) {
        const selectedAnswer = quizForm.querySelector('input[name="answer"]:checked');
        if (!selectedAnswer && !quizForm.querySelector('input[name="time_up"]')) {
            e.preventDefault();
            alert('Please select an answer!');
        }
    });
    
    // Auto-advance after selection
    const radioButtons = document.querySelectorAll('input[type="radio"]');
    radioButtons.forEach(radio => {
        radio.addEventListener('change', () => {
            // Add a small delay before submitting to show the selection
            setTimeout(() => {
                quizForm.submit();
            }, 500);
        });
    });
    
    // Add animation classes when page loads
    document.querySelector('.question-card').classList.add('fade-in');
}); 