<script setup>
import { useAuthStore } from "@/stores/auth.js"

defineOptions({
  name: 'index'
})

const store = useAuthStore()

</script>

<template>
  <div class="container">
    <div class="diet-plan">

      <div class="diet-header">
        <div>
          <h2 class="diet-title">Today's Nutrition</h2>
          <span class="diet-date">Monday, March 30</span>
        </div>
        <div class="diet-badge">Calorie Track</div>
      </div>

      <div class="calories-main">
        <div class="calories-circle">
          <svg viewBox="0 0 120 120">
            <circle cx="60" cy="60" r="52" fill="none" stroke="#d6eed9" stroke-width="10"/>
            <circle cx="60" cy="60" r="52" fill="none" stroke="#2e9e5b" stroke-width="10"
                    stroke-dasharray="326.7" stroke-dashoffset="13"
                    stroke-linecap="round" transform="rotate(-90 60 60)"/>
          </svg>
          <div class="calories-inner">
            <span class="calories-value">2900</span>
            <span class="calories-label">kcal</span>
          </div>
        </div>
        <div class="calories-info">
          <h3 class="calories-title">Calories</h3>
          <p class="calories-remaining">100 kcal remaining</p>
          <div class="calories-meta">
            <div class="meta-item">
              <span class="meta-label">Goal</span>
              <span class="meta-value">{{ store.user.daily_calories }}</span>
            </div>
            <div class="meta-divider"></div>
            <div class="meta-item">
              <span class="meta-label">Eaten</span>
              <span class="meta-value">2900</span>
            </div>
            <div class="meta-divider"></div>
            <div class="meta-item">
              <span class="meta-label">Left</span>
              <span class="meta-value">100</span>
            </div>
          </div>
        </div>
      </div>

      <div class="stats">
        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon proteins-icon">🥩</div>
            <div class="stat-info">
              <span class="stat-label">Proteins</span>
              <span class="stat-value">120<span class="stat-total">/{{ store.user.daily_macros.proteins }}g</span></span>
            </div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill proteins-fill" style="width: 80%"></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon fats-icon">🥑</div>
            <div class="stat-info">
              <span class="stat-label">Fats</span>
              <span class="stat-value">60<span class="stat-total">/{{ store.user.daily_macros.fats }}g</span></span>
            </div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill fats-fill" style="width: 75%"></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon carbs-icon">🌾</div>
            <div class="stat-info">
              <span class="stat-label">Carbs</span>
              <span class="stat-value">300<span class="stat-total">/{{ store.user.daily_macros.carbs }}g</span></span>
            </div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill carbs-fill" style="width: 85%"></div>
          </div>
        </div>
      </div>

      <div class="meals">
        <h3 class="meals-title">Meals</h3>
        <div class="meal-list">
          <div class="meal-item">
            <div class="meal-icon">🌅</div>
            <div class="meal-info">
              <span class="meal-name">Breakfast</span>
              <span class="meal-desc">Oatmeal, eggs, coffee</span>
            </div>
            <span class="meal-calories">520 kcal</span>
          </div>
          <div class="meal-item">
            <div class="meal-icon">☀️</div>
            <div class="meal-info">
              <span class="meal-name">Lunch</span>
              <span class="meal-desc">Chicken, rice, salad</span>
            </div>
            <span class="meal-calories">740 kcal</span>
          </div>
          <div class="meal-item">
            <div class="meal-icon">🌙</div>
            <div class="meal-info">
              <span class="meal-name">Dinner</span>
              <span class="meal-desc">Salmon, vegetables</span>
            </div>
            <span class="meal-calories">680 kcal</span>
          </div>
          <div class="meal-item meal-add">
            <div class="meal-icon">➕</div>
            <span class="meal-name">Add meal</span>
          </div>
        </div>
      </div>

    </div>
  </div>
</template>

<style scoped>
.container {
  display: flex;
  justify-content: center;
  padding: 40px 24px;
}

.diet-plan {
  background: #ffffff;
  border-radius: 28px;
  padding: 36px;
  width: 100%;
  max-width: 680px;
  box-shadow: 0 8px 48px rgba(34, 120, 60, 0.12);
  border: 1.5px solid #d6eed9;
  display: flex;
  flex-direction: column;
  gap: 32px;
}

.diet-header {
  display: flex;
  justify-content: space-between;
  align-items: center;
}

.diet-title {
  font-size: 26px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0 0 4px 0;
}

.diet-date {
  font-size: 14px;
  color: #5a8a6a;
}

.diet-badge {
  background: #f0faf3;
  border: 1.5px solid #c8e6cc;
  color: #2e9e5b;
  font-size: 13px;
  font-weight: 600;
  padding: 6px 14px;
  border-radius: 999px;
}

.calories-main {
  display: flex;
  align-items: center;
  gap: 32px;
  background: #f6fdf7;
  border-radius: 20px;
  padding: 28px;
  border: 1.5px solid #e8f5ea;
}

.calories-circle {
  position: relative;
  width: 140px;
  height: 140px;
  flex-shrink: 0;
}

.calories-circle svg {
  width: 100%;
  height: 100%;
}

.calories-inner {
  position: absolute;
  top: 50%;
  left: 50%;
  transform: translate(-50%, -50%);
  display: flex;
  flex-direction: column;
  align-items: center;
}

.calories-value {
  font-size: 26px;
  font-weight: 700;
  color: #1a4d2e;
  line-height: 1;
}

.calories-label {
  font-size: 12px;
  color: #5a8a6a;
  font-weight: 500;
}

.calories-info {
  display: flex;
  flex-direction: column;
  gap: 12px;
  flex: 1;
}

.calories-title {
  font-size: 20px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0;
}

.calories-remaining {
  font-size: 14px;
  color: #5a8a6a;
  margin: 0;
}

.calories-meta {
  display: flex;
  gap: 16px;
  align-items: center;
}

.meta-item {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.meta-label {
  font-size: 11px;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  color: #a8cdb2;
  font-weight: 600;
}

.meta-value {
  font-size: 18px;
  font-weight: 700;
  color: #1a4d2e;
}

.meta-divider {
  width: 1px;
  height: 32px;
  background: #d6eed9;
}

.stats {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr;
  gap: 16px;
}

.stat-card {
  padding: 18px;
  border-radius: 16px;
  border: 1.5px solid #e8f5ea;
  background: #f6fdf7;
  display: flex;
  flex-direction: column;
  gap: 12px;
}

.stat-top {
  display: flex;
  align-items: center;
  gap: 10px;
}

.stat-icon {
  font-size: 24px;
  width: 40px;
  height: 40px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 10px;
  flex-shrink: 0;
}

.proteins-icon { background: #e8f5ee; }
.fats-icon     { background: #fef9e7; }
.carbs-icon    { background: #eaf2fb; }

.stat-info {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.stat-label {
  font-size: 11px;
  font-weight: 600;
  text-transform: uppercase;
  letter-spacing: 0.4px;
  color: #5a8a6a;
}

.stat-value {
  font-size: 18px;
  font-weight: 700;
  color: #1a4d2e;
}

.stat-total {
  font-size: 12px;
  font-weight: 400;
  color: #a8cdb2;
}

.progress-bar {
  width: 100%;
  height: 6px;
  background: #d6eed9;
  border-radius: 999px;
  overflow: hidden;
}

.progress-fill {
  height: 100%;
  border-radius: 999px;
}

.proteins-fill { background: #2e9e5b; }
.fats-fill     { background: #d4a017; }
.carbs-fill    { background: #3a7fd4; }

.meals-title {
  font-size: 18px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0 0 14px 0;
}

.meal-list {
  display: flex;
  flex-direction: column;
  gap: 10px;
}

.meal-item {
  display: flex;
  align-items: center;
  gap: 14px;
  padding: 14px 18px;
  border-radius: 14px;
  border: 1.5px solid #e8f5ea;
  background: #f6fdf7;
  transition: border-color 0.2s, transform 0.2s;
  cursor: pointer;
}

.meal-item:hover {
  border-color: #2e9e5b;
  transform: translateX(4px);
}

.meal-icon {
  font-size: 22px;
  width: 42px;
  height: 42px;
  display: flex;
  align-items: center;
  justify-content: center;
  background: #ffffff;
  border-radius: 10px;
  border: 1.5px solid #d6eed9;
  flex-shrink: 0;
}

.meal-info {
  display: flex;
  flex-direction: column;
  flex: 1;
}

.meal-name {
  font-size: 15px;
  font-weight: 600;
  color: #1a4d2e;
}

.meal-desc {
  font-size: 13px;
  color: #5a8a6a;
}

.meal-calories {
  font-size: 14px;
  font-weight: 700;
  color: #2e9e5b;
}

.meal-add {
  border-style: dashed;
  justify-content: center;
}

.meal-add .meal-name {
  color: #5a8a6a;
  font-weight: 500;
}
</style>