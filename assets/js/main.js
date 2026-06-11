/* ============================================================
   Ferienhaus Rügen mit Hund – main.js
   ============================================================ */

/* ── Nav Hamburger ── */
document.addEventListener('DOMContentLoaded', function () {
  const hamburger = document.querySelector('.nav-hamburger');
  const navLinks  = document.querySelector('.nav-links');
  if (hamburger && navLinks) {
    hamburger.addEventListener('click', () => navLinks.classList.toggle('open'));
  }

  /* ── Cookie Banner ── */
  const banner  = document.getElementById('cookie-banner');
  const consent = localStorage.getItem('ga_consent');
  if (banner && consent === null) banner.style.display = 'block';

  document.getElementById('cookie-accept')?.addEventListener('click', () => {
    localStorage.setItem('ga_consent', 'yes');
    if (banner) banner.style.display = 'none';
    loadGA();
  });
  document.getElementById('cookie-decline')?.addEventListener('click', () => {
    localStorage.setItem('ga_consent', 'no');
    if (banner) banner.style.display = 'none';
  });
  if (consent === 'yes') loadGA();

  /* ── Modals ── */
  document.querySelectorAll('[data-modal-open]').forEach(btn => {
    btn.addEventListener('click', () => {
      const id = btn.dataset.modalOpen;
      document.getElementById(id)?.classList.add('open');
    });
  });
  document.querySelectorAll('.modal-backdrop').forEach(modal => {
    modal.addEventListener('click', e => {
      if (e.target === modal) modal.classList.remove('open');
    });
  });
  document.querySelectorAll('.modal-close').forEach(btn => {
    btn.addEventListener('click', () => {
      btn.closest('.modal-backdrop')?.classList.remove('open');
    });
  });

  /* ── Kontakt-Formular Verfügbarkeitscheck ── */
  const formVilla   = document.getElementById('f-villa');
  const formAnreise = document.getElementById('f-anreise');
  const formAbreise = document.getElementById('f-abreise');
  if (formVilla && formAnreise && formAbreise) {
    [formVilla, formAnreise, formAbreise].forEach(el =>
      el.addEventListener('change', checkAvailability)
    );
    // Abreise-Minimum
    formAnreise.addEventListener('change', () => {
      if (formAnreise.value) {
        const next = new Date(formAnreise.value);
        next.setDate(next.getDate() + 1);
        formAbreise.min = next.toISOString().split('T')[0];
        if (formAbreise.value && formAbreise.value <= formAnreise.value) {
          formAbreise.value = next.toISOString().split('T')[0];
        }
      }
    });
  }

  /* ── Nächte-Anzeige ── */
  function updateNights() {
    const a = formAnreise?.value, b = formAbreise?.value;
    const el = document.getElementById('f-nights');
    if (!el) return;
    if (a && b && b > a) {
      const diff = Math.round((new Date(b) - new Date(a)) / 86400000);
      el.textContent = diff + ' Nacht' + (diff !== 1 ? 'e' : '');
    } else {
      el.textContent = '';
    }
  }
  formAnreise?.addEventListener('change', updateNights);
  formAbreise?.addEventListener('change', updateNights);

  /* ── URL-Params ins Formular übernehmen ── */
  const params = new URLSearchParams(window.location.search);
  if (params.get('villa') && formVilla) {
    const opt = formVilla.querySelector(`option[value="${params.get('villa')}"]`);
    if (opt) { formVilla.value = params.get('villa'); }
  }
  if (params.get('anreise') && formAnreise) {
    formAnreise.value = toInputDate(params.get('anreise'));
  }
  if (params.get('abreise') && formAbreise) {
    formAbreise.value = toInputDate(params.get('abreise'));
  }
  if (params.get('personen')) {
    const p = document.getElementById('f-personen');
    if (p) p.value = params.get('personen');
  }
  if (params.has('villa') || params.has('anreise')) {
    updateNights();
  }
});

/* ── Datum-Konvertierung (dd.mm.yyyy ↔ yyyy-mm-dd) ── */
function toInputDate(s) {
  if (!s) return '';
  if (/^\d{4}-\d{2}-\d{2}$/.test(s)) return s;
  const m = s.match(/^(\d{2})\.(\d{2})\.(\d{4})$/);
  return m ? `${m[3]}-${m[2]}-${m[1]}` : s;
}

/* ── Verfügbarkeitscheck (einfach: nur Hinweis, kein Backend) ── */
function checkAvailability() {
  const el = document.getElementById('f-avail');
  if (!el) return;
  const villa   = document.getElementById('f-villa')?.value;
  const anreise = document.getElementById('f-anreise')?.value;
  const abreise = document.getElementById('f-abreise')?.value;
  if (!villa || !anreise || !abreise || abreise <= anreise) {
    el.textContent = '';
    el.className = '';
    return;
  }
  el.textContent = '✓ Zeitraum gewählt – wir prüfen und melden uns kurzfristig.';
  el.className = 'avail-ok';
}

/* ── Google Analytics ── */
function loadGA() {
  const GA_ID = document.querySelector('meta[name="ga-id"]')?.content;
  if (!GA_ID) return;
  const s = document.createElement('script');
  s.src = `https://www.googletagmanager.com/gtag/js?id=${GA_ID}`;
  s.async = true;
  document.head.appendChild(s);
  window.dataLayer = window.dataLayer || [];
  function gtag(){ dataLayer.push(arguments); }
  window.gtag = gtag;
  gtag('js', new Date());
  gtag('config', GA_ID, { anonymize_ip: true });
}
