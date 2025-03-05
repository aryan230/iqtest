<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/css/intlTelInput.min.css"
/>
<link
    rel="stylesheet"
    href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css"
/>
<?php
/**
 * Template Name: Test Page
 */

get_header();
if (astra_page_layout() == 'left-sidebar') {
    get_sidebar();
}
$start = get_field('start');
$continue = get_field('continue');
$result = get_field('result');
$extra_text = get_field('extra_text');
$confirm_quit = get_field('confirm_quit');
?>

<div id="quiz-container">
    <!-- Welcome Section -->
    <div id="welcome-section">
        <div class="welcome-content">
            <h2><?php echo $start['title']; ?></h2>
            <div class="instructions">
               <?php echo $start['content']; ?>
            </div>
            <button id="start-btn" class="gradient-btn-2"><?php echo $start['button']; ?></button>
        </div>
    </div>

    <!-- Loading Images -->
    <div id="image-preloading-spinner" class="loading-spinner">
    <div class="spinner"></div>
    <p>Loading quiz, please wait...</p>
</div>

    <!-- Quiz Section -->
    <div id="quiz-section" style="display: none;">
        <div class="quiz-header">
            <div class="progress-info">
                <div class="progress-bar-container">
                    <div id="progress-bar"></div>
                </div>
                <div class="progress-stats">
                    <span id="question-number">Question 1/20</span>
                    <span id="timer" class="timer">
    <svg class="si me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512">
        <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
    </svg>30:00
</span>
                </div>
            </div>
        </div>

        <div id="quiz-question" class="question-container">
            <div class="question-text-container">
                <h3 class="question-text"></h3>
                <div class="question-image">
                    <img id="question-img" src="" alt="Quiz Question">
                </div>
            </div>
            <div class="options-grid">
                <?php
                $options = ['A', 'B', 'C', 'D', 'E', 'F'];
                foreach ($options as $letter) {
                    echo "<button class='answer-btn' data-answer='$letter'>
                            <span class='option-letter'>$letter)</span>
                            <img class='option-img' loading='lazy' src='' alt='Option $letter'>
                          </button>";
                }
                ?>
            </div>
        </div>

        <div class="navigation-controls">
            <button id="prev-btn" class="nav-control-btn hidden">←  <?php echo $extra_text['previous'] ? $extra_text['previous'] : 'Previous'; ?></button>
            <button id="next-btn" class="nav-control-btn"><?php echo $extra_text['next'] ? $extra_text['next'] : 'Skip'; ?> →</button>
            <button id="finish-btn" class="gradient-btn" style="display: none;"> <?php echo $extra_text['results'] ? $extra_text['results'] : 'Results'; ?></button>
        </div>

        <div class="question-navigation">
            <?php for ($i = 1; $i <= 20; $i++) : ?>
                <button class="nav-btn" data-question="<?php echo $i; ?>"><?php echo $i; ?></button>
            <?php endfor; ?>
        </div>
    </div>

    <!-- Form Section -->
    <div id="form-section" style="display: none;" class="fff-form-container">
        <div class="fff-form-header">
            <h1>DETAILS FOR OFFICIAL IQ CERTIFICATE & REPORT</h1>
        </div>
        <div class="fff-form-content">
            <div class="result-loader-gif" id="result-loader-gif">
            <img src="https://iqtestglobal.org/wp-content/uploads/2024/12/result_loader.gif" alt="">

            </div>
            <form id="user-info-form" novalidate>
                <div class="fff-form-group">
                    <label class="fff-form-label" for="firstName">First Name</label>
                    <i class="fas fa-user"></i>
                    <input class="fff-form-input" type="text" id="firstName" name="firstName" placeholder="First Name (First Name on Official IQ Certificate)">
                    <div class="fff-error" id="firstNameError">Please enter your first name</div>
                </div>

                <div class="fff-form-group">
                    <label class="fff-form-label" for="lastName">Last Name</label>
                    <i class="fas fa-user"></i>
                    <input class="fff-form-input" type="text" id="lastName" name="lastName" placeholder="Last Name">
                    <div class="fff-error" id="lastNameError">Please enter your last name</div>
                </div>

                <div class="fff-form-group">
                    <label class="fff-form-label" for="email">Email Address</label>
                    <i class="fas fa-envelope"></i>
                    <input class="fff-form-input" type="email" id="email" name="email" placeholder="Email (Result will be sent on this email)">
                    <div class="fff-error" id="emailError">Please enter a valid email address</div>
                </div>

                <div class="fff-form-group fff-phone-group">
                    <label class="fff-form-label" for="phone">Contact Number</label>
                    <input class="fff-form-input" type="tel" id="phone" name="phone" placeholder="Phone">
                    <div class="fff-error" id="phoneError">Please enter a valid phone number</div>
                </div>

                <div class="fff-form-group">
                    <label class="fff-form-label" for="age">Age</label>
                    <i class="fas fa-calendar-alt"></i>
                    <input class="fff-form-input" type="number" id="age" name="age" placeholder="Age">
                    <div class="fff-error" id="ageError">Please enter a valid age between 1 and 120</div>
                </div>

                <button type="submit" class="fff-submit-btn">Check Your Answers</button>
                <a href="#" class="fff-edit-link" id="show-quiz-back">Edit My Answers</a>
            </form>
        </div>
    </div>

    <!-- <div id="form-section" style="display: none;" class="form-submission-wrapper">
    </div> -->
    <!-- <div class="form-card">
        <div class="form-header">
            <h2>DETAILS FOR OFFICIAL IQ CERTIFICATE & REPORT</h2>
        </div>
        <div class="result-loader-gif" id="result-loader-gif">
            <img src="http://iq-test.local/wp-content/uploads/2024/12/result_loader.gif" alt="">
        </div>
        <form id="user-info-form" class="form-content">
            <div class="form-group">
                <label for="first-name">FIRST NAME</label>
                <input 
                    type="text" 
                    id="first-name" 
                    name="first-name" 
                    placeholder="First Name (First Name on Official IQ Certificate)" 
                    required
                >
                <span class="error-message" id="first-name-error"></span>
            </div>
            
            <div class="form-group">
                <label for="last-name">LAST NAME</label>
                <input 
                    type="text" 
                    id="last-name" 
                    name="last-name" 
                    placeholder="Last Name" 
                    required
                >
                <span class="error-message" id="last-name-error"></span>
            </div>
            
            <div class="form-group">
                <label for="email">EMAIL ADDRESS</label>
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    placeholder="Email (Result will be sent on this email)" 
                    required
                >
                <span class="error-message" id="email-error"></span>
            </div>
            
            <div class="form-group">
                <label for="phone">CONTACT NUMBER</label>
                <div class="phone-input-wrapper">
                    <div class="country-code">
                        <img src="https://flagcdn.com/w20/in.png" alt="India" class="flag-icon">
                        <span>+91</span>
                    </div>
                    <input 
                        type="tel" 
                        id="phone" 
                        name="phone" 
                        placeholder="Phone Number" 
                        required 
                        maxlength="10"
                    >
                </div>
                <span class="error-message" id="phone-error"></span>
            </div>
            
            <div class="form-group">
                <label for="age">AGE</label>
                <input 
                    type="number" 
                    id="age" 
                    name="age" 
                    placeholder="Age" 
                    required 
                    min="1" 
                    max="100"
                >
                <span class="error-message" id="age-error"></span>
            </div>
            
            <button type="submit" class="submit-button">Check Your Answers</button>
           
        </form>
    </div> -->


    <!-- Modals -->
    <div id="modal-overlay" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-header">
                <h3 id="modal-title"></h3>
                <button class="modal-close">&times;</button>
            </div>
            <div class="modal-body">
                <p id="modal-message"></p>
            </div>
            <div class="modal-footer">
                <button id="modal-secondary-btn" class="modal-btn secondary"></button>
                <button id="modal-primary-btn" class="modal-btn primary"></button>
            </div>
        </div>
    </div>

    <!-- Loading Spinner -->
    <div id="loading-spinner" class="loading-spinner">
        <div class="spinner"></div>
        <p>Submitting your answers...</p>
    </div>

    <!-- Refresh Modal -->
    <div id="refresh-modal" class="modal-overlay">
        <div class="modal-content">
            <div class="modal-body">
                <p id="refresh-message"></p>
            </div>
            <div class="modal-footer">
                <button id="continue-btn" class="modal-btn primary">No</button>
                <button id="restart-btn" class="modal-btn secondary">Restart</button>
            </div>
        </div>
    </div>
</div>

<style>

    #page {
        background: #EEF2FF;
    }
/* Root Variables */
:root {
    --primary-color: #2563eb;
    --primary-dark: #1d4ed8;
    --secondary-color: #64748b;
    --success-color: #22c55e;
    --danger-color: #ef4444;
    --warning-color: #f59e0b;
    --background-light: #f8fafc;
    --text-primary: #1e293b;
    --text-secondary: #64748b;
    --border-color: #e2e8f0;
    --shadow-sm: 0 1px 3px rgba(0,0,0,0.1);
    --shadow-md: 0 4px 6px rgba(0,0,0,0.1);
    --shadow-lg: 0 10px 15px rgba(0,0,0,0.1);
}

/* Container Styles */
#quiz-container {
    max-width: 800px;
    margin: 2rem auto;
    padding: 2rem;
    background: white;
    border-radius: 1rem;
    box-shadow: var(--shadow-lg);
	width: 95%;
    box-sizing: border-box; /* Add this */
}

/* Welcome Section */
.welcome-content {
    text-align: center;
    padding: 2rem;
}

.quiz-info {
    display: grid;
    grid-template-columns: repeat(auto-fit, minmax(200px, 1fr));
    gap: 1.5rem;
    margin: 2rem 0;
}

.info-item {
    padding: 1.5rem;
    background: var(--background-light);
    border-radius: 0.75rem;
    box-shadow: var(--shadow-sm);
}

.info-icon {
    font-size: 1.5rem;
    margin-bottom: 0.5rem;
}

.instructions {
    text-align: left;
    margin: 2rem 0;
    border-radius: 0.75rem;
}

.instructions ol {
    margin-left: 1.5rem;
}

.instructions li {
    margin: 0.75rem 0;
}

/* Quiz Section */
.quiz-header {
    margin-bottom: 0.5rem;
}

.progress-bar-container {
    height: 0.5rem;
    background: var(--background-light);
    border-radius: 1rem;
    overflow: hidden;
}

#progress-bar {
    height: 100%;
    background: var(--primary-color);
    transition: width 0.3s ease;
}

.progress-stats {
    display: flex;
    justify-content: space-between;
    margin-top: 0.5rem;
    padding-bottom: 0.5rem;
}

.timer {
    font-weight: bold;
    color: var(--primary-color);
}

/* Question Styles */
.question-container {
    width: 100%;
    display: flex;
    justify-content: space-between;
    align-items: center;
    background: white;
    padding: 1rem;
    border-radius: 1rem;
    box-shadow: var(--shadow-md);
    margin-bottom: 1rem;
}

@media screen and (max-width: 700px) {
    .question-container {
        width: 100%;
        display: flex;
        flex-direction: column;
        justify-content: space-between;
        align-items: center;
        background: white;
        padding: 1rem;
        border-radius: 1rem;
        box-shadow: var(--shadow-md);
        margin-bottom: 1rem;
    }
}

.question-text-container {
    width: 45%;
}

@media screen and (max-width: 700px) {
    .question-text-container {
        width: 70%;
    }
}

.question-image {
    margin: 1rem 0;
    text-align: center;
}

.question-image img {
    width: 100%;
}

.options-grid {
    display: flex;
    flex-wrap: wrap;
    width: 40%;
}

@media screen and (max-width: 700px) {
    .options-grid {
        display: flex;
        align-items: center;
        justify-content: center;
        flex-wrap: wrap;
        width: 100%;
        margin: 0 auto;
    }
}

@media screen and (max-width: 700px) {
    .quiz-info {
        display: none;
       
    }
}

/* Answer Buttons */
.answer-btn {
    display: flex;
    flex-direction: row;
    align-items: center;
    justify-content: center;
    padding: .5rem;
    background: white;
    /* border: 2px solid var(--border-color); */
    border-radius: 0.75rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin: .5rem;
}

.answer-btn:hover {
    transform: translateY(-2px);
    box-shadow: var(--shadow-md);
    background: #bfd2ff;
}

.answer-btn.selected {
    background: #bfd2ff;
    color: white;
    border-color: var(--primary-color);
}

.option-letter {
    font-size: 1.25rem;
    font-weight: bold;
    margin-right: 0.5rem;
    color: black;
}

.option-img {
    max-width: 100%;
    max-height: 70px;
}

@media screen and (max-width: 700px) {
    .option-img {
    max-width: 100%;
    max-height: 50px;
}
}


/* Navigation Controls */
.navigation-controls {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin: 0.5rem 0;
}

.nav-control-btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    background: var(--background-light);
    color: var(--text-primary);
    cursor: pointer;
    transition: all 0.3s ease;
}

.nav-control-btn:hover {
    background: var(--primary-color);
    color: white;
}

/* Question Navigation */
.question-navigation {
    display: flex;
    flex-wrap: wrap;
    gap: 0.5rem;
    justify-content: center;
    margin-top: 1rem;
}

.nav-btn {
    width: 1.5rem;
    height: 1.5rem;
    padding: 1rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    background: var(--background-light);
    color: var(--text-primary);
    cursor: pointer;
    transition: all 0.3s ease;
    position: relative;
    display: flex;
    align-items: center;
    justify-content: center;
}

.nav-btn:hover,
.nav-btn.active {
    background: white;
    color: var(--text-primary);
    border: 2px solid var(--primary-color);
}

.nav-btn.current {
    background: white;
    color: var(--primary-color);
    border: 2px solid var(--primary-color);
    box-shadow:  0 3px var(--ast-global-color-0) !important
}

.nav-btn.answered {
    background: var(--primary-color);
    color: white;
}

/* .nav-btn.answered::after {
    position: absolute;
    top: -5px;
    right: -5px;
    background: var(--primary-color);
    color: white;
    border-radius: 50%;
    padding: 2px;
    font-size: 0.75rem;
} */



/* Modal Styles */
.modal-overlay {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(0, 0, 0, 0.5);
    z-index: 1000;
    align-items: center;
    justify-content: center;
}

.modal-content {
    background: white;
    border-radius: 1rem;
    width: 90%;
    max-width: 500px;
    box-shadow: var(--shadow-lg);
}

.modal-header {
    padding: 1.5rem;
    border-bottom: 1px solid var(--border-color);
    display: flex;
    justify-content: space-between;
    align-items: center;
}

.modal-close {
    background: none;
    border: none;
    font-size: 1.5rem;
    cursor: pointer;
}

.modal-body {
    padding: 1.5rem;
}

.modal-footer {
    padding: 1.5rem;
    border-top: 1px solid var(--border-color);
    display: flex;
    justify-content: flex-end;
    gap: 1rem;
}

.modal-btn {
    padding: 0.75rem 1.5rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.modal-btn.primary {
    background: var(--primary-color);
    color: white;
}

.modal-btn.secondary {
    background: var(--secondary-color);
    color: white;
}

/* Loading Spinner */
.loading-spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    z-index: 1001;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

.spinner {
    width: 3rem;
    height: 3rem;
    border: 0.25rem solid var(--border-color);
    border-top-color: var(--primary-color);
    border-radius: 50%;
    animation: spin 1s linear infinite;
}

@keyframes spin {
    to { transform: rotate(360deg); }
}

/* Utility Classes */
	

.gradient-btn-2 {
	background: linear-gradient(to right, var(--primary-color), var(--primary-dark));
    color: white;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}
	
.gradient-btn {
    background: #df9000;
    color: white;
    padding: 0.75rem 2rem;
    border: none;
    border-radius: 0.5rem;
    cursor: pointer;
    transition: all 0.3s ease;
}

.gradient-btn:hover {background: #df9000;
    transform: translateY(-2px);
    /* box-shadow: var(--shadow-md); */
}

/* Form Styles */
.form-submission-wrapper {
    min-height: 100vh;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 2rem;
    /* background-color: #f0f5ff; */
}

.form-card {
    width: 100%;
    max-width: 550px;
    background: white;
    border-radius: 24px;
    box-shadow: 0 4px 20px rgba(0, 0, 0, 0.08);
    overflow: hidden;
}

.form-header {
    background: #2E75B6;
    padding: 1.5rem 2rem;
    margin-bottom: 1.5rem;
}

.form-header h2 {
    color: white;
    margin: 0;
    font-size: 1.25rem;
    font-weight: 600;
    text-align: center;
    letter-spacing: 0.5px;
}

.form-content {
    padding: 0 2rem 2rem;
}

.form-group {
    margin-bottom: 1.5rem;
}

.form-group label {
    display: block;
    font-weight: 600;
    font-size: 0.875rem;
    color: #374151;
    margin-bottom: 0.5rem;
    text-transform: uppercase;
}

.form-group input {
    width: 100%;
    padding: 0.75rem 1rem;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 1rem;
    color: #1f2937;
    background: #f9fafb;
    transition: all 0.3s ease;
}

.form-group input:focus {
    outline: none;
    border-color: #2E75B6;
    background: white;
    box-shadow: 0 0 0 4px rgba(46, 117, 182, 0.1);
}

.form-group input::placeholder {
    color: #9ca3af;
    font-size: 0.875rem;
}

.phone-input-wrapper {
    display: flex;
    align-items: center;
    gap: 0.5rem;
}

.country-code {
    display: flex;
    align-items: center;
    gap: 0.5rem;
    padding: 0.75rem 1rem;
    background: #f9fafb;
    border: 1px solid #e5e7eb;
    border-radius: 8px;
    font-size: 0.875rem;
    color: #374151;
    white-space: nowrap;
}

.flag-icon {
    width: 20px;
    height: auto;
    border-radius: 2px;
}

.phone-input-wrapper input {
    flex: 1;
}

.submit-button {
    width: 100%;
    padding: 1rem;
    background: #4287f5;
    color: white;
    border: none;
    border-radius: 8px;
    font-weight: 600;
    font-size: 1rem;
    cursor: pointer;
    transition: all 0.3s ease;
    margin-top: 1rem;
}

.submit-button:hover {
    background: #2563eb;
    transform: translateY(-1px);
    box-shadow: 0 4px 12px rgba(37, 99, 235, 0.2);
}

.edit-link {
    display: block;
    text-align: center;
    color: #2E75B6;
    text-decoration: none;
    margin-top: 1rem;
    font-size: 0.875rem;
    font-weight: 500;
    transition: color 0.3s ease;
}

.edit-link:hover {
    color: #1d4ed8;
    text-decoration: underline;
}

.error-message {
    color: #dc2626;
    font-size: 0.75rem;
    margin-top: 0.25rem;
    display: none;
}

/* Mobile Responsiveness */
@media (max-width: 640px) {
    .form-submission-wrapper {
        padding: 1rem;
    }
    
    .form-content {
        padding: 0 1.5rem 1.5rem;
    }
    
    .form-header {
        padding: 1.25rem;
    }
    
    .form-header h2 {
        font-size: 1.125rem;
    }
}

/* Animation for form appearance */
@keyframes formFadeIn {
    from {
        opacity: 0;
        transform: translateY(20px);
    }
    to {
        opacity: 1;
        transform: translateY(0);
    }
}

#form-section {
    animation: formFadeIn 0.5s ease-out;
}

#result-loader-gif{
    display: none;
}

.custom-header-ribbon {
    background: linear-gradient(135deg, #276BAC, #4C93D6);
    color: white;
    text-align: center;
    padding: 25px;
    position: relative;
    margin: -40px -40px 40px -40px;
    box-shadow: 0 4px 10px -1px rgba(79, 70, 229, 0.3), 0 2px 6px -2px rgba(79, 70, 229, 0.2);
    clip-path: polygon(0 0, 100% 0, 100% 80%, 51% 100%, 50% 100%, 49% 100%, 0 80%);
}

/* New form */

.fff-form-container {
            background: white;
            border-radius: 12px;
            width: 100%;
            max-width: 800px; /* Increased from 700px */
            box-shadow: 0 4px 6px rgba(0, 0, 0, 0.1);
            overflow: hidden;
            padding: 0;
            margin: 0 auto; /* Add this */
            box-sizing: border-box; /* Add this */
          
        }

        .fff-form-header {
            background: linear-gradient(135deg, #276BAC, #4C93D6);
            color: white;
            padding: 50px 20px;
            clip-path: polygon(0 0, 100% 0, 100% 80%, 51% 100%, 50% 100%, 49% 100%, 0 80%);
            margin-bottom: 10px;
            height: 80px;
            display: flex;
            align-items: center;
            justify-content: center; /* Add this line to center the content horizontally */
            text-align: center;
            width: 100%; /* Ensure full width */
        }

        .fff-form-header h1 {
            font-size: 1.25rem;
            font-weight: 800;
            margin: 0;
            padding: 0;
            color: white;
            text-align: center;
            width: 100%; /* Ensure text takes full width */
        }

        .fff-form-content {
            padding: 20px 30px;
            box-sizing: border-box; /* Add this */
        }

        .fff-form-group {
            margin-bottom: 20px;
            position: relative;
        }

        .fff-form-group i {
            position: absolute;
            left: 15px;
            top: 45px;
            color: #276BAC;
            font-size: 16px;
            z-index: 2;
        }

        .fff-form-label {
            display: block;
            font-size: 0.9rem;
            font-weight: 600;
            color: #1f2937;
            margin-bottom: 8px;
            text-transform: uppercase;
        }

        .fff-form-input {
            width: 100% !important;
            height: 45px !important;
            padding: 10px 10px 10px 45px !important;
            border: 1px solid #e5e7eb !important;
            border-radius: 6px !important;
            font-size: 0.9rem !important;
            transition: border-color 0.2s !important;
            background: white !important;
            box-sizing: border-box; /* Add this */
        }

        .fff-form-input:focus {
            outline: none !important;
            border-color: #276BAC !important;
            box-shadow: none !important;
        }

        .fff-error-field {
            border-color: #dc2626 !important;
        }

        .fff-error {
            color: #dc2626;
            font-size: 0.875rem;
            margin-top: 4px;
            display: none;
        }

        .fff-error.fff-show {
            display: block;
        }

        .fff-submit-btn {
            width: 100% !important;
            height: 45px !important;
            background: #276BAC !important;
            color: white !important;
            border: none !important;
            border-radius: 6px !important;
            font-size: 1rem !important;
            font-weight: 500 !important;
            cursor: pointer !important;
            transition: background-color 0.2s !important;
            text-transform: none !important;
            line-height: 45px !important;
            padding: 0 !important;
            margin: 0 !important;
        }

        .fff-submit-btn:hover {
            background: #4C93D6 !important;
        }

        .fff-edit-link {
            display: block;
            text-align: center;
            color: #276BAC;
            text-decoration: none;
            margin-top: 12px;
            font-size: 0.875rem;
        }

        /* Phone input specific styles */
        .fff-phone-group .iti {
            width: 100% !important;
            display: block !important;
        }

        .fff-phone-group #phone {
            padding-left: 90px !important;
        }

        .iti__flag-container {
            height: 45px !important;
            display: flex !important;
            align-items: center !important;
        }

        .iti--separate-dial-code .iti__selected-flag {
            background-color: transparent !important;
            border-radius: 6px 0 0 6px !important;
        }

        

        /* Override any potential conflicting styles */
        .fff-form-group input[type="text"],
        .fff-form-group input[type="email"],
        .fff-form-group input[type="tel"],
        .fff-form-group input[type="number"] {
            padding-left: 45px !important;
        }

        /* Custom icons instead of Font Awesome */
        .fff-form-group.name-field::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            left: 15px;
            top: 45px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23276BAC'%3E%3Cpath d='M12 12c2.21 0 4-1.79 4-4s-1.79-4-4-4-4 1.79-4 4 1.79 4 4 4zm0 2c-2.67 0-8 1.34-8 4v2h16v-2c0-2.66-5.33-4-8-4z'/%3E%3C/svg%3E") no-repeat center center;
            z-index: 2;
        }

        .fff-form-group.email-field::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            left: 15px;
            top: 45px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23276BAC'%3E%3Cpath d='M20 4H4c-1.1 0-1.99.9-1.99 2L2 18c0 1.1.9 2 2 2h16c1.1 0 2-.9 2-2V6c0-1.1-.9-2-2-2zm0 4l-8 5-8-5V6l8 5 8-5v2z'/%3E%3C/svg%3E") no-repeat center center;
            z-index: 2;
        }

        .fff-form-group.age-field::before {
            content: '';
            position: absolute;
            width: 16px;
            height: 16px;
            left: 15px;
            top: 45px;
            background: url("data:image/svg+xml,%3Csvg xmlns='http://www.w3.org/2000/svg' viewBox='0 0 24 24' fill='%23276BAC'%3E%3Cpath d='M19 3h-1V1h-2v2H8V1H6v2H5c-1.11 0-1.99.9-1.99 2L3 19c0 1.1.89 2 2 2h14c1.1 0 2-.9 2-2V5c0-1.1-.9-2-2-2zm0 16H5V8h14v11zM7 10h5v5H7z'/%3E%3C/svg%3E") no-repeat center center;
            z-index: 2;
        }

        .hidden {
            opacity: 0;
        }

        /* Image Preloading Spinner */
#image-preloading-spinner {
    display: none;
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(255, 255, 255, 0.9);
    z-index: 1001;
    align-items: center;
    justify-content: center;
    flex-direction: column;
}

@media (prefers-reduced-data: reduce) {
    /* Reduce animations on slow connections */
    * {
        animation-duration: 0.01ms !important;
        animation-iteration-count: 1 !important;
        transition-duration: 0.01ms !important;
    }
    
    /* Use lighter background gradients */
    .fff-form-header {
        background: #276BAC;
    }
}

/* Add loading placeholder for slow connections */
.loading-indicator {
    display: inline-block;
    width: 100%;
    height: 30px;
    background: linear-gradient(90deg, #f0f0f0, #e0e0e0, #f0f0f0);
    background-size: 200% 100%;
    animation: loading-pulse 1.5s infinite;
    border-radius: 4px;
}

@keyframes loading-pulse {
    0% { background-position: 100% 0; }
    100% { background-position: -100% 0; }
}
</style>
<script src="https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/intlTelInput.min.js"></script>

<script>




    // New

    const phoneInput = document.getElementById('phone');
        const iti = window.intlTelInput(phoneInput, {
            initialCountry: "in",
            separateDialCode: true,
            utilsScript: "https://cdnjs.cloudflare.com/ajax/libs/intl-tel-input/17.0.8/js/utils.js",
        });

        
        const showError = (elementId, message) => {
            const input = document.getElementById(elementId);
            const error = document.getElementById(elementId + 'Error');
            input.classList.add('fff-error-field');
            error.textContent = message;
            error.classList.add('fff-show');
        };

        const hideError = (elementId) => {
            const input = document.getElementById(elementId);
            const error = document.getElementById(elementId + 'Error');
            input.classList.remove('fff-error-field');
            error.classList.remove('fff-show');
        };

        const validateEmail = (email) => {
            return /^[^\s@]+@[^\s@]+\.[^\s@]+$/.test(email);
        };
        const showQuizBackButton = document.getElementById('show-quiz-back')

        const form = document.getElementById('user-info-form');

        showQuizBackButton.addEventListener("click", showQuizBack)

        // Modified form validation code - Keep IntlTelInput but remove validation
        form.addEventListener('submit', (e) => {
            e.preventDefault();
            let isValid = true;

            // Reset all previous errors
            document.querySelectorAll('.fff-error').forEach(error => error.classList.remove('fff-show'));
            document.querySelectorAll('.fff-form-input').forEach(input => input.classList.remove('fff-error-field'));

            // First Name validation
            if (!form.firstName.value.trim()) {
                showError('firstName', 'Please enter your first name');
                isValid = false;
            }

            // Last Name validation
            if (!form.lastName.value.trim()) {
                showError('lastName', 'Please enter your last name');
                isValid = false;
            }

            // Email validation
            if (!validateEmail(form.email.value)) {
                showError('email', 'Please enter a valid email address');
                isValid = false;
            }

            // REMOVED PHONE VALIDATION - no validation for phone number
            // Always hide phone error if it exists
            hideError('phone');

            // Age validation
            const age = parseInt(form.age.value);
            if (isNaN(age) || age < 1 || age > 120) {
                showError('age', 'Please enter a valid age between 1 and 120');
                isValid = false;
            }

            if (isValid) {
                const formData = {
                    firstName: form.firstName.value,
                    lastName: form.lastName.value,
                    email: form.email.value,
                    phone: iti.getNumber(), // Still use the formatted number
                    age: age
                };
                console.log('Form submitted successfully:', formData);
                formMainSubmit(e);
            }
        });

        // Real-time validation
        const inputs = form.querySelectorAll('.fff-form-input');
        inputs.forEach(input => {
            input.addEventListener('input', () => {
                hideError(input.id);
            });
        });

// Quiz State Management


const quizState = {
    startTime: null,
    currentQuestion: 1,
    answers: {},
    timeRemaining: 1800, // Changed from 1200 to 1800 (30 minutes in seconds)
    timerInterval: null,
    questions: [],
    loadingQuiz: true,
    quiz_active: false,
    isQuizStart: false,
    questionCounter: 0,
    secondsRemain: 0
};

// Fetch quiz questions via AJAX.
function fetchQuestions(preloadOnly = false) {
    return new Promise((resolve, reject) => {
        var formData = new FormData();
        formData.append('handle', 'get_questions');
        var xhr = new XMLHttpRequest();
        xhr.open('POST', '/wp-admin/admin-ajax.php?action=quiz_ajax', true);
        xhr.onreadystatechange = function () {
            if (this.readyState === 4) {
                if (this.status === 200) {
                    var res = JSON.parse(xhr.responseText);
                    if (res && res.questions && res.time) {
                        console.log(res.questions)
                        quizState.questions = res.questions;
                        quizState.questionCounter = res.questions.length;
                        quizState.loadingQuiz = false;
                        quizState.secondsRemain = res.time;
                        if (!preloadOnly) {
                            startTimer();
                            updateUI();
                        }
                        resolve();
                    } else {
                        reject('Invalid response');
                    }
                } else {
                    reject('Error fetching questions');
                }
            }
        };
        xhr.send(formData);
    });
}

// Load saved state from localStorage.
function loadSavedState() {
    const saved = localStorage.getItem('quizState');
    if (saved) {
        const parsed = JSON.parse(saved);
        Object.assign(quizState, parsed);
        if (quizState.startTime) {
            const elapsed = Math.floor((Date.now() - new Date(quizState.startTime)) / 1000);
            quizState.timeRemaining = Math.max(1800 - elapsed, 0); // Changed from 1200 to 1800
        }
    }
}

// Save quiz state to localStorage.
function saveState() {
    localStorage.setItem('quizState', JSON.stringify(quizState));
}

// Timer Functions.
function startTimer() {
    if (!quizState.startTime) {
        quizState.startTime = new Date().toISOString();
    }
    quizState.timerInterval = setInterval(() => {
        quizState.timeRemaining--;
        updateTimerDisplay();
        saveState();
        if (quizState.timeRemaining <= 0) {
            clearInterval(quizState.timerInterval);
            submitQuiz()
        }
    }, 1000);
}

function stopTimer() {
    clearInterval(quizState.timerInterval);
}

function updateTimerDisplay() {
    const minutes = Math.floor(quizState.timeRemaining / 60);
    const seconds = quizState.timeRemaining % 60;
    document.getElementById('timer').innerHTML = 
        `<svg class="si me-2" fill="currentColor" xmlns="http://www.w3.org/2000/svg" viewBox="0 0 512 512" style="width: 16px; height: 16px; margin-right: 5px;">
            <path d="M464 256A208 208 0 1 1 48 256a208 208 0 1 1 416 0zM0 256a256 256 0 1 0 512 0A256 256 0 1 0 0 256zM232 120V256c0 8 4 15.5 10.7 20l96 64c11 7.4 25.9 4.4 33.3-6.7s4.4-25.9-6.7-33.3L280 243.2V120c0-13.3-10.7-24-24-24s-24 10.7-24 24z"/>
        </svg>${minutes}:${seconds.toString().padStart(2, '0')}`;
}

// Navigation Functions.
function goToQuestion(number) {
    quizState.currentQuestion = number;
    updateUI();
    saveState();
}

function updateNavButtons() {
    document.querySelectorAll('.nav-btn').forEach(btn => {
        const questionNum = parseInt(btn.dataset.question);
        btn.classList.remove('active', 'current', 'answered');
        if (quizState.answers[questionNum] !== undefined) {
            btn.classList.add('answered');
        }
        if (questionNum === quizState.currentQuestion) {
            btn.classList.add('current');
        }
    });
}


function updateUI() {
    const progress = (quizState.currentQuestion / quizState.questions.length) * 100;
    document.getElementById('progress-bar').style.width = `${progress}%`;
    document.getElementById('question-number').textContent = `Question ${quizState.currentQuestion}/${quizState.questions.length}`;
    
    const currentQuestion = quizState.questions[quizState.currentQuestion - 1];
    document.querySelector('.question-text').textContent = currentQuestion.question_text;
    const questionImg = document.getElementById('question-img');
    // questionImg.setAttribute('loading', 'lazy');
    questionImg.src = currentQuestion.question_img;
    
    updateNavButtons();
    
    // Completely reset and update answer buttons
    document.querySelectorAll('.answer-btn').forEach((btn, index) => {
        // Reset button styles
        btn.classList.remove('selected');
        btn.style.backgroundColor = 'white';
        
        // Update images
        btn.querySelector('.option-img').src = currentQuestion.answers[index].answer_img;
        
        // Reapply selected state if an answer was previously saved
        if (quizState.answers[quizState.currentQuestion] === btn.dataset.answer) {
            btn.classList.add('selected');
            btn.style.backgroundColor = '#bfd2ff';
        }
    });
    
    document.getElementById('finish-btn').style.display = quizState.currentQuestion === quizState.questions.length ? 'inline-block' : 'none';
    document.getElementById('next-btn').style.display = quizState.currentQuestion === quizState.questions.length ? 'none' : 'inline-block';

    // Show/hide the Previous button based on the current question
    if (quizState.currentQuestion === 1) {
        document.getElementById('prev-btn').classList.add('hidden');
    } else {
        document.getElementById('prev-btn').classList.remove('hidden');
    }
}

// Modal Functions.
function showModal(config) {
    const modal = document.getElementById('modal-overlay');
    const title = document.getElementById('modal-title');
    const message = document.getElementById('modal-message');
    const primaryBtn = document.getElementById('modal-primary-btn');
    const secondaryBtn = document.getElementById('modal-secondary-btn');
    title.textContent = config.title;
    message.textContent = config.message;
    primaryBtn.textContent = config.primaryBtn;
    secondaryBtn.textContent = config.secondaryBtn;
    primaryBtn.onclick = () => {
        hideModal();
        if (config.primaryAction) config.primaryAction();
    };
    secondaryBtn.onclick = () => {
        hideModal();
        if (config.secondaryAction) config.secondaryAction();
    };
    modal.style.display = 'flex';
}

function hideModal() {
    document.getElementById('modal-overlay').style.display = 'none';
}

function showTimesUpModal() {
    showModal({
        title: "Time's Up!",
        message: "Your time has expired. Your answers will be submitted automatically.",
        primaryBtn: "Submit Answers",
        secondaryBtn: "",
        primaryAction: submitQuiz
    });
}

// Loading Spinner Functions.
function showLoading() {
    document.getElementById('loading-spinner').style.display = 'flex';
}

function hideLoading() {
    document.getElementById('loading-spinner').style.display = 'none';
}

function showQuizBack() {
    document.getElementById('quiz-container').style.boxShadow = 'block';
        document.getElementById('quiz-container').style.padding = '2rem';
        document.getElementById('quiz-container').style.borderRadius = '1rem';
        document.getElementById('quiz-section').style.display = 'block';
        document.getElementById('form-section').style.display = 'none';
        startTimer();
    updateUI();
}

// Quiz Submission.
function submitQuiz() {
    stopTimer();
    showLoading();
    const submissionData = {
        user: 'aryan230',
        submitTime: new Date().toISOString(),
        startTime: quizState.startTime,
        answers: quizState.answers,
        timeRemaining: quizState.timeRemaining
    };
    setTimeout(() => {
        hideLoading();
     document.getElementById('quiz-container').style.boxShadow = 'none';
        document.getElementById('quiz-container').style.padding = 0;
        document.getElementById('quiz-container').style.borderRadius = 0;
        document.getElementById('quiz-section').style.display = 'none';
        document.getElementById('form-section').style.display = 'block';
    }, 2000);
}

// Calculate IQ Score.
function calculateIQScore(rawScore, testDurationSeconds) {
    const baseIQ = 100;
    const scalingFactor = 15;
    const meanScoreConstant = 13;
    const stdDevConstant = 2;
    const optimalTimeSaving = 810; // Changed from 540 to 810 (30 mins - 30%)
    const timeScoreConstant = 0.015;
    let iqScore = baseIQ + (scalingFactor * (rawScore - meanScoreConstant) / stdDevConstant) + ((optimalTimeSaving - testDurationSeconds) * timeScoreConstant);
    iqScore = Math.max(78, Math.min(153, iqScore));
    return iqScore;
}

// Fix the "cannot read undefined (reading 'correct')" error in both calculation functions
function calculateRawScore(answers, questions) {
    let rawScore = 0;
    for (const [questionNumber, optionLetter] of Object.entries(answers)) {
        try {
            const questionIndex = parseInt(questionNumber) - 1;
            if (questionIndex < 0 || questionIndex >= questions.length) continue;
            
            const optionIndex = optionLetter.charCodeAt(0) - 'A'.charCodeAt(0);
            const question = questions[questionIndex];
            
            if (!question || !question.answers) continue;
            if (optionIndex < 0 || optionIndex >= question.answers.length) continue;
            
            const option = question.answers[optionIndex];
            if (option && option.correct === true) { // Explicitly check for true
                rawScore++;
            }
        } catch (error) {
            console.error("Error calculating score for question", questionNumber, error);
            // Continue processing other answers
        }
    }
    return rawScore;
}

function calculateCategoryScores(answers, questions) {
    let categoryScores = {};

    questions.forEach((question, idx) => {
        try {
            // Use the question's category or 'uncategorized'
            let category = question.category || 'uncategorized';
            if (!categoryScores.hasOwnProperty(category)) {
                categoryScores[category] = { correct: 0, total: 0 };
            }
            categoryScores[category].total++;

            // Get user's answer letter (e.g., "A", "B", etc.)
            let userAnswer = answers[idx + 1];
            if (userAnswer) {
                // Determine the option index
                const optionIndex = userAnswer.charCodeAt(0) - 'A'.charCodeAt(0);
                
                // Add safety checks
                if (optionIndex < 0 || !question.answers || optionIndex >= question.answers.length) {
                    return; // Skip this iteration
                }
                
                // Retrieve the corresponding option
                const selectedOption = question.answers[optionIndex];
                if (selectedOption && selectedOption.correct === true) { // Explicit check
                    categoryScores[category].correct++;
                }
            }
        } catch (error) {
            console.error("Error calculating category score", error);
            // Continue processing other questions
        }
    });
    return categoryScores;
    
}


async function submitToCF7(formData) {
    try {
        // Build the CF7 submission payload.
        const cf7FormData = new FormData();
        cf7FormData.append('_wpcf7', '2123');
        cf7FormData.append('_wpcf7_version', '6.0.4'); // Adjust if needed
        cf7FormData.append('_wpcf7_locale', 'en_US');
        // The unit tag may vary – adjust "p" value if necessary.
        cf7FormData.append('_wpcf7_unit_tag', 'wpcf7-f62c202a-p' + document.body.dataset.pageId + '-o1');
        
        // Append only the required fields matching your CF7 configuration.
        cf7FormData.append('firt-name', formData.firstName);
        cf7FormData.append('last-name', formData.lastName);
        cf7FormData.append('email', formData.email);
        cf7FormData.append('phonetext-797', formData.phone);
        cf7FormData.append('age-462', formData.age);
        
        // Send the request to the REST API endpoint for your CF7 form.
        const response = await fetch(`/wp-json/contact-form-7/v1/contact-forms/2123/feedback`, {
            method: 'POST',
            body: cf7FormData
        });
        const result = await response.json();
        console.log('CF7 REST API submission result:', result);
        
        return result.status === 'mail_sent';
    } catch (error) {
        console.error('Error submitting to CF7:', error);
        return false;
    }
}

// Also update the form submission function to handle possible errors
async function formMainSubmit(event) {
    event.preventDefault();
    try {
        const rawScore = calculateRawScore(quizState.answers, quizState.questions);
        const categoryScores = calculateCategoryScores(quizState.answers, quizState.questions);
        console.log('Category Scores:', categoryScores);
        const testDurationSeconds = 1800 - quizState.timeRemaining;
        const totalTime = 1800;
        const iqScore = calculateIQScore(rawScore, testDurationSeconds);
        let speedPercentage = Math.round(100 - ((testDurationSeconds / totalTime) * 100));
        if (speedPercentage < 95) {
            speedPercentage = 95;
        }
        const minutes = Math.floor(testDurationSeconds / 60);
        const seconds = testDurationSeconds % 60;
        const formattedTime = `${minutes.toString().padStart(2, '0')}m:${seconds.toString().padStart(2, '0')}s`;
        const userInfo = {
            firstName: document.getElementById('firstName').value,
            lastName: document.getElementById('lastName').value,
            email: document.getElementById('email').value,
            phone: iti.getNumber(), // Keep the formatted number
            age: document.getElementById('age').value,
            iqScore: iqScore,
            rawScore: rawScore,
            categoryScores: categoryScores, 
            testDurationSeconds: testDurationSeconds,
            speedPercentage: speedPercentage,
            formattedTime: formattedTime
        };
        setCookie('first_name', userInfo.firstName, 7);
        setCookie('last_name', userInfo.lastName, 7);
        setCookie('email', userInfo.email, 7);
        setCookie('phone', userInfo.phone, 7);
        localStorage.setItem('userInfo', JSON.stringify(userInfo));
        document.getElementById('user-info-form').style.display = 'none';
        document.getElementById('result-loader-gif').style.display = 'block';

        await submitToCF7(userInfo);

        
        setTimeout(() => {
            hideLoading();
            window.location.href = '/result/?add-to-cart=107';
        }, 3000);
    } catch (error) {
        console.error("Error during form submission:", error);
        // Fallback in case of error
        window.location.href = '/result/?add-to-cart=107';
    }
}

document.getElementById('phone').addEventListener('input', function(e) {
    let value = e.target.value.replace(/\D/g, '');
    if (value.length > 10) value = value.slice(0, 10);
    e.target.value = value;
});

function setCookie(name, value, days) {
    var expires = "";
    if (days) {
        var date = new Date();
        date.setTime(date.getTime() + (days * 24 * 60 * 60 * 1000));
        expires = "; expires=" + date.toUTCString();
    }
    document.cookie = name + "=" + (value || "") + expires + "; path=/";
}

// On page load, fetch questions and preload the images for the first four questions.
document.addEventListener('DOMContentLoaded', () => {
    fetchQuestions(true);
});

// Start Test Button: When clicked, check if first four questions' images are loaded.
document.getElementById('start-btn').addEventListener('click', () => {
    document.getElementById('welcome-section').style.display = 'none';
    document.getElementById('quiz-section').style.display = 'block';
    
    // If questions aren't loaded yet, fetch them first
    if (quizState.questions.length === 0) {
        fetchQuestions(false).then(() => {
            updateUI();
            startTimer();
        });
    } else {
        updateUI();
        startTimer();
    }
});

document.getElementById('prev-btn').addEventListener('click', () => {
    if (quizState.currentQuestion > 1) {
        goToQuestion(quizState.currentQuestion - 1);
    }
});

document.getElementById('next-btn').addEventListener('click', () => {
    if (quizState.currentQuestion < quizState.questions.length) {
        goToQuestion(quizState.currentQuestion + 1);
    }
});


document.getElementById('finish-btn').addEventListener('click', () => {
    const unanswered = [];
    for (let i = 1; i <= quizState.questions.length; i++) {
        if (!quizState.answers[i]) unanswered.push(i);
    }
    submitQuiz();
    // if (unanswered.length > 0) {
    //     showModal({
    //         title: 'Unanswered Questions',
    //         message: `You have ${unanswered.length} unanswered questions (${unanswered.join(', ')}). Are you sure you want to submit?`,
    //         primaryBtn: 'Submit Anyway',
    //         secondaryBtn: 'Continue Quiz',
    //         primaryAction: submitQuiz
    //     });
    // } else {
    //     showModal({
    //         title: 'Confirm Submission',
    //         message: 'Are you sure you want to submit your quiz?',
    //         primaryBtn: 'Yes, Submit',
    //         secondaryBtn: 'No, Continue',
    //         primaryAction: submitQuiz
    //     });
    // }
});

document.querySelectorAll('.answer-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        // Remove 'selected' class and reset styles for all buttons
        document.querySelectorAll('.answer-btn').forEach(button => {
            button.classList.remove('selected');
            button.style.backgroundColor = 'white';
        });
        
        // Add 'selected' class and blue background to clicked button
        btn.classList.add('selected');
        btn.style.backgroundColor = '#bfd2ff';
        
        // Save the answer
        const answer = btn.dataset.answer;
        quizState.answers[quizState.currentQuestion] = answer;
        
        updateNavButtons();
        saveState();

        // Move to next question if not on last question
        if (quizState.currentQuestion < quizState.questions.length) {
            goToQuestion(quizState.currentQuestion + 1);
        }
    });
});

document.querySelectorAll('.nav-btn').forEach(btn => {
    btn.addEventListener('click', () => {
        goToQuestion(parseInt(btn.dataset.question));
    });
});

document.querySelector('.modal-close').addEventListener('click', hideModal);

document.getElementById('continue-btn').addEventListener('click', () => {
    document.getElementById('refresh-modal').style.display = 'none';
    document.getElementById('quiz-section').style.display = 'block';
    startTimer();
    updateUI();
});

document.getElementById('restart-btn').addEventListener('click', () => {
    localStorage.removeItem('quizState');
    location.reload();
});

document.addEventListener('visibilitychange', () => {
    if (document.hidden) {
        clearInterval(quizState.timerInterval);
    } else {
        startTimer();
    }
});

// Initialize quiz state.
loadSavedState();
if (quizState.startTime) {
    document.getElementById('welcome-section').style.display = 'none';
    if (quizState.timeRemaining > 0) {
        document.getElementById('refresh-modal').style.display = 'flex';
        document.getElementById('restart-btn').textContent = 'Yes';
        document.getElementById('refresh-message').textContent = 'Do you want to restart the test?';
    } else {
        document.getElementById('refresh-modal').style.display = 'flex';
        document.getElementById('refresh-message').textContent = 'Your session has expired. Please restart the quiz.';
        document.getElementById('continue-btn').style.display = 'none';
    }
} else {
    document.getElementById('welcome-section').style.display = 'block';
}

// Function to preload all images for questions and answers
function preloadAllImages(questions) {
    questions.forEach(question => {
        if (question.question_img) {
            const img = new Image();
            img.src = question.question_img;
        }
        if (question.answers && Array.isArray(question.answers)) {
            question.answers.forEach(answer => {
                if (answer.answer_img) {
                    const ansImg = new Image();
                    ansImg.src = answer.answer_img;
                }
            });
        }
    });
}

// On page load, fetch questions and start preloading all images.
document.addEventListener('DOMContentLoaded', () => {
    fetchQuestions(true).then(() => {
        firstFourLoaded = true;
        preloadAllImages(quizState.questions); // Preload all images.
    });
});

// Helper function to preload a single image.
function preloadImage(src) {
    return new Promise((resolve) => {
        if (!src) {
            resolve();
            return;
        }
        const img = new Image();
        img.onload = resolve;
        img.onerror = resolve;
        img.src = src;
    });
}

// Preload images sequentially for each question and its options.
async function preloadImagesSequentially(questions) {
    for (const question of questions) {
        // Preload the question image.
        await preloadImage(question.question_img);
        // Preload each answer image in the question.
        if (question.answers && Array.isArray(question.answers)) {
            for (const answer of question.answers) {
                await preloadImage(answer.answer_img);
            }
        }
    }
}

// On page load, fetch questions and preload images sequentially.
document.addEventListener('DOMContentLoaded', () => {
    fetchQuestions(true).then(() => {
        firstFourLoaded = true;
        preloadImagesSequentially(quizState.questions);
    });
});

document.addEventListener('DOMContentLoaded', function() {
    if ('connection' in navigator && navigator.connection.effectiveType) {
        const slowConnections = ['slow-2g', '2g', '3g'];
        if (slowConnections.includes(navigator.connection.effectiveType)) {
            const resultLoader = document.getElementById('result-loader-gif');
            if (resultLoader) {
                // Remove the source of the GIF so it isn't loaded.
                const loaderImg = resultLoader.querySelector('img');
                if (loaderImg) {
                    loaderImg.removeAttribute('src');
                }
                // Optionally, display an alternative lightweight message/spinner.
                resultLoader.innerHTML = '<div class="spinner"></div><p>Submitting your answers...</p>';
            }
        }
    }
});
</script>

<?php
if (astra_page_layout() == 'right-sidebar') {
    get_sidebar();
}
get_footer();
?>
