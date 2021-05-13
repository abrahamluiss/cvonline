<template>
  <div>
    <Tabs>
      <Tab title="Basic" icon="fas fa-user">
        <h1>Test Primero</h1>
      </Tab>

      <VueFormGenerator
        :schema="schemas.basics"
        :model="resume.content.basics"
        :options="options"
      />
    </Tabs>
  </div>
</template>

<script>
import Tabs from './tabs/Tabs';
import Tab from './tabs/Tab';
import basics from './schema/basics/basics';
import { component as VueFormGenerator } from 'vue-form-generator'
import 'vue-form-generator/dist/vfg.css'
export default {
  name: 'ResumeForm',
  components:{
      VueFormGenerator,
      Tabs,
      Tab,
  },
  data(){
      return {
          resume:{
            title: '',
            content: {
                basics: {}
                },
            },
            schemas:{
                basics,
            },
            options:{
                validateAfterLoad: true,
                validateAfterChanged: true,
                validateAsync: true,
            }
    };
  },
};
</script>
