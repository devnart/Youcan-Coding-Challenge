<template>
  <div class="card">
    <div class="card-header">
      <img :src="`/images/${image}`" :alt="name" srcset="" />
    </div>
    <div class="card-body">
      <div class="card-info">
        <h4 class="card-title">{{ name }}</h4>
        <p class="card-text">{{ description }}</p>
      </div>
      <div class="price">
        <span class="price-value">{{ price }}$</span>
      </div>
    </div>
  </div>
</template>

<script>
export default {
  props: ["image", "name", "description", "price"],
};
</script>

<style lang="scss" scoped>
p {
  margin: 0;
}
img {
  width: 100%;
  height: 100%;
  object-fit: cover;
}

.card {
  background: #f7f7f7;
  padding: 10px;
  border-radius: 5px;
  .card-header {
    width: 200px;
    border-radius: 5px;
    height: 250px;
    overflow: hidden;
    margin-bottom: 15px;
  }
  .card-body {
    display: flex;
    align-items: center;
    justify-content: space-between;

    .price-value {
        font-weight: 700;
    font-size: 22px;
    }
  }
}
</style>