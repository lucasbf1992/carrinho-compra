<template>
    <div class="product-list-container">
        <div class="product-list-content">
            <h1>Lista de Produtos</h1>
            <span>Escolha uma da opções abaixo:</span>
            <div v-for="product in products" :key="product.id">
                <div class="product">
                    <div class="add-cart">
                        <button class="btn-cart" @click="addToCart(product)">+</button>
                    </div>
                    <div class="product-info">
                        <div class="product-name">{{ product.name }}</div>
                        <div class="product-price">Preço: <span class="price-value">R$ {{ product.price.toFixed(2) }}</span></div>
                    </div>
                </div>

                <hr>
            </div>
        </div>
        <div class="checkout-content">
            <h1>Checkout</h1>
            <p>Resumo da compra:</p>
            <ul v-if="cart.length > 0">
                <li v-for="(item, index) in cart" :key="index">
                    <div class="item-cart">
                        <span class="item-quantity">{{item.quantity}}x</span>
                        <span class="item-name">{{ item.name }}</span>
                        <span class="item-price">R$ {{ item.price.toFixed(2) }}</span>
                    </div>
                </li>
            </ul>
            <p v-else>Nenhum produto no carrinho.</p>

            <div class="total-cart">
            <p class="total-value">Total: R$ {{ total.toFixed(2) }}</p>
            </div>
        </div>

        <div class="finish-cart">
            <button class="btn-finish-cart" @click="fecharPedido" :disabled="cart.length === 0">
                <i class="fas fa-shopping-cart"></i> &nbsp Fechar Pedido
            </button>
        </div>

    </div>
</template>

<script>
export default {
    data() {
        return {
            products: [
                {id: 1, name: 'Produto 1', price: 10.99},
                {id: 2, name: 'Produto 2', price: 19.99},
            ],
            cart: [],
            total: 0,
        };
    },
    methods: {
        addToCart(product) {
            const itemIndex = this.cart.findIndex(item => item.id === product.id);
            if (itemIndex !== -1) {
                this.cart[itemIndex].quantity++;
            } else {
                this.cart.push({...product, quantity: 1});
            }
            this.total += product.price;
        },
    },
};
</script>

<style>

hr {
    border-color: rgba(159,53,255,0.36);
}

li {
    list-style-type: none;
}

.product-list-container {
    padding: 10px;
    border-radius: 10px;
    background-color: #ffff;
    display: flex;
    flex-direction: column;
    justify-content: center;
    align-items: center;
    width: 50%;
    margin: 20% auto;
}

.product-list-content {
    text-align: center;
}

.checkout-content {
    text-align: center;
    width: 90%;
    margin: 0 auto;
}

.product {
    padding: 1rem;
    display: flex;
    justify-content: flex-start;
}

.product-name {
    padding: 0.25rem 1rem;
    font-size: 18px;
    font-weight: bold;
    color: #333;
}

.product-price {
    padding: 0.25rem 1rem;
    color: #777;
}

.price-value {
    font-weight: bold;
    color: #9f35ff;
}

.add-cart {
    display: flex;
    flex-direction: column;
    justify-content: center;
}

.btn-cart {
    background-color: #9f35ff;
    border: none;
    border-radius: 10px;
    padding: 0;
    width: 30px;
    height: 30px;
    display: flex;
    align-items: center;
    justify-content: center;
    color: #ffff;
    font-weight: bold;
}

.finish-cart{
    width: 80%;
    margin-top: auto;
    margin-bottom: 5%;
}

.btn-finish-cart {
    font-size: 16px;
    font-weight: bold;
    display: flex;
    align-items: center;
    justify-content: center;
    padding: 1rem;
    border: none;
    background-color: #9f35ff;
    color: white;
    width: 100%;
}

.btn-finish-cart:disabled {
    border: solid 1px #afafaf;
    background-color: #ffff;
    color: #afafaf;
}

.item-cart {
    display: flex;
    align-items: center;
    padding: 10px;
    margin-bottom: 10px;
    background-color: #f5f5f5;
    border-radius: 5px;
}

.item-quantity {
    font-weight: bold;
    margin-right: 5px;
}

.item-name {
    flex-grow: 1;
}

.item-price {
    font-weight: bold;
    margin-left: 10px;
}

.total-cart {
    display: flex;
    justify-content: center;
    margin-top: 20px;
}

.total-value {
    font-size: 24px;
    font-weight: bold;
    color: #9f35ff;
}

</style>
