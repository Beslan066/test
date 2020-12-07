<template>
     <div class="card m-2">
            <div class="card-header">{{title}} - {{price}}</div>

            <div class="card-body">
                        {{description}}
            </div>

             <div class="card-footer">
                        <button class="btn btn-primary" v-on:click="onClick">+</button>
            </div>
    </div>
</template>

<script>
    export default {
        props: {
            product: {
                type: Object,
                required: true,
                default: "",
            },
            title: {
                type: String,
                required: true,
                default: "",
            },

            description: {
                type: String,
                required: true,
                default: "",
            },

            price: {
                type: Number,
                required: true,
                default: "",
            },

             addCart: {
                type: Function,
                required: true,
                default: "",
            },
            
        },
        methods: {
            onClick() {
                this.addCart(this.product)
            }
        }
    }
</script>
