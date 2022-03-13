<script>
import axios from "axios";
import Product from "../Components/Product.vue";

export default {
  components: {
    Product,
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
    };
  },
  methods: {
    toggleHidden() {
      this.isHidden = !this.isHidden;
    },
    getData() {
      axios
        .get("/api/products")
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
          .get(`/api/products?sort=${this.sortby}&category=${this.category}`)
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
      // console.log(this.image);
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
      <Product
       v-for="product in products" :key="product.id"
        :name="product.name"
        :price="product.price"
        :description="product.description"
        :image="product.image"
      />
      <section class="products">
        <header>
          <div class="title">
            <h3>Products</h3>
            <p>All products</p>
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
              <button @click="toggleHidden()">+ Add Product</button>
            </div>
          </div>
        </header>
        <section class="create-form" v-if="!isHidden">
          <form @submit.prevent="addProduct()" enctype="multipart/form-data">
            <div class="form-group">
              <label for="name">Name</label>
              <input type="text" id="name" name="name" v-model="name" />
            </div>
            <div class="form-group">
              <label for="price">Price</label>
              <input type="text" id="price" name="price" v-model="price" />
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
              <input @change="getImage" type="file" id="image" name="image" />
            </div>
            <div class="form-group">
              <button type="submit">Create</button>
            </div>
          </form>
        </section>
        <div class="table">
          <div class="tbody">
            <div class="thead">
              <div class="tr">
                <div class="th">image</div>
                <div class="th">Id</div>
                <div class="th">Name</div>
                <div class="th product">product</div>
                <div class="th">Options</div>
              </div>
            </div>
            <div class="tr" v-for="product in products" :key="product.id">
              <div class="td">
                <div class="product_info">
                  <div class="product_avatar">
                    <span class="avatar">
                      <img :src="`/images/${product.image}`" />
                    </span>
                  </div>
                  <div class="product_id">
                    <span class="id">#{{ product.id }}</span>
                  </div>
                  <div class="product_name">
                    <span class="name">{{ product.name }}</span>
                  </div>
                  <div class="product_description">
                    <span class="description">{{ product.description }}</span>
                  </div>
                  <div class="product_price">
                    <span class="description">{{ product.price }}</span>
                  </div>
                </div>
              </div>
            </div>
          </div>
        </div>
      </section>
    </div>
  </main>
</template>

<style lang="scss">
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
.thead {
  .tr {
    display: flex;
    justify-content: space-between;
    padding: 15px 10px;
    text-align: center;
    margin: 10px;
    .th {
      color: #000;
      font-size: 14px;
    }
    div {
      flex: 1;
    }
  }
}
.products {
  width: 90%;
  margin: auto;
  .table {
    margin-top: 15px;
  }
  p {
    font-size: 12px;
  }
}

.products h3 {
  font-size: 24px;
  font-weight: 700;
  margin-bottom: 0;
}

.tbody {
  background: #fcfcfc;
  padding: 15px;
  border-radius: 5px;
  width: 100%;
}
.product_info {
  display: flex;
  justify-content: space-between;
  padding: 15px 10px;
  background: white;
  margin: 10px;
  border-radius: 5px;
  text-align: center;
  span {
    color: #6c6c6c;
    font-size: 14px;
  }
  div {
    flex: 1;
  }
}
.product_avatar {
  display: flex;
  align-items: center;
  gap: 10px;

  .avatar {
    width: 35px;
    height: 35px;
    border-radius: 5px;

    img {
      width: 100%;
      height: 100%;
      object-fit: cover;
    }
  }
}
</style>
