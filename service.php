<?php
    // include files
    require_once './configuration/database.php';
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0" />
  <title>Our services</title>
  <link href="https://fonts.googleapis.com/css2?family=Playfair+Display:wght@400;700&family=DM+Sans:wght@300;400;500&display=swap" rel="stylesheet" />
  <link rel="stylesheet" href="<?= site_url ?>css/style.css">
</head>
  <body>
    <div class="header">
        <div class="logo">Ema4kids</div>
        <div class="nav">
            <div id="side" class="hide"><ion-icon name="close-outline"></ion-icon></div>
            <a href="<?= site_url ?>index.php">Home</a>
            <a href="<?= site_url ?>about.php">About</a>
            <a href="<?= site_url ?>service.php">Our services</a>
            <a href="<?= site_url ?>blog/blog.php">Blog</a>
            <a href="<?= site_url ?>donate.php">Donate</a>
            <a href="mailto:ema4kids@gmail.com">Contact us</a>
            <!--Control login links-->
            <?php if (isset($_SESSION['uuid'])) : ?>
                <?php if (isset($_SESSION['is_admin']) && $_SESSION['is_admin'] === true) : ?>
                    <a href="<?= site_url ?>admin/dashboard.php">Dashboard</a>
                <?php else : ?>
                    <a href="<?= site_url ?>user/dashboard.php">Dashboard</a>
                <?php endif; ?>
            <?php else : ?>
                <a href="<?= site_url ?>authentication/signin_navigate.php">sign in</a>
            <?php endif; ?>
        </div>
        <div id="side" class="show"><ion-icon name="menu-outline"></ion-icon></div>
    </div>
    <div class="ps-hero">
        <div class="ps-hero-tag">Programs and Services</div>
        <div class="ps-hero-title">Holistic support for the whole youth</div>
        <div class="ps-hero-sub">
            A range of integrated programs and services addressing the physical, emotional, educational, and social needs of 
            every young person we serve.
        </div>
    </div>

    <div class="stats-row">
      <div class="stat-card scroll_animation_slide_right" style="--i: 0;">
          <div class="stat-num">5</div>
          <div class="stat-label">Core programs and services</div>
      </div>
      <div class="stat-card scroll_animation_slide_right" style="--i: 1;">
          <div class="stat-num">15-29</div>
          <div class="stat-label">Age range served</div>
      </div>
      <div class="stat-card scroll_animation_slide_right" style="--i: 2;">
          <div class="stat-num">5+</div>
          <div class="stat-label">Countries of impact</div>
      </div>
    </div>
    <div class="legend scroll_animation_fade" style="--i: 0;">
        <div class="legend-item">
            <span class="legend-badge badge-p">P</span> 
            Ongoing organized program
        </div>
        <div class="legend-item">
            <span class="legend-badge badge-s">S</span> 
            Direct service or offering
        </div>
        <div class="legend-item">
            <span class="legend-badge badge-ps">P+S</span> 
            Both
        </div>
    </div>

    <!-- Education -->
    <div class="program-card scroll_animation_fade" style="--i: 0;">
        <div class="card-accent accent-edu"></div>
        <div class="card-top">
            <div class="card-title">
                Education Scholarship Program
            </div>
            <div class="card-badges">
                <span class="legend-badge badge-p">P</span>
                <span class="legend-badge badge-s">S</span>
            </div>
        </div>
        <div class="card-desc">
            Full or partial scholarships and skills training for orphaned and vulnerable youth, removing every barrier to 
            uninterrupted access to quality education.
        </div>
        <div class="card-services">
            <div class="service-item">
                <div class="service-dot"></div>
                <div class="service-text"><strong>School fees</strong>: registration fees and all related expenses</div>
            </div>
            <div class="service-item">
                <div class="service-dot"></div>
                <div class="service-text"><strong>Uniforms and books</strong>: ensuring students are fully equipped</div>
            </div>
            <div class="service-item"><div class="service-dot"></div><div class="service-text"><strong>Transportation</strong>: so distance is never a barrier to attendance</div></div>
            <div class="service-item"><div class="service-dot"></div><div class="service-text"><strong>Skills acquisition training</strong>: vocational and tertiary-level pathways</div></div>
        </div>
    </div>

    <!-- Mentorship -->
    <div class="program-card scroll_animation_fade" style="--i: 0;">
      <div class="card-accent accent-mentor"></div>
      <div class="card-top">
        <div class="card-title">Mentorship and Empowerment</div>
        <div class="card-badges">
          <span class="legend-badge badge-p">P</span>
          <span class="legend-badge badge-s">S</span>
        </div>
      </div>
      <div class="card-desc">Life skills training and one-on-one mentorship to build confidence, resilience, and critical thinking in youth navigating unstable environments.</div>
      <div class="card-services">
        <div class="service-item"><div class="service-dot" style="background:#378ADD;"></div><div class="service-text"><strong>Building a Future Training</strong>: Leadership, Self-Reliance, and Financial Empowerment</div></div>
        <div class="service-item"><div class="service-dot" style="background:#378ADD;"></div><div class="service-text"><strong>Daily Security Awareness</strong>: practical personal safety skills</div></div>
        <div class="service-item"><div class="service-dot" style="background:#378ADD;"></div><div class="service-text"><strong>Social Media Best Practices</strong>: digital literacy and online safety</div></div>
        <div class="service-item"><div class="service-dot" style="background:#378ADD;"></div><div class="service-text"><strong>Malpractice Awareness and Prevention</strong>: ethical decision-making in professional and academic life</div></div>
      </div>
    </div>

    <!-- Shelter & Feeding -->
    <div class="program-card scroll_animation_fade" style="--i: 0;">
      <div class="card-accent accent-shelter"></div>
      <div class="card-top">
        <div class="card-title">Shelter and Feeding Program</div>
        <div class="card-badges">
          <span class="legend-badge badge-p">P</span>
          <span class="legend-badge badge-s">S</span>
        </div>
      </div>
      <div class="card-desc">Ensuring orphaned and vulnerable youth have access to safety, meals, and supportive care the foundational needs that make learning and growth possible.</div>
      <div class="card-services">
        <div class="service-item"><div class="service-dot" style="background:#BA7517;"></div><div class="service-text"><strong>Annual shelter stipends</strong>: stable housing support for qualifying youth</div></div>
        <div class="service-item"><div class="service-dot" style="background:#BA7517;"></div><div class="service-text"><strong>Monthly feeding stipends</strong>: consistent nutritional support</div></div>
        <div class="service-item"><div class="service-dot" style="background:#BA7517;"></div><div class="service-text"><strong>Supportive care</strong>: wraparound support for physical and emotional well-being</div></div>
      </div>
    </div>

    <!-- Anti-Trafficking -->
    <div class="program-card scroll_animation_fade" style="--i: 0;">
      <div class="card-accent accent-anti"></div>
      <div class="card-top">
        <div class="card-title">Anti-Trafficking and Violent Extremism Awareness and Advocacy</div>
        <div class="card-badges">
          <span class="legend-badge badge-p">P</span>
          <span class="legend-badge badge-s">S</span>
        </div>
      </div>
      <div class="card-desc">Community outreach and advocacy to protect young people from trafficking and radicalization empowering local leaders and communities to respond.</div>
      <div class="card-services">
        <div class="service-item"><div class="service-dot" style="background:#D85A30;"></div><div class="service-text"><strong>Educational campaigns</strong>: raising awareness on human trafficking and violent extremism</div></div>
        <div class="service-item"><div class="service-dot" style="background:#D85A30;"></div><div class="service-text"><strong>Rights advocacy</strong>: amplifying and protecting young people's rights</div></div>
        <div class="service-item"><div class="service-dot" style="background:#D85A30;"></div><div class="service-text"><strong>Local leader training</strong>: equipping community leaders to recognize and report exploitation</div></div>
      </div>
    </div>

    <!-- Trauma -->
    <div class="program-card scroll_animation_fade" style="--i: 0;"> 
        <div class="card-accent accent-trauma"></div>
        <div class="card-top">
          <div class="card-title">Trauma Awareness and Resilience Training</div>
          <div class="card-badges">
            <span class="legend-badge badge-s">S</span>
          </div>
        </div>
        <div class="card-desc">Educating scholarship recipients on the nature of trauma and providing proven strategies to strengthen coping, recovery, and long-term resilience.</div>
        <div class="card-services">
          <div class="service-item"><div class="service-dot" style="background:#7F77DD;"></div><div class="service-text"><strong>Trauma education</strong>: what trauma is, how it affects the brain, body, behavior, and relationships</div></div>
          <div class="service-item"><div class="service-dot" style="background:#7F77DD;"></div><div class="service-text"><strong>Coping skills and strategies</strong>: tools to process adversity and recover from traumatic experiences</div></div>
          <div class="service-item"><div class="service-dot" style="background:#7F77DD;"></div><div class="service-text"><strong>Protective factors</strong>: building supportive relationships, emotional regulation, and positive coping mechanisms</div></div>
        </div>
    </div>
    <div class="footer scroll_animation_fade" id="footer" style="--i: 0;">
        <div class="col">
            <a href="<?= site_url ?>gallery.php">Gallery</a>
            <a href="<?= site_url ?>team.php">Meet our team</a>
            <a href="<?= site_url ?>ema4kids_scholars.php">Our scholarship recipients</a>
            <a href="" onclick="alert('URL unavailable')">Privacy Policy</a>
            <a href="" onclick="alert('URL unavailable')">Terms & conditions</a>
            <a href="<?= site_url ?>partner.php">Ema4kids partners</a>
        </div>
        <div class="col">
            <h3>Contact us @</h3>
            <a href="mailto:ema4kids@gmail.com">ema4kids@gmail.com</a>
        </div>
        <div class="col">
            <h3>Follow us @</h3>
            <div class="socials">
                <a target="_blank" href="https://www.facebook.com/share/14rBucJsE7Z/"><ion-icon name="logo-facebook"></ion-icon></a>
                <a target="_blank" href="https://www.instagram.com/ema4kids_?utm_source=ig_web_button_share_sheet&igsi=ZDNlZDc0MzIxNw=="><ion-icon name="logo-instagram"></ion-icon></a>
                <a target="_blank" href="https://www.threads.com/@ema4kids_"><ion-icon name="logo-threads"></ion-icon></a>
            </div>
        </div>
        <div class="col">
            Ema4kids Legacy Foundation is a 501(c)(3) non-profit in the United States operating internationally. 
            Registered in the United States. EIN: 92-2485192<br>Public Charity Status: 170(b)(1)(A)(vi)
        </div>
    </div>
    <div class="copywrite">
        Copyright <?= date("Y"); ?> Ema4kids Legacy Foundation. All Rights Reserved
    </div>

    <script type="module" src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.esm.js"></script>
    <script nomodule src="https://unpkg.com/ionicons@8.0.13/dist/ionicons/ionicons.js"></script>
    <script src="script.js"></script>
</body>
</html>
