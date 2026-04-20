<script setup>
import { useUserStore } from "@/stores/user.js"
import { useProductStore } from "@/stores/product.js"
import { computed, onMounted } from "vue"

defineOptions({
  name: 'dashboard'
})

const getDate = new Date().toLocaleString('en-US', {
  weekday: 'long',
  day: 'numeric',
  month: 'long'
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
  await userStore.getRecentUsers()
  await productStore.getProducts()
})

</script>

<template>
  <div class="page">

    <div class="page-header">
      <div>
        <h1 class="page-title">Dashboard</h1>
        <span class="page-subtitle">Welcome back, {{ userStore.user.name }} 👋</span>
      </div>
      <span class="page-date">{{ getDate }}</span>
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
        </div>
        <div class="user-list">
          <div v-for="recentUser in userStore.users" :key="recentUser.id"
              class="user-item">
            <div class="user-avatar">{{ recentUser.name.charAt(0).toUpperCase() }}</div>
            <div class="user-info">
              <span class="user-name">{{ recentUser.name }}</span>
              <span class="user-meta">{{ recentUser.email }}</span>
            </div>
            <span class="user-badge badge-user">{{ recentUser.role }}</span>
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
</style>