// Smart Physics A/L Tuition — js/main.js

// ── Navbar scroll effect ──
window.addEventListener('scroll', () => {
  const navbar = document.getElementById('navbar');
  if (window.scrollY > 20) {
    navbar.classList.add('scrolled');
  } else {
    navbar.classList.remove('scrolled');
  }
});

// ── Mobile nav toggle ──
function toggleMenu() {
  document.getElementById('nav-links').classList.toggle('open');
}

// Close mobile menu when a nav link is clicked
document.querySelectorAll('.nav-links a').forEach(link => {
  link.addEventListener('click', () => {
    document.getElementById('nav-links').classList.remove('open');
  });
});

// ── Toast notification ──
function showToast(msg, color) {
  const t = document.getElementById('toast');
  t.textContent = msg;
  t.style.background = color || '#34d399';
  t.style.color = '#fff';
  t.style.display = 'block';
  setTimeout(() => { t.style.display = 'none'; }, 4000);
}

// ── ENROLLMENT FORM — saves to database via enroll.php ──
const enrollForm = document.getElementById('enroll-form');
if (enrollForm) {
  enrollForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('enroll-btn');
    const msg = document.getElementById('enroll-msg');
    btn.textContent = 'Submitting...';
    btn.disabled = true;

    fetch('enroll.php', { method: 'POST', body: new FormData(this) })
      .then(r => r.json())
      .then(data => {
        if (msg) {
          msg.style.display = 'block';
          msg.style.padding = '12px 16px';
          msg.style.borderRadius = '8px';
          msg.style.marginTop = '12px';
          msg.style.fontSize = '14px';
          if (data.status === 'success') {
            msg.style.background = 'rgba(52,211,153,0.15)';
            msg.style.border = '1px solid #34d399';
            msg.style.color = '#34d399';
            msg.innerHTML = '✓ ' + data.message;
            enrollForm.reset();
            showToast('🎉 Enrollment submitted! We\'ll contact you soon.', '#34d399');
          } else {
            msg.style.background = 'rgba(239,68,68,0.15)';
            msg.style.border = '1px solid #ef4444';
            msg.style.color = '#ef4444';
            msg.innerHTML = '✗ ' + data.message;
          }
        }
      })
      .catch(() => {
        if (msg) {
          msg.style.display = 'block';
          msg.style.background = 'rgba(239,68,68,0.15)';
          msg.style.border = '1px solid #ef4444';
          msg.style.color = '#ef4444';
          msg.textContent = 'Network error. Please try again.';
        }
      })
      .finally(() => {
        btn.textContent = 'Submit enrollment request';
        btn.disabled = false;
      });
  });
}

// ── CONTACT FORM — saves to database via contact.php ──
const contactForm = document.getElementById('contact-form');
if (contactForm) {
  contactForm.addEventListener('submit', function(e) {
    e.preventDefault();
    const btn = document.getElementById('contact-btn');
    const msg = document.getElementById('contact-msg');
    btn.textContent = 'Sending...';
    btn.disabled = true;

    fetch('contact.php', { method: 'POST', body: new FormData(this) })
      .then(r => r.json())
      .then(data => {
        if (msg) {
          msg.style.display = 'block';
          msg.style.padding = '12px 16px';
          msg.style.borderRadius = '8px';
          msg.style.marginTop = '12px';
          msg.style.fontSize = '14px';
          if (data.status === 'success') {
            msg.style.background = 'rgba(52,211,153,0.15)';
            msg.style.border = '1px solid #34d399';
            msg.style.color = '#34d399';
            msg.innerHTML = '✓ ' + data.message;
            contactForm.reset();
            showToast('✉️ Message sent!', '#34d399');
          } else {
            msg.style.background = 'rgba(239,68,68,0.15)';
            msg.style.border = '1px solid #ef4444';
            msg.style.color = '#ef4444';
            msg.innerHTML = '✗ ' + data.message;
          }
        }
      })
      .catch(() => {
        if (msg) {
          msg.style.display = 'block';
          msg.style.background = 'rgba(239,68,68,0.15)';
          msg.style.color = '#ef4444';
          msg.textContent = 'Network error. Please try again.';
        }
      })
      .finally(() => {
        btn.textContent = 'Send Message';
        btn.disabled = false;
      });
  });
}

// ── Highlight active nav link on scroll ──
const sections = document.querySelectorAll('section[id]');
const navLinks = document.querySelectorAll('.nav-links a');

window.addEventListener('scroll', () => {
  let current = '';
  sections.forEach(section => {
    if (window.scrollY >= section.offsetTop - 120) {
      current = section.getAttribute('id');
    }
  });
  navLinks.forEach(link => {
    link.style.color = '';
    if (link.getAttribute('href') === `#${current}`) {
      link.style.color = '#a78bfa';
    }
  });
});