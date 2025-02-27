<?php 
use MythicalDash\SettingsManager;

?>
<footer class="content-footer footer bg-footer-theme">
  <div class="container-xxl">
    <div
      class="footer-container d-flex align-items-center justify-content-between py-2 flex-md-row flex-column"
    >
      <div>
        Copyright © 2019 - 
        <script>
          document.write(new Date().getFullYear());
        </script>
        made with ❤️ by <a href="https://github.com/mythicalltd" target="_blank" class="fw-semibold">MythicalSystems</a>
      </div>
      <div>
        <a href="<?= SettingsManager::getSetting("PterodactylURL")?>" target="_blank" class="footer-link me-4">Pterodactyl</a>
        <a href="/help-center/tos" target="_blank" class="footer-link me-4" >Terms of Service</a>
        <a href="/help-center/pp" target="_blank" class="footer-link d-none d-sm-inline-block" >Privacy Policy</a>
      </div>
    </div>
  </div>
</footer>