<?php
session_start();
require_once('models/database.php');
require_once('models/Participant.php');
require_once('controllers/ParticipantController.php');
require_once('config.php');

ini_set('log_errors', '1');
ini_set('error_log', 'logs.log');

$errors = [];
$response = [];
$post_data = [
    'first_name'     => $_POST['first-name__input'] ?? '',
    'last_name'      => $_POST['last-name__input'] ?? '',
    'birthdate'      => $_POST['date__input'] ?? '',
    'report_subject' => $_POST['report-subject__input'] ?? '',
    'country'        => $_POST['country__input'] ?? '',
    'phone'          => $_POST['phone__input'] ?? '',
    'email'          => $_POST['email__input'] ?? '',
    'company'        => $_POST['company__input'] ?? '',
    'position'       => $_POST['position__input'] ?? '',
    'about'          => $_POST['about__input'] ?? '',
    'photo'          => $_FILES['photo__input']['name'] ?? ''
];

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $controller = new Controllers\ParticipantController($conn);
    $controller->store($post_data);
    exit;
}

?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Fill this form</title>
    <link rel="stylesheet" href="src/assets/css/styles.css" type="text/css">
    <script src="https://kit.fontawesome.com/4703f4607d.js" defer crossorigin="anonymous"></script>
    <script src="src/assets/js/tabs_form.js" defer></script>
    <script src="src/assets/js/get_countries.js" defer></script>
    <script src="src/assets/js/number_validate.js" defer></script>
    <script src="src/assets/js/popup.js" defer></script>
</head>
<body>
    <div class="page">
        <p class="google__map">
            <iframe src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d3303.761550164158!2d-118.34625852376647!3d34.10124851514021!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x80c2bf20e4c82873%3A0x14015754d926dadb!2s7060%20Hollywood%20Blvd%2C%20Los%20Angeles%2C%20CA%2090028%2C%20USA!5e0!3m2!1sen!2sua!4v1740995988251!5m2!1sen!2sua" width="1920" height="450" style="border:0;" allowfullscreen="" loading="lazy" referrerpolicy="no-referrer-when-downgrade"></iframe>
        </p>
        <div class="page__content">
            <h1 class="form__title">
                To participate in the conference, please fill out the form
            </h1>

            <form action="index.php" method="POST" class="form" enctype="multipart/form-data">
                <input type="hidden" id="serverError" name="serverError" value="">
                <section id="general__section" class="tab">
                    <div class="form__field">
                        <label>First name</label>
                        <input name='first-name__input' type="text" required value="<?= htmlspecialchars($post_data['first_name']) ?>">
                    </div>

                    <div class="form__field">
                        <label>Last name</label>
                        <input name='last-name__input' type="text" required value="<?= htmlspecialchars($post_data['last_name']) ?>">
                    </div>

                    <div class="form__field">
                        <label>Birthdate</label>
                        <input type="date" name="date__input" value="2024-03-03" required value="<?= htmlspecialchars($post_data['birthdate']) ?>">
                    </div>

                    <div class="form__field">
                        <label>Report Subject</label>
                        <input name='report-subject__input' type="text" required value="<?= htmlspecialchars($post_data['report_subject']) ?>">
                    </div>

                    <div class="form__field">
                        <label>Country</label>
                        <select name="country__input" id="countrySelect" required>
                            <option value="">Select a country</option>
                        </select>
                    </div>

                    <div class="form__field">
                        <label>Phone</label>
                        <input name='phone__input' type="tel" required value="<?= htmlspecialchars($post_data['phone']) ?>">
                    </div>

                    <div class="form__field">
                        <label>Email</label>
                        <input name='email__input' type="email" required value="<?= htmlspecialchars($post_data['email']) ?>">
                    </div>

                </section>

                <section id="work__section" class="tab">
                    <div class="form__field">
                        <label>Company</label>
                        <input name='company__input' type="text" value="<?= htmlspecialchars($post_data['company']) ?>">
                    </div>

                    <div class="form__field">
                        <label>Position</label>
                        <input name='position__input' type="text" value="<?= htmlspecialchars($post_data['position']) ?>">
                    </div>

                    <div class="form__field">
                        <label>About me</label>
                        <textarea name="about__input"><?= htmlspecialchars($post_data['about']) ?></textarea>
                    </div>

                    <div class="form__field">
                        <label>Photo</label>
                        <input name='photo__input' type="file" accept="image/png, image/jpeg">
                    </div>
                </section>
                <button type="button" id="nextBtn" onclick="nextPrev(1)">Next</button>
            </form>

            <section id="share__section" class="tab">
            <div class="social__links">
                <i class="fa-brands fa-facebook-f cursor-pointer" onclick="openPopup()"></i>
                <i class="fa-brands fa-x-twitter cursor-pointer" onclick="openPopup()"></i>
            </div>

            <div id="overlay" class="overlay hidden"></div>

            <div id="popup" class="popup hidden">
                <div class="popup-content">
                    <textarea id="popup-text" class="popup-text" readonly><?php echo POPUP_TEXT; ?></textarea>
                    <button id="copy-btn" class="copy-btn">Copy</button>
                </div>
            </div>
                <a href="views/participants.php" class="all-members__link">All members (178).</a>
            </section>        
        </div>
    </div>
</body>
</html>
