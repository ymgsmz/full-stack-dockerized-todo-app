<template>
  <div class="list-container">
    <TodoItem v-for="todo in todoList" :key="todo.id" :item="todo" @deleteItem="deleteTodo"></TodoItem>
  </div>
</template>

<script>
import { baseURL } from "@/vars.js";
import TodoItem from "@/components/TodoItem.vue";

export default {
  name: "TodoList",
  data() {
    return {
      todoList: []
    };
  },
  methods: {
    fetchTodos() {
      console.log(baseURL);
      this.$http.get(baseURL + "list").then(result => {
        this.todoList = result.data;
      });
    },
    deleteTodo(id) {
      console.log(id);
      this.$http.get(baseURL + "delete?id=" + id).then(result => {
        this.$delete(this.todoList, this.findWithAttr(this.todoList, "id", id));
      });
    },
    findWithAttr(array, attr, value) {
      for (var i = 0; i < array.length; i++) {
        if (array[i]["id"] === value) {
          return i;
        }
      }
      return -1;
    }
  },
  created: function() {
    this.fetchTodos();
  },
  components: {
    TodoItem
  }
};
</script>

<style scoped>
.list-container {
  width: 70vh;
  height: 50vh;
  overflow: scroll;
  margin: auto;
}
</style>