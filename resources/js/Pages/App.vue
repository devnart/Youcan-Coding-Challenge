<script>
import axios from "axios";
import Product from "../Components/Product.vue";
import LaravelVuePagination from "laravel-vue-pagination";
export default {
    components: {
        Product,
        Pagination: LaravelVuePagination,
    },
    data() {
        return {
            isHidden: true,
            products: [],
            sortby: "",
            categories: [],
            category: 0,
            name: "",
            price: "",
            description: "",
            image: null,
            showDisabled: true,
        };
    },
    methods: {
        toggleHidden() {
            this.isHidden = !this.isHidden;
        },
        async getData(page = 1) {
            await axios
                .get("/api/products?page=" + page)
                .then((response) => {
                    this.products = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
        sort() {
            if (this.category != 0) {
                this.products = [];

                axios
                    .get(
                        `/api/products?sort=${this.sortby}&category=${this.category}`
                    )
                    .then((response) => {
                        this.products = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                axios
                    .get(`/api/products?sort=${this.sortby}`)
                    .then((response) => {
                        this.products = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            }
        },
        getCategories() {
            axios
                .get(`/api/categories`)
                .then((response) => {
                    this.categories = response.data;
                })
                .catch((error) => {
                    console.log(error);
                });
        },

        getByCategory() {
            if (this.category != 0) {
                axios
                    .get(`/api/categories/${this.category}`)
                    .then((response) => {
                        this.products = response.data;
                    })
                    .catch((error) => {
                        console.log(error);
                    });
            } else {
                this.getData();
            }
        },
        getImage(file) {
            this.image = file.target.files[0];
        },
        addProduct() {
            const formData = new FormData();
            formData.append("name", this.name);
            formData.append("price", this.price);
            formData.append("description", this.description);
            formData.append("image", this.image);

            axios
                .post("/api/products", formData)
                .then((response) => {
                    this.getData();
                    this.name = "";
                    this.price = "";
                    this.description = "";
                    this.image = null;
                })
                .catch((error) => {
                    console.log(error);
                });
        },
    },
    mounted() {
        this.getData();
        console.log("mounted");
    },
};
</script>

<template>
    <main>
        <div class="container">
            <section class="products">
                <header>
                    <div class="title">
                        <h3>Youcan Coding Challenge</h3>
                    </div>
                    <div class="container">
                        <div class="filters">
                            <h4>Sort By:</h4>
                            <label for="byname">name</label>
                            <input
                                @change="sort"
                                type="radio"
                                id="byname"
                                name="sortby"
                                v-model="sortby"
                                value="name"
                            />

                            <label for="byprice">price</label>
                            <input
                                @change="sort"
                                type="radio"
                                id="byprice"
                                name="sortby"
                                v-model="sortby"
                                value="price"
                            />

                            <select
                                name="category"
                                id="categories"
                                v-model="category"
                                @change="getByCategory"
                                @mouseenter.once="getCategories"
                            >
                                <option value="0">All categories</option>
                                <option
                                    v-for="category in categories"
                                    :key="category.id"
                                    :value="category.id"
                                >
                                    {{ category.name }}
                                </option>
                            </select>
                        </div>
                        <div class="create">
                            <button @click="toggleHidden()">
                                + Add Product
                            </button>
                        </div>
                    </div>
                </header>
                <section class="create-form" v-if="!isHidden">
                    <form
                        @submit.prevent="addProduct()"
                        enctype="multipart/form-data"
                    >
                        <div class="form-group">
                            <label for="name">Name</label>
                            <input
                                type="text"
                                id="name"
                                name="name"
                                v-model="name"
                            />
                        </div>
                        <div class="form-group">
                            <label for="price">Price</label>
                            <input
                                type="text"
                                id="price"
                                name="price"
                                v-model="price"
                            />
                        </div>
                        <div class="form-group">
                            <label for="description">Description</label>
                            <textarea
                                id="description"
                                name="description"
                                v-model="description"
                            ></textarea>
                        </div>
                        <div class="form-group">
                            <label for="image">Image</label>
                            <input
                                @change="getImage"
                                type="file"
                                id="image"
                                name="image"
                            />
                        </div>
                        <div class="form-group">
                            <button type="submit">Create</button>
                        </div>
                    </form>
                </section>
                <div class="cards">
                    <Product
                        v-for="product in products.data"
                        :key="product.id"
                        :name="product.name"
                        :price="product.price"
                        :description="product.description"
                        :image="product.image"
                    />
                </div>
                <pagination
                    :show-disabled=showDisabled
                    align="center"
                    :data="products"
                    @pagination-change-page="getData"
                >
                    <template #prev-nav>
                        <span
                            ><img
                                src="../../images/arrow-square-left.svg"
                                alt=""
                                srcset=""
                        /></span>
                    </template>
                    <template #next-nav>
                        <span
                            ><img
                                src="../../images/arrow-square-right.svg"
                                alt=""
                                srcset=""
                        /></span>
                    </template>
                </pagination>
            </section>
        </div>
    </main>
</template>

<style lang="scss">
.pagination {
    display: flex;
    justify-content: center;
    align-items: center;
    margin: 20px auto;
    padding: 0;
    list-style: none;

    .pagination-next-nav,
    .pagination-prev-nav {
        img {
            display: block;
        }
    }
    .page-item.disabled {
        opacity: 0.4;
    }
    .pagination-page-nav.active {
        background-color: #353535;
        color: white;
    }
    .pagination-page-nav {
        background: #f4f4f4;
        padding: 5px 10px;
        margin: 0 5px;
        border-radius: 5px;
    }
    .sr-only {
        display: none;
    }
}
a {
    text-decoration: none;
}

p {
    margin: 0;
    margin-bottom: 20px;
}

h4 {
    margin: 0;
}

.container {
    display: flex;
    justify-content: space-between;
    align-items: center;
}
.cards {
    display: flex;
    flex-wrap: wrap;
    justify-content: center;
    gap: 20px;
    margin-top: 40px;
}
select {
    background: #f8f8f8;
    padding: 10px;
    margin: 0 10px;
    border-radius: 5px;
    outline: none;
    cursor: pointer;
}
.create-form {
    background: #f4f4f4;
    padding: 20px;
    border-radius: 10px;
    margin: 30px 0;

    form {
        width: 90%;
        margin: 0 auto;

        .form-group {
            display: flex;
            flex-direction: column;
            gap: 5px;
            margin-top: 10px;

            input:not([type="file"]) {
                padding: 15px 10px;
                border-radius: 5px;
                margin-top: 5px;
            }
        }
    }

    button {
        background-color: #212121;
        color: #fff;
        &:hover {
            color: #212121;
            background: #ddd;
        }
    }
}
button {
    border-radius: 5px;
    padding: 15px;
    font-size: 16px;
    cursor: pointer;
    color: #212121;

    &:hover {
        background-color: #212121;
        color: #fff;
    }
}
.products {
    margin: 0 auto;
    width: 90%;
}
</style>
