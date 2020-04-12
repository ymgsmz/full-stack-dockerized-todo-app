<template>
  <div>
    <div class="list-container">
      <TodoItem v-for="todo in todoList" :key="todo.id" :item="todo" @deleteItem="deleteTodo"></TodoItem>
    </div>

    <div class="todo-inserter">
      <div class="field-container">
        <input class="vertical-margin title" type="text" v-model="title" placeholder="Title" />
        <textarea class="vertical-margin body" rows="8" v-model="body" placeholder="Body" />
      </div>
      <button class="horizontal-margin button" type="button" @click="newTodo()">Submit</button>
    </div>
  </div>
</template>

<script>
import { baseURL } from "@/vars.js";
import TodoItem from "@/components/TodoItem.vue";

export default {
  name: "TodoList",
  data() {
    return {
      todoList: [],
      title: "",
      body: ""
    };
  },
  methods: {
    fetchTodos() {
      console.log(baseURL);
      this.$http.get(baseURL + "list").then(result => {
        this.todoList = result.data;
      });
    },
    newTodo() {
      if (this.title != "" || this.body != "") {
        this.$http
          .get(
            baseURL +
              "new?title=" +
              encodeURIComponent(this.title) +
              "&body=" +
              encodeURIComponent(this.body)
          )
          .then(result => {
            console.log(result);
            this.todoList.unshift({
              id: result.data.id,
              title: this.title,
              body: this.body
            });

            this.title = "";
            this.body = "";
          });
      }
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

.todo-inserter {
  margin-top: 50px;
  display: flex;
  justify-content: center;
}

.vertical-margin {
  margin: 12px 0;
}

.horizontal-margin {
  margin: 0 50px;
}

.field-container {
  display: flex;
  flex-flow: column;
}

.title {
  width: 220px;
  border-width: 1px;
  border-style: solid;
  height: 30px;
  border-radius: 4px;
  box-shadow: 6px 6px 24px -6px #ccc;
  font-size: 18px;
  outline: none;
  border-color: aliceblue;
  padding-left: 5px;
}

.body {
  border-width: 1px;
  border-style: solid;
  border-radius: 4px;
  box-shadow: 6px 6px 24px -6px #ccc;
  font-size: 14px;
  outline: none;
  border-color: aliceblue;
  padding-left: 5px;
  padding-top: 8px;
}

.button {
  height: 45px;
  align-self: center;
  width: 160px;
  outline: none;
  font-size: 18px;
  cursor: pointer;
  font-variant-caps: small-caps;
  border-radius: 8px;
}
</style>