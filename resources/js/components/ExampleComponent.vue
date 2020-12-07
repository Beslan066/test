<template>
    <div class="container-fluid">
        <div class="row justify-content-start">
            <div class="col-md-3" v-for="product in products" v-bind:key='product.id'>
               <card-component 
                :title="product.title" 
                :description="product.description" 
                :price="product.price" 
                :product="product"
                :addCart="addCart">
               </card-component>
            </div>

        </div>
        <hr>     

         <div>
            <h3>Корзина</h3>    
            
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Title</th>
                        <th>Price</th>
                        <th></th>
                    </tr>
                </thead>

                <tbody>
                    <tr v-for="item in Object.values(cart)" v-bind:key='"cart-" + item.id'>
                        <td>
                            {{item.id}}
                        </td>
                        <td>
                            {{item.title}}
                        </td>

                        <td>
                            {{item.price}}
                        </td>

                        <td>
                            <a href="javascript:;" v-on:click="removeElement(item.id)">Delete</a>
                        </td>
                    </tr>
                </tbody>
            </table>

            <button class="btn btn-info m-2" v-on:click="sendToTelegram">
                Заказать
            </button>
        </div>   
    </div>
</template>

<script>
    import CardComponent from './CardComponent';
    export default {
        components: {
            CardComponent
        },
        data() {
            return {
                products: [],
                cart: localStorage.getItem('cart') ? JSON.parse(localStorage.getItem('cart')) : {},
                chatId: '-1001385992835',
            }
        },
        mounted() {
            window.axios.get('/api/products').then(response => {
                this.products = response.data;
            })
        },

        methods: {
            addCart(product) {
                let cart = this.cart;

                if(cart[product.id]) {
                    cart[product.id].quantity++;
                } else {
                    cart[product.id] = {
                        ...product,
                        quantity: 1,
                    };
                }

                localStorage.setItem('cart', JSON.stringify(cart))
                this.cart = cart;
                this.$forceUpdate();

            },

            removeElement(id){
                let cart = this.cart;
                delete cart[id]

                localStorage.setItem('cart', JSON.stringify(cart))
                this.cart = cart;
                this.$forceUpdate();
            },

            sendToTelegram() {
                const message = `
                Заказ - ${new Date()}

                
                Товары - ${JSON.stringify(this.cart)}
                `
                const url = 'https://api.telegram.org/' + 'bot972483178:AAEZccqLHo5Ce2f9bOSCNUkhFB17t_uI5hs' + '/sendMessage?chat_id=' +  this.chatId + '&text=' + message
                window.axios.get(url);
            }

        }

    }
</script>
