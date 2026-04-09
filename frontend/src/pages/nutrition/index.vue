<script setup>
import { useAuthStore } from "@/stores/auth.js"
import { useMealStore } from "@/stores/meal.js"
import { useRouter } from "vue-router"
import { onMounted, computed, ref } from "vue"

defineOptions({
  name: 'index'
})

const getDate = new Date().toLocaleString('en-US', {
  weekday: 'long',
  day: 'numeric',
  month: 'long'
})

const authStore = useAuthStore()
const mealStore = useMealStore()

const router = useRouter()

const isOpenModuleWindow = ref(false)

const addMeal = function () {
  router.push({
    'name': 'products.index'
  })
}

const getMealCalories = function (meal) {
  if (!meal.products || meal.products.length === 0) {
    return 0
  }

  const totalMealCalories = meal.products.reduce((sum, product) => {
    return sum + (product.calories * product.pivot.weight_gram / 100)
  }, 0)

  return Math.round(totalMealCalories)
}

const getTotalCalories = computed (() => {
  return mealStore.meals.reduce((total, meal) => {
    return total + getMealCalories(meal)
  }, 0)
})

const caloriesLeft = computed(() => {
  return authStore.user.daily_calories - getTotalCalories.value
})

const getTotalProteins = computed(() => {
  const total = mealStore.meals.reduce((allMealsSum, meal) => {
    const mealProteins = meal.products.reduce((productSum, product) => {
      return productSum + (product.proteins * product.pivot.weight_gram / 100)
    }, 0)

    return allMealsSum + mealProteins
  }, 0)

  return Math.round(total)
})

const getTotalFats = computed(() => {
  const total = mealStore.meals.reduce((allMealsSum, meal) => {
    const mealProteins = meal.products.reduce((productSum, product) => {
      return productSum + (product.fats * product.pivot.weight_gram / 100)
    }, 0)

    return allMealsSum + mealProteins
  }, 0)

  return Math.round(total)
})

const getTotalCarbs = computed(() => {
  const total = mealStore.meals.reduce((allMealsSum, meal) => {
    const mealProteins = meal.products.reduce((productSum, product) => {
      return productSum + (product.carbs * product.pivot.weight_gram / 100)
    }, 0)

    return allMealsSum + mealProteins
  }, 0)

  return Math.round(total)
})

const getMealDetails = async function (meal_id) {
  mealStore.meal = {}

  isOpenModuleWindow.value = true

  await mealStore.showMeal(meal_id)
}

const getProductCalories = function (product) {
  const total = product.calories * product.pivot.weight_gram / 100

  return Math.round(total)
}

const deleteProductInMeal = async function (meal_id, product_id) {
  await mealStore.deleteProductInMeal(meal_id, product_id)
}

const circleOffset = computed(() => {
  const goal = authStore.user.daily_calories
  const eaten = getTotalCalories.value

  const percentage = Math.min(eaten / goal, 1)

  return 326.7 * (1 - percentage)
})

const progressColor = computed(() => {
  const percentage = getTotalCalories.value / authStore.user.daily_calories

  if (percentage > 1) {
    return '#e74c3c'
  }

  if (percentage > 0.8) {
    return '#f1c40f'
  }

  return '#2e9e5b';
})

const proteinsOffset = computed(() => {
  const goal = authStore.user.daily_macros.proteins
  const eaten = getTotalProteins.value

  if (!goal) {
    return '0%'
  }

  const percentage = (goal * eaten) * 100

  return Math.min(percentage, 100) + '%'
})

const proteinsProgressColor = computed(() => {
  const percentage = getTotalProteins.value > authStore.user.daily_macros.proteins

  if (percentage) {
    return '#e74c3c'
  }
  else {
    return '#2e9e5b'
  }
})

const fatsOffset = computed(() => {
  const goal = authStore.user.daily_macros.fats
  const eaten = getTotalFats.value

  if (!goal) {
    return '0%'
  }

  const percentage = (goal * eaten) * 100

  return Math.min(percentage, 100) + '%'
})

const fatsProgressColor = computed(() => {
  const percentage = getTotalFats.value > authStore.user.daily_macros.fats

  if (percentage) {
    return '#e74c3c'
  }
  else {
    return '#D4A017FF'
  }
})

const carbsOffset = computed(() => {
  const goal = authStore.user.daily_macros.carbs
  const eaten = getTotalCarbs.value

  if (!goal) {
    return '0%'
  }

  const percentage = (goal * eaten) * 100

  return Math.min(percentage, 100) + '%'
})

const carbsProgressColor = computed(() => {
  const percentage = getTotalCarbs.value > authStore.user.daily_macros.carbs

  if (percentage) {
    return '#e74c3c'
  }
  else {
    return '#2e9e5b'
  }
})

onMounted(async () => {
  await mealStore.getMeals()
})

</script>

<template>
  <div class="container">
    <div class="diet-plan">

      <div class="diet-header">
        <div>
          <h2 class="diet-title">Today's Nutrition</h2>
          <span class="diet-date">{{ getDate }}</span>
        </div>
        <div class="diet-badge">Calorie Track</div>
      </div>

      <div class="calories-main">
        <div class="calories-circle">
          <svg viewBox="0 0 120 120">
            <circle cx="60" cy="60" r="52" fill="none" stroke="#d6eed9" stroke-width="10"/>
            <circle cx="60" cy="60" r="52" fill="none" :stroke="progressColor" stroke-width="10"
                    stroke-dasharray="326.7"
                    :stroke-dashoffset="circleOffset"
                    stroke-linecap="round" transform="rotate(-90 60 60)"/>
          </svg>
          <div class="calories-inner">
            <span class="calories-value">{{ getTotalCalories }}</span>
            <span class="calories-label">kcal</span>
          </div>
        </div>
        <div class="calories-info">
          <h3 class="calories-title">Calories</h3>
          <p class="calories-remaining">{{ caloriesLeft }} kcal remaining</p>
          <div class="calories-meta">
            <div class="meta-item">
              <span class="meta-label">Goal</span>
              <span class="meta-value">{{ authStore.user.daily_calories }}</span>
            </div>
            <div class="meta-divider"></div>
            <div class="meta-item">
              <span class="meta-label">Eaten</span>
              <span class="meta-value">{{ getTotalCalories }}</span>
            </div>
            <div class="meta-divider"></div>
            <div class="meta-item">
              <span class="meta-label">Left</span>
              <span class="meta-value">{{ caloriesLeft }}</span>
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
              <span class="stat-value">{{ getTotalProteins }}<span class="stat-total">/{{ authStore.user.daily_macros.proteins }}g</span></span>
            </div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill proteins-fill" :style="{
              width: proteinsOffset,
              backgroundColor: proteinsProgressColor
            }"></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon fats-icon">🥑</div>
            <div class="stat-info">
              <span class="stat-label">Fats</span>
              <span class="stat-value">{{ getTotalFats }}<span class="stat-total">/{{ authStore.user.daily_macros.fats }}g</span></span>
            </div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill fats-fill" :style="{
              width: fatsOffset,
              backgroundColor: fatsProgressColor
            }"></div>
          </div>
        </div>

        <div class="stat-card">
          <div class="stat-top">
            <div class="stat-icon carbs-icon">🌾</div>
            <div class="stat-info">
              <span class="stat-label">Carbs</span>
              <span class="stat-value">{{ getTotalCarbs }}<span class="stat-total">/{{ authStore.user.daily_macros.carbs }}g</span></span>
            </div>
          </div>
          <div class="progress-bar">
            <div class="progress-fill carbs-fill" :style="{
              width: carbsOffset,
              backgroundColor: carbsProgressColor
            }"></div>
          </div>
        </div>
      </div>

      <div class="meals">
        <h3 class="meals-title">Meals</h3>
        <div class="meal-list">
          <div v-for="meal in mealStore.meals"
              :key="meal.id"
               @click="getMealDetails(meal.id)"
              class="meal-item">
            <div class="meal-info">
              <span class="meal-name">{{ meal.type }}</span>
              <div class="meal-products">
                <span v-for="product in meal.products"
                      :key="product.id"
                      class="meal-desc">
                  {{ product.name }}
                </span>
              </div>
            </div>
            <span class="meal-calories">{{ getMealCalories(meal) }}kcal</span>
          </div>
          <div @click="addMeal()"
              class="meal-item meal-add">
            <div class="meal-icon">➕</div>
            <span class="meal-name">Add meal</span>
          </div>
        </div>
      </div>

      <div v-if="isOpenModuleWindow === true" class="modal-overlay">
        <div class="modal-content">
          <div class="modal-header">
            <h3 class="modal-title">{{ mealStore.meal.type }} Details</h3>
            <button @click="isOpenModuleWindow = false"
                    class="close-btn">
              &times;
            </button>
          </div>
          <div class="modal-body">
            <div class="product-list">
              <div v-for="product in mealStore.meal.products"
                   :key="product.id"
                  class="product-item">
                <div class="product-info">
                  <span class="product-name">{{ product.name }}</span>
                  <span class="product-weight">{{ product.pivot.weight_gram }}g — {{ getProductCalories(product) }} kcal</span>
                </div>
                <button @click="deleteProductInMeal(mealStore.meal.id, product.id)"
                        class="delete-product-btn">
                  <span class="trash-icon">
                    🗑️
                  </span>
                </button>
              </div>
            </div>
          </div>
          <div class="modal-footer">
            <div class="total-summary">
              <span>Total: <strong>{{ getMealCalories(mealStore.meal) }} kcal</strong></span>
            </div>
            <button
                @click="isOpenModuleWindow = false"
                class="btn-confirm">
              Done
            </button>
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

  circle {
    transition: stroke-dashoffset 0.5s ease, stroke 0.5s ease;
  }

  .progress-fill {
    transition: width 0.5s ease, background-color 0.5s ease;
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

  .meal-products {
    display: flex;
    flex-wrap: wrap;
    gap: 6px;
    margin-top: 4px;
  }

  .meal-desc {
    font-size: 12px;
    color: #4a7556;
    background: #e8f5ea;
    padding: 3px 8px;
    border-radius: 6px;
    font-weight: 500;
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

  /* Затемнение фона */
  .modal-overlay {
    position: fixed;
    top: 0;
    left: 0;
    width: 100%;
    height: 100%;
    background: rgba(26, 77, 46, 0.4);
    display: flex;
    justify-content: center;
    align-items: center;
    z-index: 1000;
    backdrop-filter: blur(4px);
  }

  .modal-content {
    background: white;
    width: 90%;
    max-width: 450px;
    border-radius: 24px;
    padding: 24px;
    box-shadow: 0 20px 40px rgba(0,0,0,0.2);
    border: 1px solid #d6eed9;
  }

  .modal-header {
    display: flex;
    justify-content: space-between;
    align-items: center;
    margin-bottom: 20px;
  }

  .modal-title {
    font-size: 20px;
    color: #1a4d2e;
    margin: 0;
  }

  .close-btn {
    background: none;
    border: none;
    font-size: 24px;
    color: #5a8a6a;
    cursor: pointer;
  }

  .product-list {
    display: flex;
    flex-direction: column;
    gap: 12px;
  }

  .product-item {
    display: flex;
    justify-content: space-between;
    align-items: center;
    padding: 12px 16px;
    background: #f6fdf7;
    border-radius: 14px;
    border: 1px solid #e8f5ea;
  }

  .product-name {
    display: block;
    font-weight: 600;
    color: #1a4d2e;
    font-size: 14px;
  }

  .product-weight {
    font-size: 12px;
    color: #5a8a6a;
  }

  .delete-product-btn {
    background: #fff0f0;
    border: 1px solid #ffdada;
    padding: 8px;
    border-radius: 10px;
    cursor: pointer;
    transition: all 0.2s;
  }

  .delete-product-btn:hover {
    background: #ffe5e5;
    transform: scale(1.05);
  }

  .trash-icon {
    font-size: 14px;
  }

  .modal-footer {
    margin-top: 24px;
    display: flex;
    justify-content: space-between;
    align-items: center;
  }

  .total-summary {
    color: #1a4d2e;
    font-size: 15px;
  }

  .btn-confirm {
    background: #2e9e5b;
    color: white;
    border: none;
    padding: 10px 24px;
    border-radius: 12px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s;
  }

  .btn-confirm:hover {
    background: #248a4d;
  }
</style>