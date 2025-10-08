// User Icon after login & onclick toggle Menutup
document.addEventListener('DOMContentLoaded', () => {
  const userIcon = document.getElementById('user-icon');
  const dropdownMenu = document.querySelector('.dropdown-menu');

  if (userIcon && dropdownMenu) {
    userIcon.addEventListener('click', (e) => {
      e.preventDefault();
      dropdownMenu.toggleAttribute('hidden');
    });

    // Klik di luar dropdown → tutup menu
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
        window.location.href = `/FastBite/cart.php?add=${productId}`;
      }
    });
  });

  // Menampilkan popup dengan animasi
  function showPopup() {
    popup.classList.remove('hidden');
    popup.classList.add('flex');
    setTimeout(() => {
      popup.classList.remove('opacity-0');
      popupContent.classList.remove('scale-95');
    }, 10);
  }

  // Menutup popup dengan animasi
  function hidePopup() {
    popup.classList.add('opacity-0');
    popupContent.classList.add('scale-95');
    setTimeout(() => {
      popup.classList.add('hidden');
      popup.classList.remove('flex');
    }, 300);
  }

  // Tombol Batal
  if (closeBtn) {
    closeBtn.addEventListener('click', hidePopup);
  }

  // Klik di luar area popup → tutup
  popup.addEventListener('click', (e) => {
    if (e.target === popup) hidePopup();
  });

  if (loginBtn) {
    loginBtn.addEventListener('click', () => {
      window.location.href = '/FastBite/auth/login.php';
    });
  }

  if (registerBtn) {
    registerBtn.addEventListener('click', () => {
      window.location.href = '/FastBite/auth/register.php';
    });
  }
});
