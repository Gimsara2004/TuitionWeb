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

// ── Enrollment form submission ──
function submitForm() {
  const name    = document.getElementById('sname').value.trim();
  const subject = document.getElementById('subject').value;
  const phone   = document.getElementById('phone').value.trim();

  if (!name)    { alert('Please enter the student\'s full name.'); return; }
  if (!subject) { alert('Please select a subject.'); return; }
  if (!phone)   { alert('Please enter a contact number.'); return; }

  // Show success message
  const successEl = document.getElementById('success-msg');
  successEl.style.display = 'flex';

  // Clear all fields
  ['sname', 'grade', 'batch', 'pname', 'phone', 'msg'].forEach(id => {
    document.getElementById(id).value = '';
  });
  document.getElementById('subject').value = '';

  // Hide after 5 seconds
  setTimeout(() => { successEl.style.display = 'none'; }, 5000);
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
