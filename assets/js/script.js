// Fake Website Popup Alert
// TA popup — show once unless user checks "Don't show this again"
(function () {
  const key = 'fastbite_ta_notice_v1';
  // don't show if already dismissed
  if (localStorage.getItem(key) === 'hidden') return;

  // ensure DOM ready
  document.addEventListener('DOMContentLoaded', () => {
    const popup = document.getElementById('ta-popup');
    const backdrop = document.getElementById('ta-backdrop');
    const card = document.getElementById('ta-card');
    const closeBtn = document.getElementById('ta-close');
    const okBtn = document.getElementById('ta-ok');
    const dont = document.getElementById('ta-dont');

    if (!popup || !backdrop || !card) return;

    // show with animation
    popup.classList.remove('hidden');
    // small timeout to allow transition
    requestAnimationFrame(() => {
      backdrop.classList.add('opacity-100');
      card.classList.remove('opacity-0', 'scale-95');
    });

    function hide(andRemember = false) {
      // animate out
      backdrop.classList.remove('opacity-100');
      card.classList.add('opacity-0', 'scale-95');
      // after animation remove element
      setTimeout(() => {
        popup.classList.add('hidden');
      }, 300);

      if (andRemember && dont && dont.checked) {
        try { localStorage.setItem(key, 'hidden'); } catch(e) { /* ignore */ }
      }
    }

    closeBtn?.addEventListener('click', () => hide(true));
    okBtn?.addEventListener('click', () => hide(dont.checked));
    backdrop?.addEventListener('click', () => hide(dont.checked));

    // allow Esc to close
    document.addEventListener('keydown', (e) => {
      if (e.key === 'Escape') hide(dont.checked);
    });
  });
});



// User Icon after login & onclick toggle menu
document.addEventListener('DOMContentLoaded', () => {
  const userIcon = document.getElementById('user-icon');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  if (userIcon && dropdownMenu) {
    userIcon.addEventListener('click', (e) => {
      e.preventDefault();
      e.stopPropagation();
      dropdownMenu.removeAttribute('hidden');
    });

    // If clicked outside the dropdown, it will close
    document.addEventListener('click', (e) => {
      if (!userIcon.contains(e.target) && !dropdownMenu.contains(e.target)) {
        dropdownMenu.setAttribute('hidden', true);
      }
    });
  }
});



// Add to Cart (If user is not logged in, show popup)
document.addEventListener('DOMContentLoaded', () => {
  const popup = document.getElementById('loginPopup');
  const popupContent = popup?.querySelector('.popup-content');
  const loginBtn = document.getElementById('loginBtn');
  const registerBtn = document.getElementById('registerBtn');
  const closeBtn = document.getElementById('closePopup');

  document.querySelectorAll('.add-to-cart-btn').forEach(btn => {
    btn.addEventListener('click', e => {
      if (typeof isLoggedIn === 'undefined' || isLoggedIn === false || isLoggedIn === 'false') {
        e.preventDefault();
        showPopup();
      } else {
        const productId = btn.getAttribute('data-id');
        window.location.href = `./cart.php?add=${productId}`;
      }
    });
  });

  // Show popup with animation
  function showPopup() {
    popup.classList.remove('hidden');
    popup.classList.add('flex');
    setTimeout(() => {
      popup.classList.remove('opacity-0');
      popupContent.classList.remove('scale-95');
    }, 10);
  }

  // Close popup with animation
  function hidePopup() {
    popup.classList.add('opacity-0');
    popupContent.classList.add('scale-95');
    setTimeout(() => {
      popup.classList.add('hidden');
      popup.classList.remove('flex');
    }, 300);
  }

  // Cancel button
  if (closeBtn) {
    closeBtn.addEventListener('click', hidePopup);
  }

    // If clicked outside the dropdown, it will close
  popup.addEventListener('click', (e) => {
    if (e.target === popup) hidePopup();
  });

  if (loginBtn) {
    loginBtn.addEventListener('click', () => {
      window.location.href = './auth/login.php';
    });
  }

  if (registerBtn) {
    registerBtn.addEventListener('click', () => {
      window.location.href = './auth/register.php';
    });
  }
});