<template>
  <div class="my-2">
    <div v-for="(form, i) in target[prop]" :key="i" class="row mb-3">
      <div class="col-sm">
        <div class="card">
          <div class="card-header d-sm-flex justify-content-sm-between">
            <div>
              <h3>{{ title }} #{{ i }}</h3>
            </div>
            <div>
              <button class="btn btn-danger btn-block" @click="remove()">
                Delete <i class="fa fa-trash"></i>
              </button>
            </div>
          </div>
          <div class="card-body">
            <VueFormGenerator
              :schema="schema"
              :model="target[prop][i]"
              :options="{
                validateAfterLoad: true,
                validateAfterChanged: true,
                validateAsync: true,
                }"
            />
          </div>
        </div>
      </div>
    </div>
    <button class="btn btn-primary" type="button" @click="add()">
      Add New
    </button>
  </div>
</template>

<script>
import { component as VueFormGenerator } from 'vue-form-generator';
import 'vue-form-generator/dist/vfg.css';
export default {
  name: 'DynamicForm',

  components: {
    VueFormGenerator,
  },

  props: {
    title: {
      type: String,
      required: true,
    },
    model: {
      type: Object,
      required: true,
    },
    self: {
      type: String,
      required: true,
    },
    schema: {
      type: Object,
      required: true,
    },
  },

  data() {
    return {
      target: this.model,
      prop: this.self,
    };
  },

  methods: {
    add() {
      const { target, prop } = this.$data;
      if (!target[prop]) {
        this.$set(target, prop, []);
      }
      target[prop].push({});
    },
    remove(i) {
      const { target, prop } = this.$data;

      if (target[prop]) {
        target[prop].splice(i, 1);
      }
    },
  },
};
</script>
