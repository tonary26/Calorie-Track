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
        async getProducts(search = '') {
            try {
                const serverData = await api.get('products', {
                    params: { search }
                })
                const data = serverData.data

                this.products = data.products.data

                return data
            }
            catch (error) {
                console.log(error.message)
            }
        },

        async showProduct(id) {
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