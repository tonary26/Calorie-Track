<script setup>
defineOptions({
  name: 'AdminLayout'
})
</script>

<template>
  <div class="admin">

    <aside class="sidebar">
      <div class="sidebar-logo">
        <span class="logo-icon">🥗</span>
        <span class="logo-text">Calorie Track</span>
      </div>

      <nav class="sidebar-nav">
        <span class="nav-section-label">Main</span>

        <router-link
            :to="{ name: 'admin.dashboard' }"
            class="nav-item"
            active-class="active">
          <span class="nav-icon">📊</span>
          <span class="nav-label">Dashboard</span>
        </router-link>

        <router-link
            :to="{ name: 'admin.users' }"
            class="nav-item"
            active-class="active">
          <span class="nav-icon">👤</span>
          <span class="nav-label">Users</span>
        </router-link>

        <span class="nav-section-label">Catalog</span>

        <a href="#" class="nav-item">
          <span class="nav-icon">🥩</span>
          <span class="nav-label">Products</span>
        </a>
        <a href="#" class="nav-item">
          <span class="nav-icon">🏷️</span>
          <span class="nav-label">Categories</span>
        </a>
        <a href="#" class="nav-item">
          <span class="nav-icon">⚡</span>
          <span class="nav-label">Activity Levels</span>
        </a>

        <span class="nav-section-label">System</span>

        <a href="#" class="nav-item">
          <span class="nav-icon">⚙️</span>
          <span class="nav-label">Settings</span>
        </a>
        <router-link
           :to="{ name: 'dashboard.index' }"
           class="nav-item nav-logout">
          <span class="nav-icon">🚪</span>
          <span class="nav-label">Logout</span>
        </router-link>
      </nav>

      <div class="sidebar-footer">
        <div class="sidebar-user">
          <div class="user-avatar">A</div>
          <div class="user-info">
            <span class="user-name">Admin</span>
            <span class="user-role">Administrator</span>
          </div>
        </div>
      </div>
    </aside>

    <main class="main-wrapper">
      <slot />
    </main>

  </div>
</template>

<style scoped>
.admin {
  display: flex;
  min-height: 100vh;
}

.sidebar {
  width: 260px;
  background: #ffffff;
  border-right: 1.5px solid #d6eed9;
  display: flex;
  flex-direction: column;
  padding: 24px 16px;
  gap: 8px;
  position: fixed;
  top: 0;
  left: 0;
  height: 100vh;
  box-shadow: 2px 0 16px rgba(34, 120, 60, 0.06);
}

.sidebar-logo {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 8px 12px 24px;
  border-bottom: 1.5px solid #e8f5ea;
  margin-bottom: 8px;
}

.logo-icon {
  font-size: 24px;
}

.logo-text {
  font-size: 17px;
  font-weight: 700;
  color: #1a4d2e;
}

.sidebar-nav {
  display: flex;
  flex-direction: column;
  gap: 2px;
  flex: 1;
}

.nav-section-label {
  font-size: 10px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.8px;
  color: #a8cdb2;
  padding: 12px 12px 4px;
}

.nav-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 10px;
  transition: background 0.2s, color 0.2s;
  text-decoration: none;
  font-size: 14px;
  font-weight: 500;
  color: #5a8a6a;
}

.active {
  background-color: #058505;
  color: white;
}

.nav-icon {
  font-size: 18px;
  width: 24px;
  text-align: center;
  flex-shrink: 0;
}

.nav-logout {
  margin-top: auto;
  color: #e05c2a;
}

.nav-logout:hover {
  background: #fff5f0;
  color: #e05c2a;
}

.sidebar-footer {
  border-top: 1.5px solid #e8f5ea;
  padding-top: 16px;
}

.sidebar-user {
  display: flex;
  align-items: center;
  gap: 10px;
  padding: 8px 12px;
  border-radius: 10px;
  transition: background 0.2s;
  cursor: pointer;
}

.sidebar-user:hover {
  background: #f0faf3;
}

.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: #058505;
  color: #ffffff;
  font-size: 16px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.user-info {
  display: flex;
  flex-direction: column;
}

.user-name {
  font-size: 14px;
  font-weight: 600;
  color: #1a4d2e;
}

.user-role {
  font-size: 11px;
  color: #a8cdb2;
}

.main-wrapper {
  margin-left: 260px;
  flex: 1;
  padding: 40px;
  background: #f6fdf7;
  min-height: 100vh;
}
</style>