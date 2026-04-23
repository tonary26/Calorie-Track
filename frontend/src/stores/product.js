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
        },

        async addProduct(formData) {
            try {
                const serverData = await api.post('products', formData)
                const data = serverData.data

                return data
            }
            catch(error) {
                console.log(error.message)
            }
        },

        async updateProduct(id, formData) {
            try {
                const serverData = await api.patch(`products/${id}`, formData )
                const data = serverData.data

                this.product = data.product
            }
            catch(error) {
                console.log(error.message)
            }
        },

        async deleteProduct(id) {
            try {
                api.delete(`products/${id}`)

                const index = this.products.findIndex(p => p.id === id)
                if (index !== -1) {
                    this.products = this.products.filter(p => p.id !== id)
                }
            }
            catch(error) {
                console.log(error.message)
            }
        }
    },
})