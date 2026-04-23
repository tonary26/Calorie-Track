<script setup>
import { useProductStore } from "@/stores/product.js"
import { onMounted, reactive, ref, watch } from "vue"

defineOptions({
  name: 'products'
})

const store = useProductStore()

const isOpenCreateModuleWindow = ref(false)
const isOpenUpdateModuleWindow = ref(false)

const selectedProduct = ref(null)

const search = ref('')
let timeOut = null

const formData = reactive({
  name: '',
  calories: '',
  proteins: '',
  fats: '',
  carbs: ''
})

const resetForm = function () {
  formData.name = ''
  formData.calories = ''
  formData.proteins = ''
  formData.fats = ''
  formData.carbs = ''
}

const openCreateModuleWindow = function () {
  isOpenCreateModuleWindow.value = true
  resetForm()
}

const addProduct = async function () {
  isOpenCreateModuleWindow.value = false

  await store.addProduct(formData)
  await store.getProducts()
}

const openUpdateModuleWindow = function (product) {
  selectedProduct.value = product.id

  formData.name = product.name
  formData.calories = product.calories
  formData.proteins = product.proteins
  formData.fats = product.fats
  formData.carbs = product.carbs

  isOpenUpdateModuleWindow.value = true
}

const updateProduct = async function () {
  await store.updateProduct(selectedProduct.value, formData)

  isOpenUpdateModuleWindow.value = false
  await store.getProducts()
}

const deleteProduct = async function (id) {
  await store.deleteProduct(id)

  await store.getProducts()
}

watch(search, (newValue) => {
  clearTimeout(timeOut)

  timeOut = setTimeout(async () => {
    await store.getProducts(newValue)
  }, 500)
})

onMounted(async () => {
  await store.getProducts()
})

</script>

<template>
  <div class="page">

    <div class="page-header">
      <div>
        <h1 class="page-title">Products</h1>
        <span class="page-subtitle">Manage all products in the catalog</span>
      </div>
      <button @click="openCreateModuleWindow()" class="add-btn">+ Add Product</button>
    </div>

    <div class="table-wrapper">
      <div class="table-header">
        <div class="search-box">
          <span>🔍</span>
          <input v-model="search" type="text" placeholder="Search products..." class="search-input">
        </div>
      </div>

      <table class="table">
        <thead>
        <tr>
          <th>ID</th>
          <th>Name</th>
          <th>Calories</th>
          <th>Proteins</th>
          <th>Fats</th>
          <th>Carbs</th>
          <th>Actions</th>
        </tr>
        </thead>
        <tbody>
        <tr v-for="product in store.products" :key="product.id">
          <td class="td-id">#{{ product.id }}</td>
          <td><span class="product-name">{{ product.name }}</span></td>
          <td class="td-macro td-calories">{{ product.calories }} kcal</td>
          <td class="td-macro td-proteins">{{ product.proteins }}g</td>
          <td class="td-macro td-fats">{{ product.fats }}g</td>
          <td class="td-macro td-carbs">{{ product.carbs }}g</td>
          <td>
            <div class="actions">
              <button @click="openUpdateModuleWindow(product)" class="action-btn edit">✏️</button>
              <button @click="deleteProduct(product.id)" class="action-btn delete">🗑️</button>
            </div>
          </td>
        </tr>
        </tbody>
      </table>

      <div class="table-footer">
        <span class="table-count">Showing 6 of 6 products</span>
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

  <div v-if="isOpenCreateModuleWindow === true" class="modal-overlay">
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Add Product</h2>
        <button @click="isOpenCreateModuleWindow = false" class="modal-close">✕</button>
      </div>

      <div class="modal-body">
        <div class="input-wrapper">
          <label class="label">Name</label>
          <input v-model="formData.name" class="input" type="text" placeholder="e.g. Chicken Breast">
        </div>

        <div class="input-row">
          <div class="input-wrapper">
            <label class="label">Calories(by 100g)</label>
            <input v-model="formData.calories" class="input" type="number" placeholder="kcal">
          </div>
          <div class="input-wrapper">
            <label class="label">Proteins(by 100g)</label>
            <input v-model="formData.proteins" class="input" type="number" placeholder="g">
          </div>
        </div>

        <div class="input-row">
          <div class="input-wrapper">
            <label class="label">Fats(by 100g)</label>
            <input v-model="formData.fats" class="input" type="number" placeholder="g">
          </div>
          <div class="input-wrapper">
            <label class="label">Carbs(by 100g)</label>
            <input v-model="formData.carbs" class="input" type="number" placeholder="g">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="isOpenCreateModuleWindow = false" class="cancel-btn">Cancel</button>
        <button @click="addProduct()" class="submit-btn">Add Product</button>
      </div>
    </div>
  </div>

  <div v-if="isOpenUpdateModuleWindow === true" class="modal-overlay">
    <div class="modal">
      <div class="modal-header">
        <h2 class="modal-title">Update Product</h2>
        <button @click="isOpenUpdateModuleWindow = false" class="modal-close">✕</button>
      </div>

      <div class="modal-body">
        <div class="input-wrapper">
          <label class="label">Name</label>
          <input v-model="formData.name" class="input" type="text" placeholder="e.g. Chicken Breast">
        </div>

        <div class="input-row">
          <div class="input-wrapper">
            <label class="label">Calories(by 100g)</label>
            <input v-model="formData.calories" class="input" type="number" placeholder="kcal">
          </div>
          <div class="input-wrapper">
            <label class="label">Proteins(by 100g)</label>
            <input v-model="formData.proteins" class="input" type="number" placeholder="g">
          </div>
        </div>

        <div class="input-row">
          <div class="input-wrapper">
            <label class="label">Fats(by 100g)</label>
            <input v-model="formData.fats" class="input" type="number" placeholder="g">
          </div>
          <div class="input-wrapper">
            <label class="label">Carbs(by 100g)</label>
            <input v-model="formData.carbs" class="input" type="number" placeholder="g">
          </div>
        </div>
      </div>

      <div class="modal-footer">
        <button @click="isOpenUpdateModuleWindow = false" class="cancel-btn">Cancel</button>
        <button @click="updateProduct()" class="submit-btn">Update Product</button>
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

.search-input::placeholder { color: #a8cdb2; }

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
  white-space: nowrap;
  vertical-align: middle;
  overflow: hidden;
  text-overflow: ellipsis;
}

.td-id { font-size: 12px; color: #a8cdb2; font-weight: 600; }
.td-emoji { font-size: 22px; }
.product-name { font-weight: 600; }

.badge {
  padding: 3px 10px;
  border-radius: 999px;
  font-size: 12px;
  font-weight: 600;
}

.badge-category { background: #f0faf3; color: #2e9e5b; }

.td-macro { font-weight: 600; font-size: 13px; }
.td-calories { color: #e05c2a; }
.td-proteins { color: #2e9e5b; }
.td-fats     { color: #d4a017; }
.td-carbs    { color: #3a7fd4; }

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
.pagination { display: flex; gap: 6px; }

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

.page-btn:hover:not(:disabled) { border-color: #2e9e5b; color: #2e9e5b; }
.page-btn.active { background: #2e9e5b; border-color: #2e9e5b; color: #ffffff; }
.page-btn:disabled { opacity: 0.4; cursor: not-allowed; }

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

.modal-close:hover {
  background: #fff5f0;
  border-color: #e05c2a;
  color: #e05c2a;
}

.modal-body {
  display: flex;
  flex-direction: column;
  gap: 16px;
}

.input-row {
  display: grid;
  grid-template-columns: 1fr 1fr;
  gap: 12px;
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

.cancel-btn:hover {
  border-color: #a8cdb2;
  color: #1a4d2e;
}

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