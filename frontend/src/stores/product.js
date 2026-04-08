import { defineStore } from 'pinia'
import api from "@/api.js"

export const useProductStore = defineStore('product', {
    state: () => ({
        products: [],
        product: {}
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
        },

        async showProduct (id) {
            try {
                const serverData = await api.get(`products/${id}`)
                const data = serverData.data

                this.product = data.product

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        }
    },
})