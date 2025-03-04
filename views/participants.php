<?php
require_once('../models/database.php');
require_once('../models/Participant.php');
require_once('../controllers/ParticipantController.php');

$controller = new Controllers\ParticipantController($conn);

$participants = $controller->show_all_participants();
?>

<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>All Participants</title>
    <link rel="stylesheet" href="../src/assets/css/styles.css" type="text/css">
</head>
<body>

    <div class="participants__container">
        <h1 class="participants__title">Participants List</h1>
        
        <div class="participants-table__container">
            <table>
                <thead>
                    <tr>
                        <th>Full Name</th>
                        <th>Birthdate</th>
                        <th>Report Subject</th>
                        <th>Country</th>
                        <th>Phone</th>
                        <th>Email</th>
                        <th>Company</th>
                        <th>Position</th>
                        <th>About</th>
                        <th>Photo</th>
                    </tr>
                </thead>
                <tbody>
                    <?php if (empty($participants)): ?>
                        <tr><td colspan="10">No participants found.</td></tr>
                    <?php else: ?>
                        <?php foreach ($participants as $participant): ?>
                            <tr>
                                <td><?= htmlspecialchars($participant['full_name']) ?></td> 
                                <td><?= htmlspecialchars($participant['birthdate']) ?></td>
                                <td><?= htmlspecialchars($participant['report_subject']) ?></td>
                                <td><?= htmlspecialchars($participant['country']) ?></td>
                                <td><?= htmlspecialchars($participant['phone']) ?></td>
                                <td><a href="mailto:<?= htmlspecialchars($participant['email']) ?>"><?= htmlspecialchars($participant['email']) ?></a></td>
                                <td><?= htmlspecialchars($participant['company']) ?></td>
                                <td><?= htmlspecialchars($participant['position']) ?></td>
                                <td><?= htmlspecialchars($participant['about']) ?></td>
                                <td>
                                    <?php if (!empty($participant['photo'])): ?>
                                        <img src="../<?= htmlspecialchars($participant['photo']) ?>" alt="Participant photo">
                                    <?php else: ?>
                                        <span>No photo</span>
                                    <?php endif; ?>
                                </td>
                            </tr>
                        <?php endforeach; ?>
                    <?php endif; ?>
                </tbody>
            </table>
        </div>
    </div>

</body>
</html>