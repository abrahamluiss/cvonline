<template>
  <div>
      <Alert
      v-if="Array.isArray(alert.messages) && alert.messages.length> 0 || typeof alert.messages === 'string'"
      :messages="alert.messages"
      :type="alert.type"
      />

    <div class="row mb-3">
      <div class="col-sm-8">
        <div class="form-group">
          <input
            v-model="resume.title"
            placeholder="Resume Title"
            required
            autofocus
            class="form-control w-100"
          />
        </div>
      </div>
      <div class="col-sm-4">
        <button class="btn btn-success btn-block" @click="submit()">
          Submit <i class="fa fa-upload"></i>
        </button>
      </div>
    </div>

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
      <Tab title="Profiles" icon="fas fa-users">
        <DynamicForm
          title="Profile"
          self="profiles"
          :model="resume.content.basics"
          :schema="schemas.profiles"
        />
      </Tab>
      <Tab icon="fa fa-briefcase" title="Work">
        <DynamicForm
          title="Work"
          self="work"
          :model="resume.content"
          :schema="schemas.work"
          :subforms="subforms.work"
        />
      </Tab>
      <Tab icon="fa fa-graduation-cap" title="Education">
        <DynamicForm
          title="Education"
          self="education"
          :model="resume.content"
          :schema="schemas.education"
          :subforms="subforms.education"
        />
      </Tab>
      <Tab icon="fa fa-lightbulb" title="Skills">
        <DynamicForm
          title="Skill"
          self="skills"
          :model="resume.content"
          :schema="schemas.skills"
          :subforms="subforms.skills"
        />
      </Tab>
      <Tab icon="fa fa-trophy" title="Awards">
        <DynamicForm
          title="Awards"
          self="awards"
          :model="resume.content"
          :schema="schemas.awards"
        />
      </Tab>
    </Tabs>
  </div>
</template>

<script>
import jsonresume from './jsonresume';
import basics from './schema/basics/basics';
import location from './schema/basics/location';
import profiles from './schema/basics/profiles';
import work from './schema/work';
import education from './schema/education';
import awards from './schema/awards';
import skills from './schema/skills';
import Alert from '../reusable/Alert';
import FieldResumeImage from './vfg/FieldResumeImage';
import Tabs from './tabs/Tabs';
import Tab from './tabs/Tab';
import { component as VueFormGenerator } from 'vue-form-generator';
import DynamicForm from './dynamic/DynamicForm';
import ListForm from './dynamic/ListForm';
import 'vue-form-generator/dist/vfg.css';

export default {
  name: 'ResumeForm',

  props: {
    update: false,
    resume: {
      type: Object,
      default: () => ({
        id: null,
        title: 'Resume Title',
        content: jsonresume,
      }),
    },
  },
    components: {
    VueFormGenerator,
    Tabs,
    Tab,
    FieldResumeImage,
    DynamicForm,
    ListForm,
    Alert,
  },

  data() {
    return {
        alert: {
            type: '',
            messages: [],
        },
      schemas: {
        basics,
        location,
        profiles,
        work,
        education,
        skills,
        awards,
      },
      subforms: {
        work: [
          {
            component: ListForm,
            props: {
              title: 'Highlights',
              self: 'highlights',
              placeholder: 'started company',
            },
          },
        ],
        education: [
          {
            component: ListForm,
            props: {
              title: 'Courses',
              self: 'courses',
              placeholder: 'Db1101 Basic Sql',
            },
          },
        ],
        skills: [
          {
            component: ListForm,
            props: {
              title: 'Keywords',
              self: 'keywords',
              placeholder: 'Java',
            },
          },
        ],
      },
      options: {
        validateAfterLoad: true,
        validateAfterChanged: true,
        validateAsync: true,
      },
    };
  },
  methods:{
      async submit(){
          try{
              const res = await axios.post('http://localhost:8000/resumes', this.resume);
              console.log(res.data);
              window.location = '/home';
          } catch (e){
              this.alert.messages = ['ha habido un error', 'error aqui'];
          }
      }
  }
};
</script>
