<script setup>
import { useUserStore } from "@/stores/user.js"
import {onMounted, ref, watch} from "vue"

defineOptions({
  name: 'AdminUsers'
})

const store = useUserStore()

const search = ref('')

let timeOut = null

const updateRole = async function (id, role) {
  await store.updateUserRole(id, role)
}

const deleteUser = async function (id) {
  await store.deleteUser(id)
}

watch(search, (newValue) => {
  clearTimeout(timeOut)

  timeOut = setTimeout(async () => {
    await store.getUsers(newValue)
  }, 500)
})

onMounted(async () => {
  await store.getUsers()
})
</script>

<template>
  <div class="page">

    <div class="page-header">
      <div>
        <h1 class="page-title">Users</h1>
        <span class="page-subtitle">Manage all registered users</span>
      </div>
    </div>

    <div class="table-wrapper">
      <div class="table-header">
        <div class="search-box">
          <span>🔍</span>
          <input type="text" v-model="search" placeholder="Search users..." class="search-input">
        </div>
        <div class="table-filters">
          <select class="filter-select">
            <option value="">All roles</option>
            <option value="admin">Admin</option>
            <option value="user">User</option>
          </select>
          <select class="filter-select">
            <option value="">All activity</option>
            <option value="sedentary">Sedentary</option>
            <option value="light">Light</option>
            <option value="moderate">Moderate</option>
            <option value="active">Active</option>
            <option value="very_active">Very Active</option>
          </select>
        </div>
      </div>

      <table class="table">
        <thead>
        <tr>
          <th>ID</th>
          <th>User</th>
          <th>Email</th>
          <th>Sex</th>
          <th>Age</th>
          <th>Activity</th>
          <th>Calories</th>
          <th>Role</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="user in store.users" :key="user.id">
          <td class="td-id">#{{ user.id }}</td>
          <td>
            <div class="user-cell">
              <div class="user-avatar">{{ user.name.charAt(0).toUpperCase() }}</div>
              <span class="user-name">{{ user.name }}</span>
            </div>
          </td>
          <td class="td-email">{{ user.email }}</td>
          <td>{{ user.sex }}</td>
          <td>{{ user.age }}</td>
          <td><span class="badge badge-moderate">{{ user.activity_level.key }}</span></td>
          <td>{{ user.daily_calories }} kcal</td>
          <td>
            <select
                class="role-select"
                :value="user.role"
                @change="updateRole(user.id, $event.target.value)"
            >
              <option value="user">user</option>
              <option value="admin">admin</option>
            </select>
          </td>
          <td>
            <div class="actions">
              <button @click="deleteUser(user.id)"
                      class="action-btn delete">
                🗑
              ️</button>
            </div>
          </td>
        </tr>
        </tbody>
      </table>

      <div class="table-footer">
        <span class="table-count">Showing 4 of 4 users</span>
        <div class="pagination">
          <button class="page-btn" disabled>←</button>
          <button class="page-btn active">1</button>
          <button class="page-btn">2</button>
          <button class="page-btn">3</button>
          <button class="page-btn">→</button>
        </div>
      </div>
    </div>
  </div>
</template>

<style scoped>
.page {
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.page-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.page-title {
  font-size: 26px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0 0 4px 0;
}

.page-subtitle {
  font-size: 14px;
  color: #5a8a6a;
}

.table-wrapper {
  background: #ffffff;
  border-radius: 20px;
  border: 1.5px solid #d6eed9;
  box-shadow: 0 4px 24px rgba(34, 120, 60, 0.07);
  overflow: hidden;
}

.table-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 20px 24px;
  border-bottom: 1.5px solid #e8f5ea;
  gap: 16px;
}

.search-box {
  display: flex;
  align-items: center;
  gap: 8px;
  background: #f6fdf7;
  border: 1.5px solid #d6eed9;
  border-radius: 10px;
  padding: 8px 14px;
  width: 260px;
}

.search-input {
  border: none;
  outline: none;
  background: transparent;
  font-size: 14px;
  color: #1a4d2e;
  width: 100%;
}

.search-input::placeholder {
  color: #a8cdb2;
}

.table-filters {
  display: flex;
  gap: 10px;
}

.filter-select {
  padding: 8px 12px;
  border-radius: 10px;
  border: 1.5px solid #d6eed9;
  background: #f6fdf7;
  font-size: 13px;
  color: #5a8a6a;
  outline: none;
  cursor: pointer;
  appearance: none;
}

.table {
  width: 100%;
  border-collapse: collapse;
}

.table thead tr {
  background: #f6fdf7;
  border-bottom: 1.5px solid #e8f5ea;
}

.table th {
  padding: 12px 16px;
  text-align: left;
  font-size: 11px;
  font-weight: 700;
  text-transform: uppercase;
  letter-spacing: 0.5px;
  color: #a8cdb2;
  white-space: nowrap;
}

.table tbody tr {
  border-bottom: 1.5px solid #f0faf3;
  transition: background 0.15s;
}

.table tbody tr:last-child {
  border-bottom: none;
}

.table tbody tr:hover {
  background: #f6fdf7;
}

.table td {
  padding: 14px 16px;
  font-size: 14px;
  color: #1a4d2e;
  vertical-align: middle;
}

.td-id {
  font-size: 12px;
  color: #a8cdb2;
  font-weight: 600;
}

.td-email {
  color: #5a8a6a;
}

.user-cell {
  display: flex;
  align-items: center;
  gap: 10px;
}

.user-avatar {
  width: 34px;
  height: 34px;
  border-radius: 8px;
  background: #2e9e5b;
  color: #ffffff;
  font-size: 14px;
  font-weight: 700;
  display: flex;
  align-items: center;
  justify-content: center;
  flex-shrink: 0;
}

.user-name {
  font-weight: 600;
}

.badge {
  padding: 3px 10px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
}

.role-select {
  padding: 4px 10px;
  text-align: center;
  border-radius: 999px;
  border: 1.5px solid #d6eed9;
  background: #f6fdf7;
  font-size: 12px;
  font-weight: 600;
  color: #1a4d2e;
  outline: none;
  cursor: pointer;
  appearance: none;
}

.badge-user        { background: #f0faf3; color: #2e9e5b; }
.badge-moderate    { background: #fefce8; color: #d4a017; }

.actions {
  display: flex;
  gap: 6px;
}

.action-btn {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  border: 1.5px solid #e8f5ea;
  background: #f6fdf7;
  cursor: pointer;
  font-size: 14px;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.action-btn.edit:hover {
  background: #eff6ff;
  border-color: #3a7fd4;
}

.action-btn.delete:hover {
  background: #fff5f0;
  border-color: #e05c2a;
}

.table-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 24px;
  border-top: 1.5px solid #e8f5ea;
}

.table-count {
  font-size: 13px;
  color: #a8cdb2;
}

.pagination {
  display: flex;
  gap: 6px;
}

.page-btn {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  border: 1.5px solid #d6eed9;
  background: #ffffff;
  font-size: 13px;
  color: #5a8a6a;
  cursor: pointer;
  transition: all 0.2s;
  display: flex;
  align-items: center;
  justify-content: center;
}

.page-btn:hover:not(:disabled) {
  border-color: #2e9e5b;
  color: #2e9e5b;
}

.page-btn.active {
  background: #2e9e5b;
  border-color: #2e9e5b;
  color: #ffffff;
}

.page-btn:disabled {
  opacity: 0.4;
  cursor: not-allowed;
}
</style>