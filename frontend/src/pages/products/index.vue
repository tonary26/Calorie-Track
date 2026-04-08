<script setup>
import { useProductStore } from "@/stores/product.js"
import { onMounted } from "vue"

defineOptions({
  name: 'index'
})

const store = useProductStore()

onMounted(async () => {
  await store.getProducts()
})

</script>

<template>
  <div class="container">

    <div class="catalog-header">
      <h1 class="catalog-title">Products</h1>
      <div class="catalog-search">
        <span class="search-icon">🔍</span>
        <input class="search-input" type="text" placeholder="Search products...">
      </div>
    </div>

    <div class="products">

      <div v-for="product in store.products" :key="product.id"
          class="product-card">
        <div class="product-emoji">🍗</div>
        <div class="product-info">
          <span class="product-name">{{ product.name }}</span>
        </div>
        <div class="product-macros">
          <div class="macro">
            <span class="macro-value">{{ product.calories }}</span>
            <span class="macro-label">kcal</span>
          </div>
          <div class="macro">
            <span class="macro-value">{{ product.proteins }}g</span>
            <span class="macro-label">protein</span>
          </div>
          <div class="macro">
            <span class="macro-value">{{ product.fats }}g</span>
            <span class="macro-label">fat</span>
          </div>
          <div class="macro">
            <span class="macro-value">{{ product.carbs }}g</span>
            <span class="macro-label">carbs</span>
          </div>
        </div>
        <router-link :to="{ name: 'products.show', params: { id: product.id } }"
            class="product-add">
          + Add
        </router-link>
      </div>

    </div>
  </div>
</template>

<style scoped>
.container {
  padding: 40px 48px;
  display: flex;
  flex-direction: column;
  gap: 28px;
  max-width: 1100px;
  width: 100%;
}

.catalog-header {
  display: flex;
  align-items: center;
  justify-content: space-between;
  gap: 20px;
}

.catalog-title {
  font-size: 32px;
  font-weight: 700;
  color: #1a4d2e;
  margin: 0;
}

.catalog-search {
  display: flex;
  align-items: center;
  gap: 10px;
  background: #ffffff;
  border: 1.5px solid #d6eed9;
  border-radius: 12px;
  padding: 10px 16px;
  width: 280px;
  box-shadow: 0 2px 12px rgba(34, 120, 60, 0.07);
}

.search-icon {
  font-size: 16px;
}

.search-input {
  border: none;
  outline: none;
  font-size: 15px;
  color: #1a4d2e;
  background: transparent;
  width: 100%;
}

.search-input::placeholder {
  color: #a8cdb2;
}

.products {
  display: grid;
  grid-template-columns: repeat(3, 1fr);
  gap: 16px;
}

.product-card {
  background: #ffffff;
  border: 1.5px solid #d6eed9;
  border-radius: 20px;
  padding: 20px;
  display: flex;
  flex-direction: column;
  gap: 14px;
  box-shadow: 0 2px 16px rgba(34, 120, 60, 0.07);
  transition: transform 0.2s, box-shadow 0.2s, border-color 0.2s;
}

.product-card:hover {
  transform: translateY(-4px);
  box-shadow: 0 8px 28px rgba(34, 120, 60, 0.14);
  border-color: #2e9e5b;
}

.product-emoji {
  font-size: 40px;
  background: #f6fdf7;
  width: 64px;
  height: 64px;
  display: flex;
  align-items: center;
  justify-content: center;
  border-radius: 14px;
  border: 1.5px solid #e8f5ea;
}

.product-info {
  display: flex;
  flex-direction: column;
  gap: 2px;
}

.product-name {
  font-size: 17px;
  font-weight: 700;
  color: #1a4d2e;
}

.product-macros {
  display: grid;
  grid-template-columns: 1fr 1fr 1fr 1fr;
  gap: 8px;
  background: #f6fdf7;
  border-radius: 12px;
  padding: 10px;
  border: 1.5px solid #e8f5ea;
}

.macro {
  display: flex;
  flex-direction: column;
  align-items: center;
  gap: 2px;
}

.macro-value {
  font-size: 14px;
  font-weight: 700;
  color: #1a4d2e;
}

.macro-label {
  font-size: 10px;
  color: #a8cdb2;
  font-weight: 500;
  text-transform: uppercase;
  letter-spacing: 0.3px;
}

.product-add {
  padding: 10px;
  border-radius: 10px;
  border: none;
  background: #058505;
  color: #ffffff;
  font-size: 14px;
  font-weight: 600;
  cursor: pointer;
  text-decoration: none;
  transition: background 0.2s, transform 0.1s;
}

.product-add:hover {
  background: #046a04;
}

.product-add:active {
  transform: scale(0.97);
}
</style>