<script setup>
import { useRouter, useRoute } from "vue-router"
import { useProductStore } from "@/stores/product.js"
import { onMounted, ref, reactive } from "vue"
import { useMealStore } from "@/stores/meal.js"

defineOptions({
  name: 'show'
})

const router = useRouter()
const route = useRoute()

const productStore = useProductStore()
const mealStore = useMealStore()

const gram = ref(100)

const formData = reactive({
  meal_id: '',
  product_id: '',
  weight_gram: gram.value
})

const increaseGram = function () {
  gram.value += 100
}

const decreaseGram = function () {
  if (gram.value < 1) {
    return
  }
  gram.value -= 100
}

const returnBack = function () {
  router.back()
}

const addProductToMeal = async function () {
  if (!formData.meal_id) {
    return
  }

  await mealStore.addProductToMeal(formData.meal_id, route.params.id, gram.value)

  router.push({
    name: 'nutrition.index'
  })
}

onMounted(async () => {
  await productStore.showProduct(route.params.id)
  await mealStore.getMeals()
})

</script>

<template>
  <div class="container">
    <div class="product-header">
      <button
          @click="returnBack()"
          class="back-btn">← Back</button>
    </div>

    <div class="product">
      <div class="product-main">
        <div class="product-emoji">🍗</div>
        <div class="product-info">
          <h1 class="product-name">{{ productStore.product.name }}</h1>
        </div>
      </div>

      <div class="macros">
        <div class="macro-card calories">
          <span class="macro-icon">🔥</span>
          <span class="macro-value">{{ productStore.product.calories }}</span>
          <span class="macro-label">kcal</span>
        </div>
        <div class="macro-card proteins">
          <span class="macro-icon">🥩</span>
          <span class="macro-value">{{ productStore.product.proteins }}g</span>
          <span class="macro-label">Protein</span>
        </div>
        <div class="macro-card fats">
          <span class="macro-icon">🥑</span>
          <span class="macro-value">{{ productStore.product.fats }}g</span>
          <span class="macro-label">Fat</span>
        </div>
        <div class="macro-card carbs">
          <span class="macro-icon">🌾</span>
          <span class="macro-value">{{ productStore.product.carbs }}g</span>
          <span class="macro-label">Carbs</span>
        </div>
      </div>

      <div class="serving">
        <h3 class="section-title">Serving size</h3>
        <div class="serving-controls">
          <button
              @click="decreaseGram()"
              class="serving-btn">−</button>
          <div class="serving-input">
            <input class="serving-value"
                   min="1"
                   v-model.number="gram"
                   :style="{ width: gram.toString().length + 'ch' }">
            <span class="serving-unit">g</span>
          </div>
          <button
              @click="increaseGram()"
              class="serving-btn">+</button>
        </div>
      </div>

      <div class="serving">
        <h3 class="section-title">Meal</h3>
        <select v-model="formData.meal_id"
            class="meal-select">
          <option value="">Select meal...</option>
          <option v-for="meal in mealStore.meals"
                  :key="meal.id"
                  :value="meal.id">
            {{ meal.type }}
          </option>
        </select>
      </div>

      <button @click="addProductToMeal()" class="add-btn">+ Add to meal</button>
    </div>
  </div>
</template>

<style scoped>
  .container {
    padding: 40px 48px;
    display: flex;
    flex-direction: column;
    gap: 24px;
    max-width: 720px;
    width: 100%;
  }

  .back-btn {
    background: none;
    border: 1.5px solid #d6eed9;
    border-radius: 10px;
    padding: 8px 16px;
    font-size: 14px;
    color: #5a8a6a;
    cursor: pointer;
    transition: all 0.2s;
  }

  .back-btn:hover {
    border-color: #2e9e5b;
    color: #2e9e5b;
  }

  .product {
    background: #ffffff;
    border: 1.5px solid #d6eed9;
    border-radius: 28px;
    padding: 36px;
    display: flex;
    flex-direction: column;
    gap: 32px;
    box-shadow: 0 8px 48px rgba(34, 120, 60, 0.10);
  }

  .product-main {
    display: flex;
    gap: 24px;
    align-items: flex-start;
  }

  .product-emoji {
    font-size: 56px;
    background: #f6fdf7;
    width: 96px;
    height: 96px;
    display: flex;
    align-items: center;
    justify-content: center;
    border-radius: 20px;
    border: 1.5px solid #e8f5ea;
    flex-shrink: 0;
  }

  .product-info {
    display: flex;
    flex-direction: column;
    gap: 6px;
  }

  .product-name {
    font-size: 30px;
    font-weight: 700;
    color: #1a4d2e;
    margin: 0;
  }

  .macros {
    display: grid;
    grid-template-columns: repeat(4, 1fr);
    gap: 12px;
  }

  .macro-card {
    display: flex;
    flex-direction: column;
    align-items: center;
    gap: 4px;
    padding: 16px 10px;
    border-radius: 16px;
    border: 1.5px solid #e8f5ea;
  }

  .macro-icon { font-size: 20px; }

  .macro-value {
    font-size: 22px;
    font-weight: 700;
    color: #1a4d2e;
  }

  .macro-label {
    font-size: 11px;
    font-weight: 600;
    text-transform: uppercase;
    letter-spacing: 0.4px;
    color: #a8cdb2;
  }

  .calories { background: #fff5f0; border-color: #fdd9c8; }
  .proteins { background: #f0faf3; border-color: #c8e6cc; }
  .fats     { background: #fefce8; border-color: #fde68a; }
  .carbs    { background: #eff6ff; border-color: #bfdbfe; }

  .section-title {
    font-size: 16px;
    font-weight: 700;
    color: #1a4d2e;
    margin: 0 0 14px 0;
  }

  .serving-controls {
    display: flex;
    align-items: center;
    gap: 16px;
  }

  .serving-btn {
    width: 40px;
    height: 40px;
    border-radius: 10px;
    border: 1.5px solid #d6eed9;
    background: #f6fdf7;
    font-size: 20px;
    color: #2e9e5b;
    cursor: pointer;
    transition: all 0.2s;
    display: flex;
    align-items: center;
    justify-content: center;
  }

  .serving-btn:hover {
    background: #046a04;
    color: #ffffff;
    border-color: #2e9e5b;
  }

  .serving-input {
    display: flex;
    align-items: baseline;
    gap: 4px;
  }

  .serving-value {
    font-size: 28px;
    font-weight: 700;
    color: #1a4d2e;
    border: #1e9710 1px solid;
  }

  .serving-unit {
    font-size: 16px;
    color: #5a8a6a;
  }

  .meal-select {
    padding: 11px 14px;
    border-radius: 10px;
    border: 1.5px solid #c8e6cc;
    background: #f6fdf7;
    font-size: 15px;
    color: #1a4d2e;
    outline: none;
    cursor: pointer;
    width: 100%;
    appearance: none;
    -webkit-appearance: none;
    transition: border-color 0.2s, box-shadow 0.2s;
  }

  .meal-select:focus {
    border-color: #2e9e5b;
    box-shadow: 0 0 0 3px rgba(46, 158, 91, 0.13);
  }

  .add-btn {
    padding: 14px;
    border-radius: 12px;
    border: none;
    background: #058505;
    color: #ffffff;
    font-size: 16px;
    font-weight: 600;
    cursor: pointer;
    transition: background 0.2s, transform 0.1s;
    box-shadow: 0 2px 12px rgba(46, 158, 91, 0.25);
  }

  .add-btn:hover {
    background: #046a04;
  }

  .add-btn:active {
    transform: scale(0.98);
  }
</style>