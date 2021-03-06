<template>
  <div>
    <Alert
      v-if="
        (Array.isArray(alert.messages) && alert.messages.length > 0) ||
          typeof alert.messages === 'string'
      "
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
  methods: {
    validate(target, parent = 'resume') {
      let errors = [];
      for (const [prop, value] of Object.entries(target)) {
        if (Array.isArray(value)) {
          if (value.length === 0) {
            errors.push(`${parent} > ${prop} must have at leat one element`);
            continue;
          }
          for (const i in value) {
            if (typeof value[i] === null || value[i] === '') {
              errors.push(`${parent} > ${prop} > ${i} cannon be empty`);
            } else if (typeof value[i] === 'object') {
              errors = errors.concat(
                this.validate(value, `${parent} > ${prop} > ${i}`)
              );
            } else if (value === null || value === '') {
              errors.push(`${parent} > ${prop} is require`);
            }
          }
        } else if (typeof value === 'object') {
          errors = errors.concat(this.validate(value, `${parent} > ${prop}`));
        } else if (value === null || value === '') {
          errors.push(`${parent}>${prop} is require`);
        }
      }
      return errors;
    },
    isValid() {
      const { alert } = this.$data;
      const { resume } = this.$props;
      alert.messages = [];
      const errors = this.validate(this.resume.content);
      console.log(errors);
      if (errors.length < 1) {
        return true;
      }
      alert.messages = errors.slice(0, 3);
      if (errors.length > 3) {
        alert.messages.push(
          `<strong>${errors.length - 3} more errors...</strong>`
        );
      }
      alert.type = 'warning';
      //this.alert.messages = errors;
      return false;
    },
    async submit() {
      if (!this.isValid()) {
        return;
      }
      const { alert } = this.$data;
      const { resume, update } = this.$props;

      try {
        const res = this.update
          ? await axios.put(route('resumes.update', resume.id), resume)
          : await axios.post(route('resumes.store'), resume);

        //console.log(res);
        window.location = route('resumes.index');
      } catch (e) {
        alert.messages = [];
        const errors = e.response.data.errors;
        for (const [prop, value] of Object.entries(errors)) {
          let origin = prop.split('.');
          if (origin[0] === 'content') {
            origin.splice(0, 1);
          }
          origin = origin.join(' > ');
          for (const error of value) {
            const message = error.replace(prop, `<strong>${origin}</strong>`);
            alert.messages.push(message);
          }
        }
        alert.type = 'danger';
      }
    },
  },
};
</script>
