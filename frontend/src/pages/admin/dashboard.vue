<script setup>
import { useUserStore } from "@/stores/user.js"
import { useProductStore } from "@/stores/product.js"
import { computed, onMounted } from "vue"

defineOptions({
  name: 'dashboard'
})

const userStore = useUserStore()
const productStore = useProductStore()

const totalUsers = computed(() => userStore.users.length)
const totalProducts = computed(() => productStore.products.length)

const avgCalories = computed(() => {
  if (!userStore.users.length) {
    return 0
  }

  const sum = userStore.users.reduce((acc, user) => {
    return acc + user.daily_calories
  }, 0)

  return Math.round(sum / userStore.users.length)
})

onMounted(async () => {
  await userStore.getUsers()
  await productStore.getProducts()
})

</script>

<template>
  <div class="page">

    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <span class="page-subtitle">Welcome back, Admin 👋</span>
      </div>
      <span class="page-date">Saturday, April 18</span>
    </div>

    <div class="stats-grid">
      <div class="stat-card">
        <div class="stat-icon users-icon">👤</div>
        <div class="stat-info">
          <span class="stat-label">Total Users</span>
          <span class="stat-value">{{ totalUsers }}</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon products-icon">🥩</div>
        <div class="stat-info">
          <span class="stat-label">Total Products</span>
          <span class="stat-value">{{ totalProducts }}</span>
        </div>
      </div>
      <div class="stat-card">
        <div class="stat-icon calories-icon">🔥</div>
        <div class="stat-info">
          <span class="stat-label">Avg Calories</span>
          <span class="stat-value">{{ avgCalories }}</span>
        </div>
      </div>
    </div>

    <div class="content-grid">

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Recent Users</h3>
          <a href="#" class="card-link">View all →</a>
        </div>
        <div class="user-list">
          <div class="user-item">
            <div class="user-avatar">A</div>
            <div class="user-info">
              <span class="user-name">Alex Johnson</span>
              <span class="user-meta">alex@gmail.com</span>
            </div>
            <span class="user-badge badge-user">user</span>
          </div>
          <div class="user-item">
            <div class="user-avatar">M</div>
            <div class="user-info">
              <span class="user-name">Maria Smith</span>
              <span class="user-meta">maria@gmail.com</span>
            </div>
            <span class="user-badge badge-user">user</span>
          </div>
          <div class="user-item">
            <div class="user-avatar">J</div>
            <div class="user-info">
              <span class="user-name">John Doe</span>
              <span class="user-meta">john@gmail.com</span>
            </div>
            <span class="user-badge badge-admin">admin</span>
          </div>
          <div class="user-item">
            <div class="user-avatar">S</div>
            <div class="user-info">
              <span class="user-name">Sara Lee</span>
              <span class="user-meta">sara@gmail.com</span>
            </div>
            <span class="user-badge badge-user">user</span>
          </div>
          <div class="user-item">
            <div class="user-avatar">D</div>
            <div class="user-info">
              <span class="user-name">David Park</span>
              <span class="user-meta">david@gmail.com</span>
            </div>
            <span class="user-badge badge-user">user</span>
          </div>
        </div>
      </div>

      <div class="card">
        <div class="card-header">
          <h3 class="card-title">Top Products</h3>
          <a href="#" class="card-link">View all →</a>
        </div>
        <div class="product-list">
          <div class="product-item">
            <span class="product-rank">1</span>
            <span class="product-emoji">🍗</span>
            <div class="product-info">
              <span class="product-name">Chicken Breast</span>
              <span class="product-meta">165 kcal / 100g</span>
            </div>
            <div class="product-bar-wrapper">
              <div class="product-bar" style="width: 95%"></div>
            </div>
          </div>
          <div class="product-item">
            <span class="product-rank">2</span>
            <span class="product-emoji">🥚</span>
            <div class="product-info">
              <span class="product-name">Eggs</span>
              <span class="product-meta">155 kcal / 100g</span>
            </div>
            <div class="product-bar-wrapper">
              <div class="product-bar" style="width: 80%"></div>
            </div>
          </div>
          <div class="product-item">
            <span class="product-rank">3</span>
            <span class="product-emoji">🍚</span>
            <div class="product-info">
              <span class="product-name">White Rice</span>
              <span class="product-meta">130 kcal / 100g</span>
            </div>
            <div class="product-bar-wrapper">
              <div class="product-bar" style="width: 70%"></div>
            </div>
          </div>
          <div class="product-item">
            <span class="product-rank">4</span>
            <span class="product-emoji">🥦</span>
            <div class="product-info">
              <span class="product-name">Broccoli</span>
              <span class="product-meta">34 kcal / 100g</span>
            </div>
            <div class="product-bar-wrapper">
              <div class="product-bar" style="width: 55%"></div>
            </div>
          </div>
          <div class="product-item">
            <span class="product-rank">5</span>
            <span class="product-emoji">🐟</span>
            <div class="product-info">
              <span class="product-name">Salmon</span>
              <span class="product-meta">208 kcal / 100g</span>
            </div>
            <div class="product-bar-wrapper">
              <div class="product-bar" style="width: 45%"></div>
            </div>
          </div>
        </div>
      </div>

      <div class="card card-wide">
        <div class="card-header">
          <h3 class="card-title">Activity Levels Distribution</h3>
        </div>
        <div class="activity-list">
          <div class="activity-item">
            <div class="activity-info">
              <span class="activity-icon">🛋️</span>
              <span class="activity-name">Sedentary</span>
            </div>
            <div class="activity-bar-wrapper">
              <div class="activity-bar" style="width: 20%"></div>
            </div>
            <span class="activity-count">256 users</span>
          </div>
          <div class="activity-item">
            <div class="activity-info">
              <span class="activity-icon">🚶</span>
              <span class="activity-name">Light</span>
            </div>
            <div class="activity-bar-wrapper">
              <div class="activity-bar" style="width: 35%"></div>
            </div>
            <span class="activity-count">450 users</span>
          </div>
          <div class="activity-item">
            <div class="activity-info">
              <span class="activity-icon">🏃</span>
              <span class="activity-name">Moderate</span>
            </div>
            <div class="activity-bar-wrapper">
              <div class="activity-bar" style="width: 60%"></div>
            </div>
            <span class="activity-count">771 users</span>
          </div>
          <div class="activity-item">
            <div class="activity-info">
              <span class="activity-icon">🏋️</span>
              <span class="activity-name">Active</span>
            </div>
            <div class="activity-bar-wrapper">
              <div class="activity-bar" style="width: 45%"></div>
            </div>
            <span class="activity-count">578 users</span>
          </div>
          <div class="activity-item">
            <div class="activity-info">
              <span class="activity-icon">🔥</span>
              <span class="activity-name">Very Active</span>
            </div>
            <div class="activity-bar-wrapper">
              <div class="activity-bar" style="width: 25%"></div>
            </div>
            <span class="activity-count">321 users</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
.page {
  display: flex;
  flex-direction: column;
  gap: 28px;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.page-title {
  font-size: 28px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0 0 4px 0;
}

.page-subtitle {
  font-size: 14px;
  color: #5a8a6a;
}

.page-date {
  font-size: 13px;
  color: #a8cdb2;
  font-weight: 500;
}

/* Stats */
.stats-grid {
  display: grid;
  grid-template-columns: repeat(4, 1fr);
  gap: 16px;
}

.stat-card {
  background: #ffffff;
  border: 1.5px solid #d6eed9;
  border-radius: 18px;
  padding: 20px;
  display: flex;
  align-items: center;
  gap: 16px;
  box-shadow: 0 2px 16px rgba(34, 120, 60, 0.07);
  transition: transform 0.2s, box-shadow 0.2s;
}

.stat-card:hover {
  transform: translateY(-2px);
  box-shadow: 0 6px 24px rgba(34, 120, 60, 0.12);
}

.stat-icon {
  font-size: 28px;
  width: 54px;
  height: 54px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 14px;
  flex-shrink: 0;
}

.users-icon    { background: #f0faf3; }
.products-icon { background: #fff5f0; }
.meals-icon    { background: #eff6ff; }
.calories-icon { background: #fefce8; }

.stat-info {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.stat-label {
  font-size: 12px;
  color: #a8cdb2;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.4px;
}

.stat-value {
  font-size: 24px;
  font-weight: 700;
  color: #1a4d2e;
  line-height: 1.2;
}

.stat-change {
  font-size: 12px;
  font-weight: 500;
}

.positive { color: #2e9e5b; }
.negative { color: #e05c2a; }

/* Content grid */
.content-grid {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 16px;
}

.card {
  background: #ffffff;
  border: 1.5px solid #d6eed9;
  border-radius: 20px;
  padding: 24px;
  box-shadow: 0 2px 16px rgba(34, 120, 60, 0.07);
}

.card-wide {
  grid-column: 1 / -1;
}

.card-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
  margin-bottom: 20px;
}

.card-title {
  font-size: 16px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0;
}

.card-link {
  font-size: 13px;
  color: #2e9e5b;
  text-decoration: none;
  font-weight: 500;
}

.card-link:hover {
  text-decoration: underline;
}

/* User list */
.user-list {
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.user-item {
  display: flex;
  align-items: center;
  gap: 12px;
  padding: 10px 12px;
  border-radius: 12px;
  transition: background 0.15s;
}

.user-item:hover {
  background: #f6fdf7;
}

.user-avatar {
  width: 36px;
  height: 36px;
  border-radius: 10px;
  background: #2e9e5b;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.user-info {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.user-name {
  font-size: 14px;
  font-weight: 600;
  color: #1a4d2e;
}

.user-meta {
  font-size: 12px;
  color: #a8cdb2;
}

.user-badge {
  padding: 3px 10px;
  border-radius: 999px;
  font-size: 11px;
  font-weight: 600;
}

.badge-user  { background: #f0faf3; color: #2e9e5b; }
.badge-admin { background: #fff5f0; color: #e05c2a; }

/* Product list */
.product-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.product-item {
  display: flex;
  align-items: center;
  gap: 10px;
}

.product-rank {
  font-size: 12px;
  font-weight: 700;
  color: #a8cdb2;
  width: 16px;
  flex-shrink: 0;
}

.product-emoji {
  font-size: 20px;
  flex-shrink: 0;
}

.product-info {
  display: flex;
  flex-direction: column;
  width: 140px;
  flex-shrink: 0;
}

.product-name {
  font-size: 13px;
  font-weight: 600;
  color: #1a4d2e;
}

.product-meta {
  font-size: 11px;
  color: #a8cdb2;
}

.product-bar-wrapper {
  flex: 1;
  height: 6px;
  background: #e8f5ea;
  border-radius: 999px;
  overflow: hidden;
}

.product-bar {
  height: 100%;
  background: #2e9e5b;
  border-radius: 999px;
}

/* Activity list */
.activity-list {
  display: flex;
  flex-direction: column;
  gap: 14px;
}

.activity-item {
  display: flex;
  align-items: center;
  gap: 14px;
}

.activity-info {
  display: flex;
  align-items: center;
  gap: 8px;
  width: 140px;
  flex-shrink: 0;
}

.activity-icon {
  font-size: 18px;
}

.activity-name {
  font-size: 13px;
  font-weight: 600;
  color: #1a4d2e;
}

.activity-bar-wrapper {
  flex: 1;
  height: 8px;
  background: #e8f5ea;
  border-radius: 999px;
  overflow: hidden;
}

.activity-bar {
  height: 100%;
  background: linear-gradient(90deg, #2e9e5b, #058505);
  border-radius: 999px;
}

.activity-count {
  font-size: 12px;
  font-weight: 600;
  color: #5a8a6a;
  width: 70px;
  text-align: right;
  flex-shrink: 0;
}
</style>