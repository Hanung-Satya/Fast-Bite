<?php
if (session_status() == PHP_SESSION_NONE) {
    session_start();
}
?>
<footer>
    <div class="footer-container">
        <p>&copy; 2025 FastBite. All rights reserved.</p>
    </div>

    <div id="ta-popup" class="fixed inset-0 flex items-center justify-center hidden">
        <div id="ta-backdrop" class="absolute inset-0 bg-black/50 opacity-0 transition-opacity duration-300"></div>
        <div id="ta-card" class="relative bg-white rounded-2xl shadow-xl p-6 max-w-sm w-full transform opacity-0 scale-95 transition-all duration-300 z-10 text-center">
            <h2 class="text-xl font-semibold mb-2">🎓 School Project Notice</h2>
            <p class="text-gray-600 mb-4">
                This website was created as part of my SMK final project.
            </p>
            <label class="flex items-center justify-center gap-2 text-sm mb-4 text-gray-500">
                <input type="checkbox" id="ta-dont" class="accent-orange-500">
                Don’t show this again
            </label>
            <div class="flex justify-center gap-3">
                <button id="ta-ok" class="px-4 py-2 bg-orange-500 text-white rounded-lg hover:bg-orange-600 transition">OK</button>
                <button id="ta-close" class="px-4 py-2 bg-gray-200 text-gray-700 rounded-lg hover:bg-gray-300 transition">Close</button>
            </div>
        </div>
    </div>
    <script src="/FastBite/assets/js/script.js"></script>
</footer>