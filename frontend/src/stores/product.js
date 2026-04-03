import { defineStore } from 'pinia'
import api from "@/api.js"

export const useProductStore = defineStore('product', {
    state: () => ({
        products: []
    }),

    getters: {
    },

    actions: {
        async getProducts () {
            try {
                const serverData = await api.get('products')
                const data = serverData.data

                this.products = data.products

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        }
    },
})