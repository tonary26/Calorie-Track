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

      <div class="table-footer">
        <span class="table-count">Showing 5 of 5 levels</span>
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
.td-emoji { font-size: 22px; }
.td-desc { color: #5a8a6a; font-size: 13px; }
.level-name { font-weight: 600; }

.badge {
  padding: 4px 12px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 700;
}

.badge-sedentary   { background: #f5f5f5;  color: #888; }
.badge-light       { background: #eff6ff;  color: #3a7fd4; }
.badge-moderate    { background: #fefce8;  color: #d4a017; }
.badge-active      { background: #f0faf3;  color: #2e9e5b; }
.badge-very-active { background: #fff5f0;  color: #e05c2a; }

.actions { display: flex; gap: 6px; }

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

.action-btn.edit:hover { background: #eff6ff; border-color: #3a7fd4; }
.action-btn.delete:hover { background: #fff5f0; border-color: #e05c2a; }

.table-footer {
  display: flex;
  align-items: center;
  justify-content: space-between;
  padding: 16px 24px;
  border-top: 1.5px solid #e8f5ea;
}

.table-count { font-size: 13px; color: #a8cdb2; }

/* Modal */
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.3);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 100;
  backdrop-filter: blur(2px);
}

.modal {
  background: #ffffff;
  border-radius: 20px;
  padding: 32px;
  width: 100%;
  max-width: 480px;
  box-shadow: 0 8px 48px rgba(34, 120, 60, 0.15);
  border: 1.5px solid #d6eed9;
  display: flex;
  flex-direction: column;
  gap: 24px;
}

.modal-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.modal-title {
  font-size: 20px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0;
}

.modal-close {
  width: 32px;
  height: 32px;
  border-radius: 8px;
  border: 1.5px solid #d6eed9;
  background: #f6fdf7;
  color: #5a8a6a;
  font-size: 14px;
  cursor: pointer;
  display: flex;
  align-items: center;
  justify-content: center;
  transition: all 0.2s;
}

.modal-close:hover { background: #fff5f0; border-color: #e05c2a; color: #e05c2a; }

.modal-body {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.input-wrapper {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.label {
  font-size: 12px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  color: #5a8a6a;
}

.input {
  padding: 10px 14px;
  border-radius: 10px;
  border: 1.5px solid #c8e6cc;
  background: #f6fdf7;
  font-size: 14px;
  color: #1a4d2e;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s;
}

.input::placeholder { color: #a8cdb2; }

.input:focus {
  border-color: #2e9e5b;
  box-shadow: 0 0 0 3px rgba(46, 158, 91, 0.13);
}

.modal-footer {
  display: flex;
  gap: 10px;
  justify-content: flex-end;
}

.cancel-btn {
  padding: 10px 20px;
  border-radius: 10px;
  border: 1.5px solid #d6eed9;
  background: #ffffff;
  color: #5a8a6a;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  transition: all 0.2s;
}

.cancel-btn:hover { border-color: #a8cdb2; color: #1a4d2e; }

.submit-btn {
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

.submit-btn:hover { background: #239050; }
.submit-btn:active { transform: scale(0.98); }
</style>