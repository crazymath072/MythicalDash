<?php
use MythicalDash\SettingsManager;

?>
<nav class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
  id="layout-navbar">
  <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
    <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
      <i class="ti ti-menu-2 ti-sm"></i>
    </a>
  </div>

  <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
    <div class="navbar-nav align-items-center">
      <div class="nav-item navbar-search-wrapper mb-0">
        <a class="nav-item nav-link search-toggler d-flex align-items-center px-0" href="javascript:void(0);">
          <i class="ti ti-search ti-md me-2"></i>
          <span class="d-none d-md-inline-block text-muted">Search (Ctrl+/)</span>
        </a>
      </div>
    </div>
    <ul class="navbar-nav flex-row align-items-center ms-auto">
      <?php if (SettingsManager::getSetting("customcss_enabled") == "false") {
        ?>
        <li class="nav-item me-2 me-xl-0">
          <a class="nav-link style-switcher-toggle hide-arrow" href="javascript:void(0);">
            <i class="ti ti-md"></i>
          </a>
        </li>
      <?php } ?>
      <li class="nav-item dropdown-notifications navbar-dropdown dropdown me-3 me-xl-1">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown"
          data-bs-auto-close="outside" aria-expanded="false">
          <i class="ti ti-bell ti-md"></i>
          <!--<span class="badge bg-danger rounded-pill badge-notifications">5</span>-->
        </a>
        <ul class="dropdown-menu dropdown-menu-end py-0">
          <li class="dropdown-menu-header border-bottom">
            <div class="dropdown-header d-flex align-items-center py-3">
              <h5 class="text-body mb-0 me-auto">Notification</h5>
              <a href="javascript:void(0)" class="dropdown-notifications-all text-body" data-bs-toggle="tooltip"
                data-bs-placement="top" title="Mark all as read"><i class="ti ti-mail-opened fs-4"></i></a>
            </div>
          </li>
          <li class="dropdown-notifications-list scrollable-container">
            <ul class="list-group list-group-flush">
              <!--<li class="list-group-item list-group-item-action dropdown-notifications-item marked-as-read">
                          <div class="d-flex">
                            <div class="flex-shrink-0 me-3">
                              <div class="avatar">
                                <span class="avatar-initial rounded-circle bg-label-warning"
                                  ><i class="ti ti-alert-triangle"></i
                                ></span>
                              </div>
                            </div>
                            <div class="flex-grow-1">
                              <h6 class="mb-1">CPU is running high</h6>
                              <p class="mb-0">CPU Utilization Percent is currently at 88.63%,</p>
                              <small class="text-muted">5 days ago</small>
                            </div>
                            <div class="flex-shrink-0 dropdown-notifications-actions">
                              <a href="javascript:void(0)" class="dropdown-notifications-read"
                                ><span class="badge badge-dot"></span
                              ></a>
                              <a href="javascript:void(0)" class="dropdown-notifications-archive"
                                ><span class="ti ti-x"></span
                              ></a>
                            </div>
                          </div>
                        </li>-->
            </ul>
          </li>
          <li class="dropdown-menu-footer border-top">
            <a href=""
              class="dropdown-item d-flex justify-content-center text-primary p-2 h-px-40 mb-1 align-items-center">
              View all notifications
            </a>
          </li>
        </ul>
      </li>
      <!-- User -->
      <li class="nav-item navbar-dropdown dropdown-user dropdown">
        <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
          <div class="avatar avatar-online">
            <img src="<?= $session->getUserInfo("avatar") ?>" alt class="h-auto rounded-circle" />
          </div>
        </a>
        <ul class="dropdown-menu dropdown-menu-end">
          <li>
            <a class="dropdown-item" href="/user/profile?id=<?= $session->getUserInfo("id") ?>">
              <div class="d-flex">
                <div class="flex-shrink-0 me-3">
                  <div class="avatar avatar-online">
                    <img src="<?= $session->getUserInfo("avatar") ?>" alt class="h-auto rounded-circle" />
                  </div>
                </div>
                <div class="flex-grow-1">
                  <span class="fw-semibold d-block">
                    <?= $session->getUserInfo("username") ?>
                    <span class="badge bg-<?php if ($session->getUserInfo("role") == "Administrator") {
                      echo 'danger';
                    } else if ($session->getUserInfo("role") == "Support") {
                      echo "warning";
                    } else {
                      echo 'success';
                    } ?> requestor-type ms-2">
                      <?= $session->getUserInfo("role") ?>
                    </span>
                  </span>
                  <small class="text-muted">
                    <?= $session->getUserInfo("coins") ?> coins
                  </small>
                </div>
              </div>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="/user/profile?id=<?= $session->getUserInfo("id") ?>">
              <i class="ti ti-user-check me-2 ti-sm"></i>
              <span class="align-middle">Profile</span>
            </a>
          </li>
          <li>
            <a class="dropdown-item" href="/user/edit">
              <i class="ti ti-settings me-2 ti-sm"></i>
              <span class="align-middle">Settings</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="/help-center/">
              <i class="ti ti-lifebuoy me-2 ti-sm"></i>
              <span class="align-middle">Help</span>
            </a>
          </li>
          <li>
            <div class="dropdown-divider"></div>
          </li>
          <li>
            <a class="dropdown-item" href="/auth/logout">
              <i class="ti ti-logout me-2 ti-sm"></i>
              <span class="align-middle">Log Out</span>
            </a>
          </li>
        </ul>
      </li>
      <!--/ User -->
    </ul>
  </div>
  <div class="navbar-search-wrapper search-input-wrapper d-none">
    <input type="text" class="form-control search-input container-xxl border-0" placeholder="Search..."
      aria-label="Search..." />
    <i class="ti ti-x ti-sm search-toggler cursor-pointer"></i>
  </div>
</nav>