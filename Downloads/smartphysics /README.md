# MathsPro A/L Tuition Website

A clean, dark-themed website for an A/L Mathematics stream tuition class.

## 📁 Project Structure

```
mathspro-tuition/
│
├── index.html        ← Main webpage (all sections)
├── css/
│   └── style.css     ← All styles and colors
├── js/
│   └── main.js       ← Form logic, mobile menu, scroll effects
├── assets/           ← Put images here (teacher photo, logo, etc.)
└── README.md         ← This file
```

---

## 🔧 How to Edit

### Change the theme color
Open `css/style.css` and find the `:root` block at the top:
```css
:root {
  --accent:       #7c6fcd;   /* change this to your preferred color */
  --accent-light: #a78bfa;
  ...
}
```

### Change teacher details
Open `index.html` and search for comments like:
```
🔧 EDIT: Change teacher name and qualification
```
These are placed throughout the file to guide you.

### Change class schedule
In `index.html`, find the `<table class="schedule-table">` section and edit the rows.

### Change contact info
In `index.html`, find the `<!-- CONTACT -->` section and update phone, location, and email.

### Add a teacher photo
1. Put the photo inside the `assets/` folder (e.g., `assets/teacher.jpg`)
2. In `index.html`, replace the `.about-img` div content with:
```html
<img src="assets/teacher.jpg" alt="Teacher photo" style="width:100%;height:100%;object-fit:cover;border-radius:16px;" />
```

---

## 🚀 How to Push to GitHub

### First time setup
```bash
git init
git add .
git commit -m "Initial commit — tuition website"
git branch -M main
git remote add origin https://github.com/YOUR_USERNAME/YOUR_REPO_NAME.git
git push -u origin main
```

### After making changes
```bash
git add .
git commit -m "Update teacher details and schedule"
git push
```

---

## 🌐 How to Host for Free (Netlify)

1. Go to [https://netlify.com](https://netlify.com)
2. Sign up with GitHub
3. Click **"Add new site" → "Import an existing project"**
4. Connect your GitHub repo
5. Click **Deploy** — your site is live in seconds!

Or drag and drop your project folder directly on the Netlify dashboard.

---

## 📬 To Receive Form Submissions (Optional)

The enrollment form currently shows a success message only.
To get real email notifications, use **Formspree**:

1. Go to [https://formspree.io](https://formspree.io) and create a free account
2. Create a new form and get your form endpoint URL
3. In `js/main.js`, replace the `console.log(...)` line with:

```javascript
await fetch('https://formspree.io/f/YOUR_FORM_ID', {
  method: 'POST',
  headers: { 'Content-Type': 'application/json' },
  body: JSON.stringify({ name, subject, phone, msg })
});
```

---

## 🛠 Tech Stack

- HTML5
- CSS3 (custom properties, grid, flexbox)
- Vanilla JavaScript (no frameworks needed)
