<?php 
include 'conn.php';
use PHPMailer\PHPMailer\PHPMailer;
use PHPMailer\PHPMailer\Exception;

require 'vendor/autoload.php'; // Certifique-se de ter o PHPMailer instalado via Composer

$message_status = ''; // Variável para armazenar o status da mensagem

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $name = $_POST['name'];
    $email = $_POST['email'];
    $contacto = $_POST['contacto'];
    $message = $_POST['message'];
    $data = $_POST['data']; // Captura a data fornecida pelo usuário

    // Evitar SQL Injection
    $name = $conn->real_escape_string($name);
    $email = $conn->real_escape_string($email);
    $contacto = $conn->real_escape_string($contacto);
    $message = $conn->real_escape_string($message);
    $data = $conn->real_escape_string($data); // Escapar a data

    // Inserir no banco de dados com a data
    $sql = "INSERT INTO messagesss (name, email, contacto, message, data) VALUES ('$name', '$email', '$contacto', '$message', '$data')";

    if ($conn->query($sql) === TRUE) {
        $message_status = "Message envoyé avec succès!";

        // Enviar e-mail usando PHPMailer
        $mail = new PHPMailer(true);
        try {
            // Configuração do servidor SMTP
            $mail->isSMTP();
            $mail->Host = 'smtp.gmail.com';  // Servidor SMTP do Gmail
            $mail->SMTPAuth = true;
            $mail->Username = 'site01504@gmail.com';  // Seu e-mail completo
            $mail->Password = 'olom ssct ybfa peuq';  // Senha de aplicativo gerada pelo Google
            $mail->SMTPSecure = PHPMailer::ENCRYPTION_SMTPS;
            $mail->Port = 465;  // Porta SMTP para TLS
        
            // Definindo remetente e destinatário
            $mail->setFrom('site01504@gmail.com', 'Edorganization');
            $mail->addAddress('edorganisation0@gmail.com', 'Admin');  // Destinatário
        
            // Corpo do e-mail
            $mail->isHTML(true);
            $mail->Subject = 'Nouveau message envoye via formulaire';
            $mail->Body    = "
                <h2>Nouveau message reçu</h2>
                <p><strong>Nom:</strong> $name</p>
                <p><strong>E-mail:</strong> $email</p>
                <p><strong>Contact:</strong> $contacto</p>
                <p><strong>Message:</strong> $message</p>
                <p><strong>Date:</strong> $data</p>
            ";
        
            // Enviar o e-mail
            $mail->send();
            echo 'Message envoyé avec succès !';
        } catch (Exception $e) {
            echo "Mensagem não pode ser enviada. Erro: {$mail->ErrorInfo}";
        }
      }   

    $conn->close();
}
?>


<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="utf-8">
  <meta content="width=device-width, initial-scale=1.0" name="viewport">
  <title>Ed Organisation</title>
  <meta name="description" content="">
  <meta name="keywords" content="">

  <!-- Favicons -->
  <link href="assets/img/logo.jpg" rel="icon">
  <link href="assets/img/apple-touch-icon.png" rel="apple-touch-icon">

  <!-- Fonts -->
  <link href="https://fonts.googleapis.com" rel="preconnect">
  <link href="https://fonts.gstatic.com" rel="preconnect" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=Roboto:ital,wght@0,100;0,300;0,400;0,500;0,700;0,900;1,100;1,300;1,400;1,500;1,700;1,900&family=Poppins:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&family=Raleway:ital,wght@0,100;0,200;0,300;0,400;0,500;0,600;0,700;0,800;0,900;1,100;1,200;1,300;1,400;1,500;1,600;1,700;1,800;1,900&display=swap" rel="stylesheet">

  <!-- Vendor CSS Files -->
  <link href="assets/vendor/bootstrap/css/bootstrap.min.css" rel="stylesheet">
  <link href="assets/vendor/bootstrap-icons/bootstrap-icons.css" rel="stylesheet">
  <link href="assets/vendor/aos/aos.css" rel="stylesheet">
  <link href="assets/vendor/glightbox/css/glightbox.min.css" rel="stylesheet">
  <link href="assets/vendor/swiper/swiper-bundle.min.css" rel="stylesheet">

  <!-- Main CSS File -->
  <link href="assets/css/main.css" rel="stylesheet">


<body class="index-page">

  <header id="header" class="header d-flex align-items-center fixed-top">
    <div class="container-fluid container-xl position-relative d-flex align-items-center justify-content-between">

      <a href="index.html" class="logo d-flex align-items-center">
        <img src="assets/img/logo.png" alt="Logo" class="logo-img"> <!-- Logo ao lado -->
        <h1 class="sitename">Ed Organisation</h1>
      </a>
      
      <nav id="navmenu" class="navmenu">
        <ul>
          <li><a href="index.html" >Accéder</a></li>
          <li><a href="Departamentos.html">Départements</a></li>
          <li><a href="Atividades.html">Activités</a></li>
          <li><a href="contacto.php" class="active">Contact</a></li>

        </ul>
        <i class="mobile-nav-toggle d-xl-none bi bi-list"></i>
      </nav>

    </div>
  </header>

  <main class="main">

    <!-- Page Title -->
    <div class="page-title dark-background">
      <div class="container position-relative">
        <h1>Contact rapide</h1>
        <p></p>
        <nav class="breadcrumbs">
          <ol>
            <li><a href="index.html">Accéder</a></li>
            <li class="current">Contact</li>
          </ol>
        </nav>
      </div>
    </div><!-- End Page Title -->

    <!-- Contact Section -->
    <section id="contact" class="contact section">

      <div class="container" data-aos="fade-up" data-aos-delay="100">

        <div class="row gy-4">
          <div class="col-lg-6 ">
            <div class="row gy-4">

              <div class="col-lg-12">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="200">
                  <i class="bi bi-geo-alt"></i>
                  <h3>Emplacement</h3>
                  <p>115, AV Mutakato, Mabanga Sud, Goma.</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="300">
                  <i class="bi bi-telephone"></i>
                  <h3>Appel </h3>
                  <p>(+243) 824 004 960 <br> (+243) 994 309 091</p>
                </div>
              </div><!-- End Info Item -->

              <div class="col-md-6">
                <div class="info-item d-flex flex-column justify-content-center align-items-center" data-aos="fade-up" data-aos-delay="400">
                  <i class="bi bi-envelope"></i>
                  <h3>E-mail </h3>
                  <p>edorganisation22@gmail.com</p>
                </div>
              </div><!-- End Info Item -->

            </div>
          </div>
          
       <!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Styled Contact Form</title>
    <style>
        body {
            font-family: Arial, sans-serif;
            margin: 0;
            padding: 0;
            background-color: #f9f9f9;
        }

        /* Form Styles */
        form {
            background: #fff;
            padding: 20px;
            border-radius: 8px;
            box-shadow: 0 0 10px rgba(0, 0, 0, 0.1);
            margin: 20px auto;
            max-width: 600px;
        }

        /* Navbar Styles Inside Form */
        .form-navbar {
            background-color: #fff;
            padding: 15px;
            border-radius: 8px 8px 0 0;
            box-shadow: 0 2px 5px rgba(0, 0, 0, 0.1);
            margin-bottom: 20px;
            text-align: center;
        }

        .form-navbar h1 {
            margin: 0;
            font-size: 20px;
            font-weight: bold;
            color: #333;
        }

        .row {
            display: flex;
            flex-wrap: wrap;
            gap: 15px;
        }

        .col-md-6,
        .col-md-12 {
            flex: 1 1 100%;
        }

        .col-md-6 {
            max-width: 48%;
        }

        input, textarea {
            width: 100%;
            padding: 10px;
            border: 1px solid #ddd;
            border-radius: 4px;
            font-size: 16px;
        }

        textarea {
            resize: none;
        }

        /* Button Styles */
        button {
            background-color: #007bff;
            color: white;
            border: none;
            padding: 12px 20px;
            font-size: 16px;
            font-weight: bold;
            border-radius: 5px;
            cursor: pointer;
            transition: background-color 0.3s ease;
            width: 100%;
        }

        button:hover {
            background-color: #0056b3;
        }

        button:active {
            background-color: #004085;
        }
    </style>
<head>
    <!-- (Cabeçalho com links CSS e JS, se necessário) -->
</head>
<body>
  <?php if (!empty($message_status)): ?>
  <script>
      alert("<?php echo $message_status; ?>");
  </script>
<?php endif; ?>
    <form 
        id="styled-contact-form" 
        data-aos="fade-up" 
        data-aos-delay="500" 
        action="" 
        method="POST" style="width: 100%; max-width: 600px; margin: auto;">
        <div class="row gy-4">
            <div class="col-md-6">
               <input 
                    type="text" 
                    id="name" 
                    name="name" 
                    class="form-control" 
                    placeholder="Votre nom" 
                    required>
            </div>
            <div class="col-md-6">
                <input 
                    type="email" 
                    id="email" 
                    name="email" 
                    class="form-control" 
                    placeholder="Votre email" 
                    required>
            </div>
            <div class="col-md-6">
                <input 
                    type="tel" 
                    id="contacto" 
                    name="contacto" 
                    class="form-control" 
                    placeholder="numéro de téléphone" 
                    required>
            </div>
            <div class="col-md-6">
                <input 
                    type="date" 
                    id="data" 
                    name="data" 
                    class="form-control" 
                    required>
            </div>
            <div class="col-md-12">
                <textarea 
                    id="message" 
                    name="message" 
                    class="form-control" 
                    rows="4" 
                    placeholder="Message" 
                    required></textarea>
            </div>
            <div class="col-md-12 text-center">
                <button type="submit">Envoyer le Message</button>
            </div>
        </div>
    </form>
</body>
</html>


        </div>

      </div>

      <div class="mt-5" data-aos="fade-up" data-aos-delay="200">
        <iframe 
    style="border:0; width: 100%; height: 370px;" 
    src="https://www.google.com/maps/embed?pb=!1m18!1m12!1m3!1d13777.887574935433!2d29.3116375!3d-1.6005809!2m3!1f0!2f0!3f0!3m2!1i1024!2i768!4f13.1!3m3!1m2!1s0x19dd082176c8c7ad%3A0x6d4e6a6495dba6f0!2s115%2C%20AV%20Mutakato%2C%20Mabanga%20Sud%2C%20Karisimbi%2C%20Goma%20Nord-kivu.!5e0!3m2!1sen!2smz!4v1694965009612!5m2!1sen!2smz" 
    frameborder="0" 
    allowfullscreen="" 
    loading="lazy" 
    referrerpolicy="no-referrer-when-downgrade">
</iframe>

      </div><!-- End Google Maps -->

    </section><!-- /Contact Section -->

  </main>

  <footer id="footer" class="footer dark-background">

    

    <div class="container footer-top">
      <div class="row gy-4">
        <div class="col-lg-4 col-md-6 footer-about">
          <a href="index.html" class="d-flex align-items-center">
            <p>Ed Organisation</p>
          </a>
          <div class="footer-contact pt-3">
            <p>115, AV Mutakato, Mabanga Sud, <br>Karisimbi, Goma Nord-kivu.</p>
            <p class="mt-3"><strong>contacts:</strong> <br> <span>(+243) 824 004 960 <br> (+243) 994 309 091
      </span></p>
            <p><strong>Email:</strong> <span>edorganisation22@gmail.com</span></p>
          </div>
        </div>

        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Liens utiles</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="index.html">Accéder</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="departamentos.html">Départements</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="atividades.html"> Activités</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="contacto.php">Contact</a></li>
          </ul>
        </div>
             
      
        <div class="col-lg-2 col-md-3 footer-links">
          <h4>Départements</h4>
          <ul>
            <li><i class="bi bi-chevron-right"></i> <a href="departamentos.html">Ed santé</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="departamentos.html">Ed sociale</a></li>
            <li><i class="bi bi-chevron-right"></i> <a href="departamentos.html">Ed Ministère</a></li>
       
          </ul>
        </div>

        

        <div class="col-lg-4 col-md-12">
          <h4>Réseaux sociaux</h4>
          <p>Contactez-nous via nos réseaux sociaux</p>
          <div class="social-links d-flex">
            <a href="https://x.com/EOrganisat36377"><i class="bi bi-twitter-x"></i></a>
            <a href="https://web.facebook.com/profile.php?id=61569124952221"><i class="bi bi-facebook"></i></a>
            <a href="https://www.instagram.com/orga.nisationed?igsh=YzljYTK10Dg3Zg=="><i class="bi bi-instagram"></i></a>
            <a href="https://www.linkedin.com/in/ed-organisation-6450b333a/"><i class="bi bi-linkedin"></i></a>
          </div>
        </div>

      </div>
    </div>

    <div class="container copyright text-center mt-4">
      <p>© <span>Copyright 2024 Ed Organisation</span><strong class="px-1 sitename"></strong><span>Tous droits réservés</span></p>
      <div class="credits">
        Conçu par <p>Ed Organisation</p>
      </div>
    </div>

  </footer>

  <!-- Scroll Top -->
  <a href="#" id="scroll-top" class="scroll-top d-flex align-items-center justify-content-center"><i class="bi bi-arrow-up-short"></i></a>

  <!-- Preloader -->
  <div id="preloader"></div>

  <!-- Vendor JS Files -->
  <script src="assets/vendor/bootstrap/js/bootstrap.bundle.min.js"></script>
  <script src="assets/vendor/php-email-form/validate.js"></script>
  <script src="assets/vendor/aos/aos.js"></script>
  <script src="assets/vendor/glightbox/js/glightbox.min.js"></script>
  <script src="assets/vendor/purecounter/purecounter_vanilla.js"></script>
  <script src="assets/vendor/swiper/swiper-bundle.min.js"></script>
  <script src="assets/vendor/waypoints/noframework.waypoints.js"></script>
  <script src="assets/vendor/imagesloaded/imagesloaded.pkgd.min.js"></script>
  <script src="assets/vendor/isotope-layout/isotope.pkgd.min.js"></script>

  <!-- Main JS File -->
  <script src="assets/js/main.js"></script>

</body>

</html>