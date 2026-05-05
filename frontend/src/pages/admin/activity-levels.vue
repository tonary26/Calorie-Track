<script setup>
import { useActivityLevelStore } from "@/stores/activity-level.js"
import { onMounted } from "vue"

defineOptions({
  name: 'activity-levels'
})

const store = useActivityLevelStore()

onMounted(async () => {
  await store.getActivityLevels()
})

</script>

<template>
  <div class="page">

    <div class="page-header">
      <div>
        <h1 class="page-title">Activity Levels</h1>
        <span class="page-subtitle">Manage activity levels for users</span>
      </div>
    </div>

    <div class="table-wrapper">
      <table class="table">
        <colgroup>
          <col style="width: 60px">
          <col style="width: 80px">
          <col style="width: 80px">
          <col style="width: 160px">
          <col style="width: 120px">
        </colgroup>
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Key</th>
          <th>Description</th>
          <th>Coefficient</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="activityLevel in store.activityLevels" :key="activityLevel.id">
          <td class="td-id">#{{ activityLevel.id }}</td>
          <td><span class="level-name">{{ activityLevel.name }}</span></td>
          <td><span class="level-name">{{ activityLevel.key }}</span></td>
          <td class="td-desc">{{ activityLevel.description }}</td>
          <td><span class="badge badge-sedentary">× {{ activityLevel.coefficient }}</span></td>
        </tr>
        </tbody>
      </table>

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

.add-btn {
  padding: 10px 20px;
  border-radius: 10px;
  border: none;
  background: #2e9e5b;
  color: #ffffff;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: background 0.2s, transform 0.1s;
  box-shadow: 0 2px 12px rgba(46, 158, 91, 0.25);
}

.add-btn:hover { background: #239050; }
.add-btn:active { transform: scale(0.98); }

.table-wrapper {
  background: #ffffff;
  border-radius: 20px;
  border: 1.5px solid #d6eed9;
  box-shadow: 0 4px 24px rgba(34, 120, 60, 0.07);
  overflow: hidden;
}

.table {
  width: 100%;
  border-collapse: collapse;
  table-layout: fixed;
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
  vertical-align: middle;
}

.table tbody tr {
  border-bottom: 1.5px solid #f0faf3;
  transition: background 0.15s;
}

.table tbody tr:last-child { border-bottom: none; }
.table tbody tr:hover { background: #f6fdf7; }

.table td {
  padding: 14px 16px;
  font-size: 14px;
  color: #1a4d2e;
  vertical-align: middle;
  overflow: hidden;
  text-overflow: ellipsis;
}

.td-id { font-size: 12px; color: #a8cdb2; font-weight: 600; }
.td-desc { color: #5a8a6a; font-size: 13px; }
.level-name { font-weight: 600; }

.badge {
  padding: 4px 12px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
}

.badge-sedentary   { background: #f5f5f5;  color: #888; }
</style>