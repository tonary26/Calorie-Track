import { defineStore } from 'pinia'
import api from "@/api.js"

export const useMealStore = defineStore('meal', {
    state: () => ({
        meals: [],
        meal: {}
    }),

    getters: {
    },

    actions: {
        async getMeals() {
            try {
                const serverData = await api.get('meals')
                const data = serverData.data

                this.meals = data.meals

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async showMeal(meal_id) {
            try {
                const serverData = await api.get(`/meals/${meal_id}`)
                const data = serverData.data

                this.meal = data.meal

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async addProductToMeal(meal_id, product_id, weight_gram) {
            try {
                const serverData = await api.post(`meals/${meal_id}/products`, {
                    meal_id,
                    product_id,
                    weight_gram
                })
                const data = serverData.data

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async deleteProductInMeal(meal_id, product_id) {
            try {
                await api.delete(`meals/${meal_id}/products/${product_id}`)

                if (this.meal && this.meal.products) {
                    this.meal.products = this.meal.products.filter(p => p.id !== product_id)
                }

                const mealIndex = this.meals.findIndex(m => m.id === meal_id)
                if (mealIndex !== -1) {
                    this.meals[mealIndex].products = this.meals[mealIndex].products.filter(p => p.id !== product_id)
                }
            }
            catch (error) {
                console.log(error.message)
            }
        }
    },
})