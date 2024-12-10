<!DOCTYPE html>
<html lang="fr">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Cours - Centre Équestre</title>
    <link rel="stylesheet" href="../../css/style-front.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src='https://cdn.jsdelivr.net/npm/fullcalendar@6.1.10/index.global.min.js'></script>
    <script src='https://cdn.jsdelivr.net/npm/@fullcalendar/core@6.1.10/locales/fr.global.min.js'></script>
    <script src="../../js/script-front.js"></script>
</head>
<body>
    <header>
        <div class="container">
            <a href="../../index.html"><img src="../../pages-front/images-front/93863d47-8a92-4b31-b3c8-8f9891f6792a-removebg-preview.png" alt="Logo du Centre Équestre" class="logo"></a>
            <nav>
                <ul>
                    <li><a href="../../index.html" ><i class="fas fa-home"></i> Accueil</a></li>
                    <li><a href="../info/info.html" ><i class="fas fa-info-circle"></i> Info</a></li>
                    <li><a href="../services/services.html" ><i class="fas fa-cogs"></i> Services</a></li>
                    <li><a href="../inscription/inscription.html" ><i class="fas fa-envelope"></i> S'inscrire</a></li>
                    <li><a href="../cavalerie/cavalerie.php" ><i class="fas fa-horse-head"></i> Nos chevaux</a></li>
                    <li><a href="../evenements/evenements.php" ><i class="fas fa-calendar-alt"></i> Évènements</a></li>
                    <li><a href="/cours.php" ><i class="fas fa-chalkboard-teacher"></i> Cours</a></li>
                </ul>
            </nav>
        </div>
    </header>

    <main>
        <section class="calendar-section">
            <h2>Calendrier des Cours</h2>
            <div id="calendar"></div>
        </section>

        <?php
        require_once '../../includes/bdd.inc.php';
        require_once '../../pages/cours/cours.class.php';

        $oCours = new Cours(null, null, null, null, null);
        $cours = $oCours->selectCours();

        $events = array();
        foreach ($cours as $c) {
            $events[] = array(
                'title' => $c->getLibCours(),
                'start' => $c->getHoraireDebut(),
                'end' => $c->getHoraireFin()
            );
        }
        ?>

        <script>
            document.addEventListener('DOMContentLoaded', function() {
                var calendarEl = document.getElementById('calendar');
                var calendar = new FullCalendar.Calendar(calendarEl, {
                    initialView: 'timeGridWeek',
                    locale: 'fr',
                    headerToolbar: {
                        left: 'prev,next today',
                        center: 'title',
                        right: 'dayGridMonth,timeGridWeek,timeGridDay'
                    },
                    slotMinTime: '08:00:00',
                    slotMaxTime: '20:00:00',
                    events: <?php echo json_encode($events); ?>,
                    eventColor: '#3788d8',
                    height: 'auto',
                    allDaySlot: false,
                    slotDuration: '00:30:00',
                    businessHours: {
                        daysOfWeek: [ 1, 2, 3, 4, 5, 6 ],
                        startTime: '08:00',
                        endTime: '20:00',
                    }
                });
                calendar.render();
            });
        </script>

        <style>
            .calendar-section {
                padding: 2rem;
                margin: 2rem auto;
                max-width: 1200px;
            }
            
            #calendar {
                background: white;
                padding: 20px;
                border-radius: 8px;
                box-shadow: 0 0 10px rgba(0,0,0,0.1);
            }

            .fc-event {
                cursor: pointer;
                padding: 2px 4px;
            }

            .fc-toolbar-title {
                font-size: 1.5em !important;
                font-weight: bold;
            }

            .fc-button {
                background-color: #4CAF50 !important;
                border-color: #4CAF50 !important;
            }

            .fc-button:hover {
                background-color: #45a049 !important;
                border-color: #45a049 !important;
            }
        </style>
    </main>

    <!-- Footer -->
    <footer>
        <div class="container">
            <p>
                <span>Email :</span> contact@centreequestre.com | 
                <span>Téléphone :</span> 01 23 45 67 89
            </p>
            <div class="separator"></div>
            <p class="copyright">
                &copy; 2024 Centre Équestre. Tous droits réservés.
            </p>
        </div>
    </footer>

    <button class="scroll-to-top" id="scroll-to-top">
        <i class="fas fa-arrow-up"></i> <!-- Utilisation d'une icône Font Awesome -->
    </button>

</body>
</html>
