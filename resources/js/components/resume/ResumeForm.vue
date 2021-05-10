<template>
  <div>
      <Tabs>
          <Tab title="Test" icon="fas fa-user">
              <h1>Test Primero</h1>
          </Tab>

          <Tab title="otro">
              <h1>Test Dos</h1>
          </Tab>
          <Tab title="otro">
              <h1>Test Dos</h1>
          </Tab>
          <Tab title="otro">
              <h1>Test Dos</h1>
          </Tab>
          <Tab title="otro">
              <h1>Test Dos</h1>
          </Tab>
      </Tabs>
  </div>
</template>

<script>
import Tabs from './tabs/Tabs';
import Tab from './tabs/Tab';
export default {
  name: 'ResumeForm',
  components:{
      Tabs,
      Tab,
  },
};
</script>
