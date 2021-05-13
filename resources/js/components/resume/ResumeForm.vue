<template>
  <div>
    <Tabs>
      <Tab title="Basic" icon="fas fa-user">

        <VueFormGenerator
            :schema="schemas.basics"
            :model="resume.content.basics"
            :options="options"
        />
        <VueFormGenerator
            :schema="schemas.location"
            :model="resume.content.basics.location"
            :options="options"
        />
      </Tab>
    </Tabs>
  </div>
</template>

<script>
import FieldResumeImage from './vfg/FieldResumeImage';
import Tabs from './tabs/Tabs';
import Tab from './tabs/Tab';
import basics from './schema/basics/basics';
import location from './schema/basics/location';
import { component as VueFormGenerator } from 'vue-form-generator'
import 'vue-form-generator/dist/vfg.css'
export default {
  name: 'ResumeForm',
  components:{
      VueFormGenerator,
      Tabs,
      Tab,
      FieldResumeImage,

  },
  data(){
      return {
          resume:{
            title: '',
            content: {
                basics: {
                    location: {}
                    },
                },
            },
            schemas:{
                basics,
                location,
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
