const padding = ['p-0', 'pr-md-1'];
const colMd4 = ['col-md-4', ...padding];
const colMd6 = ['col-md-6', ...padding];

export default{
     fields:[
         //picture fields
         {
            type: 'resume-image',
            label: 'Resume Profile Image',
            model: 'picture',

         },
         //name
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'Your name',
             label: 'Name',
             model: 'name',
             styleClasses:colMd4
         },
         //label
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'Programmer',
             label: 'Label',
             model: 'label',
             styleClasses:colMd4

         },
         //email
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'your-name@email.com',
             label: 'Email',
             model: 'email',
             validator: 'email',
             styleClasses:colMd4
         },
         //Phone
         {
             type: 'input',
             inputType: 'tel',
             placeholder: '94515455',
             label: 'Phone',
             model: 'phone',
             styleClasses:colMd6
         },
         //Website
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'http://yourwebsite.com',
             label: 'Website',
             model: 'website',
             validator: 'url',
             styleClasses:colMd6
         },

         //Summary
         {
             type: 'textArea',
             inputType: 'text',
             placeholder: 'lorem lorem',
             label: 'Summary',
             model: 'summary'
         },
     ]
}
