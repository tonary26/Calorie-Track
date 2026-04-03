<script setup>
import { useRouter } from 'vue-router'
import { reactive } from "vue"

defineOptions({
  name: 'index'
})

const router = useRouter()

const form = reactive({
  name: '',
  email: '',
  weight: '',
  height: '',
  age: '',
  sex: '',
  password: ''
})

const sexes = [
  { value: 'man', name: 'man'},
  { value: 'woman', name: 'woman'}
]

const nextStage = function () {
  if (Object.values(form).some(value => !value)) {
    alert('Fill in the missing fields.')
    return
  }

  localStorage.setItem('registerData', JSON.stringify(form))

  router.push({
    name: 'auth.register.activity_level'
  })
}
</script>

<template>
  <div class="main">
    <div class="form-wrapper">
      <div class="form">
        <h2 class="form-title">Register</h2>

        <div class="input-wrapper">
          <label for="name" class="label">Username</label>
          <input v-model="form.name"
              class="input"
              id="name"
              name="name"
              type="text"
              placeholder="Enter username">
        </div>

        <div class="input-wrapper">
          <label for="email" class="label">Email</label>
          <input v-model="form.email"
              class="input"
              id="email"
              name="email"
              type="email"
              placeholder="example@gamil.com">
        </div>

        <div class="input-wrapper">
          <label for="weight" class="label">Weight</label>
          <input v-model="form.weight"
              class="input"
              id="weight"
              name="weight"
              type="number"
              placeholder="kg">
        </div>

        <div class="input-wrapper">
          <label for="height" class="label">Height</label>
          <input v-model="form.height"
              class="input"
              id="height"
              name="height"
              type="number"
              placeholder="cm">
        </div>

        <div class="input-wrapper">
          <label for="age" class="label">Age</label>
          <input v-model="form.age"
              class="input"
              id="age"
              name="age"
              type="number"
              placeholder="years">
        </div>

        <div class="input-wrapper">
          <label for="sex" class="label">Sex</label>
          <select v-model="form.sex"
                  class="input"
                  id="sex"
                  name="sex">
            <option value="">Select...</option>
            <option v-for="sex in sexes"
                    :value="sex.value">
              {{ sex.name }}
            </option>
          </select>
        </div>

        <div class="input-wrapper">
          <label for="password" class="label">password</label>
          <input v-model="form.password"
              class="input"
              id="password"
              name="password"
              type="password"
              placeholder="Enter password..">
        </div>

        <button @click="nextStage()" class="btn">Next</button>
      </div>
    </div>
  </div>
</template>

<style scoped>

.main {
  margin-top: 100px;
}

.form-wrapper {
  display: flex;
  align-items: center;
  justify-content: center;
}

.form {
  background: #ffffff;
  border-radius: 20px;
  padding: 40px 36px;
  width: 400px;
  display: flex;
  flex-direction: column;
  gap: 20px;
  box-shadow: 0 4px 32px rgba(34, 120, 60, 0.10);
  border: 1.5px solid #d6eed9;
}

.form-title {
  font-size: 22px;
  font-weight: 600;
  color: #1a4d2e;
  margin: 0 0 4px 0;
  letter-spacing: -0.3px;
}

.input-wrapper {
  display: flex;
  flex-direction: column;
  gap: 6px;
}

.label {
  font-size: 13px;
  font-weight: 500;
  color: #3a7d52;
  letter-spacing: 0.3px;
  text-transform: uppercase;
}

.input {
  padding: 11px 14px;
  border-radius: 10px;
  border: 1.5px solid #c8e6cc;
  background: #f6fdf7;
  font-size: 15px;
  font-family: 'DM Sans', sans-serif;
  color: #1a4d2e;
  outline: none;
  transition: border-color 0.2s, box-shadow 0.2s, background 0.2s;
  appearance: none;
  -webkit-appearance: none;
}

.input::placeholder {
  color: #a8cdb2;
}

.input:focus {
  border-color: #2e9e5b;
  background: #ffffff;
  box-shadow: 0 0 0 3px rgba(46, 158, 91, 0.13);
}

.btn {
  margin-top: 6px;
  padding: 13px;
  border-radius: 10px;
  border: none;
  background: #058505;
  color: #ffffff;
  font-size: 15px;
  font-weight: 600;
  font-family: 'DM Sans', sans-serif;
  cursor: pointer;
  letter-spacing: 0.2px;
  transition: background 0.2s, transform 0.1s, box-shadow 0.2s;
  box-shadow: 0 2px 12px rgba(46, 158, 91, 0.25);
}

.btn:hover {
  background: #025602;
  box-shadow: 0 4px 18px rgba(46, 158, 91, 0.35);
}

.btn:active {
  transform: scale(0.98);
}
</style>