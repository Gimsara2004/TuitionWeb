<?php include 'config/db.php'; ?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8" />
  <meta name="viewport" content="width=device-width, initial-scale=1.0"/>
  <title>Smart Physics A/L Tuition — Gampaha</title>
  <meta name="description" content="Enroll in 2025/2026 A/L Physics classes in Gampaha with expert tutor Induja Dayarathne. Small batches, proven results." />
  <meta name="author" content="Smart Physics A/L Tuition" />
  <meta name="keywords" content="A/L Physics tuition, Gampaha, Physics, Sri Lanka, Induja Dayarathne" />
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0/css/all.min.css" crossorigin="anonymous" />
  <link rel="stylesheet" href="css/style.css" />
</head>
<body>

  <!-- NAVIGATION -->
  <nav id="navbar">
    <div class="nav-inner">
      <a href="index.php" class="logo">Smart <span>Physics</span></a>
      <div class="nav-links" id="nav-links">
        <a href="#about">About</a>
        <a href="#subjects">Syllabus</a>
        <a href="#online">Online Classes</a>
        <a href="#feedback">Feedback</a>
        <a href="#enroll">Enroll</a>
        <a href="#contact">Contact</a>
      </div>
      <div class="nav-right">
        <a href="#enroll" class="nav-cta">Enroll Now</a>
        <button class="nav-toggle" onclick="toggleMenu()" aria-label="Open menu">
          <i class="fas fa-bars"></i>
        </button>
      </div>
    </div>
  </nav>

  <!-- HERO -->
  <section class="hero">
    <div class="hero-badge">A/L Physics Stream — 2025 / 2026</div>
    <h1>Master A/L Physics<br>with Smart Guidance</h1>
    <p>Personalised Physics tuition by Induja Dayarathne.<br>Small batches. Proven results.</p>
    <div class="hero-btns">
      <a href="#enroll" class="btn-primary">Enroll Now</a>
      <a href="#subjects" class="btn-outline">View Syllabus</a>
    </div>
    <div class="stats">
      <div class="stat-card"><div class="stat-num">200+</div><div class="stat-label">Students taught</div></div>
      <div class="stat-card"><div class="stat-num">95%</div><div class="stat-label">A/B pass rate</div></div>
      <div class="stat-card"><div class="stat-num">10+</div><div class="stat-label">Years experience</div></div>
    </div>
  </section>

  <!-- ABOUT -->
  <section id="about" class="section section-dark">
    <div class="section-label">About the teacher</div>
    <div class="section-title">Meet your tutor</div>
    <div class="about-grid">
      <div class="about-img">
        <div class="avatar">ID</div>
        <p class="teacher-name">Induja Dayarathne</p>
        <p class="teacher-qual">BSc (Hons) Physics</p>
      </div>
      <div class="about-text">
        <h3>Dedicated to your A/L success</h3>
        <p>With over 10 years of experience in A/L Physics tuition, Induja Dayarathne provides structured lessons that build both deep understanding and exam confidence.</p>
        <p>The teaching approach focuses on concept clarity first, then problem solving — so students can tackle any Physics exam paper with ease.</p>
        <ul class="qual-list">
          <li>BSc (Hons) in Physics — University of Kelaniya</li>
          <li>10+ years A/L Physics tuition experience</li>
          <li>Former teacher, national school</li>
          <li>Small batch sizes (max 15 students)</li>
          <li>Monthly past paper sessions included</li>
        </ul>
      </div>
    </div>
  </section>

  <!-- SYLLABUS -->
  <section id="subjects" class="section">
    <div class="section-label">What we teach</div>
    <div class="section-title">A/L Physics full syllabus</div>
    <div class="section-sub">Complete coverage of all 11 official units — Sri Lanka A/L Physics syllabus</div>
    <div class="subject-grid syllabus-grid">
      <?php
      $units = [
        ["📐", "Unit 01 — Measurement",                    "Physical quantities, SI units, dimensions, significant figures, errors and uncertainties, scalar and vector quantities.",         "මිනුම්"],
        ["⚙️", "Unit 02 — Mechanics",                     "Kinematics, Newton's laws, momentum, impulse, work, energy, power, circular motion, and simple harmonic motion.",                 "යාන්ත්‍ර විද්‍යාව"],
        ["🌊", "Unit 03 — Oscillations &amp; Waves",       "Oscillatory motion, wave motion, transverse and longitudinal waves, superposition, interference, diffraction, and sound.",       "දෝලන හා තරංග"],
        ["🌡️","Unit 04 — Thermal Physics",                "Temperature, heat, specific heat capacity, latent heat, thermal expansion, gas laws, and kinetic theory of gases.",              "තාප භෞතිකය"],
        ["🌍", "Unit 05 — Gravitational Field",            "Newton's law of gravitation, gravitational field strength, potential, satellite motion, and Kepler's laws.",                      "ගුරුත්වජ ක්ෂේත්‍රය"],
        ["⚡", "Unit 06 — Electrostatic Field",            "Coulomb's law, electric field strength, electric potential, capacitance, capacitors in circuits, and dielectrics.",              "ස්ථිති විද්‍යුත් ක්ෂේත්‍රය"],
        ["🔋", "Unit 07 — Current Electricity",            "Electric current, Ohm's law, resistance, EMF, internal resistance, Kirchhoff's laws, and electrical power.",                    "ධාරා විද්‍යුතය"],
        ["🧲", "Unit 08 — Electromagnetism",               "Magnetic fields, force on conductors, electromagnetic induction, Faraday's law, Lenz's law, transformers, and AC theory.",      "විද්‍යුත් චුම්බකත්වය"],
        ["💻", "Unit 09 — Electronics",                    "Semiconductors, p-n junction, diodes, rectification, transistors, logic gates, and basic digital circuits.",                    "ඉලෙක්ට්‍රොනික විද්‍යාව"],
        ["🔩", "Unit 10 — Mechanical Properties of Matter","Elasticity, stress, strain, Young's modulus, pressure in fluids, Archimedes' principle, and surface tension.",                  "පදාර්ථයේ යාන්ත්‍රික ගුණ"],
        ["☢️", "Unit 11 — Matter &amp; Radiation",         "Photoelectric effect, atomic structure, X-rays, radioactivity, nuclear reactions, and fundamental particles.",                  "පදාර්ථ හා විකිරණ"],
        ["★",  "Past Paper Practice",                      "Monthly mock exams using past A/L Physics papers. Detailed answer discussions and marking scheme analysis for all 11 units.",   "Exam prep"],
      ];
      foreach ($units as $u): ?>
      <div class="subject-card">
        <div class="subject-icon"><?= $u[0] ?></div>
        <h4><?= $u[1] ?></h4>
        <p><?= $u[2] ?></p>
        <span class="tag"><?= $u[3] ?></span>
      </div>
      <?php endforeach; ?>
    </div>
  </section>

  <!-- ONLINE CLASSES -->
  <section id="online" class="section section-dark">
    <div class="section-label">Learn from anywhere</div>
    <div class="section-title">Online classes &amp; recordings</div>
    <div class="section-sub">Join live sessions or watch recorded classes anytime, from any device</div>

    <div class="online-how">
      <a href="https://zoom.us/j/1234567890" target="_blank" class="how-card how-card-link">
        <div class="how-icon"><i class="fas fa-video"></i></div>
        <h4>Live classes <i class="fas fa-external-link-alt" style="font-size:11px;margin-left:4px;"></i></h4>
        <p>Join scheduled online sessions via Zoom. Click to join the live class room.</p>
      </a>
      <a href="#recordings" class="how-card how-card-link">
        <div class="how-icon"><i class="fas fa-play-circle"></i></div>
        <h4>Recorded sessions <i class="fas fa-arrow-down" style="font-size:11px;margin-left:4px;"></i></h4>
        <p>All classes are recorded and uploaded here. Watch or rewatch any lesson at your own pace.</p>
      </a>
      <div class="how-card">
        <div class="how-icon"><i class="fas fa-mobile-alt"></i></div>
        <h4>Any device</h4>
        <p>Works on mobile, tablet, and laptop. No app needed — just click and watch in your browser.</p>
      </div>
    </div>

    <div class="recordings-header" id="recordings">
      <h3>Class recordings</h3>
      <p>Click any lesson below to watch. New recordings added after every class.</p>
    </div>

    <div class="recordings-grid">
      <?php
      $recordings = [
        ["Unit 01", "Measurement — SI Units &amp; Errors",                   "Apr 5, 2026",  "https://youtube.com"],
        ["Unit 02", "Mechanics — Kinematics &amp; Newton's Laws",            "Apr 7, 2026",  "https://youtube.com"],
        ["Unit 02", "Mechanics — Work, Energy &amp; Power",                  "Apr 9, 2026",  "https://youtube.com"],
        ["Unit 03", "Oscillations &amp; Waves — SHM",                       "Apr 11, 2026", "https://youtube.com"],
        ["Unit 03", "Oscillations &amp; Waves — Wave Motion",                "Apr 13, 2026", "https://youtube.com"],
        ["Unit 04", "Thermal Physics — Heat &amp; Gas Laws",                 "Apr 15, 2026", "https://youtube.com"],
        ["Unit 05", "Gravitational Field — Newton's Law &amp; Satellites",   "Apr 17, 2026", "https://youtube.com"],
        ["Unit 06", "Electrostatic Field — Coulomb's Law &amp; Capacitors",  "Apr 19, 2026", "https://youtube.com"],
        ["Unit 07", "Current Electricity — Ohm's Law &amp; Circuits",        "Apr 21, 2026", "https://youtube.com"],
        ["Unit 08", "Electromagnetism — Induction &amp; AC Theory",          "Apr 23, 2026", "https://youtube.com"],
        ["Unit 09", "Electronics — Semiconductors &amp; Logic Gates",        "Apr 25, 2026", "https://youtube.com"],
        ["Unit 10", "Mechanical Properties — Elasticity &amp; Fluids",       "Apr 27, 2026", "https://youtube.com"],
        ["Unit 11", "Matter &amp; Radiation — Radioactivity &amp; Nuclear",  "Apr 29, 2026", "https://youtube.com"],
      ];
      foreach ($recordings as $r): ?>
      <div class="recording-card">
        <div class="rec-thumb"><i class="fas fa-play"></i></div>
        <div class="rec-info">
          <span class="rec-unit"><?= $r[0] ?></span>
          <h4><?= $r[1] ?></h4>
          <p class="rec-date"><i class="fas fa-calendar-alt"></i> <?= $r[2] ?></p>
          <a href="<?= $r[3] ?>" target="_blank" class="rec-btn">Watch now <i class="fas fa-external-link-alt"></i></a>
        </div>
      </div>
      <?php endforeach; ?>
    </div>

    <div class="online-note">
      <i class="fas fa-lock"></i>
      <p>Recordings are updated after every session. Enrolled students get the direct links via WhatsApp.</p>
    </div>
  </section>

  <!-- STUDENT FEEDBACK — loaded from DB -->
  <section id="feedback" class="section">
    <div class="section-label">What students say</div>
    <div class="section-title">Student feedback</div>
    <div class="section-sub">Hear from students who have excelled with Smart Physics tuition</div>
    <div class="feedback-grid">
      <?php
      $fb = $conn->query("SELECT * FROM feedback WHERE is_approved=1 ORDER BY created_at DESC LIMIT 6");
      if ($fb && $fb->num_rows > 0):
        while ($f = $fb->fetch_assoc()): ?>
        <div class="feedback-card">
          <div class="stars"><?= str_repeat('★', (int)$f['rating']) . str_repeat('☆', 5 - (int)$f['rating']) ?></div>
          <p>"<?= htmlspecialchars($f['message']) ?>"</p>
          <div class="feedback-author">
            <div class="author-avatar"><?= strtoupper(substr($f['name'], 0, 2)) ?></div>
            <div>
              <div class="author-name"><?= htmlspecialchars($f['name']) ?></div>
              <div class="author-detail"><?= htmlspecialchars($f['year_detail']) ?></div>
            </div>
          </div>
        </div>
      <?php endwhile;
      else: // fallback static feedback ?>
        <div class="feedback-card">
          <div class="stars">★★★★★</div>
          <p>"The way Induja Miss explains concepts step-by-step made Physics so much easier. I went from a C to an A in my mocks!"</p>
          <div class="feedback-author">
            <div class="author-avatar">KP</div>
            <div><div class="author-name">Kasun Perera</div><div class="author-detail">2025 A/L — Physics</div></div>
          </div>
        </div>
        <div class="feedback-card">
          <div class="stars">★★★★★</div>
          <p>"Small batch sizes made a huge difference. Miss gives individual attention and always makes sure we understand before moving on."</p>
          <div class="feedback-author">
            <div class="author-avatar">NF</div>
            <div><div class="author-name">Nimal Fernando</div><div class="author-detail">2026 A/L — Physics</div></div>
          </div>
        </div>
        <div class="feedback-card">
          <div class="stars">★★★★★</div>
          <p>"The monthly past paper sessions were a game changer for exam preparation. Highly recommend for anyone serious about their A/Ls."</p>
          <div class="feedback-author">
            <div class="author-avatar">SR</div>
            <div><div class="author-name">Sanduni Rathnayake</div><div class="author-detail">2025 A/L — Physics</div></div>
          </div>
        </div>
      <?php endif; ?>
    </div>
  </section>

  <!-- ENROLLMENT FORM — AJAX -->
  <section id="enroll" class="section section-dark">
    <div class="section-label">Get started</div>
    <div class="section-title">Student enrollment</div>
    <div class="section-sub">Fill in the form and we'll contact you to confirm your spot</div>
    <div class="form-card">

      <div id="enroll-msg" style="display:none; padding:14px 18px; border-radius:6px; font-size:14px; margin-bottom:18px; text-align:center;"></div>

      <form id="enroll-form">
        <div class="form-grid">
          <div class="form-group">
            <label for="sname">Student full name</label>
            <input type="text" id="sname" name="sname" placeholder="e.g. Kasun Perera">
          </div>
          <div class="form-group">
            <label for="grade">School / Grade</label>
            <input type="text" id="grade" name="grade" placeholder="e.g. Grade 13 — 2026">
          </div>
          <div class="form-group">
            <label for="subject">Subject</label>
            <select id="subject" name="subject">
              <option value="">Select topic</option>
              <option>Full syllabus</option>
              <option>Revision classes</option>
              <option>Past paper sessions only</option>
            </select>
          </div>
          <div class="form-group">
            <label for="batch">Preferred batch</label>
            <select id="batch" name="batch">
              <option value="">Select time</option>
              <option>Saturday 8:00 AM</option>
              <option>Saturday 11:00 AM</option>
              <option>Sunday 8:30 AM</option>
              <option>Sunday 10:30 AM</option>
              <option>Weekday (by appointment)</option>
            </select>
          </div>
          <div class="form-group">
            <label for="pname">Parent / Guardian name</label>
            <input type="text" id="pname" name="pname" placeholder="e.g. Mr. Perera">
          </div>
          <div class="form-group">
            <label for="phone">Contact number</label>
            <input type="tel" id="phone" name="phone" placeholder="07X XXX XXXX">
          </div>
          <div class="form-group full">
            <label for="msg">Additional message (optional)</label>
            <textarea id="msg" name="msg" placeholder="Any questions or notes for the tutor..."></textarea>
          </div>
        </div>
        <button type="submit" class="submit-btn" id="enroll-btn">Submit enrollment request</button>
      </form>

    </div>
  </section>

  <!-- CONTACT -->
  <section id="contact" class="section">
    <div class="section-label">Get in touch</div>
    <div class="section-title">Contact us</div>
    <div class="spacer"></div>
    <div class="contact-grid">
      <div class="contact-card">
        <div class="contact-icon"><i class="fas fa-phone"></i></div>
        <h4>Phone</h4>
        <p>071 234 5678<br>Available 8am – 8pm daily</p>
      </div>
      <div class="contact-card">
        <div class="contact-icon"><i class="fas fa-location-dot"></i></div>
        <h4>Location</h4>
        <p>No. 12, Colombo Road<br>Negombo, Western Province</p>
      </div>
      <div class="contact-card">
        <div class="contact-icon"><i class="fas fa-envelope"></i></div>
        <h4>Email</h4>
        <p>smartphysics@gmail.com<br>Reply within 24 hours</p>
      </div>
    </div>
  </section>

  <!-- WAVE DIVIDER -->
  <div class="wave-divider">
    <svg viewBox="0 0 1440 100" fill="none" xmlns="http://www.w3.org/2000/svg" preserveAspectRatio="none">
      <path d="M0 43.9999C106.667 43.9999 213.333 7.99994 320 7.99994C426.667 7.99994 533.333 43.9999 640 43.9999C746.667 43.9999 853.333 7.99994 960 7.99994C1066.67 7.99994 1173.33 43.9999 1280 43.9999C1386.67 43.9999 1440 19.0266 1440 9.01329V100H0V43.9999Z" fill="#080a12"/>
    </svg>
  </div>

  <!-- FOOTER -->
  <footer>
    <div class="footer-inner">
      <div class="footer-grid">
        <div class="footer-brand">
          <div class="footer-logo">Smart <span>Physics</span></div>
          <p class="footer-tagline">Build real understanding of Physics and excel in your A/L exams with expert guidance, innovative techniques, and proven success strategies by Induja Dayarathne.</p>
          <div class="footer-socials">
            <a href="https://facebook.com" target="_blank" rel="noopener noreferrer" aria-label="Facebook"><i class="fab fa-facebook-f"></i></a>
            <a href="https://wa.me/94712345678" target="_blank" rel="noopener noreferrer" aria-label="WhatsApp"><i class="fab fa-whatsapp"></i></a>
            <a href="https://youtube.com" target="_blank" rel="noopener noreferrer" aria-label="YouTube"><i class="fab fa-youtube"></i></a>
          </div>
        </div>
        <div class="footer-col">
          <h4>Quick Links</h4>
          <ul>
            <li><a href="#about">About the Tutor</a></li>
            <li><a href="#subjects">Syllabus</a></li>
            <li><a href="#feedback">Feedback</a></li>
            <li><a href="#enroll">Enroll</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Topics</h4>
          <ul>
            <li><a href="#subjects">Mechanics &amp; Waves</a></li>
            <li><a href="#subjects">Electricity &amp; Magnetism</a></li>
            <li><a href="#subjects">Thermal &amp; Modern Physics</a></li>
            <li><a href="#subjects">Past Paper Sessions</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Contact</h4>
          <ul>
            <li><a href="tel:0712345678"><i class="fas fa-phone footer-icon"></i> 071 234 5678</a></li>
            <li><a href="mailto:smartphysics@gmail.com"><i class="fas fa-envelope footer-icon"></i> smartphysics@gmail.com</a></li>
            <li><a href="#contact"><i class="fas fa-location-dot footer-icon"></i> Negombo, Western Province</a></li>
          </ul>
        </div>
        <div class="footer-col">
          <h4>Admin</h4>
          <ul>
            <li><a href="admin/login.php"><i class="fas fa-lock footer-icon"></i> Admin Login</a></li>
          </ul>
        </div>
      </div>
      <div class="footer-bottom">
        <p>Copyright &copy; <?php echo date('Y'); ?> &nbsp;&middot;&nbsp; Smart Physics A/L Tuition &mdash; Negombo &nbsp;&middot;&nbsp; Induja Dayarathne</p>
      </div>
    </div>
  </footer>

  <!-- TOAST -->
  <div id="toast" style="position:fixed;bottom:30px;right:30px;z-index:9999;padding:14px 24px;border-radius:8px;font-size:14px;font-weight:600;display:none;box-shadow:0 8px 24px rgba(0,0,0,0.2);"></div>

  <script src="js/main.js"></script>
  <script>
    // AJAX Enrollment form
    document.getElementById('enroll-form').addEventListener('submit', function(e) {
      e.preventDefault();
      const btn = document.getElementById('enroll-btn');
      btn.textContent = 'Submitting...';
      btn.disabled = true;

      fetch('enroll.php', { method: 'POST', body: new FormData(this) })
        .then(r => r.json())
        .then(data => {
          const msg = document.getElementById('enroll-msg');
          msg.style.display = 'block';
          if (data.status === 'success') {
            msg.style.background = 'rgba(52,211,153,0.15)';
            msg.style.color      = '#34d399';
            msg.style.border     = '1px solid rgba(52,211,153,0.3)';
            msg.innerHTML = '<i class="fas fa-check-circle"></i> ' + data.message;
            document.getElementById('enroll-form').reset();
            showToast('🎉 Enrollment submitted! We\'ll contact you soon.', '#34d399');
          } else {
            msg.style.background = 'rgba(248,113,113,0.15)';
            msg.style.color      = '#f87171';
            msg.style.border     = '1px solid rgba(248,113,113,0.3)';
            msg.innerHTML = '<i class="fas fa-exclamation-circle"></i> ' + data.message;
          }
          msg.scrollIntoView({ behavior: 'smooth', block: 'center' });
        })
        .catch(() => {
          const msg = document.getElementById('enroll-msg');
          msg.style.display = 'block';
          msg.style.color   = '#f87171';
          msg.textContent   = 'Network error. Please try again.';
        })
        .finally(() => {
          btn.textContent = 'Submit enrollment request';
          btn.disabled    = false;
        });
    });

    function showToast(msg, color) {
      const t = document.getElementById('toast');
      t.textContent   = msg;
      t.style.background = color;
      t.style.color   = '#fff';
      t.style.display = 'block';
      setTimeout(() => { t.style.display = 'none'; }, 3500);
    }
  </script>
</body>
</html>
