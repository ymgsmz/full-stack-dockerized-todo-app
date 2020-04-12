<template>
  <div class="todo-item">
    <div class="delete" @click="deleteItem()">
      <span>×</span>
    </div>
    <h3 class="title">{{ item.title }}</h3>
    <div class="horizontal-divider"></div>
    <p class="body">{{ item.body }}</p>
  </div>
</template>

<script>
export default {
  name: "TodoItem",
  props: ["item"],
  methods: {
    deleteItem() {
      this.$emit("deleteItem", this.$vnode.key);
    }
  }
};
</script>

<style scoped>
.todo-item {
  display: flex;
}

.horizontal-divider {
  width: 1px;
  margin: 0px 24px 0 12px;
  height: 80px;
  align-self: center;
  background-color: black;
}

.title {
  align-self: center;
  width: 200px;
}

.body {
  align-self: center;
  width: 400px;
  text-align: justify;
}

.delete > span {
  border-radius: 100%;
  background-color: #aaa;
  display: flex;
  align-items: center;
  place-content: center;
  width: 16px;
  color: #ffffff;
  height: 16px;
}

.delete > span:hover {
  background-color: #c62828;
  cursor: pointer;
}
</style>