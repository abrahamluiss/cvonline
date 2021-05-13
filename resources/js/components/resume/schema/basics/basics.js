export default{
     fields:[
         //name
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'Your name',
             label: 'Name',
             model: 'name',
             styleClasses:['col-md-4', 'p-0', 'pr-md-1'],
         },
         //label
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'Programmer',
             label: 'Label',
             model: 'label',
             styleClasses:['col-md-4','p-0', 'pr-md-1'],

         },
         //email
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'your-name@email.com',
             label: 'Email',
             model: 'email',
             validator: 'email',
             styleClasses:['col-md-4', 'p-0', 'pr-md-1'],
         },
         //Phone
         {
             type: 'input',
             inputType: 'tel',
             placeholder: '94515455',
             label: 'Phone',
             model: 'phone',
             styleClasses:['col-md-6', 'p-0', 'pr-md-1'],
         },
         //Website
         {
             type: 'input',
             inputType: 'text',
             placeholder: 'http://yourwebsite.com',
             label: 'Website',
             model: 'website',
             validator: 'url',
             styleClasses:['col-md-6', 'p-0', 'pr-md-1'],
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
