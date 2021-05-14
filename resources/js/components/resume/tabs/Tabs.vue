<template>
  <BTabs pills justified v-model="tab">
    <slot></slot>
    <div class="text-center">
      <BButtonGroup class="w-100">
        <BButton block class="m-0" variant="secondary" @click="tab--">
          Previos
        </BButton>
        <BButton block class="m-0" variant="primary" @click="tab++">
          Next
        </BButton>
      </BButtonGroup>
    </div>
  </BTabs>
</template>

<script>
import { BTabs, BButtonGroup, BButton } from 'bootstrap-vue';
export default {
  name: 'Tabs',
  components: {
    BTabs,
    BButtonGroup,
    BButton,
  },
  data() {
    return {
        tab: 1,
        }
  }
};
</script>
